<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index()
    {
        return view('user/finance/index');
    }

    public function invoices()
    {
        return view('user/finance/invoices/invoices');
    }

    public function expenses()
    {
        return view('user/finance/expenses/expenses');
    }

    public function budget()
    {
        return view('user/finance/budget/budget');
    }

    public function reports()
    {
        return view('user.finance.reports.reports');
    }

    





}
