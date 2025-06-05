<?php
namespace App\Http\Controllers;

use App\Models\PendingSubscription;
use App\Models\Package;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionApprovedMail;

class SubscriptionController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user = Auth::user();

        $existing = PendingSubscription::where('user_id', $user->id)
            ->where('plan_id', $request->plan_id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['You already have a pending or approved subscription for this plan.']);
        }

        PendingSubscription::create([
            'user_id' => $user->id,
            'package_id' => $request->package_id,
            'plan_id' => $request->plan_id,
            'status' => 'pending',
        ]);

        return redirect()->route('finance.subscription.thankyou');
    }

    public function index()
    {
        $subscriptions = PendingSubscription::with(['user', 'package', 'plan'])->latest()->paginate(20);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function pending()
    {
        $subscriptions = PendingSubscription::pending()->with(['user', 'package', 'plan'])->latest()->paginate(20);
        return view('admin.subscriptions.pending', compact('subscriptions'));
    }

    public function approved()
    {
        $subscriptions = PendingSubscription::approved()->with(['user', 'package', 'plan'])->latest()->paginate(20);
        return view('admin.subscriptions.approved', compact('subscriptions'));
    }

    public function rejected()
    {
        $subscriptions = PendingSubscription::rejected()->with(['user', 'package', 'plan'])->latest()->paginate(20);
        return view('admin.subscriptions.rejected', compact('subscriptions'));
    }

    public function show($id)
    {
        $subscription = PendingSubscription::with(['user', 'package', 'plan', 'payments'])->findOrFail($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function edit($id)
    {
        $subscription = PendingSubscription::findOrFail($id);
        $packages = Package::all();
        $plans = Plan::all();
        return view('admin.subscriptions.edit', compact('subscription', 'packages', 'plans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $subscription = PendingSubscription::findOrFail($id);
        $oldStatus = $subscription->status;

        $subscription->update([
            'package_id' => $request->package_id,
            'plan_id' => $request->plan_id,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        // Send email if status changed to approved
        if ($oldStatus !== 'approved' && $request->status === 'approved') {
            try {
                Mail::to($subscription->user->email)->send(new SubscriptionApprovedMail($subscription));
            } catch (\Exception $e) {
                return redirect()->route('admin.subscriptions.show', $subscription->id)
                    ->withErrors(['error' => 'Updated, but email failed: ' . $e->getMessage()]);
            }
        }

        return redirect()->route('admin.subscriptions.show', $subscription->id)
                         ->with('success', 'Subscription updated successfully.');
    }

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

    public function reject($id)
    {
        $subscription = PendingSubscription::findOrFail($id);
        $subscription->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Subscription rejected.');
    }

    public function destroy($id)
    {
        $subscription = PendingSubscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted.');
    }

    public function thankYou()
    {
        return view('user.finance.subscription.thankyou');
    }
}
