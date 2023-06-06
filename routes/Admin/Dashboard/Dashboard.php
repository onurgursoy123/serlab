<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'DashboardCTRL@index')->name('index');
Route::post('/upload', 'DashboardCTRL@index')->name('ckeditor-upload');

Route::put('/', 'DashboardCTRL@update')->name('update');
Route::delete('/', 'DashboardCTRL@destroy')->name('delete');

Route::get('/header', 'DashboardCTRL@getHeaderData')->name('header.index');
Route::put('/header', 'DashboardCTRL@headerUpdate')->name('header.update');

Route::get('/getHeaderProducts', 'DashboardCTRL@getHeaderProducts')->name('getHeaderProducts.index');

Route::get('/footer', 'DashboardCTRL@getFooterData')->name('footer.index');
Route::put('/footer', 'DashboardCTRL@footerUpdate')->name('footer.update');
