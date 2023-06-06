<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'ContactCTRL@index')->name('index');
Route::put('/', 'ContactCTRL@update')->name('update');

