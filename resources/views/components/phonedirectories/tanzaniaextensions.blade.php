<?php
$locations = App\PhoneDirectory::select('location')->groupBy('location')->get();
$location_count = App\PhoneDirectory::select('location')->groupBy('location')->count();
$active_link_status = 1;
?>
@if($location_count != 0)
<div class="card">
    <div class="card-header" style="background-color:">
        <!-- Nav tabs -->
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
                <?php
                $units = App\PhoneDirectory::select('department')->where('location', $location->location)->groupBy('department')->get();
                $active_department_status = 1;
                ?>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="{{ str_replace(' ', '',$location->location) }}-full-list-tab" data-toggle="tab" href="#{{ str_replace(' ', '',$location->location) }}-full-list" role="tab" aria-controls="home" aria-selected="true">
                                    <i class="fa fa-list-ul fa-lg" aria-hidden="true"></i> Full List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="{{ str_replace(' ', '',$location->location) }}-tiles-tab" data-toggle="tab" href="#{{ str_replace(' ', '',$location->location) }}-tiles" role="tab" aria-controls="{{ str_replace(' ', '',$location->location) }}-profile" aria-selected="false">
                                    <i class="fa fa-th-large fa-lg" aria-hidden="true"></i> Tiles
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="{{ str_replace(' ', '',$location->location) }}-full-list" role="tabpanel" aria-labelledby="{{ str_replace(' ', '',$location->location) }}-full-list-tab">
                                @if($location->location == 'Country Office')
                                <button type="button" class="btn btn-primary mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>TTCL</strong> dial <strong><em>+25522219-XXXX</em></strong><br>Via <strong>Office Mobile</strong> dial <strong><em>0784720055</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Dar es salaam Port')
                                <button type="button" class="btn btn-primary mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>TTCL</strong> dial <strong><em>+25522219-XXXX</em></strong><br>Via <strong>Office Mobile</strong> dial <strong><em>0784720055</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Dodoma Main Office')
                                <button type="button" class="btn btn-primary mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>TTCL</strong> dial <strong><em>+255262320096</em></strong><br>Via <strong>Office Mobile</strong> dial <strong><em>0784720021</em></strong>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Dodoma Warehouse')
                                <button type="button" class="btn btn-primary mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>TTCL</strong> dial <strong><em>+255262340853</em></strong>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Kibondo')
                                <button type="button" class="btn btn-primary mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>TTCL Line 1</strong> dial <strong><em>+255282820156</em></strong><br>Via <strong>TTCL Line 2</strong> dial <strong><em>+255282820157</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Isaka')
                                <button type="button" class="btn btn-primary mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>General TTCL Line </strong> dial <strong><em>+255282730003</em></strong><br>Via <strong>TTCL Line to HoSo</strong> dial <strong><em>+255282730002</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @endif

                                <table class="table table-striped table table-sm">
                                    @foreach($units as $unit)
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th colspan="4" class="text-white">
                                                <span class="btn btn-secondary btn-sm">
                                                    {{ $unit->department }}
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
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
                                                <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Office Mobile
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
                                    @endforeach
                                </table>
                            </div>
                            <div class="tab-pane fade" id="{{ str_replace(' ', '',$location->location) }}-tiles" role="tabpanel" aria-labelledby="{{ str_replace(' ', '',$location->location) }}-tiles-tab">
                                @if($location->location == 'Country Office')
                                <button type="button" class="btn btn-warning mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>TTCL</strong> dial <strong><em>+25522219-XXXX</em></strong><br>Via <strong>Office Mobile</strong> dial <strong><em>0784720055</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Dar es salaam Port')
                                <button type="button" class="btn btn-warning mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>TTCL</strong> dial <strong><em>+25522219-XXXX</em></strong><br>Via <strong>Office Mobile</strong> dial <strong><em>0784720055</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Dodoma Main Office')
                                <button type="button" class="btn btn-warning mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>TTCL</strong> dial <strong><em>+255262320096</em></strong><br>Via <strong>Office Mobile</strong> dial <strong><em>0784720021</em></strong>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Dodoma Warehouse')
                                <button type="button" class="btn btn-warning mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>TTCL</strong> dial <strong><em>+255262340853</em></strong>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Kibondo' || $location->location == 'Kasulu')
                                <button type="button" class="btn btn-warning mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>TTCL Line 1</strong> dial <strong><em>+255282820156</em></strong><br>Via <strong>TTCL Line 2</strong> dial <strong><em>+255282820157</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @elseif($location->location == 'Isaka')
                                <button type="button" class="btn btn-warning mb-1" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="To contact staff in {{ $location->location }}" data-content="Via <strong>VSAT</strong> dial <strong><em>1340-XXXX</em></strong> <br>Via <strong>General TTCL Line </strong> dial <strong><em>+255282730003</em></strong><br>Via <strong>TTCL Line to HoSo</strong> dial <strong><em>+255282730002</em></strong><br><strong>XXXX</strong> = <em>Extension Number</em>">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Dialing Instructions
                                </button>
                                @endif

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
                                                <table class="table table-striped table table-sm">
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
                                                                <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Office Mobile
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
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /end tab-fade -->
            <?php $active_nav_tab_status = 0; ?>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">Staff VSAT Extensions and Mobile Numbers</h4>
    <p>Under this section you will be able to view all Staff extension numbers and Mobile numbers.</p>
    <p class="mb-0"><strong>So far no numbers have been Uploaded. Please contact Administration</strong></p>
</div>
@endif