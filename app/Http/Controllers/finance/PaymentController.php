<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function create()
    {
        return view('user.finance.payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:mobile,card,bank',
            'mobile_number' => [
                'required_if:payment_method,mobile',
                'regex:/^(\+260|0)?(95|96|97|76|77)\d{7}$/'
            ],
            'card_number' => 'required_if:payment_method,card',
            'bank_proof' => 'required_if:payment_method,bank|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'invoice_id' => 'nullable|exists:invoices,id',
            'notes' => 'nullable|string',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'transaction_type' => 'MemberRegistrationPayment',
            'reference' => strtoupper(Str::random(10)),
            'narration' => Auth::user()->name,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'api_status' => 'not_applicable',
            'notes' => $request->notes,
            'invoice_id' => $request->invoice_id,
        ];

        if ($request->payment_method === 'mobile') {
            $data['mobile_number'] = $request->mobile_number;
        } elseif ($request->payment_method === 'card') {
            $data['card_number'] = $request->card_number;
        } elseif ($request->payment_method === 'bank') {
            $data['bank_proof'] = $request->file('bank_proof')->store('bank_proofs', 'public');
        }

        Payment::create($data);

        return redirect()->back()->with('success', 'Payment submitted successfully and is pending approval.');
    }
}
