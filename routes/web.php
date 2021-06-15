<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Drag_dropController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\AdminFormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DummyAPIController;
use App\Http\Middleware\Authenticate;

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


//Define Middleware

// Route::group(['middleware'=>'auth'], function(){
// });
// Route::middleware([Authenticate::class])->group(function () {
// });




//Login & Register
Route::get('/login', [UserController::class, 'LoginForm']);
Route::get('/register', [UserController::class, 'RegisterForm']);
Route::post('/register', [UserController::class, 'RegisterFormRec'])->name('register');
Route::post('/login', [UserController::class, 'LoginFormRec'])->name('login');

Route::middleware([Authenticate::class])->group(function () {
    
    Route::get('/', [UserController::class, 'dashboard']);

    Route::get('/form', [FormController::class, 'viewImage']);
    
    // ajax uploading image
    Route::post('/ajaxuploadimg', [FormController::class, 'imguploadpost']);


    // Drag & Drop Record with jQuery
    Route::get('/drag_drop', [Drag_dropController::class, 'showDatatable']);
    Route::post('/drag_drop', [Drag_dropController::class, 'updateOrder']);


    // Import & Export File
    Route::get('/multiple_records', [IndexController::class, 'data_view']);
    Route::get('/data_load', [IndexController::class, 'multipleRecord']);
    // Route::get('/file_export', [IndexController::class, 'btn_export']);
    Route::get('/excel_export', [IndexController::class, 'export']);
    Route::post('/import-form', [IndexController::class, 'importUploadForm']);


    // Send Mail
    Route::get('/send_mail', [MailController::class, 'sendMail']);


    // Stripe payment
    Route::get('/stripe',[StripePaymentController::class, 'checkout']);
    Route::post('/stripe',[StripePaymentController::class, 'afterpayment'])->name('stripe_chekout');


    // RazorPay payment
    Route::get('/razorpay-payment', [RazorpayController::class, 'create'])->name('pay.with.razorpay'); // create payment
    Route::post('/payment', [RazorpayController::class, 'payment'])->name('payment'); //accept paymetnt


    // Paypal payment
    Route::get('/paypal', [PaypalController::class, 'paypal_page']);
    Route::get('/payment', [PaypalController::class, 'payment'])->name('payment');
    Route::get('/payment.success', [PaypalController::class, 'success'])->name('payment.success');
    Route::get('/cancel', [PaypalController::class, 'cancel'])->name('payment.cancel');


    // Livechat 
    Route::get('/livechat', function(){
        return view('livechat');
    });
    Route::get('/livechat_output', function () {
        event(new \App\Events\SendMessage());
        dd('Event Run Successfully.');
    });


    // Full Calender
    Route::get('/fullcalendar', [FullCalendarController::class, 'index']);
    Route::post('/fullcalendarAjax', [FullCalendarController::class, 'ajax']);


    // Form
    Route::get('/add_form', [AdminFormController::class, 'AddForm']);
    Route::post('/add_form_record', [AdminFormController::class, 'addFormRecord']);
    Route::get('/view_form', [AdminFormController::class, 'viewForm']);
    Route::get('/delete-field/{id}', [AdminFormController::class, 'DeleteRec']);
    Route::get('/edit-field/{id}'   , [AdminFormController::class, 'editField']);
    Route::post('/edit_form_record', [AdminFormController::class, 'editFormRecord']);
    // Live Searching
    Route::get('/search', [AdminFormController::class, 'LiveSearch']);
    // Multiple Delete
    Route::delete('/delete_record', [AdminFormController::class, 'deleteMultipleRec'])->name('deleteSelected');

    // User
    Route::get('/logout', [UserController::class, 'LogoutRec']);
    Route::get('/edit-profile', [UserController::class, 'editProfile']);
    Route::post('/edit_user_record', [UserController::class, 'editUserRecord']);

    // Ajax Form
    Route::get('/students', [StudentController::class, 'Student']);
    Route::post('/addstudent', [StudentController::class, 'AddStudent']);
    Route::put('/studentedit/{id}', [StudentController::class, 'EditStudent']);

    //Call APIs Data
    Route::get('/apidata', [DummyAPIController::class, 'APIData']);

});

// Hotel with ajax
Route::get('/hotel', [HotelController::class, 'Hotelpage']);
Route::post('contact-form', [HotelController::class, 'store']);