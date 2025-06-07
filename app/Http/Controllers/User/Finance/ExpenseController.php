<?php
namespace App\Http\Controllers\user\Finance;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index() {
        $expenses = Expense::where('user_id', Auth::id())->get();
        return view('user.finance.expenses.index', compact('expenses'));
    }

    public function create() {
        return view('user.finance.expenses.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Expense::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'category' => $request->category,
            'notes' => $request->notes,
            'date' => $request->date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
    }
}

