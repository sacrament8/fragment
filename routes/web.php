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
Route::post('/posts', 'PostController@store')->name('posts.store');
Route::get('/posts/{id}', 'PostController@show')->name('posts.show');
Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
Route::patch('/posts/{id}', 'PostController@update')->name('posts.update');
Route::delete('/posts/{id}', 'PostController@remove')->name('posts.remove');
// boards
Route::get('/boards', 'BoardController@index')->name('boards.index');
Route::get('/boards/create', 'BoardController@create')->name('boards.create');
Route::post('/boards', 'BoardController@store')->name('boards.store');
Route::get('/boards/{id}', 'BoardController@show')->name('boards.show');
// comments
Route::post('/boards/{id}/store', 'CommentController@store')->name('comments.store');
// answers
Route::post('/answers/{id}/store', 'AnswerController@store')->name('answers.store');
Route::delete('/posts/{post_id}/answers/{answer_id}', 'AnswerController@remove')->name('answers.remove');
Route::get('/posts/{post_id}/answers/{answer_id}/edit', 'AnswerController@edit')->name('answers.edit');
Route::patch('/posts/{post_id}/answers/{answer_id}', 'AnswerController@update')->name('answers.update');

// auth
Auth::routes();
