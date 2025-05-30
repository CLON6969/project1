<!DOCTYPE html>
<html>
<head>
    <title>Subscription Approved</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>Your subscription for the <strong>{{ $plan->plan_tittle }}</strong> plan has been approved.</p>
    <p>Please complete your payment by clicking the button below:</p>
    <p>
        <a href="{{ $paymentUrl }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">Complete Payment</a>
    </p>
    <p>Thank you for choosing our service!</p>
</body>
</html>
