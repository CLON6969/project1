<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of all payments.
     */
    public function index()
    {
        $payments = Payment::with('user')->latest()->paginate(20);
        return view('admin.finance.payments.index', compact('payments'));
    }

    /**
     * Show the form for editing a specific payment.
     */
    public function edit(Payment $payment)
    {
        return view('admin.finance.payments.edit', compact('payment'));
    }

    /**
     * Update the specified payment.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'reference' => 'nullable|string|max:255',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.finance.payments.index')
            ->with('success', 'Payment updated successfully.');
    }


    

    /**
     * Display the specified payment details.
     */
    public function show(Payment $payment)
    {
        return view('admin.finance.payments.show', compact('payment'));
    }
}




