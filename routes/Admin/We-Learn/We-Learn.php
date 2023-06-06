<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'WeLearnCTRL@index')->name('index');

Route::get('/', 'WeLearnCTRL@index')->name('index');
Route::post('/', 'WeLearnCTRL@store')->name('save');
Route::put('/{id}', 'WeLearnCTRL@update')->name('update');
Route::delete('/{id}', 'WeLearnCTRL@destroy')->name('destroy');

Route::group(['prefix' => 'details', 'as' => 'details.'], function () {
  Route::get('/{id}', 'WeLearnDetailsCTRL@index')->name('index');
  
});