<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	
	$api->group(['prefix' => 'v1'], function ($api) {
		$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
		$api->get('auth/getByToken', 'App\Api\V1\Controllers\AuthController@getByToken');

		$api->group(['middleware' => ['jwt.auth']], function ($api) {
			$api->resource('researches', 'App\Api\V1\Controllers\ResearchController');
			$api->resource('seminars', 'App\Api\V1\Controllers\SeminarController');
			$api->resource('users', 'App\Api\V1\Controllers\UserController');
			$api->resource('roles', 'App\Api\V1\Controllers\RoleController');
			$api->resource('permissions', 'App\Api\V1\Controllers\PermissionController');
			
			$api->post('upload/avatar', 'App\Api\V1\Controllers\UploadController@avatar');
			$api->post('upload/pdf', 'App\Api\V1\Controllers\UploadController@pdf');
			$api->post('upload/seminar', 'App\Api\V1\Controllers\UploadController@seminar');
			$api->post('upload/knowledge', 'App\Api\V1\Controllers\UploadController@knowledge');

	    });
	    
	    $api->group(['middleware' => ['jwt.auth','role:super-admin|admin|executive']], function ($api) {
			$api->get('report/researches', 'App\Api\V1\Controllers\ResearchController@report');
			$api->get('report/seminars', 'App\Api\V1\Controllers\SeminarController@report');
			$api->get('report/officers', 'App\Api\V1\Controllers\UserController@report');
	    });
	});


});