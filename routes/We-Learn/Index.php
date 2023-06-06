<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'WeLearnCTRL@index')->name('index');

Route::group(['prefix' => 'details', 'as' => 'details.'], function () {
  Route::get('/{id}', 'WeLearnDetailsCTRL@index')->name('index');
  
});