<?php // if(Session::has('edit_user')){dd(Session::get('edit_user')->firstname);}     ?>
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link {{ Session::has('add_user_error') || Session::has('add_user_status') || Session::has('edit_user') || Session::has('edit_user_status') || Session::has('edit_user_error') || Session::has('user_status')?'active':'' }}" data-toggle="tab" href="#users" role="tab">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Session::has('add_editor_error') || Session::has('add_editor_status') || Session::has('edit_editor') || Session::has('edit_editor_status') || Session::has('edit_editor_error') || Session::has('editor_status')?'active':'' }}" data-toggle="tab" href="#editors" role="tab">Manage Editors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Session::has('add_resource_manager_error') || Session::has('add_resource_manager_status') || Session::has('edit_resource_manager') || Session::has('edit_resource_manager_status') || Session::has('edit_resource_manager_error') || Session::has('resource_manager_status')?'active':'' }}" data-toggle="tab" href="#resourceManagers" role="tab">Resource Managers</a>
            </li>
        </ul>
    </div>
    <div class="card-block">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade {{ Session::has('add_user_error') || Session::has('add_user_status') || Session::has('edit_user') || Session::has('edit_user_status') || Session::has('edit_user_error') || Session::has('user_status')?'show active':'' }}" id="users" role="tabpanel">
                <div class="card p-2">
                    <div class="">
                        @if(Session::has('add_user_status') || Session::has('edit_user_status') || Session::has('user_status'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ Session::has('edit_user_status')?Session::get('edit_user_status'):''}} {{Session::has('add_user_status')?Session::get('add_user_status'):''}} {{Session::has('user_status')?Session::get('user_status'):'' }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pull-left">
                            <a role="button" href="{{ (Session::has('edit_user') || Session::has('edit_user_error'))?URL::to('/createuser/'):'#' }}" class="btn btn-success" {!! (Session::has('edit_user') || Session::has('edit_user_error'))?"":"data-toggle='modal' data-target='#addUserModal'" !!} >
                               <i class="fa fa-plus-circle" aria-hidden="true"></i> Add User
                            </a>&nbsp;&nbsp;

                            @if(Session::has('edit_user') || Session::has('edit_user_error'))
                            <a role="button" href="#" class="btn btn-warning" data-toggle='modal' data-target='#addUserModal'>
                                <i class="fa fa-edit" aria-hidden="true"></i> Edit Previous User
                            </a>
                            @endif
                        </div>

                        <!-- User Modal -->
                        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    @if(Session::has('edit_user'))
                                    {{Form::open(array('url' => '/edituser/'.Session::get('edit_user')->id,'class' => '','role' => 'form'))}}
                                    @elseif(Session::has('edit_user_error'))
                                    {{Form::open(array('url' => '/edituser/'.Session::get('edit_user_error'),'class' => '','role' => 'form'))}}
                                    @else
                                    {{Form::open(array('url' => '/adduser','class' => '','role' => 'form'))}}
                                    @endif
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ (Session::has('edit_user') || Session::has('edit_user_error'))?'Edit':'Add' }} User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row @if($errors->has('firstname')){{ 'has-danger' }}@elseif(old('firstname')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalSuccess" class="col-sm-3 col-form-label text-right"><small>First Name</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="firstname" value="{{ Session::has('edit_user')?Session::get('edit_user')->firstname:old('firstname') }}" class="form-control @if($errors->has('firstname')){{ 'form-control-danger' }}@elseif(old('firstname')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" placeholder="Eg. Masumbuko">
                                                @if($errors->has('firstname'))
                                                <div class="form-control-feedback">{{ $errors->first('firstname') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('secondname')){{ 'has-danger' }}@elseif(old('secondname')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalWarning" class="col-sm-3 col-form-label text-right"><small>Second Name</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="secondname" value="{{ Session::has('edit_user')?Session::get('edit_user')->secondname:old('secondname') }}" class="form-control @if($errors->has('secondname')){{ 'form-control-danger' }}@elseif(old('secondname')){{ 'form-control-success' }}@endif" id="inputHorizontalWarning" placeholder="Eg. Polepole">
                                                @if($errors->has('secondname'))
                                                <div class="form-control-feedback">{{ $errors->first('secondname') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('username') && old('username')){{ 'has-warning' }}@elseif($errors->has('username')){{ 'has-danger' }}@elseif(old('username')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label text-right"><small>User Name</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" value="{{ Session::has('edit_user')?Session::get('edit_user')->username:old('username') }}" class="form-control @if($errors->has('username') && old('username')){{ 'form-control-warning' }}@elseif($errors->has('username')){{ 'form-control-danger' }}@elseif(old('username')){{ 'form-control-success' }}@endif" id="inputHorizontalDnger" placeholder="Eg. masumbuko.polepole">
                                                @if($errors->has('username'))
                                                <div class="form-control-feedback">{{ $errors->first('username') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('email') && old('email')){{ 'has-warning' }}@elseif($errors->has('email')){{ 'has-danger' }}@elseif(old('email')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalSuccess" class="col-sm-3 col-form-label text-right"><small>Email</small></label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" value="{{ Session::has('edit_user')?Session::get('edit_user')->email:old('email') }}" class="form-control @if($errors->has('email') && old('email')){{ 'form-control-warning' }}@elseif($errors->has('email')){{ 'form-control-danger' }}@elseif(old('email')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" placeholder="Eg. masumbuko.polepole@wfp.org">
                                                @if($errors->has('email'))
                                                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('title')){{ 'has-danger' }}@elseif(old('title')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalWarning" class="col-sm-3 col-form-label text-right"><small>Title</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title" value="{{ Session::has('edit_user')?Session::get('edit_user')->title:old('title') }}" class="form-control @if($errors->has('title')){{ 'form-control-danger' }}@elseif(old('title')){{ 'form-control-success' }}@endif" id="inputHorizontalWarning" placeholder="Eg. Store Keeper">
                                                @if($errors->has('title'))
                                                <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('department')){{ 'has-danger' }}@elseif(old('department')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label text-right"><small>Department</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="department" value="{{ Session::has('edit_user')?Session::get('edit_user')->department:old('department') }}" class="form-control @if($errors->has('department')){{ 'form-control-danger' }}@elseif(old('department')){{ 'form-control-success' }}@endif" id="inputHorizontalDnger" placeholder="Eg. Supply Chain">
                                                @if($errors->has('department'))
                                                <div class="form-control-feedback">{{ $errors->first('department') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('dutystation')){{ 'has-danger' }}@elseif(old('dutystation')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalSuccess" class="col-sm-3 col-form-label text-right"><small>Duty Station</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="dutystation" value="{{ Session::has('edit_user')?Session::get('edit_user')->dutystation:old('dutystation') }}" class="form-control @if($errors->has('dutystation')){{ 'form-control-danger' }}@elseif(old('dutystation')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" placeholder="Eg. Isaka">
                                                @if($errors->has('dutystation'))
                                                <div class="form-control-feedback">{{ $errors->first('dutystation') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>

                        {{Form::open(array('url' => '/search','class' => 'form-inline mt-2 mt-md-0 pull-right','role' => 'form'))}}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <td><small><strong><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br><a href="#">Name</a></strong></small></td>
                            <td><small><strong><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i><br><a href="#">User Name</a></strong></small></td>
                            <td><small><strong><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><br><a href="#">Email</a></strong></small></td>
                            <td><small><strong><i class="fa fa-header fa-2x" aria-hidden="true"></i><br><a href="#">Title</a></strong></small></td>
                            <td><small><strong><i class="fa fa-building-o fa-2x" aria-hidden="true"></i><br><a href="#">Department</a></strong></small></td>
                            <td><small><strong><i class="fa fa-home fa-2x" aria-hidden="true"></i><br><a href="#">Station</a></strong></small></td>
                            <td><small><strong><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i><br>Edit</strong></small></td>
                            <td><small><strong><i class="fa fa-unlock-alt fa-2x" aria-hidden="true"></i><br>Access</strong></small></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row_color = array('table-active', 'table-success', 'table-info', 'table-danger', 'table-warning');
                        $color_id = 0;
                        $row_status = 1;
                        ?>
                        @foreach($users as $user)
                        @if($row_status)
                        <tr class="{{ array_get($row_color,$color_id) }}">
                            <td><small>{{ $user->firstname.' '.$user->secondname }}</td>
                            <td><small>{{ $user->username }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td><small>{{ $user->title }}</small></td>
                            <td><small>{{ $user->department }}</small></td>
                            <td><small>{{ $user->dutystation }}</small></td>
                            <td><a role="button" href="{{ URL::to('/edituser/'.$user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a></td>
                            <td><a role="button" href="{{ URL::to('/deleteuser/'.$user->id) }}" class="btn btn-sm {{ $user->status?'btn-danger':'btn-success' }}"><i class="fa {{ $user->status?'fa-lock':'fa-unlock' }} fa-lg" aria-hidden="true"></i> {{ $user->status?'Lock':'Unlock' }}</a></td>
                        </tr>
                        <?php
                        ($color_id > 3) ? $color_id = 0 : ++$color_id;
                        $row_status = 0;
                        ?>
                        @else
                        <tr>
                            <td><small>{{ $user->firstname.' '.$user->secondname }}</th>
                                    <td><small>{{ $user->username }}</small></td>
                                    <td><small>{{ $user->email }}</small></td>
                                    <td><small>{{ $user->title }}</small></td>
                                    <td><small>{{ $user->department }}</small></td>
                                    <td><small>{{ $user->dutystation }}</small></td>
                                    <td><a role="button" href="{{ URL::to('/edituser/'.$user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a></td>
                                    <td><a role="button" href="{{ URL::to('/deleteuser/'.$user->id) }}" class="btn btn-sm {{ $user->status?'btn-danger':'btn-success' }}"><i class="fa {{ $user->status?'fa-lock':'fa-unlock' }} fa-lg" aria-hidden="true"></i> {{ $user->status?'Lock':'Unlock' }}</a></td>
                        </tr>
                        <?php
                        $row_status = 1;
                        ?>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade {{ Session::has('add_editor_error') || Session::has('add_editor_status') || Session::has('edit_editor') || Session::has('edit_editor_status') || Session::has('edit_editor_error') || Session::has('editor_status')?'show active':'' }}" id="editors" role="tabpanel">
                <div class="card p-2">
                    <div class="">
                        @if(Session::has('add_editor_status') || Session::has('edit_editor_status') || Session::has('editor_status'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ Session::has('edit_editor_status')?Session::get('edit_editor_status'):''}} {{Session::has('add_editor_status')?Session::get('add_editor_status'):''}} {{Session::has('editor_status')?Session::get('editor_status'):'' }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pull-left">
                            <a role="button" href="{{ (Session::has('edit_user') || Session::has('edit_user_error'))?URL::to('/createuser/'):'#' }}" class="btn btn-success" {!! (Session::has('edit_user') || Session::has('edit_user_error'))?"":"data-toggle='modal' data-target='#addEditorModal'" !!} >
                               <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Editor
                            </a>&nbsp;&nbsp;

                            @if(Session::has('edit_editor') || Session::has('edit_editor_error'))
                            <a role="button" href="#" class="btn btn-warning" data-toggle='modal' data-target='#addEditorModal'>
                                <i class="fa fa-edit" aria-hidden="true"></i> Edit Previous Editor
                            </a>
                            @endif
                        </div>

                        <!-- Editor Modal -->
                        <div class="modal fade" id="addEditorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    @if(Session::has('edit_editor'))
                                    {{Form::open(array('url' => '/editpageeditor/'.Session::get('edit_editor')->id,'class' => '','role' => 'form'))}}
                                    @elseif(Session::has('edit_editor_error'))
                                    {{Form::open(array('url' => '/editpageeditor/'.Session::get('edit_editor_error'),'class' => '','role' => 'form'))}}
                                    @else
                                    {{Form::open(array('url' => '/addeditor','class' => '','role' => 'form'))}}
                                    @endif
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ (Session::has('edit_editor') || Session::has('edit_editor_error'))?'Edit':'Add' }} Editor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row @if($errors->has('username')){{ 'has-danger' }}@elseif(old('username')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalSuccess" class="col-sm-3 col-form-label text-right"><small>User Name</small></label>
                                            <div class="col-sm-9">
                                                <fieldset {{ Session::has('edit_editor')?'disabled':'' }}>
                                                    <select name="username" class="form-control custom-select @if($errors->has('username')){{ 'form-control-danger' }}@elseif(old('username')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" id="inlineFormCustomSelect">
                                                        <option selected value="">Choose...</option>
                                                        @foreach($users as $user)
                                                        <option {{ (old('username') == $user->id) || (Session::has('edit_editor') && Session::get('edit_editor')->editor == $user->id)? 'selected':'' }} value="{{ $user->id }}">{{ $user->username }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                @if($errors->has('username'))
                                                <div class="form-control-feedback">{{ $errors->first('username') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('secondname')){{ 'has-danger' }}@elseif(old('secondname')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalSuccess" class="col-sm-3 col-form-label text-right"><small>Function</small></label>
                                            <div class="col-sm-9">
                                                <select name="function" class="form-control custom-select" id="inlineFormCustomSelect">
                                                    <option {{ Session::has('edit_editor') && Session::get('edit_editor')->function == 'Manager'?'':'selected' }} value="Editor">Editor</option>
                                                    <option {{ Session::has('edit_editor') && Session::get('edit_editor')->function == 'Manager'?'selected':'' }} value="Manager">Manager</option>
                                                </select>
                                                <!-- <input type="text" name="firstname" value="{{ Session::has('edit_user')?Session::get('edit_user')->firstname:old('firstname') }}" class="form-control @if($errors->has('firstname')){{ 'form-control-danger' }}@elseif(old('firstname')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" placeholder="Eg. Masumbuko">-->
                                                @if($errors->has('function'))
                                                <div class="form-control-feedback">{{ $errors->first('firstname') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>

                        {{Form::open(array('url' => '/search','class' => 'form-inline mt-2 mt-md-0 pull-right','role' => 'form'))}}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <td><small><strong><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br><a href="#">Name</a></strong></small></td>
                            <td><small><strong><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><br><a href="#">Email</a></strong></small></td>
                            <td><small><strong><i class="fa fa-cog fa-2x" aria-hidden="true"></i><br><a href="#">Function</a></strong></small></td>
                            <td><small><strong><i class="fa fa-building-o fa-2x" aria-hidden="true"></i><br><a href="#">Department</a></strong></small></td>
                            <td><small><strong><i class="fa fa-home fa-2x" aria-hidden="true"></i><br><a href="#">Station</a></strong></small></td>
                            <td><small><strong><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i><br>Edit</strong></small></td>
                            <td><small><strong><i class="fa fa-unlock-alt fa-2x" aria-hidden="true"></i><br>Access</strong></small></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row_color = array('table-active', 'table-success', 'table-info', 'table-danger', 'table-warning');
                        $color_id = 0;
                        $row_status = 1;
                        ?>
                        @foreach($editors as $editor)
                        @if($row_status)
                        <tr class="{{ array_get($row_color,$color_id) }}">
                            <td><small>{{ App\User::find($editor->editor)->firstname.' '.App\User::find($editor->editor)->secondname }}</td>
                            <td><small>{{ App\User::find($editor->editor)->email }}</small></td>
                            <td><small>{{ $editor->function }}</small></td>
                            <td><small>{{ App\User::find($editor->editor)->department }}</small></td>
                            <td><small>{{ App\User::find($editor->editor)->dutystation }}</small></td>
                            <td><a role="button" href="{{ URL::to('/editpageeditor/'.$editor->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a></td>
                            <td><a role="button" href="{{ URL::to('/deletepageeditor/'.$editor->id) }}" class="btn btn-sm {{ $editor->status?'btn-danger':'btn-success' }}"><i class="fa {{ $editor->status?'fa-lock':'fa-unlock' }} fa-lg" aria-hidden="true"></i> {{ $editor->status?'Lock':'Unlock' }}</a></td>
                        </tr>
                        <?php
                        ($color_id > 3) ? $color_id = 0 : ++$color_id;
                        $row_status = 0;
                        ?>
                        @else
                        <tr>
                            <td><small>{{ App\User::find($editor->editor)->firstname.' '.App\User::find($editor->editor)->secondname }}</td>
                            <td><small>{{ App\User::find($editor->editor)->email }}</small></td>
                            <td><small>{{ $editor->function }}</small></td>
                            <td><small>{{ App\User::find($editor->editor)->department }}</small></td>
                            <td><small>{{ App\User::find($editor->editor)->dutystation }}</small></td>
                            <td><a role="button" href="{{ URL::to('/editpageeditor/'.$editor->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a></td>
                            <td><a role="button" href="{{ URL::to('/deletepageeditor/'.$editor->id) }}" class="btn btn-sm {{ $editor->status?'btn-danger':'btn-success' }}"><i class="fa {{ $editor->status?'fa-lock':'fa-unlock' }} fa-lg" aria-hidden="true"></i> {{ $editor->status?'Lock':'Unlock' }}</a></td>
                        </tr>
                        <?php
                        $row_status = 1;
                        ?>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade {{ Session::has('add_resource_manager_error') || Session::has('add_resource_manager_status') || Session::has('edit_resource_manager') || Session::has('edit_resource_manager_status') || Session::has('edit_resource_manager_error') || Session::has('resource_manager_status')?'show active':'' }}" id="resourceManagers" role="tabpanel">
                <div class="card p-2">
                    <div class="">
                        @if(Session::has('add_resource_manager_status') || Session::has('edit_resource_manager_status') || Session::has('resource_manager_status'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ Session::has('edit_resource_manager_status')?Session::get('edit_resource_manager_status'):''}} {{Session::has('add_resource_manager_status')?Session::get('add_resource_manager_status'):''}} {{Session::has('resource_manager_status')?Session::get('resource_manager_status'):'' }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="pull-left">
                            <a role="button" href="{{ (Session::has('edit_user') || Session::has('edit_user_error'))?URL::to('/createuser/'):'#' }}" class="btn btn-success" {!! (Session::has('edit_user') || Session::has('edit_user_error'))?"":"data-toggle='modal' data-target='#addResourceManagerModal'" !!} >
                               <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Resource Manager
                            </a>&nbsp;&nbsp;

                            @if(Session::has('edit_resource_manager') || Session::has('edit_resource_manager_error'))
                            <a role="button" href="#" class="btn btn-warning" data-toggle='modal' data-target='#addResourceManagerModal'>
                                <i class="fa fa-edit" aria-hidden="true"></i> Edit Previous Resource Manager
                            </a>
                            @endif
                        </div>

                        <!-- Resource Manager Modal -->
                        <div class="modal fade" id="addResourceManagerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    @if(Session::has('edit_resource_manager'))
                                    <?php $resouce_manager = Session::get('edit_resource_manager')->first(); ?>
                                    {{Form::open(array('url' => '/changeresourcemanager/'.$resouce_manager->user,'multiple' => true,'class' => '','role' => 'form'))}}
                                    @elseif(Session::has('edit_resource_manager_error'))
                                    <?php $resouce_manager = Session::get('edit_resource_manager_error')->first(); ?>
                                    {{Form::open(array('url' => '/editresourcemanager/'.$resouce_manager->user,'multiple' => true,'class' => '','role' => 'form'))}}
                                    @else
                                    {{Form::open(array('url' => '/addresourcemanager','multiple' => true,'class' => '','role' => 'form'))}}
                                    @endif
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ (Session::has('edit_resource_manager') || Session::has('edit_resource_manager_error'))?'Edit':'Add' }} Resource Manager</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row @if($errors->has('username')){{ 'has-danger' }}@elseif(old('username')){{ 'has-success' }}@endif">
                                            <label for="inputHorizontalSuccess" class="col-sm-3 col-form-label text-right"><small>User Name</small></label>
                                            <div class="col-sm-9">
                                                <fieldset {{ Session::has('edit_resource_manager')?'disabled':'' }}>
                                                    <select id='username' name="username" class="form-control custom-select @if($errors->has('username')){{ 'form-control-danger' }}@elseif(old('username')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" id="inlineFormCustomSelect">
                                                        <option selected value="">Choose...</option>
                                                        @foreach($users as $user)
                                                        <option {{ (old('username') == $user->id) || ((Session::has('edit_resource_manager') || Session::has('edit_resource_manager_error')) && $resouce_manager->user == $user->id)? 'selected':'' }} value="{{ $user->id }}">{{ $user->username }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                @if($errors->has('username'))
                                                <div class="form-control-feedback">{{ ($errors->first('username')=='The username has already been taken.')?'Resource Manager has already been added.':$errors->first('username') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row @if($errors->has('resource')){{ 'has-danger' }}@elseif(old('resource')){{ 'has-success' }}@endif">
                                            <label for="resource" class="col-sm-3 col-form-label text-right"><small>Resource</small></label>
                                            <div class="col-sm-9">
                                                <?php
                                                    if(Session::has('edit_resource_manager') || Session::has('edit_resource_manager_error'))
                                                    $resource_types = Session::get('edit_resource_manager')->where('status',1);

                                                ?>
                                                <select id="resource" name="resource[]" class="form-control js-resource-multiple @if($errors->first('resource')) form-control-danger @elseif(old('resource')) form-control-success @endif" multiple>
                                                    @foreach ($resourcetypes as $resource_type)
                                                        <option @if(old('resource') && in_array($resource_type->id,old('resource'))) selected @elseif((Session::has('edit_resource_manager') || Session::has('edit_resource_manager_error')) && $resource_types->contains('resource_type',$resource_type->id)) selected @endif value="{{ $resource_type->id }}">{{ $resource_type->resource_type }}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <input type="text" name="firstname" value="{{ Session::has('edit_user')?Session::get('edit_user')->firstname:old('firstname') }}" class="form-control @if($errors->has('firstname')){{ 'form-control-danger' }}@elseif(old('firstname')){{ 'form-control-success' }}@endif" id="inputHorizontalSuccess" placeholder="Eg. Masumbuko">-->
                                                @if($errors->has('resource'))
                                                <div class="form-control-feedback">{{ $errors->first('resource') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>

                        {{Form::open(array('url' => '/search','class' => 'form-inline mt-2 mt-md-0 pull-right','role' => 'form'))}}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <td><small><strong><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br><a href="#">Name</a></strong></small></td>
                            <td><small><strong><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><br><a href="#">Email</a></strong></small></td>
                            <td><small><strong><i class="fa fa-cog fa-2x" aria-hidden="true"></i><br><a href="#">Resource Managed</a></strong></small></td>
                            <td><small><strong><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i><br>Edit Access</strong></small></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row_color = array('table-active', 'table-success', 'table-info', 'table-danger', 'table-warning');
                        $color_id = 0;
                        $row_status = 1;
                        ?>
                        @foreach($resourcemanagers as $resource_manager)
                        @if($row_status)
                        <tr class="{{ array_get($row_color,$color_id) }}">
                            <td><small>{{ App\User::find($resource_manager->user)->firstname.' '.App\User::find($resource_manager->user)->secondname }}</td>
                            <td><small>{{ App\User::find($resource_manager->user)->email }}</small></td>
                            <td>
                                <small>
                                    <?php 
                                       $managed_resources = $managedresources->where('user', $resource_manager->user);
                                    ?>
                                    @if($managed_resources->isNotEmpty())
                                        @foreach ($managed_resources as $managed_resource)
                                            @if($managed_resource->status)
                                                @if($loop->last)
                                                    <strong class="text-success">
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i> 
                                                        {{ App\ResourceType::find($managed_resource->resource_type)->resource_type }}
                                                    </strong>
                                                @else 
                                                    <strong class="text-success">
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i> 
                                                        {{ App\ResourceType::find($managed_resource->resource_type)->resource_type }}
                                                    </strong>,
                                                @endif
                                            @else
                                                @if($loop->last)
                                                    <strong class="text-danger">
                                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                                        {{ App\ResourceType::find($managed_resource->resource_type)->resource_type }}
                                                    </strong>
                                                @else 
                                                    <strong class="text-danger">
                                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                                        {{ App\ResourceType::find($managed_resource->resource_type)->resource_type }}
                                                    </strong>,
                                                @endif
                                            @endif
                                        @endforeach
                                    @else
                                    No resource managed
                                    @endif
                                </small>
                            </td>
                            <td><a role="button" href="{{ URL::to('/editresourcemanager/'.$resource_manager->user) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a></td>
                        </tr>
                        <?php
                        ($color_id > 3) ? $color_id = 0 : ++$color_id;
                        $row_status = 0;
                        ?>
                        @else
                        <tr>
                            <td><small>{{ App\User::find($resource_manager->user)->firstname.' '.App\User::find($resource_manager->user)->secondname }}</td>
                            <td><small>{{ App\User::find($resource_manager->user)->email }}</small></td>
                            <td>
                                <small>
                                    <?php 
                                       $managed_resources = $managedresources->where('user', $resource_manager->user);
                                    ?>
                                    @foreach ($managed_resources as $managed_resource)
                                        @if ($loop->last)
                                            <strong>{{ App\ResourceType::find($managed_resource->resource_type)->resource_type }}</strong>
                                        @else 
                                            <strong>{{ App\ResourceType::find($managed_resource->resource_type)->resource_type }}</strong><br>
                                        @endif
                                    @endforeach
                                </small>
                            </td>
                            <td><a role="button" href="{{ URL::to('/editpageeditor/'.$editor->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a></td>
                            <td><a role="button" href="{{ URL::to('/deletepageeditor/'.$editor->id) }}" class="btn btn-sm {{ $editor->status?'btn-danger':'btn-success' }}"><i class="fa {{ $editor->status?'fa-lock':'fa-unlock' }} fa-lg" aria-hidden="true"></i> {{ $editor->status?'Lock':'Unlock' }}</a></td>
                        </tr>
                        <?php
                        $row_status = 1;
                        ?>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>