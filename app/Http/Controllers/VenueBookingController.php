<?php

namespace App\Http\Controllers;

use App\Notifications\ConferenceRoomBooked;
use App\Notifications\ConferenceRoomBookingAmended;
use App\Notifications\ConferenceReservationCanceled;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use App\User;
use App\AccessLog;
use App\VenueBooking;
use Route;
use Date;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Notification;

class VenueBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Session::has('calendardate')){
            $venuebookings = '';
            $calendardate = date("Y-m-d", Session::get('calendardate'));

            if(Session::has('bookingID')){

                $venuebookings = VenueBooking::where('id',Session::get('bookingID'))->get();

            }else{

                if(Session::has('officefilter') && Session::has('venuefilter')){
                    $venuebookings = VenueBooking::where('status',1)
                                                 ->where('date','=',$calendardate)
                                                 ->where('venue',Session::get('venuefilter'))
                                                 ->where('location',Session::get('officefilter'))
                                                 ->orderBy('start_time')
                                                 ->get();
                }else{

                    $venuebookings = VenueBooking::where('status',1)
                                                 ->where('date','=',$calendardate)
                                                 ->orderBy('start_time')
                                                 ->get();
                }
            
            }           
        }else{
            $calendardate = date("Y-m-d");
            $now = date('H:i:s');
            $venuebookings = VenueBooking::where('status',1)
                                         ->where('date','=',$calendardate)
                                         ->where('end_time','>=',$now)
                                         ->orderBy('start_time')
                                         ->get();
        }

        $bookingcolors = collect(['badge-default','badge-info','badge-warning','badge-danger','badge-success']);


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
        
        return view('previous')->with('venuebookings',$venuebookings)->with('calendardate',$calendardate)->with('bookingcolors',$bookingcolors)->with('month',$month)->with('weeks',$weeks)->with('dates',$dates)->with('today',$today)->with('timestamp',$date->timestamp);
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

    public function filterbookings(Request $request){
        $timestamp = new Date($request->datefilter);
        $timestamp = $timestamp->timestamp;

        $validator = Validator::make($request->all(), [
            'officefilter' => 'required',
            'venuefilter' => 'required',
            'datefilter' => 'required|date',
        ]);

        if ($validator->fails()) {
            Session::flash('calendardate', $timestamp);

            return redirect('/previous')->withErrors($validator)->withInput();
        }else{
            Session::flash('calendardate', $timestamp);
            Session::flash('officefilter', $request->officefilter);
            Session::flash('venuefilter', $request->venuefilter);

            return redirect('/previous')->withInput();
        }
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
        $startdate = new Date($request->startdate);
        $enddate = new Date($request->enddate);
        $timestamp = $startdate->timestamp;

        //Convert Request timeformat to resemble those in the database
        $starttime = new Date($request->starttime);
        $starttime =  $starttime->toTimeString();
        
        $endtime = new Date($request->endtime);
        $endtime =  $endtime->toTimeString();

        if($request->requirebeverages == 'No'){
            $validator = Validator::make($request->all(), [
                'office' => 'required',
                'venue' => 'required',
                'purpose' => 'required',
                'startdate' => 'required|date|after_or_equal:today',
                'enddate' => 'required|date|after_or_equal:startdate',
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
                'startdate' => 'required|date|after_or_equal:today',
                'enddate' => 'required|date|after_or_equal:startdate',
                'starttime' => 'required|before:endtime',
                'endtime' => 'required|after:starttime',
                'participants' => 'required',
                'requirebeverages' => 'required',
                'beverageoptions' => 'required',
            ]);
        }
            

        if ($validator->fails()) {
            Session::flash('create_venue_booking_error', 'Venue Booking Validation Error');
            Session::flash('calendardate', $timestamp);

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Create Venue Booking";
            $access_log->action_details = "Booking for Venue failed due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            return redirect('/previous')->withErrors($validator)->withInput();
        }else{
            for($date = $startdate; $date <= $enddate; $date->modify('+1 day')){
                //Check if Venue has been booked or not
                $bookings = VenueBooking::select('purpose','date','start_time','end_time')
                                         ->where('status',1)
                                         ->where('venue',$request->venue)
                                         ->where('date',$date->format("Y-m-d"))
                                         ->get();

                foreach($bookings as $booking){
                    $bookingdate = new Date($booking->date);
                    $bookingdate = $bookingdate->format('l jS F, Y');

                    if(!(($starttime > $booking->start_time && $starttime >= $booking->end_time) || ($starttime < $booking->start_time && $starttime < $booking->end_time))){
                        Session::flash('starttime_error', 'Start Time overlaps with <strong>"'.$booking->purpose.'"</strong> thats on <strong>'.$bookingdate.'</strong>');
                        Session::flash('calendardate', $timestamp);
                        Session::flash('create_venue_booking_error', 'Start Time Validation Error');
                        
                        return redirect('/previous')->withInput();
                    }elseif(!(($starttime < $booking->start_time && $endtime <= $booking->start_time) || ($endtime > $booking->end_time && $starttime >= $booking->end_time))){
                        Session::flash('endtime_error', 'End Time overlaps with <strong>"'.$booking->purpose.'"</strong> thats on <strong>'.$bookingdate.'</strong>');
                        Session::flash('calendardate', $timestamp);
                        Session::flash('create_venue_booking_error', 'End Time Validation Error');
                        
                        return redirect('/previous')->withInput();
                        
                        //}elseif(!($starttime < $booking->start_time && $endtime <= $booking->start_time)){
                        //    Session::flash('endtime_error', 'End Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                        //    Session::flash('calendardate', $timestamp);
                        //    
                        //    return redirect('/previous')->withInput();
                        //
                        //}elseif(!($endtime > $booking->end_time && $starttime >= $booking->end_time)){
                        //    Session::flash('starttime_error', 'Start Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                        //    Session::flash('calendardate', $timestamp);
                        //    
                        //    return redirect('/previous')->withInput();
                        //
                    }elseif(!(($endtime > $booking->start_time && $endtime > $booking->end_time) || ($endtime <= $booking->start_time && $endtime < $booking->end_time))){
                        Session::flash('endtime_error', 'End Time overlaps with <strong>"'.$booking->purpose.'"</strong> thats on <strong>'.$bookingdate.'</strong>');
                        Session::flash('calendardate', $timestamp);
                        Session::flash('create_venue_booking_error', 'End Time Validation Error');
                        
                        return redirect('/previous')->withInput();
                    }
                }
            }
            $startdate = new Date($request->startdate);

            for($date = $startdate; $date <= $enddate; $date->modify('+1 day')){
                $new_booking = new VenueBooking;
                $new_booking->purpose = $request->purpose;
                $new_booking->location = $request->office;
                $new_booking->venue = $request->venue;
                $new_booking->date = $date->format("Y-m-d");
                $new_booking->start_time = $request->starttime;
                $new_booking->end_time = $request->endtime;
                $new_booking->participants = $request->participants;
                $new_booking->requirebeverages = $request->requirebeverages;

                if($request->requirebeverages == 'Yes'){
                    $new_booking->beverageoptions = implode( ", ", $request->beverageoptions);
                }

                $new_booking->created_by = Auth::id();
                $new_booking->save();
            }
            
            Session::flash('calendardate', $timestamp);
            Session::flash('create_venue_booking', 'Your Booking was successful');

            //Convert Request timeformat to resemble those in the database
            $starttime = new Date($request->starttime);
            $starttime =  $starttime->toTimeString();

            $endtime = new Date($request->endtime);
            $endtime =  $endtime->toTimeString();

            //Notifiable user(s) trough email after the booking is succeful
            $users = User::find([Auth::id(), 3]);

            //Find full details from the database of the booking that was made
            $startdate = new Date($timestamp);
            $startdate = $startdate->format("Y-m-d");

            $booking = VenueBooking::where('date',$startdate)
                                   ->where('start_time',$starttime)
                                   ->where('end_time',$endtime)
                                   ->first();

            try{
                //Sent Email Notification to user(s)
                //$user->notify(new ConferenceRoomBooked($booking)); //Sends Notification to a single user
                Notification::send($users, new ConferenceRoomBooked($booking,$enddate)); //Sends Notification to multiple users
            }catch(\Exception $e){
                //dd($e->getMessage());
            }

            return redirect('/previous');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbooking($id){
        $booking = VenueBooking::find($id);

        $bookingdate = new Date($booking->date);
        $bookingtimestamp = $bookingdate->timestamp;

        Session::flash('bookingID', $id);
        Session::flash('calendardate', $bookingtimestamp);

        return redirect('/previous');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editbooking($id){
        $booking = VenueBooking::find($id);

        $bookingdate = new Date($booking->date);
        $bookingtimestamp = $bookingdate->timestamp;

        Session::flash('edit_venue_booking', $booking);
        Session::flash('calendardate', $bookingtimestamp);

        return redirect('/previous');
    }

    public function edit_booking(Request $request){
        $booking = VenueBooking::find($request->reservationid);

        $timestamp = new Date($request->date);
        $timestamp = $timestamp->timestamp;

        if($request->requirebeverages == 'No'){
            $validator = Validator::make($request->all(), [
                'reservationid' => 'required',
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
                'reservationid' => 'required',
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
            Session::flash('edit_venue_booking', $booking);
            Session::flash('calendardate', $timestamp);

            return redirect('/previous')->withErrors($validator)->withInput();
        }else{
            //Check if Venue has been booked or not
            $bookings = VenueBooking::select('purpose','start_time','end_time')
                                     ->where('status',1)
                                     ->where('date',$request->date)
                                     ->where('venue',$request->venue)
                                     ->whereNotIn('id',[$request->reservationid])
                                     ->get();

            foreach($bookings as $booking){
                //Convert Request timeformat to resemble those in the database
                $starttime = new Date($request->starttime);
                $starttime =  $starttime->toTimeString();

                $endtime = new Date($request->endtime);
                $endtime =  $endtime->toTimeString();

                if(!(($starttime > $booking->start_time && $starttime >= $booking->end_time) || ($starttime < $booking->start_time && $starttime < $booking->end_time))){
                    Session::flash('starttime_error', 'Start Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                    Session::flash('calendardate', $timestamp);
                    Session::flash('edit_venue_booking', $booking);

                    return redirect('/previous')->withInput();
                }elseif(!(($starttime < $booking->start_time && $endtime <= $booking->start_time) || ($endtime > $booking->end_time && $starttime >= $booking->end_time))){
                    Session::flash('endtime_error', 'End Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                    Session::flash('calendardate', $timestamp);
                    Session::flash('edit_venue_booking', $booking);
                    
                    return redirect('/previous')->withInput();
                
                //}elseif(!($starttime < $booking->start_time && $endtime <= $booking->start_time)){
                //    Session::flash('endtime_error', 'End Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                //    Session::flash('calendardate', $timestamp);
                //    
                //    return redirect('/previous')->withInput();
                //
                //}elseif(!($endtime > $booking->end_time && $starttime >= $booking->end_time)){
                //    Session::flash('starttime_error', 'Start Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                //    Session::flash('calendardate', $timestamp);
                //    
                //    return redirect('/previous')->withInput();
                //
                }elseif(!(($endtime > $booking->start_time && $endtime > $booking->end_time) || ($endtime <= $booking->start_time && $endtime < $booking->end_time))){
                    Session::flash('endtime_error', 'End Time overlaps with <strong>"'.$booking->purpose.'"<strong>');
                    Session::flash('calendardate', $timestamp);
                    Session::flash('edit_venue_booking', $booking);
                    
                    return redirect('/previous')->withInput();
                }
            }

            $booking = VenueBooking::find($request->reservationid);
            $booking->purpose = $request->purpose;
            $booking->location = $request->office;
            $booking->venue = $request->venue;
            $booking->date = $request->date;
            $booking->start_time = $request->starttime;
            $booking->end_time = $request->endtime;
            $booking->participants = $request->participants;
            $booking->requirebeverages = $request->requirebeverages;

            if($request->requirebeverages == 'Yes'){
                $booking->beverageoptions = implode( ", ", $request->beverageoptions );
            }

            $booking->created_by = Auth::id();
            $booking->save();
            
            Session::flash('calendardate', $timestamp);
            Session::flash('venue_booking_edited', 'Your Booking was successful edited');

            //Notifiable user(s) trough email after the booking is succeful
            $users = User::find([Auth::id(), 3]);

            try{
                //Sent Email Notification to user(s)
                //$user->notify(new ConferenceRoomBooked($booking)); //Sends Notification to a single user
                Notification::send($users, new ConferenceRoomBookingAmended($booking)); //Sends Notification to multiple users
            }catch(\Exception $e){
                //dd($e->getMessage());
            }

            return redirect('/previous');
            
        }
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
    public function destroy($id){
        //
    }

    public function cancelbooking($id){
        $booking = VenueBooking::find($id);

        $bookingdate = new Date($booking->date);
        $bookingtimestamp = $bookingdate->timestamp;

        Session::flash('cancel_venue_booking', $booking);
        Session::flash('calendardate', $bookingtimestamp);

        return redirect('/previous');
    }

    public function cancel_booking($id){
        $booking = VenueBooking::find($id);
        $booking->status = 0;
        $booking->save();

        $bookingdate = new Date($booking->date);
        $bookingtimestamp = $bookingdate->timestamp;

        Session::flash('calendardate', $bookingtimestamp);

        //Notifiable user(s) trough email after the booking is succeful
        $users = User::find([Auth::id(), 3]);

        try{
            //Sent Email Notification to user(s)
            //$user->notify(new ConferenceRoomBooked($booking)); //Sends Notification to a single user
            Notification::send($users, new ConferenceReservationCanceled($booking)); //Sends Notification to multiple users
        }catch(\Exception $e){
            //dd($e->getMessage());
        }

        return redirect('/previous');
    }
}
