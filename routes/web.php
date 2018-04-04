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
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
  Route::get('login', 'AuthController@initContentLogin')->name('login');
  Route::post('login', 'AuthController@initProcessLogin');

  Route::get('password/reset', 'AuthController@initContentPasswordReset')->name('password.email');
  Route::post('password/reset', 'AuthController@initProcessSendResetLink')->name('password.reset');

  Route::get('password/reset/{token}', 'AuthController@initContentSetNewPassword')->name('password.request');
  Route::post('password/reset/{token}', 'UserController@initProcessResetPassword');

  Route::get('register', 'AuthController@initContentLogin')->name('register');
});

Route::get('admin/login', 'AdminControllers/AdminAuthController@initContentLogin');
Route::post('admin/login', 'AdminControllers/AdminAuthController@initProcessLogin');
Route::group(['middleware' => 'auth'], function () {
  Route::get('dashboard', 'UserController@initContentDashboard')->name('user.dashboard');
  Route::any('logout', 'AuthController@initProcessLogout')->name('logout');
});

include('admin.php');
