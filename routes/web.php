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
    return redirect('table');
});

Route::group(['middleware' => 'checkloggedin'], function(){
Route::get('table','EmployeeController@table');

Route::post('tableStore','EmployeeController@tableStore');

Route::post('update/{id}','EmployeeController@updateStore');

Route::get('modal/{id}', 'EmployeeController@modal');

Route::get('logout', 'EmployeeController@logout');
});
Route::get('signup','EmployeeController@signup');
Route::get('login','EmployeeController@login');
Route::post('loginStore', 'EmployeeController@loginStore');
Route::post('signupStore','EmployeeController@signupStore');
