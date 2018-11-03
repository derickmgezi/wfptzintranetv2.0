<div class="row">
    <div class="col-8">
        <div class="d-flex mb-3">
            <div class="input-group mr-1">
                <span class="input-group-addon font-weight-bold" id="basic-addon1">Office</span>
                <select id="office" class="form-control js-office-single">
                    <option selected>Country Office</option>
                    <option >Dodoma Main Office</option>
                    <option >Kibondo</option>
                </select>
            </div>

            <div class="input-group mr-1">
                    <span class="input-group-addon font-weight-bold" id="basic-addon1">Venue</span>
                    <select id="venue" class="form-control js-venue-single">
                        <option></option>
                        <option >Conference Room</option>
                        <option >Third Floor Conference</option>
                        <option >Dining Hall</option>
                    </select>
                </div>
        
            <!-- Button trigger Venue Booking modal -->
            <a href="#" class="btn btn-primary ml-1" data-toggle="modal" data-target="#createBookingModal">
                Venue Booking
            </a>
        </div>
            

        <!-- Create new Booking Modal -->
        {{Form::open(array('url' => '/create_venue_booking','multiple' => true,'role' => 'form'))}}
        <div class="modal fade" id="createBookingModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book for a Conference Venue</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Office</label>
                            <select name="office" class="form-control js-office-single">
                                <option selected value="Country Office">Country Office</option>
                                <option value="Dodoma">Dodoma</option>
                                <option value="Kibondo">Kibondo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Conference or Meeting Venue</label>
                            <select name="venue" class="form-control js-venue-single">
                                <option selected value="Main Conference Hall">Main Conference Hall</option>
                                <option value="Third Floor Conference Hall">Third Floor Conference Hall</option>
                                <option value="Canteen">Canteen</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <div class="form-group pr-1">
                                <label class="font-weight-bold">Date</label>
                                <input type="date" name="date" value="2018-11-01" class="form-control" placeholder="Enter Start time">
                            </div>
                            <div class="form-group pr-1">
                                <label class="font-weight-bold">Start Time</label>
                                <input type="time" name="starttime" value="10:00:00" class="form-control" placeholder="Enter Start time">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">End Time</label>
                                <input type="time" name="endtime" value="12:00:00" class="form-control" placeholder="Enter Start time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Number of Participants</label>
                            <input type="number" name="participants" value="2" class="form-control" placeholder="Enter Number of Participants">
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
                        <div v-show ="requirebeverages == 'Yes'" class="form-group">
                            <label for="beverages" class="font-weight-bold">Beverages</label>
                            <select name="beverageoptions[]" multiple class="form-control js-beverages-multiple" id='beverages'>
                                <option value="Cofee">Cofee</option>
                                <option value="Tea">Tea</option>
                                <option value="Water">Water</option>
                                <option value="Soft Drinks">Soft Drinks</option>
                            </select>
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

        <div class="row row-striped">
            <div class="col-2 text-right">
                <h2 class="display-4"><span class="badge badge-success">01</span></h2>
                <span class="h2">OCT</span>
            </div>
            <div class="col-10">
                <h3 class=""><strong>All Staff Meeting</strong></h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> Monday</li>
                    <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> 10:00 AM - 12:00 PM</li>
                    <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> Conference Room</li>
                </ul>
                <p>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> 64 Participants
                    <i class="fa fa-coffee" aria-hidden="true"></i> 
                    <i class="fa fa-cutlery" aria-hidden="true"></i> 
                    <i class="fa fa-tint" aria-hidden="true"></i> 
                </p>
            </div>
        </div>
        <div class="row row-striped">
            <div class="col-2 text-right">
                <h2 class="display-4"><span class="badge badge-warning">02</span></h2>
                <span class="h2">OCT</span>
            </div>
            <div class="col-10">
                <h3 class=""><strong>Programme Meeting</strong></h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> Tuesday</li>
                    <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> 08:30 AM - 11:00 AM</li>
                    <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> Conference Room</li>
                </ul>
                <p>Lorem ipsum dolsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row row-striped">
            <div class="col-2 text-right">
                <h2 class="display-4"><span class="badge badge-info">04</span></h2>
                <h2>OCT</h2>
            </div>
            <div class="col-10">
                <h3 class=""><strong>PI Donor Meeting</strong></h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> Thursday</li>
                    <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> 10:00 AM - 07:00 PM</li>
                    <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> Conference Room</li>
                </ul>
                <p>Lorem ipsum dolsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row row-striped">
            <div class="col-2 text-right">
                <h2 class="display-4"><span class="badge badge-danger">04</span></h2>
                <h2>OCT</h2>
            </div>
            <div class="col-10">
                <h3 class=""><strong>Kigoma Joint Programme Meeting</strong></h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> Thursday</li>
                    <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> 09:30 AM - 11:00 AM</li>
                    <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> Small Holder Farmer Conference Room</li>
                </ul>
                <p>Lorem ipsum dolsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row row-striped">
            <div class="col-2 text-right">
                <h2 class="display-4"><span class="badge badge-default">05</span></h2>
                <h2>OCT</h2>
            </div>
            <div class="col-10">
                <h3 class=""><strong>Intercom Session</strong></h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> Friday</li>
                    <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> 08:30 AM - 10:00 AM</li>
                    <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> Canteen</li>
                </ul>
                <p>Lorem ipsum dolsit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
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
                        <a href="{{URL::to('/calender/'.$Monday_timestamp)}}" class="float-right font-italic smaller">{{ $Monday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Tuesday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calender/'.$Tuesday_timestamp)}}" class="float-right font-italic smaller">{{ $Tuesday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Wednesday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calender/'.$Wednesday_timestamp)}}" class="float-right font-italic smaller">{{ $Wednesday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Thursday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calender/'.$Thursday_timestamp)}}" class="float-right font-italic smaller">{{ $Thursday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Friday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calender/'.$Friday_timestamp)}}" class="float-right font-italic smaller">{{ $Friday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Saturday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calender/'.$Saturday_timestamp)}}" class="float-right font-italic smaller">{{ $Saturday_date }}</a>
                    </td>
                    <td class="@if($today->day == $Sunday_date) table-active @else  @endif">
                        <a href="{{URL::to('/calender/'.$Sunday_timestamp)}}" class="float-right font-italic smaller">{{ $Sunday_date }}</a>
                    </td>
                </tr>    
                @endforeach
            </tbody>
        </table>
    </div>
</div>
