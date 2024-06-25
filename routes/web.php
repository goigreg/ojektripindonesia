<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\midtransController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientController::class, 'index'])->name('home');
Route::get('/details/{id}', [ClientController::class, 'details'])->name('details');
Route::get('/contacts', [ClientController::class, 'contacts'])->name('contacts');
Route::POST('/contacts/sendMessage', [ClientController::class, 'sendMessage'])->name('sendMessage');
Route::get('/registerForm', [ClientController::class, 'registerFormShow'])->name('registerForm');
Route::POST('/memberRegister', [ClientController::class, 'store'])->name('memberRegister');
Route::get('/loginForm', [ClientController::class, 'loginFormShow'])->name('loginForm');
Route::POST('/memberLogin', [ClientController::class, 'memberLogin'])->name('memberLogin');

Route::get('/tours', [Controller::class, 'tours'])->name('tours');
Route::get('/tours/search', [UserController::class, 'searchTours'])->name('searchTours');
Route::get('/tours/details/{id}', [Controller::class, 'tourDetails'])->name('tourDetails');
Route::get('/rentals', [Controller::class, 'rentals'])->name('rentals')->middleware('auth');
Route::get('/about_us', [Controller::class, 'about_us'])->name('about Us');


Route::get('/purchase', [Controller::class, 'purchase'])->name('purchase');
Route::POST('/purchase/process/{id}', [Controller::class, 'purchaseProcess'])->name('purchase.product');
Route::get('/memberLogout', [ClientController::class, 'memberLogout'])->name('memberLogout');

Route::middleware(['middleware' => 'member', 'verified'])->group(function () {    
    Route::POST('/bookings/{id}', [ClientController::class, 'bookings'])->name('bookings');
    Route::get('/checkOut', [ClientController::class, 'checkOut'])->name('checkOut');
    Route::get('/checkOut/viewBookData/{id}', [ClientController::class, 'viewBookData'])->name('viewBookData');
    Route::get('/checkOut/rechekBookData/{id}', [ClientController::class, 'rechekBookData'])->name('rechekBookData');
    Route::PUT('/checkOut/updateBookData/{id}', [ClientController::class, 'updateBookData'])->name('updateBookData');
    Route::get('/checkOut/cancelBooking/{id}', [ClientController::class, 'cancelBooking'])->name('cancelBooking');
    Route::get('/checkOut/payNow/{id}', [ClientController::class, 'payNow'])->name('payNow');
    Route::POST('/checkOut/submitPayment', [ClientController::class, 'submitPayment'])->name('submitPayment');
    Route::get('/customTourModal', [ClientController::class, 'customTourModal'])->name('customTourModal');
    Route::POST('/submitCustomTour', [ClientController::class, 'submitCustomTour'])->name('submitCustomTour');
    Route::get('/book/{id}', [ClientController::class, 'book'])->name('book');
    Route::get('/tours/book/{id}', [ClientController::class, 'toursBook'])->name('toursBook');
    Route::get('/tours/details/book/{id}', [ClientController::class, 'toursDetailsBook'])->name('toursDetailsBook');
    Route::get('details/book/{id}', [ClientController::class, 'detailsBook'])->name('detailsBook');
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::get('/profile/downloadPdf/{id}', [ClientController::class, 'downloadPdf'])->name('downloadPdf');
    Route::get('/profile/viewTicket/{id}', [ClientController::class, 'profileViewTicket'])->name('profileViewTicket');
    Route::get('/viewTicket/{id}', [ClientController::class, 'viewTicket'])->name('viewTicket');
    Route::GET('/profile/editProfilePhoto/{id}', [ClientController::class, 'editProfilePhoto'])->name('editProfilePhotoModal');
    Route::PUT('/profile/updateProfilePhoto/{id}', [ClientController::class, 'updateProfilePhoto'])->name('updateProfilePhoto');
    Route::GET('/profile/editProfile/{id}', [ClientController::class, 'editProfile'])->name('editProfileModal');
    Route::PUT('/profile/updateProfile/{id}', [ClientController::class, 'updateProfile'])->name('updateProfile');
    Route::GET('/profile/changePassword/{id}', [ClientController::class, 'changePassword'])->name('changePasswordModal');
    Route::PUT('/profile/updatePassword/{id}', [ClientController::class, 'updatePassword'])->name('updatePassword');
    Route::GET('/profile/deleteAccount/{id}', [ClientController::class, 'deleteAccount'])->name('deleteAccount');
    
    // Route::get('/cobaMidtrans', [midtransController::class, 'cobaMidtrans'])->name('cobaMidtrans');
});




Route::get('/admin', [Controller::class, 'adminLogin'])->name('adminLogin');
Route::POST('/admin/loginProcess', [Controller::class, 'loginProcess'])->name('loginProcess');
Route::get('/admin/logout', [Controller::class, 'logout'])->name('adminLogout');

