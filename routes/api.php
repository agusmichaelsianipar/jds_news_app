<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserAuthController;
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
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register');
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::apiResource('/news', NewsController::class);
Route::apiResource('/comments', CommentController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


