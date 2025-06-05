<?php

namespace App\Exports;

use App\Models\Budget;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BudgetsExport implements FromCollection, WithHeadings
{
    protected $period;

    public function __construct($period)
    {
        $this->period = $period;
    }

    public function collection()
    {
        return Budget::where('period', $this->period)
            ->get(['id', 'category', 'amount', 'period', 'created_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Category', 'Amount', 'Period', 'Created At'];
    }
}