Route::middleware(['middleware' => 'admin', 'verified'])->group(function () {    
    Route::get('/admin/dashboard', [adminController::class, 'index'])->name('admin');
    Route::get('/admin/order', [adminController::class, 'order'])->name('order');
    Route::get('/admin/order/filter', [adminController::class, 'filter'])->name('orderFilter');
    Route::get('/admin/order/search', [adminController::class, 'search'])->name('searchOrder');    
    Route::GET('/admin/order/viewOrderModal/{id}', [adminController::class, 'viewOrder'])->name('viewOrderModal');
    Route::get('/admin/customTour', [adminController::class, 'customTour'])->name('customTour');
    Route::get('/admin/customTour/filter', [adminController::class, 'customFilter'])->name('customFilter');
    Route::get('/admin/customTour/search', [adminController::class, 'searchCustom'])->name('searchcustom');    
    Route::GET('/admin/customTour/viewCustomModal/{id}', [adminController::class, 'viewCustom'])->name('viewCustomModal');
    Route::get('/admin/message', [adminController::class, 'message'])->name('message');
    Route::get('/admin/message/filter', [adminController::class, 'filterMessage'])->name('messageFilter');
    Route::get('/admin/message/search', [adminController::class, 'searchMessage'])->name('searchMessage');
    Route::GET('/admin/message/viewMessage/{id}', [adminController::class, 'viewMessage'])->name('viewMessage');
    Route::get('/admin/companyProfile', [adminController::class, 'companyProfile'])->name('companyProfile');
    Route::PUT('/admin/companyProfile/{id}', [adminController::class, 'updateCompanyProfile'])->name('updateCompanyProfile');

    Route::get('/admin/product', [ProductController::class, 'index'])->name('product');
    Route::get('/admin/product/filter', [ProductController::class, 'filter'])->name('productFilter');
    Route::get('/admin/product/search', [ProductController::class, 'search'])->name('searchProduct');
    Route::get('/admin/product/addPackage', [ProductController::class, 'addPackage'])->name('addPackage');
    Route::POST('/admin/product/addData', [ProductController::class, 'store'])->name('addNewPackage');
    Route::GET('/admin/product/editModal/{id}', [ProductController::class, 'edit'])->name('editModal');
    Route::PUT('/admin/product/updateData/{id}', [ProductController::class, 'update'])->name('updateData');
    Route::GET('/admin/product/deleteData/{id}', [ProductController::class, 'destroy'])->name('deleteData');

    Route::get('/admin/user', [UserController::class, 'index'])->name('user');
    Route::get('/admin/user/filter', [UserController::class, 'filter'])->name('userFilter');
    Route::get('/admin/user/search', [UserController::class, 'search'])->name('searchUser');
    Route::get('/admin/user/addUserModal', [UserController::class, 'addUserModal'])->name('addUserModal');
    Route::POST('/admin/user/addUserData', [UserController::class, 'store'])->name('addUserData');
    Route::GET('/admin/user/viewUserModal/{id}', [UserController::class, 'viewUser'])->name('viewUserModal');
    Route::GET('/admin/user/editUserModal/{id}', [UserController::class, 'edit'])->name('editUserModal');
    Route::PUT('/admin/user/updateUserData/{id}', [UserController::class, 'update'])->name('updateUserData');
    Route::GET('/admin/user/deleteUserData/{id}', [UserController::class, 'destroy'])->name('deleteUserData');
    
    Route::get('/admin/transaction', [TransactionsController::class, 'index'])->name('transaction');
    Route::get('/admin/transaction/filter', [TransactionsController::class, 'filter'])->name('transactionFilter');
    Route::get('/admin/transaction/searchBooking', [TransactionsController::class, 'searchBooking'])->name('searchBookingTransaction');
    Route::get('/admin/transaction/search', [TransactionsController::class, 'search'])->name('searchTransaction');
    Route::GET('/admin/transaction/addTransactionModal/{id}', [TransactionsController::class, 'addTransactionModal'])->name('addTransactionModal');
    Route::POST('/admin/transaction/addTransaction', [TransactionsController::class, 'storeTransaction'])->name('addTransaction');
    Route::GET('/admin/transaction/viewTransactionModal/{id}', [TransactionsController::class, 'viewTransaction'])->name('viewTransactionModal');
    Route::GET('/admin/transaction/editTransactionModal/{id}', [TransactionsController::class, 'editTransaction'])->name('editTransactionModal');
    Route::PUT('/admin/transaction/updateTransactionModal/{id}', [TransactionsController::class, 'updateTransaction'])->name('updateTransactionModal');
    Route::GET('/admin/transaction/deleteTransactionData/{id}', [TransactionsController::class, 'destroy'])->name('deleteTransactionData');
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
