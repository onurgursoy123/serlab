<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'CommentsCTRL@index')->name('index');
Route::post('/', 'CommentsCTRL@store')->name('save');
// Route::put('/', 'CommentsCTRL@destroy')->name('destroy');