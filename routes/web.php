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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/home', 'HomeController@index');

    Route::get('/create_post', 'PIController@create_post');

    Route::post('/store_post', 'PIController@store_post');

    Route::get('/edit_post/{id}', 'PIController@edit_post');

    Route::post('/edit_post/{id}', 'PIController@update_post');

    Route::get('/remove_post/{id}', 'PIController@delete_post');

    Route::get('/read_post/{id}', 'PIController@show_post');

    Route::get('/create_news_post', 'PIController@create_news_post');

    Route::post('/store_news_post', 'PIController@store_news_post');

    Route::get('/edit_news_post/{id}', 'PIController@edit_news_post');

    Route::post('/edit_news_post/{id}', 'PIController@update_news_post');

    Route::get('/remove_news_post/{id}', 'PIController@delete_news_post');

    Route::get('/read_news_post/{id}', 'PIController@show_news_post');

    Route::get('/like_news_post/{id}', 'PIController@like_news_post');

    Route::get('/internaldirectory', 'PhoneDirectoryController@index');

    Route::post('/update_contacts', 'PhoneDirectoryController@store_contacts');

    Route::get('/view_user_bio/{id}', 'PIController@show_user_bio');

    Route::get('/add_bio/{id}', 'PIController@add_user_bio');

    Route::post('/update_bio/{id}', 'PIController@update_user_bio');

    Route::get('/edit_bio/{id}', 'PIController@add_user_bio');

    Route::post('/search', 'SearchController@search');

    Route::get('/search', 'SearchController@index');

    Route::get('/it', 'ITController@index');

    Route::get('/create_it_post', 'ITController@create');

    Route::post('/store_it_post', 'ITController@store_post');

    Route::get('/edit_it_post/{id}', 'ITController@edit_post');

    Route::post('/edit_it_post/{id}', 'ITController@update_post');

    Route::get('/remove_it_post/{id}', 'ITController@destroy_post');

    Route::get('/create_update', 'UpdateController@create_update');

    Route::post('/store_update/{department}', 'UpdateController@store_update');

    Route::get('/edit_update/{id}', 'UpdateController@edit_update');

    Route::post('/edit_update/{id}', 'UpdateController@update_update');

    Route::get('/remove_update/{id}', 'UpdateController@delete_update');

    Route::get('/read_update/{id}', 'UpdateController@show_update');

    Route::get('/like_update/{id}', 'UpdateController@like_update');
    
    Route::get('/finance', function () {
        return view('finance')->with('department','Finance');
    });

    Route::get('/previous', function () {
        return view('previous');
    });

    Route::get('/administration', function () {
        return view('administration')->with('department','Admin');
    });

    Route::get('/hr', function () {
        return view('hr')->with('department','HR');
    });

    Route::get('/supplychain', function () {
        return view('supplychain')->with('department','Logistics');
    });

    Route::get('/programme', function () {
        return view('programme')->with('department','Programme');
    });
    
    Route::get('/manage', 'ManageController@index');
    
     Route::get('/createuser', 'ManageController@create');
    
    Route::post('/adduser', 'ManageController@store');
    
    Route::get('/edituser/{id}', 'ManageController@edit');
    
    Route::post('/edituser/{id}', 'ManageController@update');
    
    Route::get('/deleteuser/{id}', 'ManageController@destroy');
    
    Route::get('/feedback', 'FeedbackController@index');

    Route::post('/feedback', 'FeedbackController@store');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
