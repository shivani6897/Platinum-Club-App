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

Route::resource('/offlinepayments',\App\Http\Controllers\Customer\OfflinePayment::class);
//Route::get('/offlinepayments/',[\App\Http\Controllers\Customer\OfflinePayment::class,'edit']);
//Route::post('/offlinepayments/',[\App\Http\Controllers\Customer\OfflinePayment::class,'update']);
//Route::post('/offlinepayments/',[\App\Http\Controllers\Customer\OfflinePayment::class,'update']);
