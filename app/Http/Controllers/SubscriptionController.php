<?php

namespace App\Http\Controllers;

use App\Models\PendingSubscription;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Mail\SubscriptionApprovedMail;
use Illuminate\Support\Facades\Mail;


class SubscriptionController extends Controller
{


    // app/Http/Controllers/SubscriptionController.php


public function apply(Request $request)
{
    $request->validate([
        'package_id' => 'required|exists:packages,id',
        'plan_id' => 'required|exists:plans,id',
    ]);

    $user = Auth::user();

    // Check if user already has a pending or approved subscription for same plan
    $existing = PendingSubscription::where('user_id', $user->id)
        ->where('plan_id', $request->plan_id)
        ->whereIn('status', ['pending', 'approved'])
        ->first();

    if ($existing) {
        return redirect()->back()->withErrors(['You already have a pending or approved subscription for this plan.']);
    }

    $subscription = PendingSubscription::create([
        'user_id' => $user->id,
        'package_id' => $request->package_id,
        'plan_id' => $request->plan_id,
        'status' => 'pending',
    ]);

    return redirect()->route('subscription.thankyou');
}

    // User: Submits a subscription request
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        PendingSubscription::create([
            'user_id' => Auth::id(),
            'plan_id' => $request->plan_id,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Subscription request submitted.');
    }

    // Admin: View all subscriptions
    public function index()
    {
        $subscriptions = PendingSubscription::with('user', 'plan')->latest()->paginate(20);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    // Admin: View pending subscriptions
    public function listPending()
    {
        $subscriptions = PendingSubscription::with('user', 'plan')
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);

        return view('admin.subscriptions.pending', compact('subscriptions'));
    }

    // Admin: View approved subscriptions
    public function approved()
    {
        $subscriptions = PendingSubscription::with('user', 'plan')
            ->where('status', 'approved')
            ->latest()
            ->paginate(20);

        return view('admin.subscriptions.approved', compact('subscriptions'));
    }

    // Admin: View rejected subscriptions
    public function rejected()
    {
        $subscriptions = PendingSubscription::with('user', 'plan')
            ->where('status', 'rejected')
            ->latest()
            ->paginate(20);

        return view('admin.subscriptions.rejected', compact('subscriptions'));
    }

    // Admin: Approve a subscription and notify user

public function approve($id)
{
    try {
        $subscription = PendingSubscription::with(['user', 'plan'])->findOrFail($id);
        $subscription->status = 'approved';
        $subscription->save();



        Mail::to($subscription->user->email)->send(new SubscriptionApprovedMail($subscription));

        return back()->with('success', 'Subscription approved and email sent to user.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Failed to approve subscription: ' . $e->getMessage()]);
    }
}



    public function thankYou()
{
    return view('user.subscription.thankyou');
}

}

