<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
}
