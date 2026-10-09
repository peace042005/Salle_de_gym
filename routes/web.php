<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RessetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\Billing\PurchaseController;
use App\Http\Controllers\Billing\SubscriptionController;
use App\Http\Controllers\Site\Private\Admin\AdminDashboardController;
use App\Http\Controllers\Site\Private\Manager\ManagerDashboardController;
use App\Http\Controllers\Site\Private\User\UserDashboardController;
use App\Http\Controllers\Site\Private\OutfitController;
use App\Http\Controllers\Site\Private\PricingController;
use App\Http\Controllers\Site\Private\RoomController;
use App\Http\Controllers\Site\Public\WelcomeController;
use App\Http\Middleware\AdminManagerMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ManagerMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;


// register
Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('doRegister');
// login
Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('doLogin');
// email verification
Route::get('email/verify/{id}', [VerifyEmailController::class, 'verify'])->name('verification.verify');
Route::get('email/resend/{id}', [VerifyEmailController::class, 'resend'])->name('verification.resend');
// password resset
Route::get('/auth/password-resset', [RessetPasswordController::class, 'index'])->name('ressetPassword');
Route::post('/auth/password-resset', [RessetPasswordController::class, 'store'])->name('doRessetPassword');

// application public routes
Route::get('/', [WelcomeController::class, 'welcome'])->name('app.welcome');
Route::get('rooms/map', [WelcomeController::class, 'map'])->name('app.rooms.map');
Route::get('rooms/{id}/details', [WelcomeController::class, 'overview'])->name('app.rooms.overview');
Route::get('rooms/{id}/subscription', [WelcomeController::class, 'subscription'])->name('app.rooms.subscription');

/* monetisation */
Route::get('fedapay/checkout', [BillingController::class, 'useFedapay'])->name('fedapay.checkout');

// actions that only admin and manager can do
Route::middleware(AdminManagerMiddleware::class)->prefix('private')->name('management.')->group(
    function () {
        Route::resource('/management/outfit', OutfitController::class);
        Route::resource('/management/room', RoomController::class);

        // purchases
        Route::get('purchases', [PurchaseController::class, 'index'])->name('purchase.index');
        Route::get('purchases/{id}', [PurchaseController::class, 'show'])->name('purchase.show');

        // subscriptions
        Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
        Route::get('subscriptions/{id}', [SubscriptionController::class, 'show'])->name('subscription.show');
    }
);

// actions that only user-role can do
Route::middleware(UserMiddleware::class)->group(function () {
    Route::get('user/dashboard', [UserDashboardController::class, 'home'])->name('user.dashboad');
    Route::get('user/purchase', [UserDashboardController::class, 'home'])->name('user.purchase');
    Route::get('user/subscription', [UserDashboardController::class, 'home'])->name('user.subscription');
});

// actions that only manager-role can do
Route::middleware(ManagerMiddleware::class)->group(function () {
    Route::get('manager/dashboard', [ManagerDashboardController::class, 'home'])->name('manager.dashboad');
});

// actions that only admin-role can do
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::prefix('private')->name('management.')->group(function() {
        Route::resource('/management/pricing', PricingController::class);
    });

    Route::get('admin/dashboard', [AdminDashboardController::class, 'home'])->name('admin.dashboad');
});

// application protected routes
Route::middleware(['auth',])->group(function () {
    Route::post('/auth/logout', [LoginController::class, 'destroy'])->name('logout');
});
