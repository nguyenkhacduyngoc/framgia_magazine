<?php

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
Auth::routes();
Route::get('/', 'Frontend\PageController@index')->name('');
Route::get('/homepage', 'Frontend\PageController@index')->name('homepage');
Route::resource('posts', 'Frontend\PostController');
Route::resource('categories', 'Backend\CategoryController');
Route::get('admin/', function () {
    return view('backend.master');
});
