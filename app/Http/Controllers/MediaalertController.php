<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\MediaAlert;
use Auth;
use Image;
use DB;
use App\AccessLog;
use Route;

class MediaalertController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $days_of_media_alerts = DB::table('mediaalerts')->select(DB::raw("DATE_FORMAT(created_at,'%d %M %Y') as date, created_at"))
                                          ->where('status',1);

        $days_of_media_alerts = DB::table(DB::raw("({$days_of_media_alerts->toSql()}) as mediaalerts"))
                        ->mergeBindings($days_of_media_alerts)
                        ->select(DB::raw('mediaalerts.date, min(created_at) as fist_alert'))
                        ->orderBy('fist_alert', 'desc')
                        ->groupBy('date')
                        ->paginate(1);
        
        
        $mediaalerts = MediaAlert::select(DB::raw("id,header,mediacontent,type,source,created_at,DATE_FORMAT(created_at,'%d %M %Y') as date"))->where('status',1)->get();
        
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Access News Alerts Page";
        $access_log->action_details = "Redirected to News Alerts Page";
        $access_log->user = Auth::user()->username;
        if(!Session::has('new_media_alert_error') && !Session::has('new_media_alert') && !Session::has('edit_media_alert_error') && !Session::has('edit_media_alert') && !Session::has('delete_media_alert'))
        $access_log->save();

        return view('mediaalerts', compact('mediaalerts', 'days_of_media_alerts'));
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
    public function store(Request $request) {
        //
        if($request->mediatype == 'Link'){
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'mediatype' => 'required',
                'mediacontent' => 'required|url',
            ]);
        }elseif($request->mediatype == 'Image'){
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'mediatype' => 'required',
                'mediacontent' => 'required|image',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'mediatype' => 'required',
            ]);
        }

        if ($validator->fails()) {
            Session::flash('new_media_alert_error', 'Media Alert Creation Error');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store News Alert";
            $access_log->action_details = "Storing of new News Alert interrupted due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput();
        } else {
            if($request->mediatype == 'Link'){
                //store the media alert in database
                $mediaalert = new MediaAlert;
                $mediaalert->header = $request->header;
                $mediaalert->mediacontent = $request->mediacontent;
                $mediaalert->source = $request->source;
                $mediaalert->type = $request->mediatype;
                $mediaalert->created_by = Auth::id();
                $mediaalert->save();
            }elseif($request->mediatype == 'Image'){
                //Upload the file in storage public folder
                $image_name = (string) ($request->mediacontent->store('public/mediaalerts'));
                $image_name = str_replace('public/', '', $image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->mediacontent->store('public/thumbnails/mediaalerts'));

                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/' . $thumb_image_name);

                //Load the image into Intervention Package for manipulation
                Image::make($path)->fit(1080, 1080)->save($path);


                //store the media alert in database
                $mediaalert = new MediaAlert;
                $mediaalert->header = $request->header;
                $mediaalert->mediacontent = $image_name;
                $mediaalert->source = $request->source;
                $mediaalert->type = $request->mediatype;
                $mediaalert->created_by = Auth::id();
                $mediaalert->save();
            }
            Session::flash('new_media_alert', 'Media Alert stored');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store News Alert";
            $access_log->action_details = "New News Alert stored";
            $access_log->save();

            return back();
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
        $mediaalert = Mediaalert::find($id);
        //dd("Selection Media type: ".$request->type." Original Media Type: ".$mediaalert->type);

        if($request->type == 'Link'){
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'type' => 'required',
                'mediacontent' => 'required|url',
            ]);
        }elseif($request->type == 'Image' && $mediaalert->type == "Link"){
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'type' => 'required',
                'mediacontent' => 'required|image',
            ]);
        }elseif($request->hasFile('mediacontent')){
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'type' => 'required',
                'mediacontent' => 'required|image',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'header' => 'required',
                'source' => 'required',
                'type' => 'required',
            ]);
        }
        
        if ($validator->fails()) {
            //dd("Return to Media Page");
            Session::flash('edit_media_alert_error', 'Media Alert Edit Error');
            Session::flash('mediaid',$id);
            Session::flash('mediatype',$mediaalert->type);
            Session::flash('mediacontent',$mediaalert->mediacontent);

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Edit News Alert";
            $access_log->action_details = 'Editing News Alert with id "'.$id.'" interrupted due to validation errors';
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput();
        }else{
            
            if($request->type == 'Link'){
                //Update the media alert in database
                $mediaalert = MediaAlert::find($id);
                $mediaalert->header = $request->header;
                $mediaalert->mediacontent = $request->mediacontent;
                $mediaalert->source = $request->source;
                $mediaalert->type = $request->type;
                $mediaalert->save();
            }elseif($request->type == 'Image'){
                if($request->hasFile('mediacontent')){
                    //Upload the file in storage public folder
                    $image_name = (string) ($request->mediacontent->store('public/mediaalerts'));
                    $image_name = str_replace('public/', '', $image_name);

                    //Upload the file in storage thumbnail public folder
                    $thumb_image_name = (string) ($request->mediacontent->store('public/thumbnails/mediaalerts'));

                    //Get full path of uploaded image from the thumbnails
                    $path = storage_path('app/' . $thumb_image_name);

                    //Load the image into Intervention Package for manipulation
                    Image::make($path)->fit(1080, 1080)->save($path);
                }

                //Update the media alert in database
                $mediaalert = MediaAlert::find($id);
                $mediaalert->header = $request->header;
                if($request->hasFile('mediacontent'))
                $mediaalert->mediacontent = $image_name;
                $mediaalert->source = $request->source;
                $mediaalert->type = $request->type;
                $mediaalert->save();
            }
            Session::flash('edit_media_alert', 'News Alert Edited');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Edit News Alert";
            $access_log->action_details = 'News Alert with id "'.$id.'" edited';
            $access_log->save();

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        //
        $mediaalert = Mediaalert::find($id);
        $mediaalert->status = 0;
        $mediaalert->save();

        Session::flash('delete_media_alert', 'News Alert Deleted');

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Delete News Alert";
        $access_log->action_details = 'News Alert with id "'.$id.'" deleted';
        $access_log->save();

        return back();
    }

}
