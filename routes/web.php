<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['as' => 'articles.', 'prefix' => 'articles'], function () {
    Route::get('/', 'ArticleController@getPaginationView')->name('articles_page');
    Route::get('/pagination', 'ArticleController@getPagination')->name('pagination');
    Route::get('/{id}', 'ArticleController@get')->name('get');
    Route::get('/{id}/getLikes', 'ArticleController@getLikes')->name('get_likes');
    Route::post('/{id}/setLike', 'ArticleController@setLike')->name('set_like');
    Route::get('/{id}/getViews', 'ArticleController@getViews')->name('get_views');
    Route::post('/{id}/setView', 'ArticleController@setView')->name('set_view');
    Route::post('/{id}/comment', 'CommentController@create')->name('create_comment');
});

Route::get('/', function () {return view('home');})->name('home_page');

Route::get('/links', 'LinkController@get')->name('get_links');
