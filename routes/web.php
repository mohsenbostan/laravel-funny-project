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

Route::post('/import_users_to_db','PlayGroundController@import_users_to_db')->name('import_users_to_db');
Route::post('/export_users_to_excel','PlayGroundController@export_users_to_excel')->name('export_users_to_excel');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function () {
    return redirect('/');
});
