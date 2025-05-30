// Admin Dashboard (Role: admin only)
// -------------------------------------
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Add more admin-specific routes here

    // Add more admin-specific routes here

Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions.index');
    Route::get('/subscriptions/pending', [SubscriptionController::class, 'pending'])->name('admin.subscriptions.pending');
    Route::get('/subscriptions/approved', [SubscriptionController::class, 'approved'])->name('admin.subscriptions.approved');
    Route::get('/subscriptions/rejected', [SubscriptionController::class, 'rejected'])->name('admin.subscriptions.rejected');

        // Admin: View pending subscription applications
    Route::get('/admin/subscriptions/pending', [SubscriptionController::class, 'listPending'])
        ->name('admin.subscriptions.pending');

    // Admin: Approve a specific subscription by ID
    Route::post('/admin/subscriptions/{id}/approve', [SubscriptionController::class, 'approve'])
        ->name('admin.subscriptions.approve');



});




Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');


    // Finicial Routes

Route::prefix('user/finance')->middleware('auth')->group(function () {


    // Payments
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
    });





});
