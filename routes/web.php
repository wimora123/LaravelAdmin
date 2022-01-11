<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Untuk verifikasi email
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Route::get('/register','RegistrationController@index')->name('register');
Route::post('/registerAdmin','RegistrationController@registerAdmin')->name('registerAdmin');

// Route::get('/verify', [EmailVerificationController::class, 'show'])
//     ->middleware('auth')
//     ->name('verificationNotice'); 

// Route::post('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
// ->middleware(['auth', 'signed']) // <-- don't remove "signed"
// ->name('verification.verify'); // <-- don't change the route name



// Route for mailing
// Route::get('/email', function(){
//     Mail::to('wimorasarwindo@gmail.com')->send(new WelcomeMail());
//     return new WelcomeMail();
// });


Route::get('/login', 'LoginController@index')->name('adminLogin');
Route::post('/postLogin', 'LoginController@postLogin')->name('postLogin');
Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/postLogout', 'LoginController@postLogout')->name('postLogout');

Route::get('/listMerchant', 'MerchantController@index')->name('listMerchant');

Route::get('/createMerchant', 'MerchantController@create')->name('createMerchant');
Route::post('/addMerchant', 'MerchantController@store')->name('addMerchant');

Route::get('/editMerchant/{id}', 'MerchantController@edit')->name('editMerchant');
Route::post('/updateMerchant/{id}', 'MerchantController@update')->name('updateMerchant');

Route::get('/merchantStatus', 'MerchantController@editStatus')->name('merchantStatus');

Route::post('/deleteMerchant/{id}', 'MerchantController@destroy')->name('deleteMerchant');

Route::get('/merchantCategory', 'MerchantCategory@index')->name('merchantCategory');

Route::post('/addCategory', 'MerchantCategory@create')->name('addCategory');

Route::get('/editCategory/{id}', 'MerchantCategory@update')->name('editCategory');
Route::post('/updateCategory/{id}', 'MerchantCategory@update')->name('updateCategory');

Route::post('/deleteCategory/{id}', 'MerchantCategory@destroy')->name('deleteCategory');






// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
