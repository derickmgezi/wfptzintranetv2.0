<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Helper;
use App\AccessLog;
use Route;
use Auth;
use Redirect;
use App\Resource;

class ResourceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Access WFP Resources Page";
        $access_log->action_details = "Redirected to Resources Page";
        $access_log->user = Auth::user()->username;
        $access_log->save();

        $resource_types = Resource::select('resource_type')->groupBy('resource_type')->get();
        $all_resources = Resource::orderBy('position','desc')->get();

        return view('resources')->with('all_resources',$all_resources)->with('resource_types',$resource_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type) {
        //                                             
        return back()->with('resourcetype',$type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$type) {
        //
        if($type == 'null'){
            $validator = Validator::make($request->all(), [
                'resource_name' => 'required',
                'resource_type' => 'required',
                'file' => 'required|mimes:pdf,xls,xlsm,xlsx,doc,docx,ppt,pptm,pptx,jpeg,bmp,png,bmp,gif,svg',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'resource_name' => 'required',
                'file' => 'required|mimes:pdf,xls,xlsm,xlsx,doc,docx,ppt,pptm,pptx,jpeg,bmp,png,bmp,gif,svg',
            ]);
        }

        if ($validator->fails()) {
            Session::flash('addResource_error', 'Resource Validation Failed');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store ".$type." Resource";
            $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput()->with('resourcetype',$type);
        }else{
            //Upload the resource file in storage/app/public/resources folder 
            $file_name = (string) ($request->file->store('public/resources'));
            $file_name = str_replace('public/', '', $file_name);

            $new_resource = new Resource;
            $new_resource->resource_name = $request->resource_name;

            if($type == 'null')
            $new_resource->resource_type = $request->resource_type;
            else
            $new_resource->resource_type = $type;

            $file_position = Resource::where('resource_type',$type)->count();
            $new_resource->position = $file_position+1;

            $new_resource->resource_location = $file_name;
            $new_resource->uploaded_by = Auth::id();
            $new_resource->edited_by = Auth::id();
            $new_resource->save();

            return back()->with('resouce','Resource was succesfully uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type,$url) {
        //
        //$output = null;
        //exec('"C:\Program Files (x86)\Adobe\Reader 10.0\Reader\AcroRd32.exe" \\10.11.74.12\Public\IT Unit\LTA-citizen_2CAD.pdf',$output);
        //dd($output);
        
        //$decrepted_url = (string) decrypt($url);
        $filetype = 'valid';
        
        if(!Str::contains($url, ['.pdf', 'jpeg'])){
            $filetype = 'invalid';
        }
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = 'View "'.$type.'" Resource';
        $access_log->action_details = 'Accessed '.$type.' resource';
        $access_log->user = Auth::user()->username;
        $access_log->save();

        return view('resource')->with('resource',$url)->with('filetype',$filetype);
        //echo '<iframe src="public/resource/'.$decrepted_url.'" width="100%" style="height:100%"></iframe>';
    }

    public function show_external_link($name,$url) {
        //
        $decrepted_url = (string) decrypt($url);

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = 'Access '.$name;
        $access_log->action_details = 'Redirected to '.$name;
        $access_log->user = Auth::user()->username;
        $access_log->link_type = 'External';
        $access_log->save();

        return Redirect::to($decrepted_url);
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
