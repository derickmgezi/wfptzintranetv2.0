@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">
                @if(Auth::id() == 2)
                <div class="d-flex justify-content-start mt-1">
                    <a href="{{URL::to('/addresourcecategory/')}}" class="btn btn-secondary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> add Resource Category</a>
                </div>
                @endif

                @if($resource_categories->count() == 0)
                <div class="alert alert-success mt-2" role="alert">
                    <strong>No Categories have been added</strong>. Click on the add Resource Category button to add a Category.
                </div>
                @else
                    @foreach ($resource_categories as $resource_category)
                    <div class="d-flex mt-1">
                        <span class="lead text-primary">
                            <strong>{{ $resource_category->category }}</strong>
                        </span>&nbsp;
                        @if(Auth::id() == 2)
                        <a href="{{URL::to('/addresourcetab/'.$resource_category->id)}}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> add {{ $resource_category->category }}
                        </a>
                        @endif
                    </div>

                    <div class="row no-gutters">
                        <?php 
                        $resource_types = $resource_supporting_units->where('category_id', $resource_category->id);
                        ?>
                        @if($resource_types->count() == 0)
                        <div class="alert alert-success mt-2" role="alert">
                            No <strong>{{ $resource_category->category }}</strong> have been added.
                        </div>
                        @else
                            @foreach ($resource_types as $resource_type)
                            <div class="col-2 p-1">
                                <div class="card card-outline-primary">
                                    <div class="caption">
                                        @if($resource_category->category == 'Quick links')
                                        <?php $quick_link = $quick_links->where('resource_type',$resource_type->resource_type)->first(); ?>
                                        <a  @if($quick_link->external_link == "Yes") target="_blank"
                                            href="{{URL::to('/resource/'.$quick_link->id.'/'.$quick_link->external_link.'/'.encrypt($quick_link->resource_location))}}"
                                            @else
                                            href="{{URL::to('/resource/'.$quick_link->id.'/'.$quick_link->external_link.'/'.$quick_link->resource_location)}}"
                                            @endif>
                                            <img class="img-fluid" alt="Responsive image" src="{{ strlen($resource_type->image) != 0? url('imagecache/original/thumbnails/'.$resource_type->image):url('/image/external resources.png') }}" alt="Generic placeholder image">
                                            <h2 class="text-center">
                                                {{ $resource_type->resource_type }}
                                            </h2>
                                        </a>
                                        @else
                                        <a href="{{ URL::to('/resourcestabs/'.$resource_type->id) }}">
                                            <img class="img-fluid" alt="Responsive image" src="{{ strlen($resource_type->image) != 0? url('imagecache/original/thumbnails/'.$resource_type->image):url('/image/external resources.png') }}" alt="Generic placeholder image">
                                            <h2 class="text-center">
                                                {{ $resource_type->resource_type }}
                                            </h2>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @endforeach
                @endif

                <!-- Start of Add Resource Category Modal -->
                @if(Session::has('add_resource_category') || Session::has('add_resource_category_error'))
                {{Form::open(array('url' => '/addresourcecategory/','multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                <div class="modal fade addResourceCategoryModal" id="addResourceCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="addResourceCategoryModal">Add New Resource Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group @if($errors->first('image')) has-danger @elseif(old('image')) has-success @endif">
                                    <label class="font-weight-bold">Category Image</label>
                                    <input name="image" value="{{old('image')}}" type="file" class="form-control @if($errors->first('image')) form-control-danger @elseif(old('image')) form-control-success @endif" placeholder="Enter File name">
                                    @if($errors->first('image'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('image') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have selected an Image for the Category
                                    </small>
                                </div>
                                <div class="form-group @if($errors->first('resource_category_name')) has-danger @elseif(old('resource_category_name')) has-success @endif">
                                    <label class="font-weight-bold">Category name</label>
                                    <input name="resource_category_name" value="{{old('resource_category_name')}}" type="text" class="form-control @if($errors->first('resource_category_name')) form-control-danger @elseif(old('resource_category_name')) form-control-success @endif" placeholder="Enter name of the new resource category">
                                    @if($errors->first('resource_category_name'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('resource_category_name') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have entered the name of the new resource category
                                    </small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Category</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::token()}}
                {{Form::close()}}
                @endif<!-- end of Add Resource Category Modal -->

                <!-- Start of Add Resouce Type Modal -->
                @if(Session::has('add_resource_tab') || Session::has('add_resource_tab_error'))
                {{Form::open(array('url' => '/addresourcetab/','multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                <div class="modal fade addResourceTabModal" id="addResourceTabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="addResourceTabModal">Add New {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group @if($errors->first('resource_category')) has-danger @elseif(old('resource_category')) has-success @endif">
                                    <label class="font-weight-bold">Resource Category</label>
                                    <input name="resource_category" value="{{old('resource_category')?old('resource_category'):Session::get('category')->category}}" type="text" class="form-control @if($errors->first('resource_category')) form-control-danger @elseif(old('resource_category')) form-control-success @endif" placeholder="Enter name of the resource category" readonly>
                                    @if($errors->first('resource_category'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('resource_category') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have entered the name of the resource category
                                    </small>
                                </div>
                                <div class="form-group @if($errors->first('resource_tab_name')) has-danger @elseif(old('resource_tab_name')) has-success @endif">
                                    <label class="font-weight-bold">Name of the {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}</label>
                                    <input name="resource_tab_name" value="{{old('resource_tab_name')}}" type="text" class="form-control @if($errors->first('resource_tab_name')) form-control-danger @elseif(old('resource_tab_name')) form-control-success @endif" placeholder="Enter name of the new resource type">
                                    @if($errors->first('resource_tab_name'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('resource_tab_name') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have entered the name of the {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}
                                    </small>
                                </div>
                                <div class="form-group @if($errors->first('image')) has-danger @elseif(old('image')) has-success @endif">
                                    <label class="font-weight-bold">Image</label>
                                    <input name="image" value="{{old('image')}}" type="file" class="form-control @if($errors->first('image')) form-control-danger @elseif(old('image')) form-control-success @endif" placeholder="Enter File name">
                                    @if($errors->first('image'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('image') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have selected an Image for the {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}
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
                @endif<!-- end of Add Resouce Type Modal -->

                <!-- Start of Add Quick Link Resouce Type Modal -->
                @if(Session::has('add_quick_link') || Session::has('add_quick_link_error'))
                {{Form::open(array('url' => '/addquicklink/','multiple' => true,'role' => 'form', 'enctype' => 'multipart/form-data'))}}
                <div class="modal fade addResourceTabQuickLinkModal" id="addResourceTabQuickLinkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="addResourceTabQuickLinkModal">Add New {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group @if($errors->first('resource_category')) has-danger @elseif(old('resource_category')) has-success @endif">
                                    <label class="font-weight-bold">Resource Category</label>
                                    <input name="resource_category" value="{{old('resource_category')?old('resource_category'):Session::get('category')->category}}" type="text" class="form-control @if($errors->first('resource_category')) form-control-danger @elseif(old('resource_category')) form-control-success @endif" placeholder="Enter name of the resource category" readonly>
                                    @if($errors->first('resource_category'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('resource_category') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have entered the name of the resource category
                                    </small>
                                </div>
                                <div class="form-group @if($errors->first('resource_tab_name')) has-danger @elseif(old('resource_tab_name')) has-success @endif">
                                    <label class="font-weight-bold">Name of the {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}</label>
                                    <input name="resource_tab_name" value="{{old('resource_tab_name')}}" type="text" class="form-control @if($errors->first('resource_tab_name')) form-control-danger @elseif(old('resource_tab_name')) form-control-success @endif" placeholder="Enter name of the new resource type">
                                    @if($errors->first('resource_tab_name'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('resource_tab_name') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have entered the name of the {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}
                                    </small>
                                </div>
                                <div class="form-group @if($errors->first('image')) has-danger @elseif(old('image')) has-success @endif">
                                    <label class="font-weight-bold">Image</label>
                                    <input name="image" value="{{old('image')}}" type="file" class="form-control @if($errors->first('image')) form-control-danger @elseif(old('image')) form-control-success @endif" placeholder="Enter File name">
                                    @if($errors->first('image'))
                                    <div class="form-control-feedback">
                                        <small class="font-weight-bold">{{ $errors->first('image') }}</small>
                                    </div>
                                    @endif
                                    <small class="form-text text-muted">
                                        Make sure you have selected an Image for the {{ old('resource_category')?old('resource_category'):Session::get('category')->category }}
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> close</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Tab</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::token()}}
                {{Form::close()}}
                @endif<!-- end of Add Quick Link Resouce Type Modal -->
                
                <hr>

                <!-- FOOTER -->
                @include('frames/footer')

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */