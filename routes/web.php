<?php

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
    return view('front.home3');
})->name("home");
Route::get('/about-us', 'HomeController@aboutus')->name('aboutus');
Route::get('/contact-us', 'HomeController@contactus')->name('contactus');
Route::post('/contact-us', 'HomeController@savecontactus_details')->name('contactus.savedetails');
Route::post('/signup', 'HomeController@registeruser_details')->name('signup.registeruser');
Route::post('/sendProfileRequest', 'HomeController@sendProfileRequest')->name('sendProfileRequest');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name("logout");
Route::get('/profile/{string}', 'HomeController@userprofiledetails')->name('user.profiledetails');
Route::post('/profile/{string}', 'User\UserController@userSubmitReview')->name('user.reviewSubmit');

/*Route::post('/searchDetailsMap', 'HomeController@searchdetails_map')->name('home.searchmap');*/

Route::get('/password/forget', 'HomeController@forgetpassword')->name('forgetpassword');
Route::post('/password/forget', 'HomeController@forgetpasswordSendLink')->name('forgetpasswordSendLink');

Route::group(
	[
		'prefix' => 'administracion',  // Prefijo de las url de este grupo
		'namespace' => 'Admin', // Carpeta de los controladores
		'middleware' => 'App\Http\Middleware\AdminMiddleware' // El Middleware para proteger de usuarios indeseables
	], function() {
	    // Inicio del admin
        Route::match(["get","post"],'/', 'AdminController@index')->name("admin.home");
        // Vista para cambiar el password
		Route::get('/changepassword', 'AdminController@changepassword')->name("admin.change-password");
		// Proceso de cambiar el password
		Route::post('/changepassword', 'AdminController@savenewpassword')->name('admin.changepassword');
		// Vista para cambiar el nombre de usuario
		Route::get('/changeusername', 'AdminController@changeusername')->name("admin.change-username");
		// Proceso para cambiar el nombre de usuario
		Route::post('/changeusername', 'AdminController@savenewusername')->name('admin.changeusername');
		// Lista de contactos
		Route::get('contact', 'ContactController@index')->name("contact.index");
		// Recurso de usuarios
		Route::resource('user', 'UserController');
		// Ruta para cambiar el estado de un usuario
		Route::post('/user/changestatus', 'UserController@changestatus')->name("changeStatus");
		// Descargar los usuarios en un CVS
		Route::get('/downloadUsers', 'UserController@downloadUsers')->name('admin.users.download');
		

});

Route::group(
	[
		'prefix' => 'mydashboard',  //link url parameter
		'namespace' => 'User', //folder
		'middleware' => 'App\Http\Middleware\UserMiddleware'
	], function() {
		Route::get('/', 'UserController@index')->name('user.dashboard');
		
		Route::get('/my-profile', 'UserController@editprofile')->name('user.editprofile');
		Route::post('/my-profile', 'UserController@updateprofile_details')->name('user.updateprofiledetails');
		Route::post('/my-profile-visitor', 'UserController@updateprofile_details_visitor')->name('user.updateprofiledetailsVisitor');

		Route::get('/my-location', 'UserController@userlocation')->name('user.userlocation');
		Route::post('/my-location', 'UserController@userlocation_update')->name('user.userlocationUpdate');

		Route::get('/my-reviews', 'UserController@reviewsFromMe')->name('user.userreviewsFromme');
		Route::get('/my-reviews/to-me', 'UserController@reviewsToMe')->name('user.userreviewsTome');

		Route::get('/change-password', 'UserController@changepassword')->name('user.changepassword');
		Route::post('/change-password', 'UserController@changepassword_save')->name('user.changepasswordSave');
		
		
});

Route::get('/mailtest', 'TestController@mailtest')->name('mailtest');