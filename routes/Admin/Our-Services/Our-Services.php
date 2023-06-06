<?php

use Illuminate\Support\Facades\Route;

Route::get('/getOurServicesHeader', 'OurServicesCTRL@getOurServicesHeader')->name('getOurServicesHeader.index');
Route::get('/', 'OurServicesCTRL@get')->name('get.index');
Route::get('/v/{url}', 'OurServicesCTRL@getDynamicUrl')->name('getDynamicUrl.index');
Route::post('/', 'OurServicesCTRL@store')->name('getDynamicUrl.store');
Route::put('/', 'OurServicesCTRL@update')->name('getDynamicUrl.update');


/*

Route::get('/getHeaderName', 'OurServicesCTRL@getHeaderName')->name('getHeaderName.index');
Route::put('/changeName', 'OurServicesCTRL@changeName')->name('changeName.update');

Route::get('/guarantee', 'OurServicesCTRL@guarantee')->name('guarantee');
Route::put('/guarantee', 'OurServicesCTRL@guaranteeUpdate')->name('guarantee.update');

Route::get('/product-sales', 'OurServicesCTRL@productSales')->name('productSales');
Route::put('/product-sales', 'OurServicesCTRL@productSalesUpdate')->name('productSales.update');

Route::get('/repair-and-maintenance', 'OurServicesCTRL@repairAndMaintenance')->name('repairAndMaintenance');
Route::put('/repair-and-maintenance', 'OurServicesCTRL@repairAndMaintenanceUpdate')->name('repairAndMaintenance.update');

Route::get('/spare-parts', 'OurServicesCTRL@spareParts')->name('spareParts');
Route::put('/spare-parts', 'OurServicesCTRL@sparePartsUpdate')->name('spareParts.update');

Route::get('/other-services', 'OurServicesCTRL@otherServices')->name('otherServices');
Route::put('/other-services', 'OurServicesCTRL@otherServicesUpdate')->name('otherServices.update');

*/