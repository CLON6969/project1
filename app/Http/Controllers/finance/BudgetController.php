<?php
namespace App\Http\Controllers\Finance;

use App\Models\Budget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index() {
        $budgets = Budget::where('user_id', Auth::id())->get();
        return view('finance.budgets.index', compact('budgets'));
    }

    public function create() {
        return view('finance.budgets.create');
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget created successfully.');
    }
}
