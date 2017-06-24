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
Route::get('/', 'UserController@index');

Route::post('/signin', 'UserController@store');

Route::get('/signout', 'UserController@logout');

Route::get('/home', 'HomeController@index')->middleware('guest');

Route::get('/create_post', 'PIController@create_post')->middleware('guest');

Route::post('/store_post', 'PIController@store_post')->middleware('guest');

Route::get('/edit_post/{id}', 'PIController@edit_post')->middleware('guest');

Route::post('/edit_post/{id}', 'PIController@update_post')->middleware('guest');

Route::get('/remove_post/{id}', 'PIController@delete_post')->middleware('guest');

Route::get('/read_post/{id}', 'PIController@show_post')->middleware('guest');

Route::get('/create_news_post', 'PIController@create_news_post')->middleware('guest');

Route::post('/store_news_post', 'PIController@store_news_post')->middleware('guest');

Route::get('/edit_news_post/{id}', 'PIController@edit_news_post')->middleware('guest');

Route::post('/edit_news_post/{id}', 'PIController@update_news_post')->middleware('guest');

Route::get('/remove_news_post/{id}', 'PIController@delete_news_post')->middleware('guest');

Route::get('/read_news_post/{id}', 'PIController@show_news_post')->middleware('guest');

Route::get('/internaldirectory', 'PhoneDirectoryController@index')->middleware('guest');

Route::post('/update_contacts', 'PhoneDirectoryController@store_contacts')->middleware('guest');

Route::get('/view_user_bio/{id}', 'PIController@show_user_bio')->middleware('guest');

Route::get('/add_bio/{id}', 'PIController@add_user_bio')->middleware('guest');

Route::post('/update_bio/{id}', 'PIController@update_user_bio')->middleware('guest');

Route::get('/edit_bio/{id}', 'PIController@add_user_bio')->middleware('guest');

Route::post('/search', 'SearchController@search')->middleware('guest');

Route::get('/search', 'SearchController@index')->middleware('guest');

Route::get('/it', 'ITController@index')->middleware('guest');

Route::get('/create_it_post', 'ITController@create')->middleware('guest');

Route::post('/store_it_post', 'ITController@store_post')->middleware('guest');

Route::get('/edit_it_post/{id}', 'ITController@edit_post')->middleware('guest');

Route::post('/edit_it_post/{id}', 'ITController@update_post')->middleware('guest');

Route::get('/remove_it_post/{id}', 'ITController@destroy_post')->middleware('guest');

Route::get('/news', function () {
    return view('news');
});

Route::get('/previous', function () {
    return view('previous');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
