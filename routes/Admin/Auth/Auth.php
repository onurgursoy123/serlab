<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', 'AuthCTRL@login')->name('login');
Route::post('/logout', 'AuthCTRL@logout')->name('logout');
