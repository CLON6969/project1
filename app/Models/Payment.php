<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model {
    protected $fillable = [
        'user_id', 'transaction_type', 'reference', 'narration', 'amount', 'payment_method',
        'mobile_number', 'card_number', 'transaction_id', 'api_status', 'gateway_response',
        'bank_proof', 'invoice_id', 'paid_at', 'status', 'notes'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
