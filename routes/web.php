<?php

use App\Http\Controllers\Customer\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\UserDetailsController;

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
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'auth.admin']
], base_path('routes/admin.php'));

Route::get('/login', [LoginController::class, 'customer'])->name('customerLogin.index');
Route::post('/login', [LoginController::class, 'customerLogin'])->name('customer-login');

Route::get('/customer/password/set/{token}', [LoginController::class, 'passwordSet'])->name('customer.password.set');
Route::post('/customer/password/set/{token}', [LoginController::class, 'passwordSetAttempt'])->name('customer.password.set');

Route::get('/admin', [LoginController::class, 'admin'])->name('adminLogin.index');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin-login');


// Landing page routes
Route::get('/landing/{id}', [\App\Http\Controllers\Customer\LandingPageController::class, 'index'])->name('landing.index');
Route::post('/landing/{id}', [\App\Http\Controllers\Customer\LandingPageController::class, 'payInstamojo'])->name('landing.pay_instamojo');
Route::get('/landing/{id}/product/{product}', [\App\Http\Controllers\Customer\LandingPageController::class, 'getProduct'])->name('landing.product');
// landing pay with stripe
Route::post('/landing/{id}/stripe/payment-intent/{amount}', [\App\Http\Controllers\Customer\LandingPageController::class, 'stripePaymentIntent']);
Route::get('/landing/{id}/stripe/success', [\App\Http\Controllers\Customer\LandingPageController::class, 'stripeSuccess']);
// landing pay with razorpay
Route::post('/landing/{id}/razorpay/create-order/{amount}', [\App\Http\Controllers\Customer\LandingPageController::class, 'razorpayCreateOrder']);
Route::post('/landing/{id}/razorpay/success', [\App\Http\Controllers\Customer\LandingPageController::class, 'razorpaySuccess']);

//instamojo
Route::get('/landing/{id}/{product_id}/instamojo/success', [\App\Http\Controllers\Customer\LandingPageController::class, 'instamojoSuccess']);

Route::get('/invoices/payment/{id}/{invoiceId}/{rinvoiceId}', [\App\Http\Controllers\Customer\SubscriptionController::class, 'getInvoiceLink'])->name('invoices.payment');
Route::get('/invoices/payment/{id}/{invoiceId}/{rinvoiceId}/{amount}', [\App\Http\Controllers\Customer\SubscriptionController::class, 'paymentPage'])->name('invoices.payment.page');
Route::post('/invoices/payment/{id}/{invoiceId}/{rinvoiceId}/{amount}', [SubscriptionController::class, 'instamojoPayment'])
    ->name('invoices.instamojo.payment');

