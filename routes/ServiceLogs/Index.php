<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'ServiceLogsCTRL@index')->name('index');

Route::group(['prefix' => 'details', 'as' => 'details.'], function () {
  Route::get('/{id}', 'ServiceLogsDetailsCTRL@index')->name('index');
  
});