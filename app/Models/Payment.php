<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_type',
        'reference',
        'narration',
        'amount',
        'payment_method',
        'mobile_number',
        'card_number',
        'bank_proof',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
