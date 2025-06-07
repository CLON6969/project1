<?php
namespace App\Http\Controllers\user\Finance;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index() {
        return view('user.finance.reports.index', [
            'totalPayments' => Payment::where('user_id', Auth::id())->sum('amount'),
            'totalExpenses' => Expense::where('user_id', Auth::id())->sum('amount'),
            'totalBudgets' => Budget::where('user_id', Auth::id())->sum('amount'),
            'unpaidInvoices' => Invoice::where('user_id', Auth::id())->where('status', 'unpaid')->get(),
        ]);
    }
}


