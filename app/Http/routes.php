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

Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);


// Public Server Status Beacon
Route::get('beacon',
  function() {

    $serverConfig = config('landrive');

    return response()->json(['Status' => 1 , 'Code' => 200 , 'Message' => 'Landrive Server found!' ,  'Server' => 'Landrive' , 'Name' => $serverConfig['servername'] ]);
 });

// Get LanDriveAccess Route
Route::post('getlandriveaccesstoken','LanDriveTokenController@getToken');

// This route is accessible only to Authenticated Requests
Route::group(['middleware' => 'ValidateLanDriveAPIRequest'], function()
{

  Route::resource('drive', 'DriveController');

  Route::post('revokelandriveaccesstoken','LanDriveTokenController@revokeToken');

  Route::get('server/config' , 'LanDriveServerConfigController@index');

});



