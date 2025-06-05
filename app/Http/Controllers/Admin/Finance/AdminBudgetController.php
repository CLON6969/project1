<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('user')->latest()->paginate(10);
        return view('admin.finance.budgets.index', compact('budgets'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.finance.budgets.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Budget::create($request->all());

        return redirect()->route('admin.finance.budgets.index')->with('success', 'Budget created successfully.');
    }

    public function show(Budget $budget)
    {
        return view('admin.finance.budgets.show', compact('budget'));
    }

    public function edit(Budget $budget)
    {
        $users = User::all();
        return view('admin.finance.budgets.edit', compact('budget', 'users'));
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $budget->update($request->all());

        return redirect()->route('admin.finance.budgets.index')->with('success', 'Budget updated successfully.');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('admin.finance.budgets.index')->with('success', 'Budget deleted.');
    }
}
