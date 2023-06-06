<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'CorporateCTRL@index')->name('index');
Route::put('/', 'CorporateCTRL@update')->name('update');