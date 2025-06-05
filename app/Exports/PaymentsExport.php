<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection, WithHeadings
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
        return Payment::whereBetween('paid_at', [$this->from, $this->to])
            ->get([
                'id',
                'reference',
                'amount',
                'payment_method',
                'transaction_type',
                'narration',
                'paid_at',
                'status'
            ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Reference',
            'Amount',
            'Payment Method',
            'Transaction Type',
            'Narration',
            'Paid At',
            'Status'
        ];
    }
}
