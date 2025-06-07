<?php

namespace App\Http\Controllers\user\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
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
}


