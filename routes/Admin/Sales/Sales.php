<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'SalesCTRL@index')->name('index');
Route::put('/', 'SalesCTRL@mailAddress')->name('mailAddress');

