<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SailboatController;
use App\Http\Controllers\UserController;

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

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::get('sailboats/{id}', [SailboatController::class, 'show']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::get('data/{id}', [SailboatController::class, 'data']);
    Route::get('search-sailboatOptions', [SailboatController::class, 'searchOptions']);
    Route::get('search-userOptions', [UserController::class, 'userSearchOptions']);
    Route::get('search-users', [UserController::class, 'searchUsers'])->name('search-users');
    Route::get('search-sailboats', [SailboatController::class, 'searchSailboats'])->name('search-sailboats');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('profile', [AuthController::class, 'updateProfile']);
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::post('create-user', [UserController::class, 'store']);
        Route::get('sailboats', [SailboatController::class, 'index'])->name('sailboats');
        Route::post('create-sailboat', [SailboatController::class, 'store']);
        Route::post('update-sailboat', [SailboatController::class, 'update']);
        Route::post('upload-sailboat-video', [SailboatController::class, 'uploadVideo']);
        Route::post('remove-sailboat-video', [SailboatController::class, 'removeVideo']);
        Route::post('remove-sailboat-image', [SailboatController::class, 'removeImage']);
    });
});
