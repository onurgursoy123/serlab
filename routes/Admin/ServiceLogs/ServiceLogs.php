<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'ServiceLogsCTRL@index')->name('index');
Route::post('/', 'ServiceLogsCTRL@store')->name('save');
Route::put('/{id}', 'ServiceLogsCTRL@update')->name('update');
Route::delete('/{id}', 'ServiceLogsCTRL@destroy')->name('destroy');

Route::group(['prefix' => 'details', 'as' => 'details.'], function () {
  Route::get('/{id}', 'ServiceLogsDetailsCTRL@index')->name('index');
  
});