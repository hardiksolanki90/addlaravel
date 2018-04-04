<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'authority'], function () {
  Route::get('/', function () {
    return redirect(route('challenge'));
  });
  Route::group(['middleware' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@initContent')->name('dashboard');
    Route::get('logout', 'EmployeeController@initProcessLogout')->name('employee.logout');
  });
  Route::group(['prefix' => 'employee'], function () {
    Route::get('register', 'EmployeeController@initContentRegister')->name('employee.register');
    Route::post('register', 'EmployeeController@initProcessRegister');
  });
});
