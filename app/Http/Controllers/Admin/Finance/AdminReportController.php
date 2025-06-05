<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    /**
     * Show a dashboard-style finance summary report.
     */
    public function index()
    {
        $totalPayments = Payment::where('status', 'approved')->sum('amount');
        $totalExpenses = Expense::sum('amount');
        $totalBudgets = Budget::sum('amount');
        $unpaidInvoices = Invoice::where('status', 'unpaid')->sum('amount');
        $overdueInvoices = Invoice::where('status', 'overdue')->count();

        $paymentsByMethod = Payment::select('payment_method', DB::raw('SUM(amount) as total'))
            ->where('status', 'approved')
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method');

        $expensesByCategory = Expense::select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');

        $budgetAllocations = Budget::select('category', 'amount')
            ->get()
            ->groupBy('category');

        return view('admin.finance.reports.index', compact(
            'totalPayments',
            'totalExpenses',
            'totalBudgets',
            'unpaidInvoices',
            'overdueInvoices',
            'paymentsByMethod',
            'expensesByCategory',
            'budgetAllocations'
        ));
    }

    /**
     * Show detailed report by type (payments, invoices, expenses, budgets).
     */
    public function details($type)
    {
        switch ($type) {
            case 'payments':
                $records = Payment::with('user')->latest()->paginate(20);
                break;
            case 'invoices':
                $records = Invoice::latest()->paginate(20);
                break;
            case 'expenses':
                $records = Expense::with('user')->latest()->paginate(20);
                break;
            case 'budgets':
                $records = Budget::with('user')->latest()->paginate(20);
                break;
            default:
                abort(404);
        }

        return view('admin.finance.reports.details', compact('type'))->with([$type => $records]);
    }
}