<?php
$updates = App\News::where('status', 1)->where('type',$department)->orderBy('created_at', 'desc')->paginate(5);
$update_count = $updates->count();
?>
@if($update_count != 0)
<div class="row">
    <div class="col-md-12" style="background-color:">
        
        <a class="btn btn-success btn-lg float-right hidden-sm-down {{ Auth::user()->department == $department? '':'invisible'}}" href="{{URL::to('/create_update')}}" role="button">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Add Update
        </a>
        <a class="btn btn-success float-right hidden-md-up {{ Auth::user()->department == $department? '':'invisible'}}" href="{{URL::to('/create_update')}}" role="button">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Add Update
        </a>

        <button type="button" class="btn btn-primary btn-lg float-left hidden-sm-down invisible" onclick="location.href = '{{URL::to('/previous')}}'"><i class="fa fa-calendar" aria-hidden="true"></i> News Calender</button>
        <button type="button" class="btn btn-primary float-left hidden-md-up invisible" onclick="location.href = '{{URL::to('/previous')}}'"><i class="fa fa-calendar" aria-hidden="true"></i> News</button>
        
        <h1 class="text-center featurette-heading">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i> {{ (($department == 'Logistics')? 'Supply Chain':$department) }} Updates
        </h1>
    </div>
</div>

    <!-- START THE FEATURETTES -->
    @foreach ($updates as $update)
    <div class="row featurette align-items-center" style="background-color:">
        <div class="col-md-6{{ ($update_count%2 == 1)?'':' push-md-6' }}">
            <h3 class="featurette-heading hidden-md-down text-primary">{{ substr(strip_tags($update->header),0,65) }}{{ strlen(strip_tags($update->header)) > 65 ? "...":"" }}</h3>
            <h2 class="hidden-lg-up text-justify"><small class="text-primary">{{ substr(strip_tags($update->header),0,65) }}{{ strlen(strip_tags($update->header)) > 65 ? "...":"" }}</small></h2>

            <img class="featurette-image img-fluid mx-auto hidden-md-up" src="{{url('/storage/thumbnails/'.$update->image)}}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
            <hr class="hidden-md-up">

            <blockquote class="blockquote{{ ($update_count%2 == 1)?' blockquote-reverse':'' }}">
                <p class="lead text-left"> 
                    {{ substr(strip_tags($update->description),0,250) }}{{ strlen(strip_tags($update->description)) > 250 ? "...":"" }}
                    <a class="btn btn-success btn-sm" href="{{URL::to('/read_update/'.$update->id)}}" role="button">
                        <i class="fa fa-book" aria-hidden="true"></i> Read More
                    </a>
                    
                    @if(Auth::user()->department == $department)
                    <a class="btn btn-warning btn-sm" href="{{URL::to('/edit_update/'.$update->id)}}" role="button">
                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="{{URL::to('/remove_update/'.$update->id)}}" role="button">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Remove
                    </a>
                    @endif  
                    
                    <br>
                    
                    <?php
                    $total_views = App\View::where('view_id',$update->id)->get();
                    $unique_views = App\View::select('viewed_by')->where('view_id',$update->id)->groupBy('viewed_by')->get();
                    $total_unique_view_count = $unique_views->count();
                    $total_view_count = $total_views->count();

                    $total_likes = App\Like::where('view_id',$update->id)->get();
                    $unique_likes = App\Like::select('liked_by')->where('view_id',$update->id)->groupBy('liked_by')->get();
                    $total_unique_like_count = $unique_likes->count();
                    $total_like_count = $total_views->count();
                    ?>
                    <span class="badge badge-pill badge-success" data-delay="300000" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Viewed By" data-content="@if($total_unique_view_count == 0)No views @else @foreach($unique_views as $view){{ App\User::find($view->viewed_by)->firstname.' '.App\User::find($view->viewed_by)->secondname }}<br> @endforeach @endif">
                        {{ $total_unique_view_count }} <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                    <span class="badge badge-pill badge-primary" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Liked By" data-content="@if($total_unique_like_count == 0)No likes @else @foreach($unique_likes as $like){{ App\User::find($like->liked_by)->firstname.' '.App\User::find($like->liked_by)->secondname }}<br> @endforeach @endif">
                        {{ $total_unique_like_count }} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    </span>
