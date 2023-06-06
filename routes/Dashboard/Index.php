<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'DashboardCTRL@index')->name('index');


Route::get('/header', 'DashboardCTRL@getHeaderData')->name('header.index');
Route::get('/getHeaderProducts', 'DashboardCTRL@getHeaderProducts')->name('getHeaderProducts.index');

Route::get('/footer', 'DashboardCTRL@getFooterData')->name('footer.index');
