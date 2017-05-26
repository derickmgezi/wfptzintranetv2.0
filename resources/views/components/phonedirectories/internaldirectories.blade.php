
<div class="card">
    <div class="card-header" style="background-color:">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#extension" role="tab">VSAT Extensions & Mobile Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#other" role="tab">Other Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#manage" role="tab">Manage Numbers</a>
            </li>
        </ul>
    </div>
    <div class="card-block">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="extension" role="tabpanel">
                <div class="card">
                    <div class="card-header" style="background-color:">
                        <!-- Nav tabs -->
                        <?php $locations = App\PhoneDirectory::select('location')->groupBy('location')->get(); $active_link_status=1; ?>
                        <ul class="nav nav-tabs card-header-tabs" id="extensionTab" role="tablist">
                            @foreach($locations as $location)
                            <li class="nav-item">
                                <a class="nav-link {{ $active_link_status? 'active':'' }}" data-toggle="tab" href="#{{ str_replace(' ', '',$location->location) }}" role="tab">{{ $location->location }}</a>
                            </li>
                            <?php $active_link_status=0; ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-block">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php $active_nav_tab_status=1; ?>
                            @foreach($locations as $location)
                            <div class="tab-pane fade show {{ $active_nav_tab_status? 'active':'' }}" id="{{ str_replace(' ', '',$location->location) }}" role="tabpanel">
                                <?php $units = App\PhoneDirectory::select('department')->where('location',$location->location)->groupBy('department')->get(); $active_department_status=1; ?>
                                <!-- Collapse -->
                                <div id="extensionaccordion{{ str_replace(' ', '',$location->location) }}" role="tablist" aria-multiselectable="true">
                                    @foreach($units as $unit)
                                    <div class="card">
                                        <div class="card-header" role="tab" id="extensionHeading{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}">
                                            <h5 class="mb-0">
                                                <a class="font-weight-normal" data-toggle="collapse" data-parent="#extensionaccordion{{ str_replace(' ', '',$location->location) }}" href="#extensionCollapse{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}" aria-expanded="true" aria-controls="extensionCollapse{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}">
                                                    <small>{{ $unit->department }}</small>
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="extensionCollapse{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}" class="collapse {{ $active_department_status? 'show':'' }}" role="tabpanel" aria-labelledby="extensionHeading{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}">
                                            <div class="card-block">
                                                <table class="table table-hover">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>
                                                                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i> Name
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-id-badge fa-lg" aria-hidden="true"></i> Tile
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-phone-square fa-lg" aria-hidden="true"></i> Extension
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Mobile
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $unit_members = App\PhoneDirectory::select('name','function','ext_no','department')->where('department',$unit->department)->where('location',$location->location)->get(); ?>
                                                        @foreach($unit_members as $unit_member)
                                                        <tr>
                                                            <td>{{ $unit_member->name }}</td>
                                                            <td>{{ $unit_member->function }}</td>
                                                            <th scope="row">{{ $unit_member->ext_no }}</th>
                                                            <th scope="row"></th>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $active_department_status=0; ?>
                                    @endforeach
                                </div><!-- /end Collapse -->
                            </div><!-- /end tab-fade -->
                            <?php $active_nav_tab_status=0; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel">
                Other Numbers
            </div>
            <div class="tab-pane fade" id="manage" role="tabpanel">
                {{ Form::open(array('url' => '/update_contacts','class' => 'form-signin','role' => 'form','files' => 'true')) }}
                <div class="input-group">
                    <input type="file" name="file" value="{{ (old('file')) }}" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Update Contacts</button>
                    </span>
                </div>
                {{Form::token()}}
                {{ Form::close() }}
                <br>
                @if(Session::has('file_upload_error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                    </button>
                    <i class="fa fa-exclamation " aria-hidden="true"></i> {{Session::get('file_upload_error')}}
                </div>
                @endif
            </div>
        </div><!-- end Tab panes -->
    </div><!-- end card block -->   
</div><!-- end card -->
