<div class="row">
    <div class="col-8">
        <div class="d-flex flex-column">
            {{Form::open(array('url' => '/filter_bookings','multiple' => true,'role' => 'form'))}}
            <div class="row" style="border:2px solid #ebeaec">
                <div class="col-12">
                    <div class="row">
                        <div class="col form-group @if($errors->first('officefilter')) has-danger @elseif(old('officefilter')) has-success @endif">
                            <label class="font-weight-bold font-italic">Conference Location</label>
                            <select id="officefilter" name="officefilter" class="form-control js-officefilter-single @if($errors->first('officefilter')) form-control-danger @elseif(old('officefilter')) form-control-success @endif">
                                <option></option>
                                <option @if(old('officefilter') == 'Country Office') selected @endif value="Country Office">Country Office</option>
                                <!-- <option >Dodoma Main Office</option>
                                <option >Kibondo</option> -->
                            </select>
                            {{-- @if($errors->first('officefilter'))
                                <div class="form-control-feedback">Location not selected</div>
                            @endif --}}
                        </div>
                        <div class="col form-group @if($errors->first('venuefilter')) has-danger @elseif(old('venuefilter')) has-success @endif">
                            <label class="font-weight-bold font-italic">Conference Room</label>
                            <select id="venuefilter" name="venuefilter" class="form-control js-venuefilter-single @if($errors->first('venuefilter')) form-control-danger @elseif(old('venuefilter')) form-control-success @endif">
                                <option></option>
                                <option @if(old('venuefilter') == 'Main Conference Room') selected @endif value="Main Conference Room">Main Conference Room</option>
                                <option @if(old('venuefilter') == 'Third Floor Conference Room') selected @endif value="Third Floor Conference Room">Third Floor Conference Room</option>
                                <!-- <option @if(old('venuefilter') == 'Canteen') selected @endif value="Canteen">Canteen</option> -->
                            </select>
                            {{-- @if($errors->first('venuefilter'))
                                <div class="form-control-feedback">Conference not selected</div>
                            @endif --}}
                        </div>
                        <div class="col form-group">
                            <?php $calendardate = new Jenssegers\Date\Date($calendardate); ?>
                            <label class="font-weight-bold font-italic">Conference Date</label>
                            <input class="form-control form-control-sm" type="date" name="datefilter" value="{{ $calendardate->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-warning pull-right mb-2">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filter Reservations
                    </button>
                </div>
                
            </div>
            <div class="row">
                <!-- Button trigger Venue Booking modal -->
                <a href="#" class="btn btn-success mb-1 mt-1" data-toggle="modal" data-target="#createBookingModal">
                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Create a new Reservation
                </a>
            </div>
            {{Form::token()}}
            {{Form::close()}}
    
            @if($venuebookings->count() == 0)
                <div class="row row-striped alert">
                    <div class="col-2 text-center">
                        <h2 class="display-4"><span class="badge badge-default">{{ $calendardate->format('d') }}</span></h2>
                        <span class="h2">{{ strtoupper($calendardate->format('M')) }}</span>
                    </div>
                    <div class="col-10">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $calendardate->format('l') }}</li>
                        </ul>
                        <h5 class="alert-heading">No reservations have been created at this time!</h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">To Researve a conference room click on the Create New Reservation Button above</li>
                        </ul>
                    </div>
                </div>
            @else
                @foreach($venuebookings as $venuebooking)
                <?php 
                    $date = new Jenssegers\Date\Date($venuebooking->date); 
                    $color = $bookingcolors->pull(0);
                    $bookingcolors->push($color);
                    $bookingcolors = $bookingcolors->values();
                ?>
                <div class="row row-striped">
                    <div class="col-2 text-center">
                        <h2 class="display-4"><span class="badge {{ $color }}">{{ $date->format('d') }}</span></h2>
                        <span class="h2">{{ strtoupper($date->format('M')) }}</span>
                    </div>
                    <div class="col-10">
                        <div class="pb-1">
                            <img class="img-fluid rounded-circle" src="{{ strlen(App\User::find($venuebooking->created_by)->image) != 0? url('/storage/thumbnails/'.App\User::find($venuebooking->created_by)->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="29" data-src="holder.js/25x25/auto"> 
                            <span class="text-primary">{{ App\User::find($venuebooking->created_by)->firstname.' '.App\User::find($venuebooking->created_by)->secondname}}</span>
                        </div>
                        <h5 class=""><strong>{{ $venuebooking->purpose }}</strong></h5>
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $date->format('l') }}</li>
                            <?php 
                                $start_time = new Jenssegers\Date\Date($venuebooking->start_time);
                                $end_time = new Jenssegers\Date\Date($venuebooking->end_time);
                             ?>
                            <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $start_time->format('h:i A') }} - {{ $end_time->format('h:i A') }}</li>
                            <li class="list-inline-item"><i class="fa fa-location-arrow text-warning" aria-hidden="true"></i> <a href="#" class="text-warning font-weight-bold">{{ $venuebooking->venue }}</a></li>
                        </ul>
                        <div>
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ $venuebooking->participants }} Participants
                            @if(str_contains($venuebooking->beverageoptions, 'Cofee'))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Cofee">
                                <i class="fa fa-coffee" aria-hidden="true"></i>
                            </a>
                            @endif
                            @if(str_contains($venuebooking->beverageoptions, 'Tea'))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Tea">
                                <i class="fa fa-pagelines" aria-hidden="true"></i>
                            </a>
                            @endif
                            @if(str_contains($venuebooking->beverageoptions, 'Water'))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Water">
                                <i class="fa fa-glass" aria-hidden="true"></i> 
                            </a>
                            @endif
                            @if(str_contains($venuebooking->beverageoptions, 'Milk'))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Milk">
                                <i class="fa fa-bitbucket" aria-hidden="true"></i>
                            </a>
                            @endif
                            @if(str_contains($venuebooking->beverageoptions, 'Cashew nuts'))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Cashew nuts">
                                <i class="fa fa-lemon-o" aria-hidden="true"></i>
                            </a>
                            @endif
                            @if(str_contains($venuebooking->beverageoptions, 'Biscuits'))
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Biscuits">
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </a>
                            @endif
                            @if(Auth::id() == $venuebooking->created_by)
                            <div class="btn-group btn-group-sm pull-right" role="group" aria-label="Basic example">
                                <a href="{{URL::to('/editconferencebooking/'.$venuebooking->id)}}" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                <a href="{{URL::to('/cancelconferencebooking/'.$venuebooking->id)}}" class="btn btn-secondary"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancel</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-4">
            <div class="d-flex justify-content-around" >
                <div class="">
                    <a href="{{URL::to('/previousmonth/'.$timestamp)}}" class="h4">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    </a>
                </div><!-- /.col-md-1 -->
                <div class="">
                    <h4 class="">{{ $month->get('month').' '.$month->get('year') }}</h4>
                </div><!-- /.col-md-1 -->
                <div class="">
                    <a href="{{URL::to('/nextmonth/'.$timestamp)}}" class="h4">
                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                    </a>
                </div><!-- /.col-md-1 -->
            </div>
        <!-- Three columns of text below the carousel -->
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="table-active">
                    <th class="text-center smaller"><span class="hidden-sm-down">M</span></th>
                    <th class="text-center smaller"><span class="hidden-sm-down">T</span></th>
                    <th class="text-center smaller"><span class="hidden-sm-down">W</span></th>
                    <th class="text-center smaller"><span class="hidden-sm-down">T</span></th>
                    <th class="text-center smaller"><span class="hidden-sm-down">F</span></th>
                    <th class="text-center smaller"><span class="hidden-sm-down">S</span></th>
                    <th class="text-center smaller"><span class="hidden-sm-down">S</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeks as $week)
                <?php 
                $week = collect($week);
                $week = $week->get('week');
                $Monday_date = collect($dates->where('week', $week)->where('day', 'Monday')->values()->get(0))->get('date');
                $Monday_timestamp = collect($dates->where('week', $week)->where('day', 'Monday')->values()->get(0))->get('timestamp');
                $Tuesday_date = collect($dates->where('week', $week)->where('day', 'Tuesday')->values()->get(0))->get('date');
                $Tuesday_timestamp = collect($dates->where('week', $week)->where('day', 'Tuesday')->values()->get(0))->get('timestamp');
                $Wednesday_date = collect($dates->where('week', $week)->where('day', 'Wednesday')->values()->get(0))->get('date');
                $Wednesday_timestamp = collect($dates->where('week', $week)->where('day', 'Wednesday')->values()->get(0))->get('timestamp');
                $Thursday_date = collect($dates->where('week', $week)->where('day', 'Thursday')->values()->get(0))->get('date');
                $Thursday_timestamp = collect($dates->where('week', $week)->where('day', 'Thursday')->values()->get(0))->get('timestamp');
                $Friday_date = collect($dates->where('week', $week)->where('day', 'Friday')->values()->get(0))->get('date');
                $Friday_timestamp = collect($dates->where('week', $week)->where('day', 'Friday')->values()->get(0))->get('timestamp');
                $Saturday_date = collect($dates->where('week', $week)->where('day', 'Saturday')->values()->get(0))->get('date');
                $Saturday_timestamp = collect($dates->where('week', $week)->where('day', 'Saturday')->values()->get(0))->get('timestamp');
                $Sunday_date = collect($dates->where('week', $week)->where('day', 'Sunday')->values()->get(0))->get('date');
                $Sunday_timestamp = collect($dates->where('week', $week)->where('day', 'Sunday')->values()->get(0))->get('timestamp');
                ?>
                <tr>
                    <td class="@if($today->day == $Monday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Monday_timestamp)}}" class="float-right font-italic smaller">{{ $Monday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Tuesday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Tuesday_timestamp)}}" class="float-right font-italic smaller">{{ $Tuesday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Wednesday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Wednesday_timestamp)}}" class="float-right font-italic smaller">{{ $Wednesday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Thursday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Thursday_timestamp)}}" class="float-right font-italic smaller">{{ $Thursday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Friday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Friday_timestamp)}}" class="float-right font-italic smaller">{{ $Friday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Saturday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Saturday_timestamp)}}" class="float-right font-italic smaller">{{ $Saturday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Sunday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calendar/'.$Sunday_timestamp)}}" class="float-right font-italic smaller">{{ $Sunday_date }}</a>
                    </td>
                </tr>    
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create new Booking Modal -->
    {{Form::open(array('url' => '/create_venue_booking','multiple' => true,'role' => 'form'))}}
    <div class="modal fade createBookingModal" id="createBookingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div v-if="reservationsubmited" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Conference Reservation is in progress
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: black"></i>
                </div>
            </div>
            <div v-else="reservationsubmited" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Book for a Conference Venue
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group @if($errors->first('office')) has-danger @elseif(old('office')) has-success @endif">
                        <label class="font-weight-bold">Office</label>
                        <select name="office" class="form-control js-office-single @if($errors->first('office')) form-control-danger @elseif(old('office')) form-control-success @endif">
                            <option></option>
                            <option @if(old('office') == 'Country Office') selected @endif value="Country Office">Country Office</option>
                            <!-- <option @if(old('office') == 'Dodoma') selected @endif value="Dodoma">Dodoma</option>
                            <option @if(old('office') == 'Kibondo') selected @endif value="Kibondo">Kibondo</option> -->
                        </select>
                        @if($errors->first('office'))
                            <div class="form-control-feedback">Office not selected</div>
                            <small class="form-text text-muted">Make sure you select an office.</small>
                        @endif
                    </div>
                    <div class="form-group @if($errors->first('venue')) has-danger @elseif(old('venue')) has-success @endif">
                        <label class="font-weight-bold">Conference or Meeting Venue</label>
                        <select name="venue" class="form-control js-venue-single @if($errors->first('venue')) form-control-danger @elseif(old('venue')) form-control-success @endif">
                            <option></option>
                            <option @if(old('venue') == 'Main Conference Room') selected @endif value="Main Conference Room">Main Conference Room</option>
                            <option @if(old('venue') == 'Third Floor Conference Room') selected @endif value="Third Floor Conference Room">Third Floor Conference</option>
                            <!-- <option @if(old('venue') == 'Canteen') selected @endif value="Canteen">Canteen</option> -->
                        </select>
                        @if($errors->first('venue'))
                            <div class="form-control-feedback">Venue not selected</div>
                            <small class="form-text text-muted">Make sure you select a venue.</small>
                        @endif
                    </div>
                    <div class="form-group @if($errors->first('purpose')) has-danger @elseif(old('purpose')) has-success @endif">
                        <label class="font-weight-bold">Purpose of your Conference or Meeting</label>
                        <input type="text" name="purpose" value="{{ old('purpose') }}" class="form-control form-control-sm @if($errors->first('purpose')) form-control-danger @elseif(old('purpose')) form-control-success @endif" placeholder="Enter Meeting or Conference Purpose">
                        @if($errors->first('purpose'))
                            <div class="form-control-feedback">Purpose not filled</div>
                            <small class="form-text text-muted">Make sure you fill in the Purpose Field.</small>
                        @endif
                    </div>
                    <div class="d-flex">
                        <div class="form-group pr-1 @if($errors->first('startdate')) has-danger @elseif(old('startdate')) has-success @endif">
                            <label class="font-weight-bold">Start Date</label>
                            <input type="date" name="startdate" value="{{ old('startdate') }}" class="form-control form-control-sm @if($errors->first('startdate')) form-control-danger @elseif(old('startdate')) form-control-success @endif" placeholder="Enter Start time">
                            @if($errors->first('startdate'))
                            <div class="form-control-feedback">Start Date is incorrect</div>
                            <small class="form-text text-muted">Example 01-Dec-2018</small>
                            @endif
                        </div>
                        <div class="form-group pr-1 @if($errors->first('enddate')) has-danger @elseif(old('enddate')) has-success @endif">
                                <label class="font-weight-bold">End Date</label>
                                <input type="date" name="enddate" value="{{ old('enddate') }}" class="form-control form-control-sm @if($errors->first('enddate')) form-control-danger @elseif(old('enddate')) form-control-success @endif" placeholder="Enter Start time">
                                @if($errors->first('enddate'))
                                <div class="form-control-feedback">End Date is incorrect</div>
                                <small class="form-text text-muted">Example 10-Dec-2018</small>
                                @endif
                            </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group pr-1 @if($errors->first('starttime') || Session::has('starttime_error')) has-danger @elseif(old('starttime')) has-success @endif">
                            <label class="font-weight-bold">Start Time</label>
                            <input type="time" name="starttime" value="{{ old('starttime') }}" class="form-control form-control-sm @if($errors->first('starttime') || Session::has('starttime_error')) form-control-danger @elseif(old('starttime')) form-control-success @endif" placeholder="Enter Start time">
                            @if($errors->first('starttime'))
                            <div class="form-control-feedback">Start Time is incorect</div>
                            <small class="form-text text-muted">Example 10:00</small>
                            @endif
                        </div>
                        <div class="form-group pl-1 @if($errors->first('endtime') || Session::has('endtime_error')) has-danger @elseif(old('endtime')) has-success @endif">
                            <label class="font-weight-bold">End Time</label>
                            <input type="time" name="endtime" value="{{ old('endtime') }}" class="form-control form-control-sm @if($errors->first('endtime') || Session::has('endtime_error')) form-control-danger @elseif(old('endtime')) form-control-success @endif" placeholder="Enter Start time">
                            @if($errors->first('endtime'))
                            <div class="form-control-feedback">End Time is incorect</div>
                            <small class="form-text text-muted">Example 16:00</small>
                            @endif
                        </div>
                    </div>
                    @if(Session::has('starttime_error'))
                        <div class="text-danger mb-2 font-italic">{!! Session::get('starttime_error') !!}</div>
                    @elseif(Session::has('endtime_error'))
                        <div class="text-danger mb-2 font-italic">{!! Session::get('endtime_error') !!}</div>
                    @endif
                    <div class="form-group @if($errors->first('participants')) has-danger @elseif(old('participants')) has-success @endif">
                        <label class="font-weight-bold">Number of Participants</label>
                        <input type="number" min="1" name="participants" value="{{ old('participants') }}" class="form-control form-control-sm @if($errors->first('participants')) form-control-danger @elseif(old('participants')) form-control-success @endif" placeholder="Enter Number of Participants">
                        @if($errors->first('participants'))
                            <div class="form-control-feedback">Number of Participants not filled</div>
                            <small class="form-text text-muted">Please fill in the number of participants</small>
                            @endif
                    </div>
                    <fieldset class="form-group">
                        <label class="font-weight-bold">Beverages or Snacks Required</label>
                        <div class="d-flex">
                            <div class="form-check pr-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="requirebeverages" v-model="requirebeverages" value="No">
                                    No
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="requirebeverages" v-model="requirebeverages" value="Yes">
                                    Yes
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div v-show ="requirebeverages == 'Yes'" class="form-group @if($errors->first('beverageoptions')) has-danger @elseif(old('beverageoptions')) has-success @endif">
                        <label for="beverages" class="font-weight-bold">Select Beverages or Snacks</label>
                        <select name="beverageoptions[]" multiple class="form-control js-beverages-multiple @if($errors->first('beverageoptions')) form-control-danger @elseif(old('beverageoptions')) form-control-success @endif" id='beverages'>
                            <option @if(old('beverageoptions') && in_array('Cofee',old('beverageoptions'))) selected @endif value="Cofee">Cofee</option>
                            <option @if(old('beverageoptions') && in_array('Tea',old('beverageoptions'))) selected @endif value="Tea">Tea</option>
                            <option @if(old('beverageoptions') && in_array('Water',old('beverageoptions'))) selected @endif value="Water">Water</option>
                            <option @if(old('beverageoptions') && in_array('Milk',old('beverageoptions'))) selected @endif value="Milk">Milk</option>
                            <option @if(old('beverageoptions') && in_array('Cashew nuts',old('beverageoptions'))) selected @endif value="Cashew nuts">Cashew nuts</option>
                            <option @if(old('beverageoptions') && in_array('Biscuits',old('beverageoptions'))) selected @endif value="Biscuits">Biscuits</option>
                        </select>
                        @if($errors->first('beverageoptions'))
                            <div class="form-control-feedback">Beverages not selected</div>
                            <small class="form-text text-muted">Please select at least one Beverage.</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-on:click="submitReservation()" type="submit" class="btn btn-primary">Submit Reservation</button>
                </div>
            </div>
        </div>
    </div>
    {{Form::token()}}
    {{Form::close()}}<!-- end of Create new Booking Modal -->

    @if(Session::has('edit_venue_booking') || Session::has('edit_venue_booking_error'))
    <!-- Edit Boking Modal -->
    {{Form::open(array('url' => '/edit_venue_booking','multiple' => true,'role' => 'form'))}}
    <div class="modal fade editBookingModal" id="editBookingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div v-if="reservationedited" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Editing of Conference Reservation is in progress
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: black"></i>
                </div>
            </div>
            <div v-else="reservationedited" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit your Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group @if($errors->first('reservationid')) has-danger @elseif(old('reservationid')) has-success @endif">
                        <label class="font-weight-bold">Reservation ID</label>
                        <input readonly type="number" name="reservationid" value="{{ old('reservationid')?old('reservationid'):Session::get('edit_venue_booking')->id }}" class="form-control form-control-sm @if($errors->first('reservationid')) form-control-danger @elseif(old('reservationid')) form-control-success @endif" placeholder="Enter Number Reservation ID">
                        @if($errors->first('reservationid'))
                            <div class="form-control-feedback">Reservation ID not filled</div>
                            <small class="form-text text-muted">Please fill in the Reservation ID</small>
                            @endif
                    </div>
                    <div class="form-group @if($errors->first('office')) has-danger @elseif(old('office')) has-success @endif">
                        <label class="font-weight-bold">Office</label>
                        <select name="office" class="form-control js-office-single @if($errors->first('office')) form-control-danger @elseif(old('office')) form-control-success @endif">
                            <option></option>
                            <option @if(old('office') == 'Country Office' || Session::get('edit_venue_booking')->location == 'Country Office') selected @endif value="Country Office">Country Office</option>
                            <!-- <option @if(old('office') == 'Dodoma' || Session::get('edit_venue_booking')->location == 'Dodoma') selected @endif value="Dodoma">Dodoma</option>
                            <option @if(old('office') == 'Kibondo' || Session::get('edit_venue_booking')->location == 'Kibondo') selected @endif value="Kibondo">Kibondo</option> -->
                        </select>
                        @if($errors->first('office'))
                            <div class="form-control-feedback">Office not selected</div>
                            <small class="form-text text-muted">Make sure you select an office.</small>
                        @endif
                    </div>
                    <div class="form-group @if($errors->first('venue')) has-danger @elseif(old('venue')) has-success @endif">
                        <label class="font-weight-bold">Conference or Meeting Venue</label>
                        <select name="venue" class="form-control js-venue-single @if($errors->first('venue')) form-control-danger @elseif(old('venue')) form-control-success @endif">
                            <option></option>
                            <option @if(old('venue') == 'Main Conference Room' || Session::get('edit_venue_booking')->venue == 'Main Conference Room') selected @endif value="Main Conference Room">Main Conference Room</option>
                            <option @if(old('venue') == 'Third Floor Conference Room' || Session::get('edit_venue_booking')->venue == 'Third Floor Conference Room') selected @endif value="Third Floor Conference Room">Third Floor Conference</option>
                            <!-- <option @if(old('venue') == 'Canteen' || Session::get('edit_venue_booking')->venue == 'Canteen') selected @endif value="Canteen">Canteen</option> -->
                        </select>
                        @if($errors->first('venue'))
                            <div class="form-control-feedback">Venue not selected</div>
                            <small class="form-text text-muted">Make sure you select a venue.</small>
                        @endif
                    </div>
                    <div class="form-group @if($errors->first('purpose')) has-danger @elseif(old('purpose')) has-success @endif">
                        <label class="font-weight-bold">Purpose of your Conference or Meeting</label>
                        <input type="text" name="purpose" value="{{ old('purpose')?old('purpose'):Session::get('edit_venue_booking')->purpose }}" class="form-control form-control-sm @if($errors->first('purpose')) form-control-danger @elseif(old('purpose')) form-control-success @endif" placeholder="Enter Meeting or Conference Purpose">
                        @if($errors->first('purpose'))
                            <div class="form-control-feedback">Purpose not filled</div>
                            <small class="form-text text-muted">Make sure you fill in the Purpose Field.</small>
                        @endif
                    </div>
                    <div class="form-group pr-1 @if($errors->first('date')) has-danger @elseif(old('date')) has-success @endif">
                        <label class="font-weight-bold">Meeting or Conference Date</label>
                        <input type="date" name="date" value="{{ old('date')?old('date'):Session::get('edit_venue_booking')->date }}" class="form-control form-control-sm @if($errors->first('date')) form-control-danger @elseif(old('date')) form-control-success @endif" placeholder="Enter Start time">
                        @if($errors->first('date'))
                        <div class="form-control-feedback">Date is incorrect</div>
                        <small class="form-text text-muted">Example 12-Dec-2018</small>
                        @endif
                    </div>
                    <div class="d-flex">
                        <?php
                        $start_date = new Date(Session::get('edit_venue_booking')->start_time);
                        $start_date = $start_date->format('H:i');

                        $end_date = new Date(Session::get('edit_venue_booking')->end_time);
                        $end_date = $end_date->format('H:i');
                        ?>
                        <div class="form-group pr-1 @if($errors->first('starttime') || Session::has('starttime_error')) has-danger @elseif(old('starttime')) has-success @endif">
                            <label class="font-weight-bold">Start Time</label>
                            <input type="time" name="starttime" value="{{ old('starttime')?old('starttime'):$start_date }}" class="form-control form-control-sm @if($errors->first('starttime') || Session::has('starttime_error')) form-control-danger @elseif(old('starttime')) form-control-success @endif" placeholder="Enter Start time">
                            @if($errors->first('starttime'))
                            <div class="form-control-feedback">Start Time is incorect</div>
                            <small class="form-text text-muted">Example 10:00</small>
                            @endif
                        </div>
                        <div class="form-group pl-1 @if($errors->first('endtime') || Session::has('endtime_error')) has-danger @elseif(old('endtime')) has-success @endif">
                            <label class="font-weight-bold">End Time</label>
                            <input type="time" name="endtime" value="{{ old('endtime')?old('endtime'):$end_date }}" class="form-control form-control-sm @if($errors->first('endtime') || Session::has('endtime_error')) form-control-danger @elseif(old('endtime')) form-control-success @endif" placeholder="Enter Start time">
                            @if($errors->first('endtime'))
                            <div class="form-control-feedback">End Time is incorect</div>
                            <small class="form-text text-muted">Example 16:00</small>
                            @endif
                        </div>
                    </div>
                    @if(Session::has('starttime_error'))
                        <div class="text-danger mb-2 font-italic">{!! Session::get('starttime_error') !!}</div>
                    @elseif(Session::has('endtime_error'))
                        <div class="text-danger mb-2 font-italic">{!! Session::get('endtime_error') !!}</div>
                    @endif
                    <div class="form-group @if($errors->first('participants')) has-danger @elseif(old('participants')) has-success @endif">
                        <label class="font-weight-bold">Number of Participants</label>
                        <input type="number" name="participants" value="{{ old('participants')?old('participants'):Session::get('edit_venue_booking')->participants }}" class="form-control form-control-sm @if($errors->first('participants')) form-control-danger @elseif(old('participants')) form-control-success @endif" placeholder="Enter Number of Participants">
                        @if($errors->first('participants'))
                            <div class="form-control-feedback">Number of Participants not filled</div>
                            <small class="form-text text-muted">Please fill in the number of participants</small>
                            @endif
                    </div>
                    <fieldset class="form-group">
                        <label class="font-weight-bold">Beverages or Snacks Required</label>
                        <div class="d-flex">
                            <div class="form-check pr-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="requirebeverages" v-model="requirebeverages" value="No">
                                    No
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="requirebeverages" v-model="requirebeverages" value="Yes">
                                    Yes
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div v-show ="requirebeverages == 'Yes'" class="form-group @if($errors->first('beverageoptions')) has-danger @elseif(old('beverageoptions')) has-success @endif">
                        <label for="beverages" class="font-weight-bold">Beverages</label>
                        <select name="beverageoptions[]" multiple class="form-control js-beverages-multiple @if($errors->first('beverageoptions')) form-control-danger @elseif(old('beverageoptions')) form-control-success @endif" id='beverages'>
                            <option @if((old('beverageoptions') && in_array('Cofee',old('beverageoptions'))) || str_contains(Session::get('edit_venue_booking')->beverageoptions,'Cofee')) selected @endif value="Cofee">Cofee</option>
                            <option @if((old('beverageoptions') && in_array('Tea',old('beverageoptions'))) || str_contains(Session::get('edit_venue_booking')->beverageoptions,'Tea')) selected @endif value="Tea">Tea</option>
                            <option @if((old('beverageoptions') && in_array('Water',old('beverageoptions'))) || str_contains(Session::get('edit_venue_booking')->beverageoptions,'Water')) selected @endif value="Water">Water</option>
                            <option @if((old('beverageoptions') && in_array('Milk',old('beverageoptions'))) || str_contains(Session::get('edit_venue_booking')->beverageoptions,'Milk')) selected @endif value="Milk">Milk</option>
                            <option @if((old('beverageoptions') && in_array('Cashew nuts',old('beverageoptions'))) || str_contains(Session::get('edit_venue_booking')->beverageoptions,'Cashew nuts')) selected @endif value="Cashew nuts">Cashew nuts</option>
                            <option @if((old('beverageoptions') && in_array('Biscuits',old('beverageoptions'))) || str_contains(Session::get('edit_venue_booking')->beverageoptions,'Biscuits')) selected @endif value="Biscuits">Biscuits</option>
                        </select>
                        @if($errors->first('beverageoptions'))
                            <div class="form-control-feedback">Beverages not selected</div>
                            <small class="form-text text-muted">Please select at least one Beverage.</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-on:click="editReservation()" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{Form::token()}}
    {{Form::close()}}<!-- end of Edit Boking Modal -->
    @endif

    <!-- Successful Booking Message Modal -->
    <div class="modal fade successfulBookingModal" id="successfulBookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        <strong>Congratulations!</strong> {{ Session::get('create_venue_booking') }}.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- end of Successful Booking Message Modal -->

    <!-- Successful Booking Amendment Message Modal -->
    <div class="modal fade successfulBookingAmendmentModal" id="successfulBookingAmendmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        <strong>Congratulations!</strong> {{ Session::get('venue_booking_edited') }}.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- end of Successful Booking Amendment Message Modal -->
    @if(Session::has('cancel_venue_booking'))
    <?php 
    $date = new Date(Session::get('cancel_venue_booking')->date);
    $start_time = new Jenssegers\Date\Date(Session::get('cancel_venue_booking')->start_time);
    $end_time = new Jenssegers\Date\Date(Session::get('cancel_venue_booking')->end_time);
    ?>
    <!-- Booking Cancellation Modal -->
    <div class="modal fade venueBookingCancellationModal" id="venueBookingCancellationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div v-if="reservationcanceled" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Cancellation of Conference Reservation is in progress
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: black"></i>
                </div>
            </div>
            <div v-else="reservationcanceled" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-striped mr-1 ml-1">
                        <div class="col-2 text-center">
                            <h2 class="display-4"><span class="badge badge-success">{{ $date->format('d') }}</span></h2>
                            <span class="h2">{{ strtoupper($date->format('M')) }}</span>
                        </div>
                        <div class="col-10">
                            <div class="pb-1">
                                <img class="img-fluid rounded-circle" src="{{ strlen(App\User::find(Session::get('cancel_venue_booking')->created_by)->image) != 0? url('/storage/thumbnails/'.App\User::find(Session::get('cancel_venue_booking')->created_by)->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="29" data-src="holder.js/25x25/auto"> 
                                <span class="text-primary">{{ App\User::find(Session::get('cancel_venue_booking')->created_by)->firstname.' '.App\User::find(Session::get('cancel_venue_booking')->created_by)->secondname}}</span>
                            </div>
                            <h5 class=""><strong>{{ Session::get('cancel_venue_booking')->purpose }}</strong></h5>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> {{ $date->format('l') }}</li>
                                <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $start_time->format('h:i A') }} - {{ $end_time->format('h:i A') }}</li>
                                <li class="list-inline-item"><i class="fa fa-location-arrow text-warning" aria-hidden="true"></i> <a href="#" class="text-warning font-weight-bold">{{ Session::get('cancel_venue_booking')->venue }}</a></li>
                            </ul>
                            <div>
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Session::get('cancel_venue_booking')->participants }} Participants
                                @if(str_contains(Session::get('cancel_venue_booking')->beverageoptions, 'Cofee'))
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Cofee">
                                    <i class="fa fa-coffee" aria-hidden="true"></i>
                                </a>
                                @endif
                                @if(str_contains(Session::get('cancel_venue_booking')->beverageoptions, 'Tea'))
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Tea">
                                    <i class="fa fa-pagelines" aria-hidden="true"></i>
                                </a>
                                @endif
                                @if(str_contains(Session::get('cancel_venue_booking')->beverageoptions, 'Water'))
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Water">
                                    <i class="fa fa-glass" aria-hidden="true"></i> 
                                </a>
                                @endif
                                @if(str_contains(Session::get('cancel_venue_booking')->beverageoptions, 'Milk'))
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Milk">
                                    <i class="fa fa-bitbucket-square" aria-hidden="true"></i>
                                </a>
                                @endif
                                @if(str_contains(Session::get('cancel_venue_booking')->beverageoptions, 'Cashew nuts'))
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Cashew nuts">
                                    <i class="fa fa-lemon-o" aria-hidden="true"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Ignore</button>
                    <a v-on:click="cancelReservation()" href="{{URL::to('/confirmconferencebookingcancellation/'.Session::get('cancel_venue_booking')->id)}}" class="btn btn-danger"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Confirm</a>
                </div>
            </div>
        </div>
    </div><!-- end of Booking Cancellation Modal -->
    @endif
</div>
