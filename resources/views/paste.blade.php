**`resources/views/admin/subscriptions/index.blade.php`**
```blade

```

**`resources/views/admin/subscriptions/pending.blade.php`**
```blade


**`resources/views/admin/subscriptions/approved.blade.php`**
```blade

```

**`resources/views/admin/subscriptions/rejected.blade.php`**
```blade

```

**`resources/views/admin/subscriptions/show.blade.php`**
```blade

```

**`resources/views/admin/subscriptions/edit.blade.php`**
```blade

```

**`resources/views/components/subscription-table.blade.php`**
```blade

```

**`resources/views/user/finance/subscription/thankyou.blade.php`**
```blade
@extends('layouts.user')

@section('content')
    <div class="p-6 text-center">
        <h1 class="text-2xl font-bold mb-2">Thank You!</h1>
        <p>Your subscription request has been submitted successfully. Please wait for admin approval.</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-4">Return to Dashboard</a>
    </div>
@endsection
```



Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->````````````````````````````````````````````````````````````````````````` `````````\]``````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````                                                       
        
        
                                    ('user.dashboard');


    // Finicial Routes

Route::prefix('user/finance')->middleware('auth')->group(function () {


    // Payments
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
    });





});
