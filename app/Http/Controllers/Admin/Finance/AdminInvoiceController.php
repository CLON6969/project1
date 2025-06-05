<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

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
}


