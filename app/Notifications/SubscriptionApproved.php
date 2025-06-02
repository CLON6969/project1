<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\PendingSubscription;

class SubscriptionApproved extends Notification implements ShouldQueue
{
    use Queueable;

    public $subscription;
public function __construct(PendingSubscription $subscription)
{
    $this->subscription = $subscription;
}


    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Subscription Has Been Approved')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your subscription for the "' . $this->subscription->plan->plan_tittle . '" plan has been approved.')
            ->action('Complete Payment', route('payments.create', ['subscription_id' => $this->subscription->id]))
            ->line('Thank you for choosing our service!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your subscription for "' . $this->subscription->plan->plan_tittle . '" was approved.',
            'link' => route('payments.create', ['subscription_id' => $this->subscription->id]),
        ];
    }
}
