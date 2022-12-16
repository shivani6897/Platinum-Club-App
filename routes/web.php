<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CustomerController;

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

Route::redirect('/', 'login');

Auth::routes(['verify' => true,'register' => false]);

// Admin Route
Route::group([
    'prefix'=>'admin',
    'as'=>'admin.',
    'middleware'=>['auth','auth.admin']
],base_path('routes/admin.php'));

Route::get('/login',[LoginController::class,'customer'])->name('customerLogin.index');
Route::post('/login', [LoginController::class,'customerLogin'])->name('customer-login');

Route::get('/customer/password/set/{token}',[LoginController::class,'passwordSet'])->name('customer.password.set');
Route::post('/customer/password/set/{token}',[LoginController::class,'passwordSetAttempt'])->name('customer.password.set');

Route::get('/admin',[LoginController::class,'admin'])->name('adminLogin.index');
Route::post('/admin', [LoginController::class,'adminLogin'])->name('admin-login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','verified']], function () {

    Route::get('/home', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('home');

    // Profile Management
    Route::get('profile/{user}/edit', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('updateProfile');

    // Top Performers
    ROute::get('top-performers',[App\Http\Controllers\Customer\TopPerformerController::class,'index'])->name('top_performers');

    // Tasks management
    Route::get('/tasks/calendar',[App\Http\Controllers\Customer\TaskController::class,'calendar'])->name('tasks.calendar');
    Route::get('/tasks/complete/{task}',[App\Http\Controllers\Customer\TaskController::class,'complete'])->name('tasks.complete');
    Route::resource('/tasks',App\Http\Controllers\Customer\TaskController::class);

    // Habit management
    Route::get('/habits',[App\Http\Controllers\Customer\HabitController::class, 'index'])->name('habits.index');
    Route::post('/habits/complete/{habit}',[App\Http\Controllers\Customer\HabitController::class,'complete'])->name('habits.complete');
    Route::delete('/habits/destroy/{habit}',[App\Http\Controllers\Customer\HabitController::class,'destroy'])->name('habits.destroy');

    // Events View
    Route::get('/events', [App\Http\Controllers\Customer\EventController::class, 'index'])->name('events');

    // Business State
    Route::resource('business',App\Http\Controllers\Customer\BusinessStatController::class);
    Route::get('business-stats', [App\Http\Controllers\Customer\BusinessStatController::class, 'businessStats']);

    Route::get('/customer/setpassword/{userToken}', [\App\Http\Controllers\Admin\UserController::class, 'userPassword'])->name('setuserpassword');
    Route::post('/customer/setpassword/{userToken}', [\App\Http\Controllers\Admin\UserController::class, 'userPasswordUpdate'])->name('userpassword.update');

    Route::resource('/customers',CustomerController::class);

    Route::get('/invoices/create',[\App\Http\Controllers\Customer\InvoiceController::class,'create'])->name('invoices.create');
    Route::post('/invoices/store',[\App\Http\Controllers\Customer\InvoiceController::class,'store'])->name('invoices.store');
});
