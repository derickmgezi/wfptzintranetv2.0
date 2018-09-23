<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Helper;
use App\AccessLog;
use Route;
use Auth;
use Redirect;

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

        return view('resources');
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
        
        $decrepted_url = (string) decrypt($url);
        $filetype = 'pdf';
        
        if(!str_contains($decrepted_url, $filetype)){
            $filetype = 'invalid';
        }
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = 'View "'.$type.'" Resource';
        $access_log->action_details = 'Accessed '.$type.' resource';
        $access_log->user = Auth::user()->username;
        $access_log->save();

        return view('resource')->with('resource',$decrepted_url)->with('filetype',$filetype);
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
