<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\News;
use App\Story;
use App\Resource;
use App\MediaAlert;
use App\PhoneDirectory;
use Session;
use App\AccessLog;
use Auth;
use Route;
use App\View;

class SearchController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $news_search_results = News::search(Session::get('search_string'))->where('status', 1)->get();
        $news_search_results_count= $news_search_results->count();

        $story_search_results = Story::search(Session::get('search_string'))->where('status', 1)->get();
        $story_search_results_count = $story_search_results->count();

        $media_alert_search_results = MediaAlert::search(Session::get('search_string'))->where('status', 1)->get();
        $media_alert_search_results_count = $media_alert_search_results->count();

        $resource_search_results = Resource::search(Session::get('search_string'))->where('status', 1)->get();
        $resource_search_results_count = $resource_search_results->count();

        $phone_directory_search_results = PhoneDirectory::search(Session::get('search_string'))->get();
        $phone_directory_search_results_count = $phone_directory_search_results->count();

        $search_result_count = $news_search_results_count + $story_search_results_count + $media_alert_search_results_count + $resource_search_results_count + $phone_directory_search_results_count;
        
        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Access Search Page";
        $access_log->action_details = '"'.$search_result_count.'" results for search text "'.Session::get('search_string').'" displayed';
        if(!Session::has('read_news_post'))
        $access_log->save();

        return view('search', compact('news_search_results', 'news_search_results_count', 'story_search_results', 'story_search_results_count', 'resource_search_results', 'resource_search_results_count', 'media_alert_search_results', 'media_alert_search_results_count','phone_directory_search_results', 'phone_directory_search_results_count', 'search_result_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
                    'search' => 'required',
        ]);
        
        if ($validator->fails()) {
            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Search for text";
            $access_log->action_details = 'Search text box empty';
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()
                   ->withErrors($validator)
                   ->withInput();
        } else {
            Session::put('search_string',$request->search);

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Search for text";
            $access_log->action_details = 'Search text "'.$request->search.'" submited';
            $access_log->save();

            return redirect('search');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    public function show_news_post($id) {
        //Record the view in the Database
        $view = new View;
        $view->view_id = $id;
        $view->viewed_by = Auth::id();
        $view->save();

        $news_post = News::find($id);
        Session::flash('read_news_post', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Diaplay Wfp Update";
        $access_log->action_details = 'Wfp update with id "'.$id.'" displayed';
        $access_log->save();
        
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
