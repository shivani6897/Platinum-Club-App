<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

//Route::redirect('/', 'login');

// Route::get('/', function () {
//     return view('welcome');
// });
// Test

Auth::routes();

Route::get('/',[LoginController::class,'customer'])->name('customerLogin.index');
Route::post('/', [LoginController::class,'customerLogin'])->name('customer-login');

Route::get('/admin',[LoginController::class,'admin'])->name('adminLogin.index');
Route::post('/admin', [LoginController::class,'adminLogin'])->name('admin-login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'adninDashboard'])->name('admin.dashboard');
