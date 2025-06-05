<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        return Invoice::whereBetween('created_at', [$this->from, $this->to])
            ->get(['id', 'invoice_number', 'client_name', 'total', 'status', 'created_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Invoice Number', 'Client Name', 'Total', 'Status', 'Created At'];
    }
}
