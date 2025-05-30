<?php


namespace App\Mail;

use App\Models\PendingSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;

    public function __construct(PendingSubscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this->subject('Your Subscription Has Been Approved')
                    ->view('emails.subscription_approved')
                    ->with([
                        'subscription' => $this->subscription,
                        'user' => $this->subscription->user,
                        'plan' => $this->subscription->plan,
                        'paymentUrl' => route('payments.create', ['subscription_id' => $this->subscription->id])
                    ]);
    }
}
