@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-example">
                            <nav id="navbar-example2">
                                <a class="navbar-brand" href="#">WFP Resources</a>
                                <a href="{{URL::to('/addresourcetab/')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> add Resource Tab</a>
                                {{-- <a href="{{URL::to('/addresource/null')}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> add Resource</a> --}}
                                <ul id="navbar-example2" class="nav nav-tabs" role="tablist">
                                    @foreach($resource_types as $resource_type)
                                    <li class="nav-item"><a class="nav-link" href="{{URL::to('#'.$resource_type->resource_type)}}">{{$resource_type->resource_type}}</a></li>
                                    @endforeach
                                    <!--<li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#one">one</a>
                                            <a class="dropdown-item" href="#two">two</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#three">three</a>
                                        </div>
                                    </li>-->
                                </ul>
                            </nav>
                            <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="scrollspy-example" style="position: relative; height: 660px; overflow-y: scroll">
                                @foreach($resource_types as $resource_type)
                                <h4 id="{{$resource_type->resource_type}}" class="text-primary">
                                    {{$resource_type->resource_type}}
                                    <a href="{{URL::to('/addfolder/'.$resource_type->resource_type)}}" data-toggle="tooltip" data-placement="top" title="create subfolder" class="text-muted"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/addresource/'.$resource_type->resource_type)}}" data-toggle="tooltip" data-placement="top" title="add resource" class="text-muted"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                </h4>
                                    <?php $subfolders =  $resource_subfolders->where('resource_type', $resource_type->resource_type) ?>
                                    @foreach ($subfolders as $subfolder)
                                    @if($subfolder->subfolder_name != NULL)
                                    <h5>
                                        &nbsp;&nbsp;
                                        <i class="fa fa-folder-open" aria-hidden="true"></i> {{ $subfolder->subfolder_name }}
                                    </h5>
                                    @endif
                                        <?php $resources =  $all_resources->where('subfolder_id', $subfolder->id); ?>
                                        
                                        @foreach($resources as $resource)
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i @if($resource->external_link == "Yes") class="fa fa-link" @else class="fa fa-file-text" @endif aria-hidden="true"></i> 
                                        <a class="text-muted font-italic" @if($resource->external_link == "Yes") target="_blank" href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.encrypt($resource->resource_location))}}" @else href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.$resource->resource_location)}}" @endif>{{$resource->resource_name}}</a> 
                                        @if($resources->count() != $resource->position)
                                        <a href="{{URL::to('/moveresource/up/'.$resource->id)}}" data-toggle="tooltip" data-placement="top" title="move up" class="text-primary"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
                                        @endif
                                        @if($resource->position > 1)
                                        <a href="{{URL::to('/moveresource/down/'.$resource->id)}}" data-toggle="tooltip" data-placement="top" title="move down" class="text-primary"><i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
                                        @endif
                                        <a href="{{URL::to('/editresource/'.$resource->id)}}" data-toggle="tooltip" data-placement="top" title="edit" class="text-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="{{URL::to('/deleteresourceconfirmation/'.$resource->id)}}" data-toggle="tooltip" data-placement="top" title="delete" class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <br>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>

                            <!-- Start of Add Resource Tab Modal -->
                            @if(Session::has('add_resource_tab') || Session::has('add_resource_tab_error'))
                            {{Form::open(array('url' => '/addresourcetab/','multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                            <div class="modal fade addResourceTabModal" id="addResourceTabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="addResourceTabModal">Add New Resource Tab</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group @if($errors->first('resource_tab_name')) has-danger @elseif(old('resource_tab_name')) has-success @endif">
                                                <label class="font-weight-bold">Resource tab name</label>
                                                <input name="resource_tab_name" value="{{old('resource_tab_name')}}" type="text" class="form-control @if($errors->first('resource_tab_name')) form-control-danger @elseif(old('resource_tab_name')) form-control-success @endif" placeholder="Enter name of the new resource tab">
                                                @if($errors->first('resource_tab_name'))
                                                <div class="form-control-feedback">
                                                    <small class="font-weight-bold">{{ $errors->first('resource_tab_name') }}</small>
                                                </div>
                                                @endif
                                                <small class="form-text text-muted">
                                                    Make sure you have entered the name of the new resource tab
                                                </small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Tab</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{Form::token()}}
                            {{Form::close()}}
                            @endif<!-- end of Add Resource Tab Modal -->

                            <!-- Start of Add Resource Folder Modal -->
                            @if(Session::has('add_resource_folder') || Session::has('add_resource_folder_error'))
                            {{Form::open(array('url' => '/addfolder/'.Session::get('resourcetype'),'multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                            <div class="modal fade addResourceFolderModal" id="addResourceFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="addResourceFolderModal">Create new {{ Session::get('resourcetype') }} Resource subfolder</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group @if($errors->first('subfolder_name')) has-danger @elseif(old('subfolder_name')) has-success @endif">
                                                <label class="font-weight-bold">Subfolder name</label>
                                                <input name="subfolder_name" value="{{old('subfolder_name')}}" type="text" class="form-control @if($errors->first('subfolder_name')) form-control-danger @elseif(old('subfolder_name')) form-control-success @endif" placeholder="Enter name of the new subfolder">
                                                @if($errors->first('subfolder_name'))
                                                <div class="form-control-feedback">
                                                    <small class="font-weight-bold">{{ $errors->first('subfolder_name') }}</small>
                                                </div>
                                                @endif
                                                <small class="form-text text-muted">
                                                    Make sure you have entered the name of the new subfolder
                                                </small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{Form::token()}}
                            {{Form::close()}}
                            @endif<!-- end of Add Resource Folder Modal -->

                            <!-- Add new Resource Modal -->
                            @if(Session::has('add_resource') || Session::has('add_resource_error'))
                            {{Form::open(array('url' => '/addresource/'.Session::get('resourcetype'),'multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                            <div class="modal fade addResourceModal" id="addResourceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                Add New @if(Session::get('resourcetype') != 'null') {{Session::get('resourcetype')}} @endif Resource
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group @if($errors->first('resource_type')) has-danger @elseif(old('resource_type')) has-success @endif">
                                                <label class="font-weight-bold">Resource Type</label>
                                                <select id="resource_type" name="resource_type" class="form-control @if($errors->first('resource_type')) form-control-danger @elseif(old('resource_type')) form-control-success @endif @if(Session::get('resourcetype') == 'null') js-resourcetype-single @else js-resourcetype-disabled @endif">
                                                    <option></option>
                                                    @foreach ($resource_types as $resource_type)
                                                        <option value="{{ $resource_type->resource_type }}" @if(Session::get('resourcetype') == $resource_type->resource_type || old('resource_type') == $resource_type->resource_type) selected @endif>{{ $resource_type->resource_type }}</option>
                                                    @endforeach
                                                </select>
                                                @if(Session::get('resourcetype') == 'null')
                                                    @if($errors->first('resource_type'))
                                                    <div class="form-control-feedback">
                                                        <small class="font-weight-bold">{{ $errors->first('resource_type') }}</small>
                                                    </div>
                                                    @endif
                                                    <small class="form-text text-muted">Make sure you have selected the correct resource type</small>
                                                @endif
                                            </div>
                                            <div class="form-group @if($errors->first('subfolder_id')) has-danger @elseif(old('subfolder_id')) has-success @endif">
                                                <label class="font-weight-bold">Subfolder</label>
                                                <select id="subfolder_id" name="subfolder_id" class="form-control js-subfolderid-single">
                                                    <option></option>
                                                    <?php $subfolders = $resource_subfolders->where('resource_type', Session::get('resourcetype')) ?>
                                                    @foreach ($subfolders as $subfolder)
                                                    <option value="{{ $subfolder->id }}" @if(old('subfolder_id') == $subfolder->id) selected @endif>{{ ($subfolder->subfolder_name == NULL)?"Root File":$subfolder->subfolder_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->first('subfolder_id'))
                                                <div class="form-control-feedback">
                                                    <small class="font-weight-bold">{{ $errors->first('subfolder_id') }}</small>
                                                </div>
                                                @endif
                                                <small class="form-text text-muted">
                                                    Make sure you have selected the corresponding subfolder
                                                </small>
                                            </div>
                                            <div class="form-group @if($errors->first('resource_name')) has-danger @elseif(old('resource_name')) has-success @endif">
                                                <label class="font-weight-bold">File name</label>
                                                <input name="resource_name" value="{{old('resource_name')}}" type="text" class="form-control @if($errors->first('resource_name')) form-control-danger @elseif(old('resource_name')) form-control-success @endif" placeholder="Enter File name">
                                                @if($errors->first('resource_name'))
                                                <div class="form-control-feedback">
                                                    <small class="font-weight-bold">{{ $errors->first('resource_name') }}</small>
                                                </div>
                                                @endif
                                                <small class="form-text text-muted">
                                                    Make sure you have entered the correct Resource Name
                                                </small>
                                            </div>
                                            <fieldset class="form-group">
                                                <label class="font-weight-bold">Is the resource an external link</label>
                                                <div class="d-flex">
                                                    <div class="form-check pr-2">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="resourceislink" v-model="resourceislink" value="No">
                                                            No
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="resourceislink" v-model="resourceislink" value="Yes">
                                                            Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-group @if($errors->first('file')) has-danger @elseif(old('file')) has-success @endif">
                                                <label class="font-weight-bold">Resource location</label>
                                                <div v-if ="resourceislink == 'No'">
                                                    <input name="file" value="{{old('file')}}" type="file" class="form-control-file"
                                                        id="exampleInputFile" aria-describedby="fileHelp">
                                                    @if($errors->first('file'))
                                                    <div class="form-control-feedback">
                                                        <small class="font-weight-bold">{{ $errors->first('file') }}</small>
                                                    </div>
                                                    @endif
                                                    <small id="fileHelp" class="form-text text-muted">
                                                        Make sure you have uploaded the correct file.<br> Only PDF,
                                                        MS Word, MS Excel and MS PowerPoint formats are excepted
                                                    </small>
                                                </div>
                                                <div v-else ="resourceislink == 'Yes'">
                                                    <input class="form-control @if($errors->has('file')){{ 'form-control-danger' }}@elseif(old('file')){{ 'form-control-success' }}@endif" type="url" name='file' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->source:(old('file')) }}" placeholder="https://example.com">
                                                    @if($errors->has('file') && old('resourceislink') == 'Yes')
                                                    <div class="form-control-feedback">
                                                        <small class="font-weight-bold">The url field is required</small>
                                                    </div>
                                                    @elseif(old('file'))
                                                    <div class="form-control-feedback">
                                                        <em>Success! Externa link has been captured</em>
                                                    </div>
                                                    @endif
                                                    <small class="form-text text-muted">
                                                        Make sure you enter a valid url link
                                                    </small>
                                                </div>
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
                            {{Form::close()}}<!-- end of Add new Resource Modal -->
                            @endif

                            <!-- Edit Resource Modal -->
                            @if(Session::has('editresource'))
                            {{Form::open(array('url' => '/editresource/'.Session::get('editresource')->id,'multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                            <div class="modal fade editResourceModal" id="editResourceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-warning" id="exampleModalLabel">
                                                Edit {{Session::get('editresource')->resource_type}} Resource
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group @if($errors->first('resource_type')) has-danger @elseif(old('resource_type')) has-success @endif">
                                                <label class="font-weight-bold">Resource Type</label>
                                                <select id="resource_type" name="resource_type" class="form-control js-resourcetype-disabled">
                                                    <option></option>
                                                    @foreach ($resource_types as $resource_type)
                                                    <option value="{{ $resource_type->resource_type }}" @if(Session::get('editresource')->resource_type == $resource_type->resource_type) selected @endif>{{ $resource_type->resource_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group @if($errors->first('subfolder_id')) has-danger @elseif(old('subfolder_id')) has-success @endif">
                                                <label class="font-weight-bold">Subfolder</label>
                                                <select id="subfolder_id" name="subfolder_id" class="form-control js-subfolderid-single">
                                                    <option></option>
                                                    <?php $subfolders = $resource_subfolders->where('resource_type', Session::get('editresource')->resource_type) ?>
                                                    @foreach ($subfolders as $subfolder)
                                                    <option value="{{ $subfolder->id }}" @if(Session::get('editresource')->subfolder_id == $subfolder->id) selected @endif>{{ ($subfolder->subfolder_name == NULL)?"Root File":$subfolder->subfolder_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group @if($errors->first('resource_name')) has-danger @elseif(old('resource_name')) has-success @endif">
                                                <label class="font-weight-bold">File name</label>
                                                <input name="resource_name" value="@if(old('resource_name')) {{old('resource_name')}} @else {{Session::get('editresource')->resource_name}} @endif" type="text" class="form-control @if($errors->first('resource_name')) form-control-danger @elseif(old('resource_name')) form-control-success @endif" placeholder="Enter File name">
                                                @if($errors->first('resource_name'))
                                                <div class="form-control-feedback">
                                                    <small class="font-weight-bold">{{ $errors->first('resource_name') }}</small>
                                                </div>
                                                @endif
                                                <small class="form-text text-muted">
                                                    Make sure you have entered the correct Resource Name
                                                </small>
                                            </div>
                                            <fieldset class="form-group">
                                                <label class="font-weight-bold">Is the resource an external link</label>
                                                <div class="d-flex">
                                                    <div class="form-check pr-2">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="resourceislink" v-model="resourceislink" value="No">
                                                            No
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="resourceislink" v-model="resourceislink" value="Yes">
                                                            Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-group @if($errors->first('file')) has-danger @elseif(old('file')) has-success @endif">
                                                <label class="font-weight-bold">Resource location</label>
                                                <div v-if ="resourceislink == 'No'">
                                                    <input name="file" value="" type="file" class="form-control-file"
                                                    id="exampleInputFile" aria-describedby="fileHelp">
                                                    @if($errors->first('file') && Session::get('editresource')->external_link == "Yes")
                                                    <div class="form-control-feedback">
                                                        <small class="font-weight-bold">{{ $errors->first('file') }}</small>
                                                    </div>
                                                    @elseif(Session::get('editresource')->external_link == "No")
                                                    <small id="fileHelp" class="form-text text-success font-weight-bold">
                                                        File exists
                                                    </small>
                                                    @else
                                                    <small id="fileHelp" class="form-text text-warning font-weight-bold">
                                                        Upload a Valid file
                                                    </small>
                                                    @endif
                                                    <small id="fileHelp" class="form-text text-muted">
                                                        Only PDF, MS Word, MS Excel and MS PowerPoint formats are excepted
                                                    </small>
                                                </div>
                                                <div v-else ="resourceislink == 'Yes'">
                                                    <input value="@if(Session::get('editresource')->external_link == "Yes") {{ old('file')? old('file'): Session::get('editresource')->resource_location }} @endif" type="url" name='file' class="form-control @if($errors->first('file')) form-control-danger @elseif(old('file')) form-control-success @endif" placeholder="https://example.com">
                                                    @if($errors->has('file') && old('resourceislink') == 'Yes')
                                                    <div class="form-control-feedback">
                                                        <small class="font-weight-bold">The url field is required</small>
                                                    </div>
                                                    @elseif(old('file'))
                                                    <div class="form-control-feedback">
                                                        <em>Success! Externa link has been captured</em>
                                                    </div>
                                                    @endif
                                                    <small class="form-text text-muted">
                                                        Make sure you enter a valid url link
                                                    </small>
                                                </div>
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
                            {{Form::close()}}<!-- end of Edit Resource Modal -->
                            @endif

                            <!-- Start of Delete Resource Modal -->
                            @if(Session::has('delete_resource'))
                            <div class="modal fade deleteResourceModal" id="deleteResourceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">Delete Resource</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body font-italic">
                                            You're about to remove <strong class="text-warning">{{ Session::get('delete_resource')->resource_name }}</strong> from <strong class="text-primary">{{ Session::get('delete_resource')->resource_type }} Resources</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                            <a href="{{URL::to('/deleteresource/'.Session::get('delete_resource')->id)}}" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end of Delete Resource Modal -->
                            @endif
                        </div>
                    </div>
                </div>
                
                <hr>

                <!-- FOOTER -->
                @include('frames/footer')

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

