<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// error page
Route::get('/error', function () {
  return view('error');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ADMIN
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    include(__DIR__ . '/Admin/Index.php');
  });
});

// PRODUCTS
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'products', 'namespace' => 'Products', 'as' => 'products.'], function () {
    include(__DIR__ . '/Products/Index.php');
  });
});

// DASHBOARD
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['namespace' => 'Dashboard', 'as' => 'dashboard.'], function () {
    include(__DIR__ . '/Dashboard/Index.php');
  });
});

// COMMENTS
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'comments', 'namespace' => 'Comments', 'as' => 'comments.'], function () {
    include(__DIR__ . '/Comments/Index.php');
  });
});

// CORPORATE
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate', 'as' => 'corporate.'], function () {
    include(__DIR__ . '/Corporate/Index.php');
  });
});

// SERVICE-LOGS
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'serviceLogs', 'namespace' => 'ServiceLogs', 'as' => 'serviceLogs.'], function () {
    include(__DIR__ . '/ServiceLogs/Index.php');
  });
});

// CONTACT
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'contact', 'namespace' => 'Contact', 'as' => 'contact.'], function () {
    include(__DIR__ . '/Contact/Index.php');
  });
});

// FORM
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'form', 'namespace' => 'Form', 'as' => 'form.'], function () {
    include(__DIR__ . '/Form/Index.php');
  });
});

// SALES
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'sales', 'namespace' => 'Sales', 'as' => 'sales.'], function () {
    include(__DIR__ . '/Sales/Index.php');
  });
});

// OUR-SERVICES
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'our-services', 'namespace' => 'OurServices', 'as' => 'our-services.'], function () {
    include(__DIR__ . '/Our-Services/Index.php');
  });
});

// WE-LEARN
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'we-learn', 'namespace' => 'WeLearn', 'as' => 'we-learn.'], function () {
    include(__DIR__ . '/We-Learn/Index.php');
  });
});