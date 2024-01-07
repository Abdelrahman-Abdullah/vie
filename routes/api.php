<?php

use App\Http\Controllers\API\{CheckPasswordResetCodeController,
    ForgetPasswordController,
    PaymentStatusController,
    ResetPasswordController,
    UserAuthSessions,
    UserRegistrationController,
    PaymobMobileWalletController};

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#region User All API Routes
Route::prefix('users')->name('users.')
    ->group(function () {
    Route::post('register', UserRegistrationController::class)->name('register');
    Route::post('login', [UserAuthSessions::class, 'login'])->name('login');
    Route::post('forget-password', ForgetPasswordController::class)->name('forget-password');
    Route::post('check-code', CheckPasswordResetCodeController::class)->name('check-code');
    Route::post('reset-password', ResetPasswordController::class)->name('reset-password');
    #------------------------------// User Authenticated Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserAuthSessions::class, 'logout'])->name('logout');
    });
});
#endregion

#region General API Routes
Route::prefix('categories')->name('categories.')
    ->group(function () {
    Route::get('', [CategoryController::class, 'index'])->name('index');
});

Route::prefix('products')->name('products.')
    ->group(function () {
    Route::get('', [ProductsController::class, 'index'])->name('index');
    Route::get('{product:name}', [ProductsController::class, 'show'])->name('show');
});
#endregion

#region Paymob Mobile Wallet API Routes
Route::prefix('paymob-mobile-wallet')->name('paymob-mobile-wallet.')
    ->group(function () {
        Route::post('frame', PaymobMobileWalletController::class)->middleware('auth:sanctum')->name('frame');
        Route::get('payment-status', PaymentStatusController::class)->name('payment-status');
    });
#endregion