<!--                    <span class="badge badge-pill badge-default">
                        {{ rand(0,20) }} <i class="fa fa-commenting-o" aria-hidden="true"></i>
                    </span>-->
                    
                </p>

                <footer class="blockquote-footer">Source <cite title="Source Title">{{ $update->source }}</cite></footer>
            </blockquote>
        </div>
        <div class="col-md-6{{ ($update_count%2 == 1)?'':' pull-md-6' }} hidden-sm-down">
            <img class="featurette-image img-fluid mx-auto" src="{{url('/storage/thumbnails/'.$update->image)}}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
    </div>

    <hr>
    <?php ++$update_count; ?>
    @endforeach

    <div class="col-12">
        <nav aria-label="Page navigation example">
            {{ $updates->links('vendor.pagination.bootstrap-4') }}

            {{ $updates->links('vendor.pagination.bootstrap-4-small') }}
        </nav>
    </div>
@else
    <div class="row">
        <div class="col-md-12" style="background-color:">
            @if(Auth::user()->department == $department)
            <a class="btn btn-success btn-lg float-right hidden-sm-down" href="{{URL::to('/create_update')}}" role="button">
                <i class="fa fa-plus-square" aria-hidden="true"></i> Add Update
            </a>
            <a class="btn btn-success float-right hidden-md-up" href="{{URL::to('/create_update')}}" role="button">
                <i class="fa fa-plus-square" aria-hidden="true"></i> Add Update
            </a>
   
            <button type="button" class="btn btn-primary btn-lg float-left hidden-sm-down invisible" onclick="location.href = '{{URL::to('/previous')}}'"><i class="fa fa-calendar" aria-hidden="true"></i> Add Update</button>
            <button type="button" class="btn btn-primary float-left hidden-md-up invisible" onclick="location.href = '{{URL::to('/previous')}}'"><i class="fa fa-calendar" aria-hidden="true"></i> Add Update</button>
            @endif
            
            <h1 class="text-center featurette-heading">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i> {{ (($department == 'Logistics')? 'Supply Chain':$department) }} Updates
            </h1>
        </div>
        
        <div class="col-md-12">
            <div class="alert alert-info text-center" role="alert">
                <strong>No Updates from {{ (($department == 'Logistics')? 'Supply Chain':$department) }} have been added.</strong> {{ Auth::user()->department == $department? 'To add updates, click the Add Update Button.':'' }}
            </div>
        </div>

    </div>
@endif

