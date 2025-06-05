<?php
use App\Http\Controllers\auth\AuthenticatedSessionController;

use App\Http\Middleware\RedirectBasedOnRole;


use App\Http\Controllers\{
    DashboardController
};
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubAccountController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\Personal_solutionsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\MoreController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Finance\AdminPaymentController;
use App\Http\Controllers\admin\Finance\AdminExpenseController;
use App\Http\Controllers\admin\Finance\AdminBudgetController;
use App\Http\Controllers\admin\Finance\AdminInvoiceController;
use App\Http\Controllers\admin\Finance\AdminReportController;
use App\Http\Controllers\admin\Finance\ReportExportController;
use App\Http\Controllers\StaffPaymentController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\SubscriptionController;



use App\Http\Controllers\Finance\{
    ExpenseController,
    InvoiceController,
    ReportController,
    PaymentController,
    BudgetController,
    FinanceController
};


use App\Models\Pricing;
use App\Models\Package;
use App\Models\Plan;


// web controllers

use App\Http\Controllers\Web\HomepageContentController;
use App\Http\Controllers\Web\HomepageContentTableController;
use App\Http\Controllers\Web\CompanyStatementController;

// -----------------------------
// Registration Pages (Custom for Admin Dashboard)
// -----------------------------

// Admin Registration Form (page loads inside iframe)
Route::get('/admin/register/admin', [RegisteredUserController::class, 'showAdminRegisterForm'])->name('admin.register.admin');

// Admin Registration Form Submit
Route::post('/admin/register/admin', [RegisteredUserController::class, 'storeAdmin'])->name('admin.register.admin.store');

// Staff Registration Form (page loads inside iframe)
Route::get('/admin/register/staff', [RegisteredUserController::class, 'showStaffRegisterForm'])->name('admin.register.staff');

// Staff Registration Form Submit
Route::post('/admin/register/staff', [RegisteredUserController::class, 'storeStaff'])->name('admin.register.staff.store');

// -------------------
// Public Routes
// -------------------
Route::get('/', [HomepageController::class, 'index']);
Route::get('/solutions', [SolutionController::class, 'showSolutions'])->name('solutions.index');
Route::get('/solutions/view/{id}', [SolutionController::class, 'showDetail'])->name('solutions.show');

Route::get('/personal_solutions', [Personal_solutionsController::class, 'showSolutions'])->name('personal_solutions.index');
Route::get('/personal_solutions/view/{id}', [Personal_solutionsController::class, 'showDetail'])->name('personal_solutions.show');

Route::get('/services', [ServicesController::class, 'showSolutions'])->name('services.index');
Route::get('/services/view/{id}', [ServicesController::class, 'show'])->name('services.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/more', [MoreController::class, 'showSolutions']);
Route::get('/pricing', [PackageController::class, 'pricingPage']);
Route::get('/premium', [PackageController::class, 'premiumPage']);


Route::get('/events', [EventController::class, 'showEvents'])->name('events.index');
Route::get('/events/view/{id}', [EventController::class, 'show'])->name('events.show');

Route::view('/loading_count_down', 'loading_count_down');
Route::view('/page_loading', 'page_loading');

Route::view('/emails/sales_contact_form', '/emails/sales_contact_form');

Route::get('/load-more-packages', [PackageController::class, 'loadMore']);



Route::get('/plan/compare', function () {
    $packages = Package::all(); // <-- fetch packages

    return view('plan.compare', compact('packages')); // <-- pass packages to view
})->name('compare');

Route::get('/pricing', function () {
    $pricing = Pricing::all();
    $packages = Package::with('plans.features')->get();
    return view('pricing-page', compact('pricing', 'packages'));
})->name('pricing.page');

Route::get('/plan/{id}', function ($id) {
    $plan = Plan::with('features')->findOrFail($id);
    $packages = Package::all(); // 

    return view('plan-detail', compact('plan', 'packages'));
})->name('plan.details');







Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route(match (auth()->user()->role_id) {
            1 => 'admin.dashboard',
            2 => 'staff.dashboard',
            3 => 'user.dashboard',
        });
    }

    return view('auth.login');
})->name('login');
    
Route::get('/register', function () {
    if (auth()->check()) {
        return redirect()->route(match (auth()->user()->role_id) {
            1 => 'admin.dashboard',
            2 => 'staff.dashboard',
            3 => 'user.dashboard',
        });
    }

    return view('auth.register');
})->name('register');
   




// -------------------------------------
// Admin Dashboard (Role: admin only)
// -------------------------------------

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');



    
    // Subscriptions Management (Admin Panel)
    Route::prefix('admin/subscriptions')->controller(SubscriptionController::class)->name('admin.subscriptions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/pending', 'pending')->name('pending');
        Route::get('/approved', 'approved')->name('approved');
        Route::get('/rejected', 'rejected')->name('rejected');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/', 'update')->name('update');
        Route::post('/{id}/approve', 'approve')->name('approve');
        Route::post('/{id}/reject', 'reject')->name('reject');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });





Route::prefix('admin/finance/payments')->name('admin.finance.payments.')->group(function () {
    
    Route::get('/', [AdminPaymentController::class, 'index'])->name('index');
    Route::get('/{payment}', [AdminPaymentController::class, 'show'])->name('show');
    Route::get('/{payment}/edit', [AdminPaymentController::class, 'edit'])->name('edit');
    Route::put('/{payment}', [AdminPaymentController::class, 'update'])->name('update');
});

