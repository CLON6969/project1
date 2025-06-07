
Route::middleware(['auth', 'role:3'])->group(function () {

    // Dashboard
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Subscription Plan Selection
    Route::get('/select-payment', [PaymentController::class, 'select'])->name('payment.select');
    Route::post('/user/finance/payments/subscription/apply', [SubscriptionController::class, 'apply'])->name('subscription.apply');
     Route::post('/subscription/apply', [SubscriptionController::class, 'apply'])->name('subscription.apply');
    Route::get('/finance/subscription/thankyou', [SubscriptionController::class, 'thankYou'])->name('finance.subscription.thankyou');

    // User Profile
    Route::get('/user/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');

});