@if(Session::has('update_id'))
<!-- Edit News Modal -->
{{Form::open(array('url' => '/edit_update/'.Session::get('update_id'),'enctype' => "multipart/form-data",'role' => 'form'))}}
<div class="modal fade add-update-modal" id="add-update-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit News Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="headerText"><strong>Header</strong></label>
                            @if(old('header'))
                            <input type="text" name='header' value="{{ (old('header')) }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter News Post Header">
                            @elseif(Session::has('update_id'))
                            <input type="text" name='header' value="{{ App\News::find(Session::get('update_id'))->header }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter News Post Header">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image"><strong>Image</strong></label><br>
                            <img class="featurette-image img-fluid mx-auto img-thumbnail" src="{{url('/storage/'.App\News::find(Session::get('update_id'))->image)}}">
                            <hr>
                            @if(old('image'))
                            <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
                            @elseif(Session::has('update_id'))
                            <input type="file" name='image' value="{{ App\News::find(Session::get('update_id'))->image }}" id="image" class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="source"><strong>Source</strong></label>
                            @if(old('source'))
                            <input type="text" name='source' value="{{ (old('source')) }}" class="form-control" id="source" aria-describedby="text" placeholder="Enter Source">
                            @elseif(Session::has('update_id'))
                            <input type="text" name='source' value="{{ App\News::find(Session::get('update_id'))->source }}" class="form-control" id="source" aria-describedby="text" placeholder="Enter Source">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="descriptionTextarea"><strong>Description</strong></label>
                            @if(old('source'))
                            <textarea class="form-control" name='description' id="descriptionTextarea" rows="5">{{ (old('description')) }}</textarea>
                            @elseif(Session::has('update_id'))
                            <textarea class="form-control" name='description' id="descriptionTextarea" rows="5">{{ App\News::find(Session::get('update_id'))->description }}</textarea>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="storyTextarea"><strong>Story</strong></label>
                            @if(old('story'))
                            <textarea class="form-control" name='story' id="storyTextarea" rows="10">{{ (old('story')) }}</textarea>
                            @elseif(Session::has('update_id'))
                            <textarea class="form-control" name='story' id="storyTextarea" rows="10">{{ App\News::find(Session::get('update_id'))->story }}</textarea>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        @if(Session::has('new_update_error') || Session::has('edit_update_error'))
                        <div class="panel-footer">
                            <div class="alert alert-danger">{{$errors->first()}}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-inverse text-white">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning"><i class="fa fa-edit fa-lg" aria-hidden="true"></i> Edit News Post</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg" aria-hidden="true"></i> Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{Form::token()}}
{{Form::close()}}<!-- end Edit News Modal -->
@elseif(Session::has('create_update') || Session::has('new_update_error'))
<!-- Add News Modal -->
{{Form::open(array('url' => '/store_update/'.$department,'enctype' => "multipart/form-data",'role' => 'form'))}}
<div class="modal fade add-update-modal" id="add-update-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add News Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="headerText"><strong>Header</strong></label>
                            <input type="text" name='header' value="{{ (old('header')) }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter News Post Header">
                        </div>
                        <div class="form-group">
                            <label for="image"><strong>Image</strong></label>
                            <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="source"><strong>Source</strong></label>
                            <input type="text" name='source' value="{{ (old('source')) }}" class="form-control" id="source" aria-describedby="text" placeholder="Enter Source">
                        </div>
                        <div class="form-group">
                            <label for="headerText"><strong>Description</strong></label>
                            <textarea class="form-control" name='description' id="exampleTextarea" rows="5">{{ (old('description')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="headerText"><strong>Story</strong></label>
                            <textarea class="form-control" name='story' id="exampleTextarea" rows="10">{{ (old('story')) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        @if(Session::has('new_update_error'))
                        <div class="panel-footer">
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-inverse text-white">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-lg" aria-hidden="true"></i> Create News Post</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg" aria-hidden="true"></i> Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{Form::token()}}
{{Form::close()}}<!-- end Add News Modal -->
@endif

@if(Session::has('read_update'))
<!-- start of News Pop Up Modal -->
<div class="modal fade read-update-modal" id='read-update-modal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">{{ App\News::find(Session::get('read_update'))->header }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <img class="featurette-image img-fluid mx-auto d-flex justify-content-center" src="{{url('/storage/'.App\News::find(Session::get('read_update'))->image)}}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                        <hr>
                    </div>
                    <div class="col-12">
                        <blockquote class="blockquote">
                            <p class="text-justify lead">
                                {!! App\News::find(Session::get('read_update'))->description !!}
                            </p>
                            <footer class="blockquote-footer">Source <cite title="Source Title" class=" text-primary">{{ App\News::find(Session::get('read_update'))->source }}</cite></footer>
                        </blockquote>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                {!! App\News::find(Session::get('read_update'))->story !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                        <blockquote class="blockquote blockquote-reverse">
                            <p class="mb-0">Uploaded By <em class="text-primary">{{ App\User::find(App\News::find(Session::get('read_update'))->created_by)->firstname.' '.App\User::find(App\News::find(Session::get('read_update'))->created_by)->secondname }}</em></p>
                            <footer class="blockquote-footer text-success"><cite title="Source Title">{{ App\News::find(Session::get('read_update'))->created_at }}</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-inverse text-white">
                <a class="btn btn-primary" href="{{URL::to('/like_update/'.App\News::find(Session::get('read_update'))->id)}}" role="button">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> like
                </a>
                <a class="btn btn-secondary" href="{{URL::to('/like_update/'.$update->id)}}" role="button">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> comment
                </a>
                @if(Auth::user()->department == $department)
                <a class="btn btn-warning" href="{{URL::to('/edit_update/'.Session::get('read_update'))}}" role="button">
                    <i class="fa fa-edit fa-lg" aria-hidden="true"></i> Edit News Post
                </a>
                @endif
                <a class="btn btn-danger" data-dismiss="modal" role="button">
                    <i class="fa fa-close fa-lg" aria-hidden="true"></i> Close
                </a>
            </div>
        </div>
    </div>
</div><!-- /.end News Modal -->
@endif