Route::get('/invoices/payment/{id}/{invoiceId}/{rinvoiceId}/stripe/success', [\App\Http\Controllers\Customer\SubscriptionController::class, 'stripeSuccess'])->name('invoices.payment.stripe.success');
Route::post('/invoices/payment/{id}/{invoiceId}/{rinvoiceId}/razorpay/success', [\App\Http\Controllers\Customer\SubscriptionController::class, 'razorpaySuccess'])->name('invoices.payment.razorpay.success');
Route::get('/invoices/payment/{id}/{invoiceId}/{rinvoiceId}/instamojo/success', [SubscriptionController::class, 'instamojoSuccess'])
    ->name('invoices.payment.instamojo.success');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/home', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('home');

    // Profile Management
    Route::get('profile/{user}/edit', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('updateProfile');

    // Top Performers
    Route::get('top-performers', [App\Http\Controllers\Customer\TopPerformerController::class, 'index'])->name('top_performers');

    // Tasks management
    Route::get('/tasks/calendar', [App\Http\Controllers\Customer\TaskController::class, 'calendar'])->name('tasks.calendar');
    Route::get('/tasks/complete/{task}', [App\Http\Controllers\Customer\TaskController::class, 'complete'])->name('tasks.complete');
    Route::resource('/tasks', App\Http\Controllers\Customer\TaskController::class);

    // Habit management
    Route::get('/habits', [App\Http\Controllers\Customer\HabitController::class, 'index'])->name('habits.index');
    Route::post('/habits/complete/{habit}', [App\Http\Controllers\Customer\HabitController::class, 'complete'])->name('habits.complete');
    Route::delete('/habits/destroy/{habit}', [App\Http\Controllers\Customer\HabitController::class, 'destroy'])->name('habits.destroy');

    // Events View
    Route::get('/events', [App\Http\Controllers\Customer\EventController::class, 'index'])->name('events');

    // Business State
    Route::resource('business', App\Http\Controllers\Customer\BusinessStatController::class);
    Route::get('business-stats', [App\Http\Controllers\Customer\BusinessStatController::class, 'businessStats']);

    Route::get('/customer/setpassword/{userToken}', [\App\Http\Controllers\Admin\UserController::class, 'userPassword'])->name('setuserpassword');
    Route::post('/customer/setpassword/{userToken}', [\App\Http\Controllers\Admin\UserController::class, 'userPasswordUpdate'])->name('userpassword.update');

    Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');
    Route::post('/customers/import', [CustomerController::class, 'import'])->name('customers.import');
    Route::get('/customers/file/import', [CustomerController::class, 'importFile'])->name('customers.file.import');

    Route::resource('/customers', CustomerController::class);

    Route::resource('/incomes', \App\Http\Controllers\Customer\IncomeController::class);
    Route::resource('/expenses', \App\Http\Controllers\Customer\ExpenseController::class);

    Route::resource('/leads', \App\Http\Controllers\Customer\LeadController::class);

    Route::get('/invoices', [\App\Http\Controllers\Customer\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}/pdf', [\App\Http\Controllers\Customer\InvoiceController::class, 'getPdf'])->name('invoices.pdf');
    Route::get('/invoices/create', [\App\Http\Controllers\Customer\InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices/store', [\App\Http\Controllers\Customer\InvoiceController::class, 'store'])->name('invoices.store');
    Route::post('/customer/invoices/test/{amount}', [\App\Http\Controllers\Customer\InvoiceController::class, 'paymentIntent'])->name('customer.invoices.paymentIntent');
    Route::get('/customer/invoices/stripe/success', [\App\Http\Controllers\Customer\InvoiceController::class, 'stripeSuccess'])->name('customer.invoices.stripe.success');

    Route::get('/subscriptions', [\App\Http\Controllers\Customer\SubscriptionController::class, 'index'])->name('subscriptions.index');

    //    TODO Products Page Route
    // Route::get('/products', function () {return view('products.index');})->name('products.index');
    Route::resource('/products', \App\Http\Controllers\Customer\ProductController::class);
    Route::get('getProductById', [\App\Http\Controllers\Customer\ProductController::class, 'getProductById'])->name('products.getProductById');

    Route::get('/customer/payment-gateways', [\App\Http\Controllers\Customer\PaymentGatewayController::class, 'index'])->name('paymentgateways');
    Route::get('/customer/payment-gateways/changeVisibility/{id}/{visibility}/{type}', [\App\Http\Controllers\Customer\PaymentGatewayController::class, 'changeVisibility'])->name('changeVisibility');
    Route::get('/customer/payment-gateways/show/{id}/{type}', [\App\Http\Controllers\Customer\PaymentGatewayController::class, 'show'])->name('customer.create');
    Route::post('/customer/payment-gateways/store', [\App\Http\Controllers\Customer\PaymentGatewayController::class, 'store'])->name('customer.store');


    //    TODO Subscription Page Route
    Route::get('/subscription', function () {
        return view('subscription.index');
    })->name('subscription.index');
    Route::get('/add-subscription', function () {
        return view('subscription.add-subscription');
    })->name('add-subscription.index');

    //    TODO Paymentz Page
    Route::get('/paymentz', function () {
        return view('paymentz.index');
    })->name('paymentz.index');

    //    TODO Invoice page
    Route::get('/invoice', function () {
        return view('invoice.invoice');
    })->name('invoice');


//    //userprofile
//    Route::get('/user-profile', function () {
//        return view('user.profile.general_info');
//    });
//    Route::get('/business-profile', function () {
//        return view('user.profile.business_physical_add');
//    });
//    Route::get('/authorized_contact', function () {
//        return view('user.profile.authorized_contact');
//    });


    //userprofile
    Route::get('/user-profile/', [UserDetailsController::class, 'generalInfo'])->name('user.profile');
    Route::post('/user-profile/post/', [UserDetailsController::class, 'postGeneralInfo'])->name('user.profile.post');

    Route::get('/user-business-profile/', [UserDetailsController::class, 'businessAdd'])->name('user.businessProfile');
    Route::post('/user-business-profile/post/', [UserDetailsController::class, 'postBusinessAdd'])->name('user.business_add.post');

    Route::get('/user-authorized_contact/', [UserDetailsController::class, 'authorizeContact'])->name('user.authorizedContact');
    Route::post('/user-authorized_contact/post/', [UserDetailsController::class, 'postAuthorizeContact'])->name('user.authorizeContact.post');
});
