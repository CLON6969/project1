<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class AdminExpenseController extends Controller
{
    /**
     * Display a listing of all expenses.
     */
    public function index()
    {
        $expenses = Expense::with('user')->latest()->paginate(20);
        return view('admin.finance.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense)
    {
        return view('admin.finance.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified expense.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'date' => 'required|date',
        ]);

        $expense->update($validated);

        return redirect()->route('admin.finance.expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    /**
     * Display the specified expense details.
     */
    public function show(Expense $expense)
    {
        return view('admin.finance.expenses.show', compact('expense'));
    }

    /**
     * Remove the specified expense.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.finance.expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}



