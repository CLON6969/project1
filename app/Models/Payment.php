<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pending_subscription_id',
        'transaction_type',
        'reference',
        'narration',
        'amount',
        'payment_method',
        'mobile_number',
        'card_number',
        'transaction_id',
        'api_status',
        'gateway_response',
        'bank_proof',
        'invoice_id',
        'paid_at',
        'status',
        'notes',
    ];

    protected $dates = ['paid_at'];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendingSubscription()
    {
        return $this->belongsTo(PendingSubscription::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    

    /**
     * Accessors / Helpers
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}


