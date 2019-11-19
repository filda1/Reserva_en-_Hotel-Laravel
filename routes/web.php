<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

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

// VIEW USER
/*Route::get('/', function () {
    return view('welcome');
})->name('welcome');*/

/*Route::get('/hotel/{id}', function ($id) {
    return view('hotel');
    //return $id;
})->name('hotel');*/


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
    })->name('lang');

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/hotel', function () {
    return view('hotel');
    //return $id;
})->name('hotel');

Route::get('/hotels', 'HotelsController@index')->name('hotels');

Route::get('/services', 'ServiceController@index')->name('services');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('admin/home', function () {
    return view('admin.home');
})->name('admin.home');


/*Route::get('admin/post', function () {
    return view('admin.post.post');
})->name('admin.post');*/

/*Route::get('admin/show', function () {
    return view('admin.post.show');
});*/

/*Route::get('admin/edit', function () {
    return view('admin.post.edit');
});*/




Route::any('/reserve', 'ReserveController@save')->name('reserve');


//****** Buscador ******** */
Route::any ( '/search', 'SearchController@search');  

// Email related routes
Route::get('mail/home', 'MailController@home');
Route::post('mail/send', 'MailController@send');



Auth::routes();


//****************************************************************** USER ************************************************************ */
// AREA USER,el home pinta head6.blade.php
Route::any('/home', 'HomeController@index')->name('home');

 // AREA USER, el click button Cancel, campos de db available y vacancies se activan
Route::get('change/{id}', 'ChangeController@index')->name('Change');






/*Route::get('admin-login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin-login', 'Auth\AdminLoginController@login');*/


// ************************************************************** ADMIN ****************************************************************/


Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','HomeController@index')->name('admin.home');

	// Admin Auth Routes
	Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\LoginController@login');
});
 



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
  
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
  
  
  
    // Password reset routes
  
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
  
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
  
  });

  // Imagen General
  Route::resource('/admin/post','Admin\PostController');

  Route::resource('/admin/room','Admin\RoomController');
  Route::resource('/admin/roomeng','Admin\RoomengController');

  
  Route::resource('/admin/reserve','Admin\ReserveController');
  Route::resource('/admin/user','Admin\UserController');




Route::get('/exitreserve', function () {
    return view('exitreserve');
});