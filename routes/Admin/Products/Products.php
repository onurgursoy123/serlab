<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'ProductsCTRL@index')->name('index');
Route::put('/', 'ProductsCTRL@update')->name('update');
Route::post('/', 'ProductsCTRL@store')->name('save');
Route::delete('/', 'ProductsCTRL@destroy')->name('destroy');

Route::post('/search', 'ProductsCTRL@search')->name('search');

Route::group(['prefix' => 'productlist', 'as' => 'productList.'], function () {
  Route::post('/search', 'ProductsListCTRL@search')->name('search');
  Route::get('/{parent_id}', 'ProductsListCTRL@index')->name('index');
  Route::put('/{parent_id}', 'ProductsListCTRL@update')->name('update');
  Route::post('/', 'ProductsListCTRL@store')->name('save');

  Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/{parent_id}/{id}', 'ProductCTRL@index')->name('index');
  });

});

Route::group(['prefix' => 'subproducts', 'as' => 'subProducts.'], function () {
  Route::get('/{parent_id}', 'SubProductsCTRL@index')->name('index');
  Route::put('/{parent_id}', 'SubProductsCTRL@update')->name('update');
  Route::post('/{parent_id}/search', 'SubProductsCTRL@search')->name('search');

  Route::post('/', 'SubProductsCTRL@store')->name('save');

});

