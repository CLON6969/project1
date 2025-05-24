<?php

namespace App\Http\Controllers\finance;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
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
            'payment_method' => 'required|in:mobile,card,bank',
            'mobile_number' => [
                           'required_if:payment_method,mobile',
                           'regex:/^(\+260|0)?(95|96|97|76|77)\d{7}$/',
                              ],
            'card_number' => 'required_if:payment_method,card',
            'bank_proof' => 'required_if:payment_method,bank|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'transaction_type' => 'Payment',
            'reference' => strtoupper(Str::random(10)),
            'narration' => Auth::user()->name,
            'amount' => $request->input('amount'), // You can make this dynamic later
            'payment_method' => $request->payment_method,
            'status' => 'pending',
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

        return redirect()->back()->with('success', 'Payment submitted successfully and is pending approval.');
    }
}
