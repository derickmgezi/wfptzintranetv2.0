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
    
    Route::get('/innovation', 'InnovationController@index');
    
    Route::get('/latestnewsupdates', 'HomeController@latestnewsupdates');
    
    Route::get('/unreadnewsupdate', 'HomeController@unreadnewsupdate');

    Route::get('/newsupdateviews', 'HomeController@newsupdateviews');
    
    Route::get('/newsupdatelikes', 'HomeController@newsupdatelikes');
    
    Route::get('/newsupdatecomments', 'HomeController@newsupdatecomments');
    
    Route::get('/mynewsupdate', 'HomeController@mynewsupdate');
    
    Route::get('/communications', 'PIController@index');

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
    
    Route::get('/private/{id}', 'PhoneDirectoryController@make_call_private');
    
    Route::get('/public/{id}', 'PhoneDirectoryController@make_call_public');

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
    
    Route::get('/resizenewsthumbnails', 'UpdateController@resizenewsthumbnails');
    
    Route::get('/add_update', 'UpdateController@add_update');

    Route::post('/store_update/{department}/{dutystation}', 'UpdateController@store_update');

    Route::get('/edit_update/{id}', 'UpdateController@edit_update');

    Route::post('/edit_update/{id}', 'UpdateController@update_update');
    
    Route::get('/delete_update/{id}', 'UpdateController@delete_update');

    Route::get('/remove_update/{id}', 'UpdateController@delete_update');

    Route::get('/read_update/{id}', 'UpdateController@show_update');

    Route::get('/like_update/{id}', 'UpdateController@like_update');
    
    Route::get('/storiyangu', 'StoryController@index');
    
    Route::get('/lateststory', 'StoryController@lateststory');
    
    Route::get('/resizethumbnails', 'StoryController@resizethumbnails');
    
    Route::get('/unreadstory', 'StoryController@unreadstory');
    
    Route::get('/storyviews', 'StoryController@storyviews');
    
    Route::get('/storylikes', 'StoryController@storylikes');
    
    Route::get('/storycomments', 'StoryController@storycomments');
    
    Route::get('/mystory', 'StoryController@mystory');
    
    Route::get('/addstory', 'StoryController@create');
    
    Route::get('/story/', 'StoryController@storyindex');
    
    Route::post('/store_story', 'StoryController@store');
    
    Route::get('/storiyangu/{id}', 'StoryController@show');
    
    Route::get('/likestory/{id}', 'StoryController@like');
    
    Route::get('/editstory/{id}', 'StoryController@edit');
    
    Route::get('/deletestory/{id}', 'StoryController@destroy');
    
    Route::post('/edit_story/{id}', 'StoryController@update');
    
    Route::post('/store_story_comment/{id}', 'StoryController@storecomment');
    
    Route::get('/mediaalerts', 'MediaalertController@index');
    
    Route::post('/store_media_alert', 'MediaalertController@store');

    Route::get('/resource', 'ResourceController@index');
    
    Route::get('/resource/{url}', 'ResourceController@show');
    
    Route::get('/previous', function () {
        return view('previous');
    });
    
    Route::get('/finance', function () {
        return view('finance')->with('department','Finance')->with('dutystation','Country Office');
    });

    Route::get('/administration', function () {
        return view('administration')->with('department','Admin')->with('dutystation','Country Office');
    });

    Route::get('/hr', function () {
        return view('hr')->with('department','HR')->with('dutystation','Country Office');
    });

    Route::get('/supplychain', function () {
        return view('supplychain')->with('department','Logistics')->with('dutystation','Country Office');
    });

    Route::get('/programme', function () {
        return view('programme')->with('department','Programme')->with('dutystation','Country Office');
    });
    
    Route::get('/dodoma', function () {
        return view('dodoma')->with('department','Programme')->with('dutystation','Dodoma');
    });
    
    Route::get('/kibondo', function () {
        return view('kibondo')->with('department','Programme')->with('dutystation','Kibondo');
    });
    
    Route::get('/kigoma', function () {
        return view('kigoma')->with('department','Programme')->with('dutystation','Kigoma');
    });
    
    Route::get('/kasulu', function () {
        return view('kasulu')->with('department','Programme')->with('dutystation','Kasulu');
    });
    
    Route::get('/isaka', function () {
        return view('isaka')->with('department','Programme')->with('dutystation','Isaka');
    });
    
    Route::get('/manage', 'ManageController@index');
    
    Route::get('/createuser', 'ManageController@create');
    
    Route::post('/adduser', 'ManageController@store');
    
    Route::get('/edituser/{id}', 'ManageController@edit');
    
    Route::post('/edituser/{id}', 'ManageController@update');
    
    Route::get('/deleteuser/{id}', 'ManageController@destroy');
    
    Route::get('/createeditor', 'ManageController@create');
    
    Route::post('/addeditor', 'EditorController@store');
    
    Route::get('/editpageeditor/{id}', 'EditorController@edit');
    
    Route::post('/editpageeditor/{id}', 'EditorController@update');
    
    Route::get('/deletepageeditor/{id}', 'EditorController@destroy');
    
    Route::get('/feedback', 'FeedbackController@index');

    Route::post('/feedback', 'FeedbackController@store');
    
    Route::get('/canteen/{meal}', 'CanteenController@index');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
