<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class VenueBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
        if($request->requirebeverages == 'No'){
            $validator = Validator::make($request->all(), [
                'office' => 'required',
                'venue' => 'required',
                'date' => 'required',
                'starttime' => 'required',
                'endtime' => 'required',
                'participants' => 'required',
                'requirebeverages' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'office' => 'required',
                'venue' => 'required',
                'date' => 'required',
                'starttime' => 'required',
                'endtime' => 'required',
                'participants' => 'required',
                'requirebeverages' => 'required',
                'beverageoptions' => 'required',
            ]);
        }
            

        if ($validator->fails()) {
            Session::flash('create_venue_booking_error', 'Venue Booking Validation Error');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Create Venue Booking";
            $access_log->action_details = "Booking for Venue failed due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput();
        }else{
            dd($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
