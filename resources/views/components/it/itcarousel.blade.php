<?php 
     $posts = App\Post::where('status',1)->where('type','IT_post')->orderBy('created_by','desc')->get();
     $post_count = $posts->count();
     $slide_id = 0;
?>
@if($post_count != 0)
<div id="myCarousel" class="container carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($posts as $post)
        <li data-target="#myCarousel" data-slide-to="{{$slide_id}}" class="{{($slide_id == 0)? 'active':''}}"></li>
        <?php ++$slide_id ?>
        @endforeach

        @if(Auth::user()->department=='IT')
        <li data-target="#myCarousel" data-slide-to="{{$slide_id}}" class="{{($slide_id == 0)? 'active':''}}"></li>
        @endif
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php $slide_id = 0; $text_format_id = 1; ?>
        @foreach($posts as $post)
        <div class="carousel-item {{($slide_id == 0)? 'active':''}}">
            <img class="first-slide img-wraper" style="filter: brightness(60%);" src="{{url('/storage/thumbnails/'.$post->image)}}" alt="First slide">
            <div class="container">
                @if($text_format_id == 1)
                <div class="carousel-caption d-none d-md-block text-left">
                @elseif($text_format_id == 2)
                <div class="carousel-caption d-none d-md-block">
                @elseif($text_format_id == 3)
                <div class="carousel-caption d-none d-md-block text-right">
                @endif
                    <h1 class="">{{$post->header}} {{ $text_format_id }}</h1>

                    <p>
                        {!!$post->description!!}
                    </p>

                    <p>
                        <a class="btn btn-lg btn-primary" href="{{URL::to('/read_post/'.$post->id)}}" role="button">
                            <i class="fa fa-leanpub" aria-hidden="true"></i> Read more
                        </a>
                        @if(Auth::user()->department == 'IT')
                        <a class="btn btn-lg btn-warning" href="{{URL::to('/edit_it_post/'.$post->id)}}" role="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post
                        </a>
                        <a class="btn btn-lg btn-danger" href="{{URL::to('/remove_it_post/'.$post->id)}}" role="button">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Remove Post
                        </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <?php ++$slide_id;  $text_format_id != 3? ++$text_format_id:$text_format_id = 1; ?>
        @endforeach

        @if(Auth::user()->department == 'IT')
        <div class="carousel-item {{($slide_id == 0)? 'active':''}}">
            <img class="fourth-slide img-wraper" style="filter: brightness(60%);" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
            <div class="container">
                <div class="carousel-caption d-none d-md-block text-right">
                    <h1>Heading</h1>
                    <p>Brief explanations regarding the heading.</p>
                    <p>
                        <a class="btn btn-lg btn-success" href="{{URL::to('/create_post')}}" role="button">
                            <i class="fa fa-plus-square" aria-hidden="true"></i> Add Post
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <?php ++$slide_id ?>
        @endif
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@else
    @if(Auth::user()->department == 'IT')
    <div id="myCarousel" class="container carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="{{$slide_id}}" class="{{($slide_id == 0)? 'active':''}}"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item {{($slide_id == 0)? 'active':''}}">
                <img class="fourth-slide img-wraper" style="filter: brightness(60%);" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption d-none d-md-block text-right">
                        <h1>Heading</h1>
                        <p>Brief explanations regarding the heading.</p>
                        <p>
                            <a class="btn btn-lg btn-success" href="{{action('ITController@create')}}" role="button">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> Add Post
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <?php ++$slide_id ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    @endif
@endif

@if($slide_id != 0)
<hr>
@endif

@if(Session::has('post_id'))
<!-- Edit Post Modal -->
{{ Form::open(array('url' => '/edit_it_post/'.Session::get('post_id'),'enctype' => "multipart/form-data",'role' => 'form')) }}
<div class="modal fade add-post-modal" id='add-post-modal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
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
                            <input type="text" name='header' value="{{ (old('header')) }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter Post Header">
                            @elseif(Session::has('post_id'))
                            <input type="text" name='header' value="{{ App\Post::find(Session::get('post_id'))->header }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter Post Header">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image"><strong>Image</strong></label>
                            <img class="first-slide img-wraper" style="filter: brightness(60%);" src="{{url('/storage/thumbnails/'.App\Post::find(Session::get('post_id'))->image)}}" alt="First slide">
                            <hr>
                            @if(old('image'))
                            <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
                            @elseif(Session::has('post_id'))
                            <input type="file" name='image' value="{{ App\Post::find(Session::get('post_id'))->image }}" id="image" class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="headerText"><strong>Description</strong></label>
                            @if(old('description'))
                            <textarea class="form-control" name='description' id="exampleTextarea" rows="5">{{ (old('description')) }}</textarea>
                            @elseif(Session::has('post_id'))
                            <textarea class="form-control" name='description' id="exampleTextarea" rows="5">{{ App\Post::find(Session::get('post_id'))->description }}</textarea>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="headerText"><strong>Story</strong></label>
                            @if(old('story'))
                            <textarea class="form-control" name='story' id="exampleTextarea" rows="10">{{ (old('story')) }}</textarea>
                            @elseif(Session::has('post_id'))
                            <textarea class="form-control" name='story' id="exampleTextarea" rows="10">{{ App\Post::find(Session::get('post_id'))->story }}</textarea>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        @if(Session::has('edit_post_error'))
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
                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Edit Post</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg" aria-hidden="true"></i> Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><!-- end Edit News Modal -->
{{Form::token()}}
{{Form::close()}}
@elseif(Session::has('create_post') || Session::has('new_post_error')) 
<!-- Add Post Modal -->
{{ Form::open(array('url' => '/store_it_post','enctype' => "multipart/form-data",'role' => 'form')) }}
<div class="modal fade add-post-modal" id='add-post-modal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="headerText"><strong>Header</strong></label>
                            <input type="text" name='header' value="{{ (old('header')) }}" class="form-control" id="headerText" aria-describedby="text" placeholder="Enter Post Header">
                        </div>
                        <div class="form-group">
                            <label for="image"><strong>Image</strong></label>
                            <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
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
                        @if(Session::has('new_post_error'))
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
                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Create Post</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg" aria-hidden="true"></i> Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><!-- end Add News Modal -->
{{Form::token()}}
{{Form::close()}}
@endif


@if(Session::has('read_post'))
<!-- start of Post Pop Up Modal -->
<div class="modal fade" id="read-post" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">{{ App\Post::find(Session::get('read_post'))->header }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <img class="featurette-image img-fluid mx-auto d-flex justify-content-center" src="{{url('/storage/'.App\Post::find(Session::get('read_post'))->image)}}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                        <hr>
                    </div>
                    <div class="col-12">
                        <blockquote class="blockquote">
                            <p class="text-justify">
                                {!! App\Post::find(Session::get('read_post'))->description !!}
                            </p>
                            <footer class="blockquote-footer">By <cite title="Source Title" class="text-primary">{{ App\User::find(App\Post::find(Session::get('read_post'))->edited_by)->firstname.' '.App\User::find(App\Post::find(Session::get('read_post'))->edited_by)->secondname }}</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-inverse text-white">
                <div class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <p class="text-justify">
                                {!! App\Post::find(Session::get('read_post'))->story !!}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif
