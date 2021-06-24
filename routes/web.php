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


Route::get('data_wilayah', 'FormPendaftaranController@data_wilayah')->name('data_wilayah');
Route::get("form_pendaftaran", "FormPendaftaranController@form_pendaftaran");