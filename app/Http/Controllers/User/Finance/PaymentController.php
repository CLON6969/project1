<?php

namespace App\Http\Controllers\user\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\invoice;
use App\Models\PendingSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())->latest()->get();

        return view('user.finance.payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $subscription = PendingSubscription::findOrFail($request->subscription_id);

        if ($subscription->user_id !== Auth::id() || $subscription->status !== 'approved') {
            abort(403, 'Unauthorized or subscription not approved.');
        }

        return view('user.finance.payments.create', [
            'subscription' => $subscription,
            'plan' => $subscription->plan,
            'amount' => $subscription->plan->amount,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pending_subscription_id' => 'required|exists:pending_subscriptions,id',
            'payment_method' => 'required|in:mobile,card,bank',
            'mobile_number' => [
                'required_if:payment_method,mobile',
                'regex:/^(\+260|0)?(95|96|97|76|77)\d{7}$/'
            ],
            'card_number' => 'required_if:payment_method,card',
            'bank_proof' => 'required_if:payment_method,bank|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'notes' => 'nullable|string|max:1000',
        ]);

        $subscription = PendingSubscription::findOrFail($request->pending_subscription_id);

        if ($subscription->user_id !== Auth::id() || $subscription->status !== 'approved') {
            return redirect()->back()->withErrors('Unauthorized or subscription not approved.');
        }

        $data = [
            'user_id' => Auth::id(),
            'pending_subscription_id' => $subscription->id,
            'reference' => strtoupper(Str::uuid()),
            'amount' => $subscription->plan->amount,
            'payment_method' => $request->payment_method,
            'transaction_type' => 'MemberRegistrationPayment',
            'status' => 'pending',
            'api_status' => 'not_applicable',
            'notes' => $request->notes,
            'narration' => 'Payment for subscription: ' . $subscription->plan->name,
        ];

        if ($request->payment_method === 'mobile') {
            $data['mobile_number'] = $request->mobile_number;
        } elseif ($request->payment_method === 'card') {
            $data['card_number'] = $request->card_number;
        } elseif ($request->payment_method === 'bank') {
            $path = $request->file('bank_proof')->store('bank_proofs', 'public');
            $data['bank_proof'] = $path;
        }

        Payment::create($data);

        return redirect()->route('payments.index')->with('success', 'Payment submitted successfully and is now pending review.');
    }


    public function createGeneral()
{
    $services = ['Consultation', 'Support', 'Custom Development', 'Other']; // Replace with your real services if dynamic
    return view('user.finance.payments.general_create', compact('services'));
}

public function storeGeneral(Request $request)
{
    $request->validate([
        'service' => 'required|string|max:255',
        'notes' => 'nullable|string|max:1000',
        'payment_method' => 'required|in:mobile,card,bank',
        'mobile_number' => [
            'required_if:payment_method,mobile',
            'regex:/^(\+260|0)?(95|96|97|76|77)\d{7}$/'
        ],
        'card_number' => 'required_if:payment_method,card',
        'bank_proof' => 'required_if:payment_method,bank|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'amount' => 'required|numeric|min:1',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'reference' => strtoupper(Str::uuid()),
        'amount' => $request->amount,
        'payment_method' => $request->payment_method,
        'transaction_type' => 'GeneralServicePayment',
        'status' => 'pending',
        'api_status' => 'not_applicable',
        'notes' => $request->notes,
        'narration' => 'Payment for service: ' . $request->service,
    ];

    if ($request->payment_method === 'mobile') {
        $data['mobile_number'] = $request->mobile_number;
    } elseif ($request->payment_method === 'card') {
        $data['card_number'] = $request->card_number;
    } elseif ($request->payment_method === 'bank') {
        $data['bank_proof'] = $request->file('bank_proof')->store('bank_proofs', 'public');
    }

    Payment::create($data);

    return redirect()->route('payments.index')->with('success', 'Payment submitted successfully.');
}



public function createFromInvoice($id)
{
    $invoice = Invoice::where('id', $id)
        ->where('user_id', Auth::id())
        ->where('is_paid', false)
        ->firstOrFail();

    // Generate random reference (e.g., UUID or numeric)
    $reference = strtoupper(Str::random(10));

    return view('user.finance.invoices.pay', compact('invoice', 'reference'));
}

public function storeInvoicePayment(Request $request, $id)
{
    $invoice = Invoice::where('id', $id)
        ->where('user_id', Auth::id())
        ->where('is_paid', false)
        ->firstOrFail();

    // Check if payment already exists for this invoice
    $existingPayment = Payment::where('invoice_id', $invoice->id)
        ->where('user_id', Auth::id())
        ->whereNotIn('status', ['rejected', 'failed']) // optional: allow resubmission if rejected
        ->first();

    if ($existingPayment) {
        return redirect()->back()->withErrors(['invoice' => 'Payment has already been submitted for this invoice.']);
    }

    $request->validate([
        'payment_method' => 'required|in:mobile,card,bank',
        'reference' => 'required|string|unique:payments,reference',
    ]);

    Payment::create([
        'user_id' => Auth::id(),
        'invoice_id' => $invoice->id,
        'amount' => $invoice->amount,
        'payment_method' => $request->payment_method,
        'reference' => $request->reference,
        'transaction_type' => 'InvoicePayment',
        'status' => 'pending',
        'narration' => 'Invoice #' . $invoice->number,
        'api_status' => 'not_applicable',
    ]);

    return redirect()->route('payments.index')->with('success', 'Payment submitted for approval. Admin will review it.');
}

    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('user.finance.payments.show', compact('payment'));
    }

    public function fillForm(Payment $payment)
{
    // Optional: authorize the user to only see their own payment
    if ($payment->user_id !== auth()->id()) {
        abort(403);
    }

    return view('user.finance.payments.create', [
        'payment' => $payment,
        'amount' => $payment->amount
    ]);
}

public function proceed(Payment $payment)
{
    return view('user.finance.payments.proceed', compact('payment'));
}


public function cancel($id)
{
    $payment = Payment::where('id', $id)
        ->where('user_id', Auth::id())
        ->where('status', 'pending') // Only allow canceling if not approved
        ->firstOrFail();

    // Optionally delete file if bank proof was uploaded
    if ($payment->bank_proof) {
        Storage::disk('public')->delete($payment->bank_proof);
    }

    $payment->delete();

    return redirect()->route('payments.index')->with('success', 'Payment cancelled successfully.');
}


}


