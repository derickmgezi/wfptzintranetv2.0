<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use App\AccessLog;
use App\VenueBooking;
use Route;
use Date;
use Illuminate\Database\Eloquent\Collection;

class VenueBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Session::has('calendardate')){
            $date = date("Y-m-d", Session::get('calendardate'));
            $venuebookings = VenueBooking::where('status',1)
                                         ->where('date','=',$date)
                                         ->orderBy('start_time')
                                         ->get();
            //Session::forget('calendardate');                         
        }else{
            $date = date("Y-m-d");
            $now = date('H:i:s');
            $venuebookings = VenueBooking::where('status',1)
                                         ->where('date','=',$date)
                                         ->where('end_time','>=',$now)
                                         ->orderBy('start_time')
                                         ->get();
        }

        $bookingcolors = collect(['badge-success','badge-warning','badge-info','badge-danger','badge-default']);


        $today = new Date('today');
        if(Session::has('date')){
            $date = Session::get('date');
        }else{
            $date = $today;
        }
        $days_in_month = cal_days_in_month(CAL_GREGORIAN,$date->month,$date->year);
        $month = collect();
        $weeks = Collection::make();
        $dates = new Collection;


        for($day = 1; $day <= $days_in_month; $day++){
            $date_in_month = Date::createFromDate($date->year, $date->month, $day);
            
            $weeks->push(['week'=>$date_in_month->weekNumberInMonth]);

            $dates->push(['date'=>$date_in_month->day,'day'=>$date_in_month->format('l'), 'week'=>$date_in_month->weekNumberInMonth, 'month'=>$date_in_month->month, 'year'=>$date_in_month->year, 'timestamp'=>$date_in_month->timestamp]);

            //array_push($dates, array('date'=>$date_in_month->day, 'day'=>$date_in_month->format('l'), 'week'=>$date_in_month->weekNumberInMonth, 'month'=>$date_in_month->month, 'year'=>$date_in_month->year));

        }
        $month = collect(['month'=>$date->format('M'),'year'=>$date->year]);
        $weeks = $weeks->unique('week');
        
        return view('previous')->with('venuebookings',$venuebookings)->with('bookingcolors',$bookingcolors)->with('month',$month)->with('weeks',$weeks)->with('dates',$dates)->with('today',$today)->with('timestamp',$date->timestamp);
    }
    
    public function previousmonth($timestamp) {
        $previous_month_timestamp = (new Date((int)$timestamp))->sub('1 month');
        //dd($previous_month_timestamp);
        Session::flash('date', $previous_month_timestamp);
        return redirect('/previous');
    }

    public function nextmonth($timestamp) {
        $next_month_timestamp = (new Date((int)$timestamp))->add('1 month');
        //dd($next_month_timestamp);
        Session::flash('date', $next_month_timestamp);
        return redirect('/previous');
    }

    public function calendar($timestamp) {
        Session::flash('calendardate', $timestamp);
        return redirect('/previous');
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
                'purpose' => 'required',
                'date' => 'required|date|after_or_equal:today',
                'starttime' => 'required|before:endtime',
                'endtime' => 'required|after:starttime',
                'participants' => 'required',
                'requirebeverages' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'office' => 'required',
                'venue' => 'required',
                'purpose' => 'required',
                'date' => 'required|date|after_or_equal:today',
                'starttime' => 'required|before:endtime',
                'endtime' => 'required|after:starttime',
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
            Session::flash('create_venue_booking', 'Your Booking was successful');

            $new_booking = new VenueBooking;
            $new_booking->purpose = $request->purpose;
            $new_booking->location = $request->office;
            $new_booking->venue = $request->venue;
            $new_booking->date = $request->date;
            $new_booking->start_time = $request->starttime;
            $new_booking->end_time = $request->endtime;
            $new_booking->participants = $request->participants;
            $new_booking->requirebeverages = $request->requirebeverages;
            if($request->requirebeverages == 'Yes')
            $new_booking->beverageoptions = implode( ", ", $request->beverageoptions );
            $new_booking->created_by = Auth::id();
            $new_booking->save();

            $timestamp = new Date($request->date);
            $timestamp = $timestamp->timestamp;

            Session::flash('calendardate', $timestamp);
            return redirect('/previous');
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
