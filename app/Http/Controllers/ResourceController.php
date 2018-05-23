<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

class ResourceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
    public function show($url) {
        //
        //$output = null;
        //exec('"C:\Program Files (x86)\Adobe\Reader 10.0\Reader\AcroRd32.exe" \\10.11.74.12\Public\IT Unit\LTA-citizen_2CAD.pdf',$output);
        //dd($output);
        
        $decrepted_url = (string) decrypt($url);
        $filetype = 'pdf';
        
        if(!str_contains($decrepted_url, $filetype)){
            $filetype = 'invalid';
        }
        
        return view('resource')->with('resource',$decrepted_url)->with('filetype',$filetype);
        //echo '<iframe src="public/resource/'.$decrepted_url.'" width="100%" style="height:100%"></iframe>';
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
