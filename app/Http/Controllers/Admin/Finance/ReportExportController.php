<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PaymentsExport;
use App\Exports\InvoicesExport;
use App\Exports\ExpensesExport;
use App\Exports\BudgetsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportController extends Controller
{
    public function exportPayments(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        return Excel::download(new PaymentsExport($from, $to), 'payments_report.xlsx');
    }

    public function exportInvoices(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        return Excel::download(new InvoicesExport($from, $to), 'invoices_report.xlsx');
    }

    public function exportExpenses(Request $request)
    {
        $month = $request->input('month');
        $category = $request->input('category');

        return Excel::download(new ExpensesExport($month, $category), 'expenses_report.xlsx');
    }

    public function exportBudgets(Request $request)
    {
        $period = $request->input('period');

        return Excel::download(new BudgetsExport($period), 'budgets_report.xlsx');
    }
}
