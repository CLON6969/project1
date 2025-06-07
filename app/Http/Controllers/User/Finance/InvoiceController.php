<?php
namespace App\Http\Controllers\user\Finance;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    
public function index() {
    $invoices = Invoice::where('user_id', Auth::id())->get();
    return view('user.finance.invoices.index', compact('invoices'));
}


    public function create() {
        return view('user.finance.invoices.create'); // Usually a different view for create
    }

    public function store(Request $request) {
        $request->validate([
            'number' => 'required|unique:invoices',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'due_date' => 'nullable|date',
        ]);

        Invoice::create([
            'user_id' => Auth::id(),
            'number' => $request->number,
            'description' => $request->description,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('user.finance.invoices.index')->with('success', 'Invoice created successfully.');
    }
}


