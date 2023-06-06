<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'FormCTRL@index')->name('index');
Route::put('/', 'FormCTRL@mailAddress')->name('mailAddress');
