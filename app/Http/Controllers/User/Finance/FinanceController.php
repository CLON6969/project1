<?php

namespace App\Http\Controllers\user\Finance;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;



class FinanceController extends Controller
{
public function index()
{
    $userId = Auth::id();

    return view('user.finance.index', [
        'totalPayments' => Payment::where('user_id', $userId)->sum('amount'),
        'totalExpenses' => Expense::where('user_id', $userId)->sum('amount'),
        'totalBudgets' => Budget::where('user_id', $userId)->sum('amount'),
        'unpaidInvoices' => Invoice::where('user_id', $userId)->where('status', 'unpaid')->get(),

        // Chart-specific datasets
        'paymentsOverTime' => Payment::where('user_id', $userId)
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get(),

        'expensesByCategory' => Expense::where('user_id', $userId)
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get(),

        'budgetVsActual' => Budget::where('user_id', $userId)
            ->selectRaw('category, SUM(amount) as budget')
            ->groupBy('category')
            ->get()
            ->map(function ($budget) use ($userId) {
                $actual = Expense::where('user_id', $userId)
                    ->where('category', $budget->category)
                    ->sum('amount');
                return [
                    'category' => $budget->category,
                    'budget' => $budget->budget,
                    'actual' => $actual
                ];
            }),

        'invoicesByDueDate' => Invoice::where('user_id', $userId)
            ->where('status', 'unpaid')
            ->selectRaw('due_date, SUM(amount) as total')
            ->groupBy('due_date')
            ->orderBy('due_date')
            ->get(),
    ]);
}


}




