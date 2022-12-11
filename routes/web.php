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

Route::redirect('/', 'login');

Auth::routes(['verify' => true]);

// Admin Route
Route::group([
    'prefix'=>'admin',
    'as'=>'admin.',
    'middleware'=>['auth','auth.admin']
],base_path('routes/admin.php'));

Route::get('/login',[LoginController::class,'customer'])->name('customerLogin.index');
Route::post('/login', [LoginController::class,'customerLogin'])->name('customer-login');

Route::get('/admin',[LoginController::class,'admin'])->name('adminLogin.index');
Route::post('/admin', [LoginController::class,'adminLogin'])->name('admin-login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){
    Route::group(['middleware' => ['verified']], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('profile/{user}/edit', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
        Route::post('profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('updateProfile');

        Route::get('/tasks/calendar',[App\Http\Controllers\Customer\TaskController::class,'calendar'])->name('tasks.calendar');
        Route::resource('/tasks',App\Http\Controllers\Customer\TaskController::class);

        Route::get('/events', [App\Http\Controllers\Customer\EventController::class, 'index'])->name('events');
        Route::resource('business',App\Http\Controllers\Customer\BusinessStatController::class);
        Route::get('business-stats', [App\Http\Controllers\Customer\BusinessStatController::class, 'businessStats']);
    });
});
