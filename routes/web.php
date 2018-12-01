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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/#/{vue_capture?}', function () {
    return redirect('/');
})->where('vue_capture', '[\/\w\.-]*');

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::post('/posts', 'PostsController@index')->name('posts.index');
Route::post('/post/store', 'PostsController@store')->name('posts.store');
Route::post('/post/edit', 'PostsController@edit')->name('post.edit');
Route::post('/post/update', 'PostsController@update')->name('post.update');
Route::post('/post/show', 'PostsController@show')->name('post.show');
Route::post('/post/delete', 'PostsController@destroy')->name('post.delete');
