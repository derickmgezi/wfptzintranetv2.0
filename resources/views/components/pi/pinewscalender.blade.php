<div class="row">
    <div class="col-8">
        <!-- Button trigger Venue Booking modal -->
        <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#createBookingModal">
            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Book for a Conference Room
        </a>

        <div class="d-flex mb-3">
            <div class="input-group mr-1">
                <select id="office" class="form-control js-office-single">
                    <option></option>
                    <option>Country Office</option>
                    <!-- <option >Dodoma Main Office</option>
                    <option >Kibondo</option> -->
                </select>
            </div>

            <div class="input-group mr-1">
                <select id="venue" class="form-control js-venue-single">
                    <option></option>
                    <option >Main Conference Hall</option>
                    <option >Third Floor Conference</option>
                    <option >Canteen</option>
                </select>
            </div>

            <a href="#" class="btn btn-secondary btn-sm mr-1">
                    <i class="fa fa-filter" aria-hidden="true"></i> Filter
            </a>
        </div>
            

        <!-- Create new Booking Modal -->
        {{Form::open(array('url' => '/create_venue_booking','multiple' => true,'role' => 'form'))}}
        <div class="modal fade createBookingModal" id="createBookingModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book for a Conference Venue</h5>
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
                                <option @if(old('venue') == 'Main Conference Hall') selected @endif value="Main Conference Hall">Main Conference Hall</option>
                                <option @if(old('venue') == 'Third Floor Conference') selected @endif value="Third Floor Conference Hall">Third Floor Conference</option>
                                <option @if(old('venue') == 'Canteen') selected @endif value="Canteen">Canteen</option>
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
                        <div class="form-group pr-1 @if($errors->first('date')) has-danger @elseif(old('date')) has-success @endif">
                            <label class="font-weight-bold">Meeting or Conference Date</label>
                            <input type="date" name="date" value="{{ old('date') }}" class="form-control form-control-sm @if($errors->first('date')) form-control-danger @elseif(old('date')) form-control-success @endif" placeholder="Enter Start time">
                            @if($errors->first('date'))
                            <div class="form-control-feedback">Date is incorrect</div>
                            <small class="form-text text-muted">Example 12-Dec-2018</small>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="form-group pr-1 @if($errors->first('starttime')) has-danger @elseif(old('starttime')) has-success @endif">
                                <label class="font-weight-bold">Start Time</label>
                                <input type="time" name="starttime" value="{{ old('starttime') }}" class="form-control form-control-sm @if($errors->first('starttime')) form-control-danger @elseif(old('starttime')) form-control-success @endif" placeholder="Enter Start time">
                                @if($errors->first('starttime'))
                                <div class="form-control-feedback">Start Time is incorect</div>
                                <small class="form-text text-muted">Example 10:00AM</small>
                                @endif
                            </div>
                            <div class="form-group pl-1 @if($errors->first('endtime')) has-danger @elseif(old('endtime')) has-success @endif">
                                <label class="font-weight-bold">End Time</label>
                                <input type="time" name="endtime" value="{{ old('endtime') }}" class="form-control form-control-sm @if($errors->first('endtime')) form-control-danger @elseif(old('endtime')) form-control-success @endif" placeholder="Enter Start time">
                                @if($errors->first('endtime'))
                                <div class="form-control-feedback">End Time is incorect</div>
                                <small class="form-text text-muted">Example 12:00PM</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if($errors->first('participants')) has-danger @elseif(old('participants')) has-success @endif">
                            <label class="font-weight-bold">Number of Participants</label>
                            <input type="number" name="participants" value="{{ old('participants') }}" class="form-control form-control-sm @if($errors->first('participants')) form-control-danger @elseif(old('participants')) form-control-success @endif" placeholder="Enter Number of Participants">
                            @if($errors->first('participants'))
                                <div class="form-control-feedback">Number of Participants not filled</div>
                                <small class="form-text text-muted">Please fill in the number of participants</small>
                                @endif
                        </div>
                        <fieldset class="form-group">
                            <label class="font-weight-bold">Beverages Required</label>
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
                                <option @if(old('beverageoptions') && in_array('Cofee',old('beverageoptions'))) selected @endif value="Cofee">Cofee</option>
                                <option @if(old('beverageoptions') && in_array('Tea',old('beverageoptions'))) selected @endif value="Tea">Tea</option>
                                <option @if(old('beverageoptions') && in_array('Water',old('beverageoptions'))) selected @endif value="Water">Water</option>
                                <option @if(old('beverageoptions') && in_array('Soft Drinks',old('beverageoptions'))) selected @endif value="Soft Drinks">Soft Drinks</option>
                            </select>
                            @if($errors->first('beverageoptions'))
                                <div class="form-control-feedback">Beverages not selected</div>
                                <small class="form-text text-muted">Please select at least one Beverage.</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        {{Form::token()}}
        {{Form::close()}}<!-- end of Create new Booking Modal -->

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

        @if($venuebookings->count() == 0)
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">No bookings have been created at this time!</h4>
                <p>
                    To create a new booking please click on the Conference Venue Booking Button above
                </p>
                <p class="mb-0 font-weight-bold">Please make your booking now.</p>
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
                <div class="col-2 text-right">
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
                        <i class="fa fa-coffee" aria-hidden="true"></i> 
                        @endif
                        @if(str_contains($venuebooking->beverageoptions, 'Tea'))
                        <i class="fa fa-beer" aria-hidden="true"></i>
                        @endif
                        @if(str_contains($venuebooking->beverageoptions, 'Water'))
                        <i class="fa fa-glass" aria-hidden="true"></i> 
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
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
</div>
