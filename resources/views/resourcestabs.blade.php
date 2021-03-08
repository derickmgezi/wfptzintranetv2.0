@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">

                <div class="card mt-2">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#list" role="tab">
                                    <i class="fa fa-list" aria-hidden="true"></i> Full List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#home" role="tab">
                                    <i class="fa fa-th-large fa-lg" aria-hidden="true"></i> Tiles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                    <i class="fa fa-list-ul fa-lg" aria-hidden="true"></i> List
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane" id="home" role="tabpanel">
                                <div class="h5 mt-2">
                                    <span class="lead text-primary">{{ $resource_type->resource_type }}</span>
                                    <a href="{{URL::to('/addfolder/'.$resource_type->resource_type)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="create subfolder"
                                        class="text-muted"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/addresource/'.$resource_type->resource_type)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="add resource"
                                        class="text-muted"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/editresourcetab/'.$resource_type->id)}}" data-toggle="tooltip"
                                        data-placement="bottom" title="edit" class="text-warning"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/deleteresourcetab/'.$resource_type->id)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="delete"
                                        class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-2">
                                        <ul class="nav nav-pills flex-column" role="tablist"
                                            style="position: sticky;top: 80px;">
                                            <?php $active_pill=true; ?>
                                            @foreach ($resource_supporting_units_subfolders as
                                            $resource_supporting_units_subfolder)
                                            <?php 
                                            $resources = $supporting_unit_resources->where('subfolder_id',$resource_supporting_units_subfolder->id);
                                            ?>
                                            @if ($resources->isNotEmpty())
                                            <li class="nav-item mb-2">
                                                <a class="nav-link {{ ($active_pill)?'active':'' }}" data-toggle="pill"
                                                    role="tab"
                                                    href="#{{ ($resource_supporting_units_subfolder->subfolder_name == NULL)?"Resources":str_replace(' ', '', $resource_supporting_units_subfolder->subfolder_name) }}"
                                                    style="padding: 0">
                                                    <div class="card">
                                                        <div class="caption">
                                                            <img class="img-fluid" alt="Responsive image"
                                                                src="{{ strlen($resource_supporting_units_subfolder->image) != 0? url('imagecache/original/thumbnails/'.$resource_supporting_units_subfolder->image):url('/image/WFP blue background.png') }}"
                                                                alt="Generic placeholder image">
                                                            <h2 class="text-center">
                                                                {{ ($resource_supporting_units_subfolder->subfolder_name == NULL)?$resource_type->resource_type:$resource_supporting_units_subfolder->subfolder_name }}
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php $active_pill=false; ?>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="col-10 tab-content card border-right-0 border-bottom-0 border-top-0">
                                        <?php $active_tab=true; ?>
                                        @foreach ($resource_supporting_units_subfolders as
                                        $resource_supporting_units_subfolder)
                                        <?php 
                                        $resources = $supporting_unit_resources->where('subfolder_id',$resource_supporting_units_subfolder->id);
                                        ?>
                                        @if ($resources->isNotEmpty())
                                        <div class="tab-pane fade show {{ ($active_tab)?'active':'' }}"
                                            id="{{ ($resource_supporting_units_subfolder->subfolder_name == NULL)?"Resources":str_replace(' ', '', $resource_supporting_units_subfolder->subfolder_name) }}"
                                            role="tabpanel">
                                            <div class="list-group">
                                                @foreach ($resources as $resource)
                                                <?php $date = new Jenssegers\Date\Date($resource->updated_at); ?>
                                                <a class="list-group-item list-group-item-action text-primary mb-1"
                                                    data-delay="300" data-trigger="hover" data-container="body"
                                                    data-toggle="popover" data-trigger="focus" data-placement="right"
                                                    data-html="true" title="Updated by"
                                                    data-content="{{ App\user::find($resource->edited_by)->firstname." ".App\user::find($resource->edited_by)->secondname }}<br>{{ $date->ago() }}"
                                                    @if($resource->external_link == "Yes") target="_blank"
                                                    href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.encrypt($resource->resource_location))}}"
                                                    @else
                                                    href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.$resource->resource_location)}}"
                                                    @endif>
                                                    <i @if($resource->external_link == "Yes") class="fa
                                                        fa-external-link" @else class="fa fa-file-text" @endif
                                                        aria-hidden="true"></i>&nbsp;{{ $resource->resource_name }}
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <?php $active_tab=false; ?>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="list" role="tabpanel">
                                <div class="h5 mt-2">
                                    <span class="lead text-primary">{{ $resource_type->resource_type }}</span>
                                    <a href="{{URL::to('/addfolder/'.$resource_type->resource_type)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="create subfolder"
                                        class="text-muted"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/addresource/'.$resource_type->resource_type)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="add resource"
                                        class="text-muted"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/editresourcetab/'.$resource_type->id)}}" data-toggle="tooltip"
                                        data-placement="bottom" title="edit" class="text-warning"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/deleteresourcetab/'.$resource_type->id)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="delete"
                                        class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>
                                @foreach ($resource_supporting_units_subfolders as $resource_supporting_units_subfolder)
                                <?php $resources = $supporting_unit_resources->where('subfolder_id',$resource_supporting_units_subfolder->id); ?>
                                @if ($resources->isNotEmpty())
                                <div class="row mt-1">
                                    <div class="col-2">
                                        <ul class="nav nav-pills flex-column" role="tablist"
                                            style="position: sticky;top: 80px;">
                                            <li class="nav-item mb-2">
                                                <a class="nav-link active" data-toggle="pill"
                                                    role="tab"
                                                    href="#{{ ($resource_supporting_units_subfolder->subfolder_name == NULL)?"Resources":str_replace(' ', '', $resource_supporting_units_subfolder->subfolder_name) }}"
                                                    style="padding: 0">
                                                    <div class="card">
                                                        <div class="caption">
                                                            <img class="img-fluid" alt="Responsive image"
                                                                src="{{ strlen($resource_supporting_units_subfolder->image) != 0? url('imagecache/original/thumbnails/'.$resource_supporting_units_subfolder->image):url('/image/WFP blue background.png') }}"
                                                                alt="Generic placeholder image">
                                                            <h2 class="text-center">
                                                                {{ ($resource_supporting_units_subfolder->subfolder_name == NULL)?$resource_type->resource_type:$resource_supporting_units_subfolder->subfolder_name }}
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="col-8 tab-content card border-right-0 border-bottom-0 border-top-0">
                                        <div class="tab-pane fade show active"
                                            id="{{ ($resource_supporting_units_subfolder->subfolder_name == NULL)?"Resources":str_replace(' ', '', $resource_supporting_units_subfolder->subfolder_name) }}"
                                            role="tabpanel">
                                            <div class="list-group">
                                                @foreach ($resources as $resource)
                                                <?php $date = new Jenssegers\Date\Date($resource->updated_at); ?>
                                                <a class="list-group-item list-group-item-action mb-1 text-secondary font-italic"
                                                    data-delay="300" data-trigger="hover" data-container="body"
                                                    data-toggle="popover" data-trigger="focus" data-placement="right"
                                                    data-html="true" title="Updated by"
                                                    data-content="{{ App\user::find($resource->edited_by)->firstname." ".App\user::find($resource->edited_by)->secondname }}<br>{{ $date->ago() }}"
                                                    @if($resource->external_link == "Yes") target="_blank"
                                                    href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.encrypt($resource->resource_location))}}"
                                                    @else
                                                    href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.$resource->resource_location)}}"
                                                    @endif>
                                                    <i @if($resource->external_link == "Yes") class="fa
                                                        fa-external-link" @else class="fa fa-file-text" @endif
                                                        aria-hidden="true"></i>&nbsp;{{ $resource->resource_name }}
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif
                                @endforeach
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="h5 mt-2">
                                    <span class="lead text-primary">{{ $resource_type->resource_type }}</span>
                                    <a href="{{URL::to('/addfolder/'.$resource_type->resource_type)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="create subfolder"
                                        class="text-muted"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/addresource/'.$resource_type->resource_type)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="add resource"
                                        class="text-muted"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/editresourcetab/'.$resource_type->id)}}" data-toggle="tooltip"
                                        data-placement="bottom" title="edit" class="text-warning"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="{{URL::to('/deleteresourcetab/'.$resource_type->id)}}"
                                        data-toggle="tooltip" data-placement="bottom" title="delete"
                                        class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="row no-gutters">

                                    @foreach ($resource_supporting_units_subfolders as
                                    $resource_supporting_units_subfolder)
                                    <?php 
                                    $resources = $supporting_unit_resources->where('subfolder_id',$resource_supporting_units_subfolder->id);
                                    ?>
                                    @if ($resources->isNotEmpty())
                                    <div class="col-3 p-1">
                                        <div class="card">
                                            <div class="caption">
                                                <a data-toggle="collapse" href="#collapse1" aria-expanded="true"
                                                    aria-controls="collapse1">
                                                    <img class="img-fluid" alt="Responsive image"
                                                        src="{{ strlen($resource_supporting_units_subfolder->image) != 0? url('/storage/thumbnails/'.$resource_supporting_units_subfolder->image):url('/image/WFP blue background.png') }}"
                                                        alt="Generic placeholder image">
                                                    <h2 class="text-center">
                                                        @if($resource_supporting_units_subfolder->subfolder_name ==
                                                        NULL)
                                                        {{ $resource_type->resource_type }}
                                                        @else
                                                        {{ $resource_supporting_units_subfolder->subfolder_name }}
                                                        @endif
                                                    </h2>
                                                </a>
                                            </div>
                                            <div class="collapse show" id="collapse1">
                                                <div class="card" @if($resources->count() >= 4)style="height: 320px;
                                                    overflow-y: scroll"@endif>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($resources as $resource)
                                                        <li class="list-group-item">
                                                            <a @if($resource->external_link == "Yes") target="_blank"
                                                                href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.encrypt($resource->resource_location))}}"
                                                                @else
                                                                href="{{URL::to('/resource/'.$resource_type->resource_type.'/'.$resource->external_link.'/'.$resource->resource_location)}}"
                                                                @endif>
                                                                <i @if($resource->external_link == "Yes") class="fa
                                                                    fa-external-link" @else class="fa fa-file-text"
                                                                    @endif
                                                                    aria-hidden="true"></i>&nbsp;{{ $resource->resource_name }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start of Edit Supporting Unit Modal -->
                @if(Session::has('edit_resource_tab') || Session::has('edit_resource_tab_error'))
                {{Form::open(array('url' => '/editresourcetab/'.Session::get('edit_resource_tab')->id,'multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                <div class="modal fade editResourceTabModal" id="editResourceTabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="editResourceTabModal">Edit Unit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <img class="img-fluid img-thumbnail" alt="Responsive image" src="{{ strlen(Session::get('edit_resource_tab')->image) != 0? url('/storage/thumbnails/'.Session::get('edit_resource_tab')->image):url('/image/external resources.png') }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto"><br>
                                    
                                    <label for="image"><strong>Change photo</strong></label>
                                    
                                    @if(old('image'))
                                    <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control-file">
                                    @elseif(Session::has('edit_resource_tab'))
                                    <input type="file" name='image' value="{{ Session::get('edit_resource_tab')->image }}" id="image" class="form-control-file">
                                    @endif
                                </div>
                                <div class="form-group @if($errors->first('resource_tab_name')) has-danger @elseif(old('resource_tab_name')) has-success @endif">
                                    <label class="font-weight-bold">Resource tab name</label>
                                    <input name="resource_tab_name" value="{{old('resource_tab_name')?old('resource_tab_name'):Session::get('edit_resource_tab')->resource_type}}" type="text" class="form-control @if($errors->first('resource_tab_name')) form-control-danger @elseif(old('resource_tab_name')) form-control-success @endif" placeholder="Enter name of the new resource tab">
                                    @if($errors->first('resource_tab_name'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('resource_tab_name') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have entered the name of the resource tab
                                    </small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Unit</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::token()}}
                {{Form::close()}}
                @endif<!-- end of Edit Supporting Unit Modal -->

                <!-- Start of Delete Supporting Unit Modal -->
                @if(Session::has('delete_resource_tab'))
                <div class="modal fade deleteResourceTabModal" id="deleteResourceTabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="exampleModalLabel">Remove Resource Tab</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body font-italic">
                                <strong class="text-info"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></strong> You're about to remove the <strong class="text-primary">{{ str_contains(Session::get('delete_resource_tab')->resource_type, 'Resource')?Session::get('delete_resource_tab')->resource_type:Session::get('delete_resource_tab')->resource_type.' Resource' }} Tab</strong> <br>
                                <strong class="text-danger"><i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i></strong> All <strong class="text-warning">Resources</strong> and <strong class="text-warning">Subfolders</strong> under <strong class="text-primary">{{ str_contains(Session::get('delete_resource_tab')->resource_type, 'Resource')?Session::get('delete_resource_tab')->resource_type:Session::get('delete_resource_tab')->resource_type.' Resource' }} Tab</strong> will also be removed
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                <a href="{{URL::to('/removeresourcetab/'.Session::get('delete_resource_tab')->id)}}" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif<!-- end of Delete Supporting Unit Modal -->

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

                <!-- Start of Edit Resource Folder Modal -->
                @if(Session::has('edit_resource_folder') || Session::has('edit_resource_folder_error'))
                {{Form::open(array('url' => '/changefolder/'.Session::get('edit_resource_folder')->id,'multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                <div class="modal fade editResourceFolderModal" id="editResourceFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="editResourceFolderModal">Edit subfolder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group @if($errors->first('subfolder_name')) has-danger @elseif(old('subfolder_name')) has-success @endif">
                                    <label class="font-weight-bold">Subfolder name</label>
                                    <input name="subfolder_name" value="{{old('subfolder_name')?old('subfolder_name'):Session::get('edit_resource_folder')->subfolder_name}}" type="text" class="form-control @if($errors->first('subfolder_name')) form-control-danger @elseif(old('subfolder_name')) form-control-success @endif" placeholder="Enter name of the new subfolder">
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
                                <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::token()}}
                {{Form::close()}}
                @endif<!-- end of Edit Resource Folder Modal -->

                <!-- Start of Delete Resource Folder Modal -->
                @if(Session::has('delete_resource_folder'))
                <div class="modal fade deleteResourceFolderModal" id="deleteResourceFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="exampleModalLabel">Remove a Subfolder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body font-italic">
                                <strong class="text-info"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></strong> You're about to remove the <strong class="text-primary">{{ Session::get('delete_resource_folder')->subfolder_name }}</strong> subfolder from <strong class="text-primary">{{Session::get('delete_resource_folder')->resource_type}}</strong><br>
                                <strong class="text-danger"><i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i></strong> All <strong class="text-warning">Resources</strong> under <strong class="text-primary">{{ Session::get('delete_resource_folder')->subfolder_name }}</strong> subfolder will also be removed
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                <a href="{{URL::to('/removefolder/'.Session::get('delete_resource_folder')->id)}}" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif<!-- end of Delete Resource Folder Modal -->

                <!-- Add new Resource Modal -->
                @if(Session::has('add_resource') || Session::has('add_resource_error'))
                {{Form::open(array('url' => '/addresource/'.Session::get('resourcetype'),'multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                <div class="modal fade addResourceModal" id="addResourceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="exampleModalLabel">
                                    Add New {{$resource_type->resource_type}} Resources
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
                                        @foreach (Session::get('resource_types') as $resource_type)
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
                                        @foreach ($resource_supporting_units_subfolders as $subfolder)
                                        <option value="{{ $subfolder->id }}" @if(old('subfolder_id') == $subfolder->id) selected @endif>{{ ($subfolder->subfolder_name == NULL)?Session::get('resourcetype')." Resources":$subfolder->subfolder_name }}</option>
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
                                        @foreach (Session::get('resource_types') as $resource_type)
                                        <option value="{{ $resource_type->resource_type }}" @if(Session::get('editresource')->resource_type == $resource_type->resource_type) selected @endif>{{ $resource_type->resource_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group @if($errors->first('subfolder_id')) has-danger @elseif(old('subfolder_id')) has-success @endif">
                                    <label class="font-weight-bold">Subfolder</label>
                                    <select id="subfolder_id" name="subfolder_id" class="form-control js-subfolderid-single">
                                        <option></option>
                                        <?php $subfolders = Session::get('resource_subfolders')->where('resource_type', Session::get('editresource')->resource_type) ?>
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
                </div>
                @endif<!-- end of Delete Resource Modal -->
                
                <hr>

                <!-- FOOTER -->
                @include('frames/footer')

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */