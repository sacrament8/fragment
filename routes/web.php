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
Route::post('/posts/store', 'PostController@store')->name('posts.store');
Route::get('/posts/{id}', 'PostController@show')->name('posts.show');
Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
Route::patch('/posts/{id}', 'PostController@update')->name('posts.update');
Route::delete('/posts/{id}', 'PostController@remove')->name('posts.remove');
// auth
Auth::routes();
