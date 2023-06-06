<?php

use Illuminate\Support\Facades\Route;


Route::get('/getOurServicesHeader', 'OurServicesCTRL@getOurServicesHeader')->name('getOurServicesHeader.index');

Route::get('/v/{url}', 'OurServicesCTRL@getDynamicUrl')->name('getDynamicUrl.index');

/*
Route::get('/getHeaderName', 'OurServicesCTRL@getHeaderName')->name('getHeaderName.index');

Route::get('/guarantee', 'OurServicesCTRL@guarantee')->name('guarantee');
Route::get('/product-sales', 'OurServicesCTRL@productSales')->name('productSales');
Route::get('/repair-and-maintenance', 'OurServicesCTRL@repairAndMaintenance')->name('repairAndMaintenance');
Route::get('/spare-parts', 'OurServicesCTRL@spareParts')->name('spareParts');
Route::get('/other-services', 'OurServicesCTRL@otherServices')->name('otherServices');
*/