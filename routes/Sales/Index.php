<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'SalesCTRL@index')->name('index');
Route::post('/sendFormUsingMail', 'SalesCTRL@sendFormUsingMail')->name('sendFormUsingMail');

