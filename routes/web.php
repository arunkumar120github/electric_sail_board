<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SailboatController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\SailboatMedia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('sailboats', SailboatController::class)->except([
        'store', 'update'
    ]);
    Route::resource('users', UserController::class)->except([
        'store', 'update'
    ]);
    Route::post('upload-sailboat-video', [SailboatController::class, 'uploadVideo'])->name('sailboat-video.upload');
});

