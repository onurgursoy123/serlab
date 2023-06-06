<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'apiAuth'], function () {
    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
            Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'api.dashboard.'], function () {
                Route::post('/upload', 'DashboardCTRL@upload')->name('ckeditor-upload');
            });
        });
    });
});

/*
Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    include(__DIR__ . '/Admin/Index.php');
});
*/