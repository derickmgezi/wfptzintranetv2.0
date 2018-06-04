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
                    <div class="col-md-12">
                        <h1>
                            <div class="row  hidden-sm-down">
                                <div class="col-lg-9 col-md-8">
                                    <!-- <i class="fa fa-newspaper-o" aria-hidden="true"></i> --> News
                                </div>

                                <div class="col-lg-3 col-md-4 text-right">
                                    @if($editors->contains('editor', Auth::id()))
                                    <a class="btn btn-success" href="{{URL::to('/add_update')}}" role="button">
                                        <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add News Post
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </h1>

                        <!-- Update Modal -->
                        @if(Session::has('update_id'))
                        {{Form::open(array('url' => '/edit_update/'.Session::get('update_id'),'enctype' => "multipart/form-data",'role' => 'form'))}}
                        @elseif(Session::has('add_update') || Session::has('new_update_error'))
                        {{Form::open(array('url' => '/store_update/'.Auth::user()->department.'/'.Auth::user()->dutystation,'enctype' => "multipart/form-data",'role' => 'form'))}}
                        @endif

                        @if(Session::has('update_id') || Session::has('add_update') || Session::has('new_update_error'))
                        <div class="modal fade add-update-modal" id="add-update-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ Session::has('update_id')?"Edit News Post":"Add News Post" }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="headerText"><strong>Header</strong></label>
                                            <input type="text" name='header' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->header:(old('header')) }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter News Post Header">
                                        </div>
                                        <div class="form-group">
                                            <label for="image"><strong>Image</strong></label>
                                            @if(Session::has('update_id'))
                                            <br>
                                            <img class="featurette-image img-fluid mx-auto img-thumbnail" src="{{url('/storage/'.App\News::find(Session::get('update_id'))->image)}}">
                                            <hr>
                                            @endif
                                            <input type="file" name='image' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->image:(old('image')) }}" id="image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="source"><strong>Source</strong></label>
                                            <input type="text" name='source' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->source:(old('source')) }}" class="form-control" id="source" aria-describedby="text" placeholder="Enter Source">
                                        </div>
                                        <div class="form-group">
                                            <label for="headerText"><strong>Description</strong></label>
                                            <textarea class="complete-tinymce form-control" name='description' id="exampleTextarea" rows="5">{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->description:(old('description')) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="headerText"><strong>Story</strong></label>
                                            <textarea class="complete-tinymce form-control" name='story' id="exampleTextarea" rows="10">{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->story:(old('story')) }}</textarea>
                                        </div>
                                        @if(Session::has('new_update_error') || Session::has('edit_update_error'))
                                        <div class="panel-footer">
                                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer bg-inverse text-white">
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-edit fa-lg" aria-hidden="true"></i> {{ Session::has('update_id')?"Edit News Post":"Create News Post" }}</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg" aria-hidden="true"></i> Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{Form::token()}}
                        {{Form::close()}}
                        @endif<!-- end Update Modal -->

                        <div class="row align-items-center">
                            @if($recent_posts->count() != 0)
                                @foreach($recent_posts as $recent_post)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-outline-primary card-primary mb-4">
                                        <a href="{{URL::to('/read_update/'.$recent_post->id)}}">
                                            <img class="card-img-top img-fluid" src="{{ url('imagecache/original/thumbnails/'.$recent_post->image) }}" alt="Card image cap">
                                        </a>
                                        <div class="card-block">
                                            <p>
                                                <a href="{{URL::to('/read_update/'.$recent_post->id)}}" class="card-text text-primary" style="text-decoration: none">
                                                    <strong>{{ substr(strip_tags($recent_post->header),0,65) }}{{ strlen(strip_tags($recent_post->header)) > 65 ? "...":"" }}</strong>
                                                </a>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group btn-group-sm">
                                                    <?php
                                                    $views = $unique_views->where('view_id', $recent_post->id)->unique('viewed_by');
                                                    ?>
                                                    @if(Auth::user()->department == 'IT' || Auth::user()->department == 'Communications')
                                                    <a href="#" role="button" class="btn btn-success" data-delay="300" data-trigger="hover" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Viewed By" data-content="@if($views->count() == 0) No Views Yet @else @foreach($views as $view) {{ App\User::find($view->viewed_by)->firstname.' '.App\User::find($view->viewed_by)->secondname }} <br>@endforeach @endif">
                                                        {{ $views->count() }} <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
                                                    <?php
                                                    $likes = $unique_likes->where('view_id', $recent_post->id);
                                                    ?>
                                                    <a href="#" role="button" class="btn btn-primary" data-delay="300" data-trigger="{{ Auth::user()->username == 'derick.ruganuza'? 'hover':'' }}" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Liked By" data-content="@if($likes->count() == 0) No Likes Yet @else @foreach($likes as $like) {{ App\User::find($like->liked_by)->firstname.' '.App\User::find($like->liked_by)->secondname }} <br>@endforeach @endif">
                                                        {{ $likes->count() }} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                    </a>
                                                    @if($editors->contains('editor', Auth::id()) && $recent_post->type == Auth::user()->department)
                                                    <a role="button" class="btn btn-warning" href="{{URL::to('/edit_update/'.$recent_post->id)}}" data-toggle="tooltip" data-placement="top" title="Edit News Post">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    <a role="button" class="btn btn-danger" href="{{URL::to('/delete_update/'.$recent_post->id)}}" data-toggle="tooltip" data-placement="top" title="Delete News Post">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                                <?php $date = new Jenssegers\Date\Date($recent_post->created_at); ?>
                                                <small class="text-muted">{{ $date->ago() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Welcome!</h4>
                                    <p>No News Updates have been posted yet</p>
                                    <p class="mb-0"><strong>Click on the Add Your Story button to post your story</strong></p>
                                </div>
                            </div>
                            @endif
                            
                            @if($recent_posts->hasPages())
                            <div class="col-12">
                                <nav aria-label="Page navigation example">
                                    {{ $recent_posts->links('vendor.pagination.bootstrap-4') }}

                                    {{ $recent_posts->links('vendor.pagination.bootstrap-4-small') }}
                                </nav>
                            </div>
                            @endif
                        </div>

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
                                                <img class="featurette-image img-fluid mx-auto d-flex justify-content-center" src="{{url('/imagecache/original/'.App\News::find(Session::get('read_update'))->image)}}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                                                <hr>
                                            </div>
                                            <div class="col-12">
                                                <div class="media">
                                                    <?php $date = new Jenssegers\Date\Date(App\News::find(Session::get('read_update'))->created_at); ?>
                                                    <img class="d-flex mr-3 rounded-circle" src="{{ strlen(App\User::find(App\News::find(Session::get('read_update'))->created_by)->image) != 0? url('storage/thumbnails/'.App\User::find(App\News::find(Session::get('read_update'))->created_by)->image):url('/image/default_profile_picture.jpg') }}" width="45" height="45" alt="">
                                                    <div class="media-body">
                                                        <em>{{ App\User::find(App\News::find(Session::get('read_update'))->created_by)->firstname.' '.App\User::find(App\News::find(Session::get('read_update'))->created_by)->secondname }}</em>
                                                        <p class="font-weight-bold">
                                                            {!! App\News::find(Session::get('read_update'))->description !!}

                                                        <footer class="blockquote-footer">
                                                            Source <cite title="Source Title" class=" text-primary">{{ App\News::find(Session::get('read_update'))->source }}</cite>
                                                        </footer>
                                                        </p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="btn-group btn-group-sm">
                                                                <?php
                                                                $views = $unique_views->where('view_id', Session::get('read_update'))->unique('viewed_by');
                                                                ?>
                                                                <a href="#" role="button" class="btn btn-success" data-delay="300" data-trigger="{{ Auth::user()->username == 'derick.ruganuza'? 'hover':'' }}" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Viewed By" data-content="@if($views->count() == 0) No Views @else @foreach($views as $view) {{ App\User::find($view->viewed_by)->firstname.' '.App\User::find($view->viewed_by)->secondname }} <br>@endforeach @endif">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i> {{ ($views->count() == 1)?$views->count().' Viewer':$views->count().' Viewers' }}
                                                                </a>
                                                                <?php
                                                                $likes = $unique_likes->where('view_id', Session::get('read_update'));
                                                                ?>
                                                                <a href="#" role="button" class="btn btn-primary" data-delay="300" data-trigger="{{ Auth::user()->username == 'derick.ruganuza'? 'hover':'' }}" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Liked By" data-content="@if($likes->count() == 0) No Views @else @foreach($likes as $like) {{ App\User::find($like->liked_by)->firstname.' '.App\User::find($like->liked_by)->secondname }} <br>@endforeach @endif">
                                                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{ ($likes->count() == 1)?$likes->count().' Like':$likes->count().' Likes' }}
                                                                </a>
                                                                @if($editors->contains('editor', Auth::id()) && App\News::find(Session::get('read_update'))->type == Auth::user()->department)
                                                                <a role="button" class="btn btn-warning" href="{{URL::to('/edit_update/'.$recent_post->id)}}">
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post
                                                                </a>
                                                                @endif
                                                            </div>
                                                            <?php $date = new Jenssegers\Date\Date($recent_post->created_at); ?>
                                                            <small class="text-muted">{{ $date->ago() }}</small>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-block">
                                                        {!! App\News::find(Session::get('read_update'))->story !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-inverse text-white">
                                        <a class="btn btn-primary {{ $likes->contains('liked_by',Auth::id())?"disabled":"" }}" href="{{URL::to('/like_update/'.App\News::find(Session::get('read_update'))->id)}}" role="button">
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{ $likes->contains('liked_by',Auth::id())?"You liked this Post":"like" }}
                                        </a>
                                        <a class="btn btn-danger" data-dismiss="modal" role="button">
                                            <i class="fa fa-close fa-lg" aria-hidden="true"></i> Close
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.end News Modal -->
                        @endif

                    </div>

                </div>

                <!-- Three columns of text below the carousel -->


                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')

