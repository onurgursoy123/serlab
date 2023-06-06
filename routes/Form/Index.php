<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'FormCTRL@index')->name('index');
Route::post('/sendFormUsingMail', 'FormCTRL@sendFormUsingMail')->name('sendFormUsingMail');
