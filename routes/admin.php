<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HabitController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
Route::resource('/habits',HabitController::class);
Route::resource('/events',EventController::class);
Route::resource('/clubs',ClubController::class);
Route::resource('/users',UserController::class);

//Route::resource('/offlinepayments',\App\Http\Controllers\Customer\OfflinePaymentController::class);
Route::get('/offlinepayments',[\App\Http\Controllers\Customer\OfflinePaymentController::class,'index'])->name('offlinepayments.index');
Route::get('/offlinepayments/{invoices}/edit',[\App\Http\Controllers\Customer\OfflinePaymentController::class,'edit'])->name('offlinepayments.edit');
Route::match(['put', 'patch'],'/offlinepayments/{invoices}/',[\App\Http\Controllers\Customer\OfflinePaymentController::class,'update'])->name('offlinepayments.update');
Route::delete('/offlinepayments/{invoices}/destroy',[\App\Http\Controllers\Customer\OfflinePaymentController::class,'destroy'])->name('offlinepayments.destroy');
