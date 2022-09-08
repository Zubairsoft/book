<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ResetPassword;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('forgetPassword', [AuthController::class,'forgetPassword']);
Route::post('ResetPassword', [AuthController::class,'reset']);

Route::post('register', [AuthController::class,'register'])->name('register');

Route::group(['middleware'=>['auth:api','verified','lang']],function (){
    Route::get('profile', [AuthController::class,'profile'])->name('profile');
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
    Route::post('changePassword',[ResetPassword::class,'changePassword'])->name('changePassword');
    Route::post('/lang',LocalController::class)->name('lang');

    Route::apiResource('books',BookController::class);

});

Route::get('email/verify/{id}', [VerificationController::class,'verify'])->name('verification.verify'); // Make sure to keep this as your route name

Route::get('email/resend', [VerificationController::class,'resend'])->name('verification.resend');




