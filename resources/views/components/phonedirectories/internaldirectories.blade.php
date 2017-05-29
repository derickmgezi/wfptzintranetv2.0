<div class="card">
    <div class="card-header" style="background-color:">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ Session::has('upload_message')? '':'active' }}" data-toggle="tab" href="#extension" role="tab">VSAT Extensions <i class="fa fa-plus" aria-hidden="true"></i> Mobile Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#other" role="tab">Other Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Session::has('upload_message')? 'active':'' }}" data-toggle="tab" href="#manage" role="tab">Manage Numbers</a>
            </li>
        </ul>
    </div>
    <div class="card-block">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade show {{ Session::has('upload_message')? '':'active' }}" id="extension" role="tabpanel">
                <div class="card">
                    <div class="card-header" style="background-color:">
                        <!-- Nav tabs -->
                        <?php $locations = App\PhoneDirectory::select('location')->groupBy('location')->get();
                        $active_link_status = 1; ?>
                        <ul class="nav nav-tabs card-header-tabs" id="extensionTab" role="tablist">
                            @foreach($locations as $location)
                            <li class="nav-item">
                                <a class="nav-link {{ $active_link_status? 'active':'' }}" data-toggle="tab" href="#{{ str_replace(' ', '',$location->location) }}" role="tab">{{ $location->location }}</a>
                            </li>
                            <?php $active_link_status = 0; ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-block">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php $active_nav_tab_status = 1; ?>
                            @foreach($locations as $location)
                            <div class="tab-pane fade show {{ $active_nav_tab_status? 'active':'' }}" id="{{ str_replace(' ', '',$location->location) }}" role="tabpanel">
                            <?php $units = App\PhoneDirectory::select('department')->where('location', $location->location)->groupBy('department')->get();$active_department_status = 1; ?>
                                <!-- Collapse -->
                                <div id="extensionaccordion{{ str_replace(' ', '',$location->location) }}" role="tablist" aria-multiselectable="true">
                                    @foreach($units as $unit)
                                    <div class="card">
                                        <div class="card-header" role="tab" id="extensionHeading{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}">
                                            <h5 class="mb-0">
                                                <button class="font-weight-normal btn btn-secondary btn-sm" data-toggle="collapse" data-parent="#extensionaccordion{{ str_replace(' ', '',$location->location) }}" href="#extensionCollapse{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}" aria-expanded="true" aria-controls="extensionCollapse{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}">
                                                    <en>{{ $unit->department }}</en>
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="extensionCollapse{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}" class="collapse {{ $active_department_status? 'show':'' }}" role="tabpanel" aria-labelledby="extensionHeading{{ str_replace(' ', '',$location->location) }}{{ str_replace(' ', '',$unit->department) }}">
                                            <div class="card-block">
                                                <table class="table table-striped">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th class="text-center">
                                                                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i> User
                                                            </th>
                                                            <th class="text-center">
                                                                <i class="fa fa-address-card-o fa-lg" aria-hidden="true"></i> Role
                                                            </th>
                                                            <th class="text-center">
                                                                <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Extension
                                                            </th>
                                                            <th class="text-center">
                                                                <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Mobile
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $unit_members = App\PhoneDirectory::select('name', 'function', 'ext_no', 'department', 'number', 'type')->where('department', $unit->department)->where('location', $location->location)->orderBy('ext_no')->get(); ?>
                                                        @foreach($unit_members as $unit_member)
                                                        <tr>
                                                            <td class="text-center"><em>{{ $unit_member->name }}</em></td>
                                                            <td class="text-center"><em>{{ $unit_member->function }}</em></td>
                                                            <td class="text-center"><em>{{ $unit_member->ext_no }}</em></td>
                                                            <td class="text-center">
                                                                <em>
                                                                    @if(strlen($unit_member->number) == 0 && $unit_member->name == Auth::user()->firstname.' '.Auth::user()->secondname)
                                                                    <a class="btn btn-success btn-sm" href="#navigation-main" aria-label="Add number">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i> Add Number
                                                                    </a>
                                                                    @else
                                                                    {{ $unit_member->number }}
                                                                    @endif
                                                                </em>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $active_department_status = 0; ?>
                                    @endforeach
                                </div><!-- /end Collapse -->
                            </div><!-- /end tab-fade -->
                            <?php $active_nav_tab_status = 0; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel">
                Other Numbers
            </div>
            <div class="tab-pane fade show {{ Session::has('upload_message')? 'active':'' }}" id="manage" role="tabpanel">
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
                @if(Session::has('upload_message'))
                <div class="alert alert-{{ Session::get('upload_message') == 'File Uploaded Succesfully'? 'success':'danger' }} alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                    </button>
                    <i class="fa fa-exclamation " aria-hidden="true"></i> {{Session::get('upload_message')}}
                </div>
                @endif
            </div>
        </div><!-- end Tab panes -->
    </div><!-- end card block -->   
</div><!-- end card -->
