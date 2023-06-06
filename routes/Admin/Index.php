<?php

use Illuminate\Support\Facades\Route;


Route::get('/support', 'AdminCTRL@support');
Route::get('/', 'AdminCTRL@login');

/*
Route::get('/', function () {
  return view('admin.auth.login');
});
*/

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth.'], function () {
  include(__DIR__ . '/Auth/Auth.php');
});


Route::group(['middleware' => 'auth'], function () {
  Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard.'], function () {
    include(__DIR__ . '/Dashboard/Dashboard.php');
  });

  Route::group(['prefix' => 'products', 'namespace' => 'Products', 'as' => 'products.'], function () {
    include(__DIR__ . '/Products/Products.php');
  });

  Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate', 'as' => 'corporate.'], function () {
    include(__DIR__ . '/Corporate/Corporate.php');
  });

  Route::group(['prefix' => 'serviceLogs', 'namespace' => 'ServiceLogs', 'as' => 'serviceLogs.'], function () {
    include(__DIR__ . '/ServiceLogs/ServiceLogs.php');
  });

  Route::group(['prefix' => 'contact', 'namespace' => 'Contact', 'as' => 'contact.'], function () {
    include(__DIR__ . '/Contact/Contact.php');
  });

  Route::group(['prefix' => 'sales', 'namespace' => 'Sales', 'as' => 'sales.'], function () {
    include(__DIR__ . '/Sales/Sales.php');
  });

  Route::group(['prefix' => 'form', 'namespace' => 'Form', 'as' => 'form.'], function () {
    include(__DIR__ . '/Form/Form.php');
  });

  Route::group(['prefix' => 'our-services', 'namespace' => 'OurServices', 'as' => 'our-services.'], function () {
    include(__DIR__ . '/Our-Services/Our-Services.php');
  });

  Route::group(['prefix' => 'we-learn', 'namespace' => 'WeLearn', 'as' => 'we-learn.'], function () {
    include(__DIR__ . '/We-Learn/We-Learn.php');
  });

});
