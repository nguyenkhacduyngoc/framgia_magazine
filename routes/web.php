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
Route::get('category/{id}', 'Frontend\PageController@category')->name('category');
Route::get('tag/{id}', 'Frontend\PageController@tag')->name('tag');

Route::post('posts/search', 'Frontend\PostController@search')->name('posts.search');
Route::post('posts/rate', 'Frontend\PostController@ratePost')->name('posts.rate_post');
Route::post('posts/like', 'Frontend\PostController@likePost')->name('posts.like_post');

Route::resource('posts', 'Frontend\PostController');

Route::resource('user', 'Frontend\UserController');

Route::post('comments-post', 'Frontend\CommentController@storeComment')->name('comments.store_comment');
Route::post('replyComments', 'Frontend\CommentController@storeReplyComment')->name('comments.store_reply_comment');
Route::resource('comments', 'Frontend\CommentController');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', function () {
        return view('backend.master');
    })->name('admin');
    Route::get('/homeApi', function () {
        return view('backend.mastervue');
    })->name('adminApi');
    Route::resource('users', 'Backend\UserController')->names([
        'create' => 'admin.users.create',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'show' => 'admin.users.show',
        'index' => 'admin.users.index',
    ]);
    Route::resource('categories', 'Backend\CategoryController')->names([
        'create' => 'admin.categories.create',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'show' => 'admin.categories.show',
        'index' => 'admin.categories.index',
    ]);

    Route::get('categoriesApi', 'Backend\CategoryController@indexApi')->name('admin.posts.indexApi');
    Route::get('categoriesApi/{category}', 'Backend\CategoryController@showApi')->name('admin.posts.showApi');
    Route::post('categoriesApi', 'Backend\CategoryController@storeApi')->name('admin.posts.storeApi');
    Route::put('categoriesApi/{category}', 'Backend\CategoryController@updateApi')->name('admin.posts.updateApi');
    Route::delete('categoriesApi/{category}', 'Backend\CategoryController@destroyApi')->name('admin.posts.destroyApi');

    Route::resource('posts', 'Backend\PostController')->names([
        'create' => 'admin.posts.create',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
        'show' => 'admin.posts.show',
        'index' => 'admin.posts.index',
    ]);
});