Route::prefix('admin/finance/expenses')->name('admin.finance.expenses.')->middleware(['auth', 'role:1'])->group(function () {
    Route::get('/', [AdminExpenseController::class, 'index'])->name('index');
    Route::get('/{expense}', [AdminExpenseController::class, 'show'])->name('show');
    Route::get('/{expense}/edit', [AdminExpenseController::class, 'edit'])->name('edit');
    Route::put('/{expense}', [AdminExpenseController::class, 'update'])->name('update');
    Route::delete('/{expense}', [AdminExpenseController::class, 'destroy'])->name('destroy');
});


Route::prefix('admin/finance/budgets')->name('admin.finance.budgets.')->group(function () {
    Route::get('/', [AdminBudgetController::class, 'index'])->name('index');
    Route::get('/create', [AdminBudgetController::class, 'create'])->name('create');
    Route::post('/', [AdminBudgetController::class, 'store'])->name('store');
    Route::get('/{budget}', [AdminBudgetController::class, 'show'])->name('show');
    Route::get('/{budget}/edit', [AdminBudgetController::class, 'edit'])->name('edit');
    Route::put('/{budget}', [AdminBudgetController::class, 'update'])->name('update');
    Route::delete('/{budget}', [AdminBudgetController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/finance/invoices')->name('admin.finance.invoices.')->group(function () {
    Route::get('/', [AdminInvoiceController::class, 'index'])->name('index');
    Route::get('/create', [AdminInvoiceController::class, 'create'])->name('create');
    Route::post('/', [AdminInvoiceController::class, 'store'])->name('store');
    Route::get('/{invoice}', [AdminInvoiceController::class, 'show'])->name('show');
    Route::get('/{invoice}/edit', [AdminInvoiceController::class, 'edit'])->name('edit');
    Route::put('/{invoice}', [AdminInvoiceController::class, 'update'])->name('update');
    Route::delete('/{invoice}', [AdminInvoiceController::class, 'destroy'])->name('destroy');
});





Route::prefix('admin/finance/reports')->name('admin.finance.reports.')->group(function () {

    // 📊 Report Views


    Route::get('/', [AdminReportController::class, 'index'])->name('index');
    Route::get('/details/{type}', [AdminReportController::class, 'details'])->name('details');


 
    // 📦 Export Endpoints (CSV/XLSX)



    Route::get('/export/payments', [ReportExportController::class, 'exportPayments'])->name('reports.export.payments');
    Route::get('/export/invoices', [ReportExportController::class, 'exportInvoices'])->name('reports.export.invoices');
    Route::get('/export/expenses', [ReportExportController::class, 'exportExpenses'])->name('reports.export.expenses');
    Route::get('/export/budgets', [ReportExportController::class, 'exportBudgets'])->name('reports.export.budgets');







});











// web routes)

// --- Homepage Main Content ---
Route::prefix('admin/web/homepage')->name('admin.web.homepage.')->group(function () {

    // Homepage Content
    Route::get('/content/edit', [HomepageContentController::class, 'edit'])->name('content.edit');
    Route::post('/content/update', [HomepageContentController::class, 'update'])->name('content.update');

    // Homepage Content Table
    Route::prefix('table')->name('table.')->group(function () {
        Route::get('/', [HomepageContentTableController::class, 'index'])->name('index');
        Route::get('/create', [HomepageContentTableController::class, 'create'])->name('create');
        Route::post('/', [HomepageContentTableController::class, 'store'])->name('store');
        Route::get('/{table}/edit', [HomepageContentTableController::class, 'edit'])->name('edit');
        Route::put('/{table}', [HomepageContentTableController::class, 'update'])->name('update');
        Route::delete('/{table}', [HomepageContentTableController::class, 'destroy'])->name('destroy');
    });

    // Company Statements
    Route::prefix('statements')->name('statements.')->group(function () {
        Route::get('/', [CompanyStatementController::class, 'index'])->name('index');
        Route::get('/create', [CompanyStatementController::class, 'create'])->name('create');
        Route::post('/store', [CompanyStatementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CompanyStatementController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [CompanyStatementController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CompanyStatementController::class, 'destroy'])->name('destroy');
    });

});








});








// -------------------------------------
// Staff Dashboard (Role: staff only)
// -------------------------------------
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    // Add more staff-specific routes here
    

    
});

// -------------------------------------
// User Dashboard (Role: user only)


Route::middleware(['auth', 'role:3'])->group(function () {

    // Dashboard
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Subscription Plan Selection
    Route::get('/select-payment', [PaymentController::class, 'select'])->name('payment.select');
    Route::post('/user/finance/payments/subscription/apply', [SubscriptionController::class, 'apply'])->name('subscription.apply');


     Route::post('/subscription/apply', [SubscriptionController::class, 'apply'])->name('subscription.apply');
    Route::get('/finance/subscription/thankyou', [SubscriptionController::class, 'thankYou'])->name('finance.subscription.thankyou');

    // Finance Main Group
    Route::prefix('user/finance')->group(function () {

        // Finance Overview
        Route::get('/', [FinanceController::class, 'index'])->name('user.finance.index');

        // Expenses
        Route::prefix('expenses')->group(function () {
            Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
            Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
            Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
        });

        // Invoices
        Route::prefix('invoices')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('user.finance.invoices.index');
            Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
            Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
        });

        // Payments
        Route::prefix('payments')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
            Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
            Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
        });

        // Budgets
        Route::prefix('budgets')->group(function () {
            Route::get('/', [BudgetController::class, 'index'])->name('user.finance.budgets.index');
            Route::get('/create', [BudgetController::class, 'create'])->name('budgets.create');
            Route::post('/', [BudgetController::class, 'store'])->name('budgets.store');
        });

        // Reports
        Route::prefix('reports')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        });

    });

    // User Profile
    Route::get('/user/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');

});


// Keep this LAST so default auth routes don’t override custom ones
require __DIR__.'/auth.php';