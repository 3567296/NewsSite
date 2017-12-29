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

Route::middleware(['web'])->namespace('Web')->as('web.')->group(function () {
    Route::get('/', [
        'uses' => 'NewsController@index',
        'as' => 'news'
    ]);

    Route::get('/news/{post}', [
        'uses' => 'NewsController@show',
        'as' => 'news.show'
    ]);

    Route::post('news/{post}/comments', [
        'uses' => 'CommentController@store',
        'as' => 'news.comments'
    ]);

    Route::get('/category/{category}', [
        'uses' => 'CategoryController@category',
        'as' => 'category'
    ]);

    Route::get('/tag/{tag}', [
        'uses' => 'NewsController@tag',
        'as' => 'tag'
    ]);
});

Route::middleware(['admin'])->namespace('Admin')->as('admin.')->prefix('admin')->group(function () {
    Route::resource('/', 'PostController');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController', ['except' => ['show']]);

    Route::resource('comments', 'CommentController', ['except' => ['create']]);
    Route::resource('tags', 'TagController');

    Route::get('/edit-account', 'ProfileController@edit');
    Route::put('/edit-account', 'ProfileController@update');

    Route::as('ajax.')->group(function () {
        Route::post('categories/activeChange/{id}', 'CategoryController@activeChange')->name('category');
        Route::post('comments/activeChange/{id}', 'CommentController@activeChange')->name('comment');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/logout', function () {
    Auth::logout();
    return back();
});
