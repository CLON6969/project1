<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('admin.finance.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('admin.finance.invoices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:50|unique:invoices',
            'client_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,paid,overdue',
            'service_id' => 'nullable|exists:services_table,id',
            'solution_id' => 'nullable|exists:solution_tables,id',
            'notes' => 'nullable|string',
        ]);

        Invoice::create($validated);

        return redirect()->route('admin.finance.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        return view('admin.finance.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.finance.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:50|unique:invoices,invoice_number,' . $invoice->id,
            'client_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,paid,overdue',
            'service_id' => 'nullable|exists:services_table,id',
            'solution_id' => 'nullable|exists:solution_tables,id',
            'notes' => 'nullable|string',
        ]);

        $invoice->update($validated);

        return redirect()->route('admin.finance.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.finance.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }



public function payInvoice(Invoice $invoice)
{
    if ($invoice->user_id !== Auth::id()) {
        abort(403);
    }

    return view('user.finance.payments.pay_invoice', compact('invoice'));
}

public function storeInvoicePayment(Request $request, Invoice $invoice)
{
    if ($invoice->user_id !== Auth::id() || $invoice->status !== 'unpaid') {
        return back()->withErrors('Unauthorized or already paid.');
    }

    $request->validate([
        'payment_method' => 'required|in:mobile,card,bank',
        'mobile_number' => 'required_if:payment_method,mobile|regex:/^(\+260|0)?(95|96|97|76|77)\d{7}$/',
        'card_number' => 'required_if:payment_method,card',
        'bank_proof' => 'required_if:payment_method,bank|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'notes' => 'nullable|string|max:1000',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'invoice_id' => $invoice->id,
        'reference' => strtoupper(Str::uuid()),
        'amount' => $invoice->amount,
        'payment_method' => $request->payment_method,
        'transaction_type' => 'InvoicePayment',
        'status' => 'pending',
        'api_status' => 'not_applicable',
        'narration' => 'Payment for Invoice #' . $invoice->number,
        'notes' => $request->notes,
    ];

    if ($request->payment_method === 'mobile') {
        $data['mobile_number'] = $request->mobile_number;
    } elseif ($request->payment_method === 'card') {
        $data['card_number'] = $request->card_number;
    } elseif ($request->payment_method === 'bank') {
        $data['bank_proof'] = $request->file('bank_proof')->store('bank_proofs', 'public');
    }

    Payment::create($data);

    return redirect()->route('payments.index')->with('success', 'Invoice payment submitted and is pending review.');
}

}


