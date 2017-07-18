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
	return view('main');
});

Route::group(['prefix' => 'layouts'], function () {
   	Route::get('header', function () {
	    return view('layouts.header');
	});
	Route::get('sidebar', function () {
	    return view('layouts.sidebar');
	});
});

Route::group(['prefix' => 'partials'], function () {
	Route::get('index', function () {
	    return view('partials.index');
	});
	Route::get('/{category}/{action?}', function ($category, $action = 'index') {
	    return view(join('.', ['partials', $category, $action]));
	});

	Route::get('/{category}/{action}/{id}', function ($category, $action = 'index', $id) {
	    return view(join('.', ['partials', $category, $action]));
	});
});

// Catch all undefined routes. Always gotta stay at the bottom since order of routes matters.
Route::any('{undefinedRoute}', function ($undefinedRoute) {
    return view('main');
})->where('undefinedRoute', '([A-z\d-\/_.]+)?');
