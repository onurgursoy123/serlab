<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'ProductsCTRL@products')->name('index');
Route::post('/search', 'ProductsCTRL@search')->name('search');

Route::group(['prefix' => 'productlist', 'as' => 'productList.'], function () {
  Route::post('/search', 'ProductsListCTRL@search')->name('search');
  Route::get('/{parent_id}', 'ProductsListCTRL@index')->name('index');

  Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/{parent_id}/{id}', 'ProductCTRL@index')->name('index');
  });
  
});


Route::group(['prefix' => 'subproducts', 'as' => 'subProducts.'], function () {
  Route::get('/{parent_id}', 'SubProductsCTRL@index')->name('index');
  Route::post('/{parent_id}/search', 'SubProductsCTRL@search')->name('search');

});