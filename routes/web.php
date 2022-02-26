<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');


// https://laravel.com/docs/8.x/controllers#controller-middleware
Route::group(['middleware' => ['auth']], function(Router $router){
	
	Route::resources([
		
		'/' => 'App\Http\Controllers\HomeController',
		'/user' => 'App\Http\Controllers\UserController',
		'/profile' => 'App\Http\Controllers\ProfileController',
		'/role' => 'App\Http\Controllers\RoleController',
		'/album' => 'App\Http\Controllers\AlbumController'
	]);
	
	// Route::post('workorders/time', array('as'=>'workorders.time', 'uses'=>'WorkordersController@time'));

//	
//	$router->match(['POST', 'GET', 'DELETE'], '/{controller?}/{action?}/{id?}', function($controller = 'home', $action = 'index', $id = null) use($router){
//		
//		return app_dispatch($router, $controller, $action, $id);
//    });
});