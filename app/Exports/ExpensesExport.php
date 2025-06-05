<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class ExpensesExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $category;

    public function __construct($month, $category)
    {
        $this->month = $month;
        $this->category = $category;
    }

    public function collection()
    {
        $query = Expense::query();

        if ($this->month) {
            $query->whereMonth('date', Carbon::parse($this->month)->month)
                  ->whereYear('date', Carbon::parse($this->month)->year);
        }

        if ($this->category && $this->category !== 'all') {
            $query->where('category', $this->category);
        }

        return $query->get(['id', 'description', 'amount', 'category', 'date']);
    }

    public function headings(): array
    {
        return ['ID', 'Description', 'Amount', 'Category', 'Date'];
    }
}
