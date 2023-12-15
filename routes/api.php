<?php

use App\Http\Controllers\API\UserAuthSessions;
use App\Http\Controllers\API\UserRegistrationController;
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
Route::prefix('user')->name('user.')
    ->group(function () {
    Route::post('register', UserRegistrationController::class)->name('register');
    Route::post('login', [UserAuthSessions::class, 'login'])->name('login');
});
#endregion
