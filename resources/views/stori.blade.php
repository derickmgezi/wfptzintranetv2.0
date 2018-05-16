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

                <div class="row justify-content-md-center">
                    <div class="col-md-8 col-md-offset-3">
                        <div class="card card-outline-primary card-primary mb-4">
                            <div class="card-header font-weight-bold">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="{{ strlen(App\User::find($story->posted_by)->image) != 0? url('/storage/thumbnails/'.App\User::find($story->posted_by)->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="45" height="45" data-src="holder.js/25x25/auto"> 
                                    <div class="media-body">
                                        <strong class="text-primary">{{ App\User::find($story->posted_by)->firstname.' '.App\User::find($story->posted_by)->secondname }}</strong>
                                        <p>{{ strip_tags($story->caption) }}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group btn-group-sm">
                                        <?php $views = $views->unique('viewed_by'); ?>
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-eye" aria-hidden="true"></i> {{ ($views->count() == 1)?$views->count().' viewer':$views->count().' viewers' }}
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{ ($likes == 1)?$likes.' like':$likes.' likes' }}
                                        </button>
                                        <button type="button" class="btn btn-secondary">
                                            <i class="fa fa-comments" aria-hidden="true"></i> {{ ($comments->count() == 1)?$comments->count().' comment':$comments->count().' comments' }}
                                        </button>
                                        @if($story->posted_by == Auth::id())
<!--                                        <a role="button" class="btn btn-warning" href="{{URL::to('/editstory/'.$story->id)}}">
                                            <i class="fa fa-edit" aria-hidden="true"></i> Edit 
                                        </a>
                                        <a role="button" class="btn btn-danger" href="{{URL::to('/deletestory/'.$story->id)}}">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete 
                                        </a>-->
                                        @endif
                                    </div>
                                    <div class="text-muted smaller">
                                        <?php $date = new Jenssegers\Date\Date($story->created_at); ?>
                                        {{ $date->ago() }}
                                    </div>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ URL::to('imagecache/original/'.$story->image) }}" alt="Card image cap">
                            <div @if($comments->count() > 4)style="height: 335px; overflow-y: scroll"@endif>
                                <div class="card-footer">
                                    <a class="btn btn-sm btn-primary float-right {{ $liked?'disabled':'' }}" href="{{URL::to('/likestory/'.$story->id)}}">
                                        <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i> {{ $liked?'You Liked this Story':'like' }}
                                    </a>
                                    <i class="fa fa-comments fa-lg"></i> Comments
                                </div>
                                <div class="list-group list-group-flush small">
                                    @if($comments->count() != 0)
                                    @foreach($comments as $comment)
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="media">
                                            <img class="d-flex mr-3 rounded-circle" src="{{ strlen(App\User::find($comment->comment_by)->image) != 0? url('/storage/thumbnails/'.App\User::find($comment->comment_by)->image):url('/image/default_profile_picture.jpg') }}" width="45" height="45" alt="">
                                            <div class="media-body">
                                                <strong>{{ App\User::find($comment->comment_by)->firstname.' '.App\User::find($comment->comment_by)->secondname }}</strong>
                                                {!! $comment->comment !!}
                                                <div class="text-muted smaller">
                                                    <?php $date = new Jenssegers\Date\Date($comment->created_at); ?>
                                                    {{ $date->ago() }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    @else
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="media">
                                            <img class="d-flex mr-3 rounded-circle" src="{{ url('/image/default_profile_picture.jpg') }}" width="45" height="45" alt="">
                                            <div class="media-body">
                                                <strong>Wazo</strong>
                                                <p><em class="text-primary">Please comment on the post</em></p>
                                            </div>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>

                            {{Form::open(array('url' => '/store_story_comment/'.$story->id,'enctype' => "multipart/form-data",'role' => 'form'))}}
                            <div class="card-block p-1">
                                <textarea class="simple-tinymce" name='comment'>
                                        
                                </textarea>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success"><i class="fa fa-paper-plane-o fa-lg" aria-hidden="true"></i> Send</button>
                            </div>
                            {{Form::token()}}
                            {{Form::close()}}
                        </div>
                    </div>
                </div>

                <!-- /END THE FEATURETTES -->


                <hr class="featurette-divider">
                
                <!-- FOOTER -->
                @include('frames/footer')