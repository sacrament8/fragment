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

// Route::get('/', function () {
//     return view('welcome');
// });

// ランディングページ
Route::get('/', 'StaticPageController@index')->name('lp');
// users
Route::get('/users/{id}', 'UserController@show')->name('users.show');
Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
// posts
Route::get('/posts/index', 'PostController@index')->name('posts.index');
Route::get('/posts/create', 'PostController@create')->name('posts.create');
ROute::post('/users/{id}/posts/store', 'PostController@store')->name('posts.store');
// auth
Auth::routes();
