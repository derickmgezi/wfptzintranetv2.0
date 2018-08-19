@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

            <!--            @include('components/pi/picarousel')-->

            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container-fluid marketing"> 

                
                <div class="row">
                    <div class="col-12">
                        <h1>
                            <div class="row  hidden-sm-down">
                                <div class="col-lg-9 col-md-8">
                                    <!-- <i class="fa fa-commenting-o" aria-hidden="true"></i> --> Stori Yangu

                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-secondary">
                                            Order By
                                        </button>
                                        
                                        <div class="btn-group" role="group">
                                                @if(Request::is('storiyangu'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-clock-o faa-shake animated" aria-hidden="true"></i> Latest <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('storyviews'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-eye faa-shake animated" aria-hidden="true"></i> Views <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('storylikes'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-thumbs-up faa-shake animated" aria-hidden="true"></i> Likes <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('storycomments'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-comments faa-shake animated" aria-hidden="true"></i> Comments <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('mystory'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-user-circle-o faa-shake animated" aria-hidden="true"></i> My Stories <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @endif
                                            
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @if(!Request::is('storiyangu'))
                                                <a class="dropdown-item" href="{{URL::to('/storiyangu')}}"><i class="fa fa-clock-o" aria-hidden="true"></i> Latest</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('storyviews'))
                                                <a class="dropdown-item" href="{{URL::to('/storyviews')}}"><i class="fa fa-eye" aria-hidden="true"></i> Views</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('storylikes'))
                                                <a class="dropdown-item" href="{{URL::to('/storylikes')}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Likes</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('storycomments'))
                                                <a class="dropdown-item" href="{{URL::to('/storycomments')}}"><i class="fa fa-comments" aria-hidden="true"></i> Comments</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('mystory'))
                                                <a class="dropdown-item" href="{{URL::to('/mystory')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Stories</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 text-right">
<!--                                    <a class="btn btn-warning" href="{{ URL::to('/resizethumbnails') }}">
                                       <i class="fa fa-expand" aria-hidden="true"></i>
                                    </a>-->
                                    <a class="btn btn-success" @if(Session::has('edit_story') || Session::has('edit_story_error')) href="{{URL::to('/addstory/')}}" @else data-toggle="modal" data-target="#add-story-modal" href="#"  @endif  role="button">
                                       <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add Your Story
                                    </a>
                                </div>
                            </div>
                            <div class="row hidden-md-up">
                                <div class="col-sm-9">
                                    <!--<i class="fa fa-commenting-o" aria-hidden="true"></i>--> Stori
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-secondary">
                                            Order By
                                        </button>
                                        
                                        <div class="btn-group btn-group-sm" role="group">
                                                @if(Request::is('storiyangu'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-clock-o faa-shake animated" aria-hidden="true"></i> Latest <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('storyviews'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-eye faa-shake animated" aria-hidden="true"></i> Views <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('storylikes'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-thumbs-up faa-shake animated" aria-hidden="true"></i> Likes <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('storycomments'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-comments faa-shake animated" aria-hidden="true"></i> Comments <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @elseif(Request::is('mystory'))
                                                <button id="btnGroupDrop1" type="button" class="btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-user-circle-o faa-shake animated" aria-hidden="true"></i> My Stories <i class="fa fa-sort" aria-hidden="true"></i>
                                                </button>
                                                @endif
                                            
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @if(!Request::is('storiyangu'))
                                                <a class="dropdown-item" href="{{URL::to('/storiyangu')}}"><i class="fa fa-clock-o" aria-hidden="true"></i> Latest</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('storyviews'))
                                                <a class="dropdown-item" href="{{URL::to('/storyviews')}}"><i class="fa fa-eye" aria-hidden="true"></i> Views</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('storylikes'))
                                                <a class="dropdown-item" href="{{URL::to('/storylikes')}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Likes</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('storycomments'))
                                                <a class="dropdown-item" href="{{URL::to('/storycomments')}}"><i class="fa fa-comments" aria-hidden="true"></i> Comments</a>
                                                <div class="dropdown-divider"></div>
                                                @endif
                                                @if(!Request::is('mystory'))
                                                <a class="dropdown-item" href="{{URL::to('/mystory')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Stories</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 text-right">
                                    <a class="btn btn-sm btn-success" @if(Session::has('edit_story') || Session::has('edit_story_error')) href="{{URL::to('/addstory/')}}" @else data-toggle="modal" data-target="#add-story-modal" href="#"  @endif  role="button">
                                       <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add Story
                                    </a>
                                </div>
                            </div>
                        </h1>
                        <!-- Add/Edit Story Modal -->
                        @if(Session::has('edit_story'))
                        {{Form::open(array('url' => '/edit_story/'.Session::get('edit_story')->id,'enctype' => "multipart/form-data",'role' => 'form'))}}
                        @elseif(Session::has('edit_story_error'))
                        {{Form::open(array('url' => '/edit_story/'.Session::get('edit_story_error')->id,'enctype' => "multipart/form-data",'role' => 'form'))}}
                        @else
                        {{Form::open(array('url' => '/store_story','enctype' => "multipart/form-data",'role' => 'form'))}}
                        @endif
                        <div class="modal fade add-story-modal" id="add-story-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            @if(Session::has('edit_story') || Session::has('edit_story_error'))
                                            Edit Your Story
                                            @else
                                            Add Your Story
                                            @endif
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="recipient-name" class="form-control-label"><strong>Image</strong></label><br>
                                            @if(Session::has('edit_story'))
                                            <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/large/'.Session::get('edit_story')->image) }}" alt="Card image cap">
                                            @elseif(Session::has('edit_story_error'))
                                            <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/large/'.Session::get('edit_story_error')->image) }}" alt="Card image cap">
                                            @endif
                                            <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="form-control-label"><strong>Image Caption</strong></label>
                                            <textarea class="form-control simple-tinymce" name='caption' id="exampleTextarea" rows="5">
                                                @if(Session::has('edit_story'))
                                                {!! Session::get('edit_story')->caption !!}
                                                @elseif(Session::has('edit_story_error'))
                                                {!! Session::get('edit_story_error')->caption !!}
                                                @else
                                                {{ (old('caption')) }}
                                                @endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            <i class="fa fa-times" aria-hidden="true"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Upload Story
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{Form::token()}}
                        {{Form::close()}}<!-- end Add Story Modal -->
                    </div>
                </div>

                <div class="row align-items-center">
                    @if($stories->count() == 0)
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Welcome!</h4>
                            <p>No stories have been posted yet</p>
                            <p class="mb-0"><strong>Click on Add Your Story button to post your story</strong></p>
                        </div>
                    </div>
                    @else
                    @foreach($stories as $story)
                    <div class="col-md-6 col-xl-4 mb-4">
                        <div class="card card-outline-primary card-primary  h-100 d-inline-block">
                            <a href="{{URL::to('/storiyangu/'.$story->id)}}">
                                <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/original/thumbnails/'.$story->image) }}" alt="Card image cap">
                            </a>
                            <div class="card-block">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="{{ strlen(App\User::find($story->posted_by)->image) != 0? url('/storage/thumbnails/'.App\User::find($story->posted_by)->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="45" height="45" data-src="holder.js/25x25/auto"> 
                                    <div class="media-body">
                                        <em>{{ App\User::find($story->posted_by)->firstname.' '.App\User::find($story->posted_by)->secondname }}</em>
                                        <p>
                                            <a href="{{URL::to('/storiyangu/'.$story->id)}}" style="text-decoration: none;">
                                                {{ substr(strip_tags($story->caption),0,65) }}{{ strlen(strip_tags($story->caption)) > 65 ? "...":"" }}
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group btn-group-sm">
                                        <?php
                                        $storyviews = $views->where('story_id', $story->id)->unique('viewed_by');
                                        $storylikes = $likes->where('story_id', $story->id);
                                        $storycomments = $comments->where('story_id', $story->id);
                                        $uniquestorycomments = $storycomments->unique('comment_by');
                                        ?>
                                        @if(Auth::user()->department == 'IT' || Auth::user()->department == 'Communications')
                                        <button type="button" class="btn btn-success" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Viewed By" data-content="@if($storyviews->count() == 0) No Views Yet @else @foreach($storyviews as $storyview) {{ App\User::find($storyview->viewed_by)->firstname.' '.App\User::find($storyview->viewed_by)->secondname }} <br>@endforeach @endif">
                                            {{ $storyviews->count() }}
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                        @endif
                                        <button type="button" class="btn btn-primary" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Liked By" data-content="@if($storylikes->count() == 0) No Likes Yet @else @foreach($storylikes as $storylike) {{ App\User::find($storylike->liked_by)->firstname.' '.App\User::find($storylike->liked_by)->secondname }} <br>@endforeach @endif">
                                            {{ $storylikes->count() }}
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        </button>

                                        <button type="button" class="btn btn-secondary"  data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Comments From" data-content="@if($uniquestorycomments->count() == 0) No Likes Yet @else @foreach($uniquestorycomments as $storycomment) {{ App\User::find($storycomment->comment_by)->firstname.' '.App\User::find($storycomment->comment_by)->secondname }} <br>@endforeach @endif">
                                            {{ $storycomments->count() }}
                                            <i class="fa fa-comments" aria-hidden="true"></i>
                                        </button>

                                        @if($story->posted_by == Auth::id())
                                        <a role="button" class="btn btn-warning" href="{{URL::to('/editstory/'.$story->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Story">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a role="button" class="btn btn-danger" href="{{URL::to('/deletestory/'.$story->id)}}" data-toggle="tooltip" data-placement="top" title="Delete Story">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </div>

                                    <?php $date = new Jenssegers\Date\Date($story->created_at); ?>
                                    <small class="text-muted">{{ $date->ago() }}</small>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    @if($stories->hasPages())
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            {{ $stories->links('vendor.pagination.bootstrap-4') }}

                            {{ $stories->links('vendor.pagination.bootstrap-4-small') }}
                        </nav>
                    </div>
                    @endif
                    
                </div>

                <!-- /END THE FEATURETTES -->



                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')