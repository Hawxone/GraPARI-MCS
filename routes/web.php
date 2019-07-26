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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){

    //Checklist
    Route::get('/home/app', 'ChecklistController@index')->name('checklist.index');
    Route::post('/home/app/store', 'ChecklistController@store')->name('checklist.store');
    Route::post('/home/app/edit', 'ChecklistController@edit')->name('checklist.edit');

    //Report
    Route::get('home/report', 'ReportController@index')->name('report.index');

    //Perangkat
    Route::get('/home/master/perangkat', 'PerangkatController@index')->name('perangkat.index');
    Route::post('/home/master/perangkat/store', 'PerangkatController@store')->name('perangkat.store');
    Route::post('/home/master/perangkat/edit', 'PerangkatController@edit')->name('perangkat.edit');
    Route::post('/home/master/perangkat/destroy', 'PerangkatController@destroy')->name('perangkat.destroy');


    //Layanan
    Route::get('/home/master/layanan', 'LayananController@index')->name('layanan.index');
    Route::post('/home/master/layanan/store', 'LayananController@store')->name('layanan.store');
    Route::post('/home/master/layanan/edit', 'LayananController@edit')->name('layanan.edit');
    Route::post('/home/master/layanan/destroy', 'LayananController@destroy')->name('layanan.destroy');

    //App
    Route::get('/home/master/app', 'AplikasiController@index')->name('app.index');
    Route::post('/home/master/app/store', 'AplikasiController@store')->name('app.store');
    Route::post('/home/master/app/edit', 'AplikasiController@edit')->name('app.edit');
    Route::post('/home/master/app/destroy', 'AplikasiController@destroy')->name('app.destroy');


});



