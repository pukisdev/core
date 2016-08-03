<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
//     // return view('modules.sites.sn.social_networking');
// });

Route::auth();


//Route::get('/','sites\snController@index');
Route::get('/home', 'HomeController@index');



Route::get('/token', 'Auth\TokenController@getToken');

Route::group(/*['prefix'=>'site'],*/['middleware'=>['menus']], function(){
	// Route::get('menus','Sys\menuController@index');
        Route::get('/','sites\snController@index');
});

Route::group(['prefix'=>'mst', 'middleware'=>['menus','auth']], function(){
	Route::get('pms/customer', 'PMS\customerController@_index');
	Route::get('pms/customer/add', 'PMS\customerController@create');
});

Route::group(['prefix'=>'trx'], function(){
});

Route::group(['prefix'=>'rpt'], function(){
});

Route::group(['prefix'=>'app'], function(){
});


