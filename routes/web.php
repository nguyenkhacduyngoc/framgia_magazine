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
Route::resource('user', 'Frontend\UserController');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('backend.master');
    })->middleware('auth', 'isAdmin');
    Route::resource('users', 'Backend\UserController')->names([
        'create' => 'admin.users.create',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'show' => 'admin.users.show',
        'index' => 'admin.users.index',
    ])->middleware('auth', 'isAdmin');
    Route::resource('categories', 'Backend\CategoryController')->names([
        'create' => 'admin.categories.create',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'show' => 'admin.categories.show',
        'index' => 'admin.categories.index',
    ])->middleware('auth', 'isAdmin');;
});
