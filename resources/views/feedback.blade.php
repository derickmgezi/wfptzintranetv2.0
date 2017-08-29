@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

            <div class="container-fluid marketing">
                <div class="row">
                    @if(Auth::user()->username == 'derick.ruganuza' || Auth::user()->username == 'daudi.kabalika' || Auth::user()->username == 'fizza.moloo' || Auth::user()->username == 'max.wohlgemuth')
                    <div class="col-8">
                        <!-- Example Notifications Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-comments-o"></i> Sent Feedback
                            </div>
                            <div class="list-group list-group-flush small">
                                @if($feedback->count() == 0)
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="text-primary smaller">
                                                <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> No Feedback has been provided yet
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @else
                                @foreach($feedback as $info)
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="{{ strlen(App\User::find($info->feedback_by)->image) != 0? url('/storage/thumbnails/'.App\User::find($info->feedback_by)->image):url('/image/default_profile_picture.jpg') }}" width="45" height="45" alt="">
                                        <div class="media-body">
                                            <strong>{{ App\User::find($info->feedback_by)->firstname.' '.App\User::find($info->feedback_by)->secondname }}</strong>
                                            {!! $info->feedback !!}
                                            <div class="text-muted smaller">
                                                <?php 
                                                    $date = new Jenssegers\Date\Date($info->created_at);
                                                ?>
                                                {{ $date->format('l j F Y').' at '.$date->format('h:i A').' - '.$date->ago() }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                            </div>
                            @if($feedback->total() > 5)
                            <div class="card-footer text-center">
                                <nav aria-label="...">
                                    {{ $feedback->links('vendor.pagination.bootstrap-4-small-feedback') }}
                                </nav>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if(Auth::user()->username != 'daudi.kabalika' && Auth::user()->username != 'fizza.moloo' && Auth::user()->username != 'max.wohlgemuth')
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-comments-o"></i> Send us your Feedback
                            </div>
                            {{ Form::open(array('url' => '/feedback/','enctype' => "multipart/form-data",'role' => 'form')) }}
                            <div class="card-block p-1">
                                <textarea class="simple-tinymce" name='feedback'>
                                        
                                </textarea>
                            </div>
                            @if($errors->has('feedback'))
                            <div class="card-footer p-1 text-center text-danger">
                                <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> <small><strong>{{ $errors->first('feedback') }}</strong></small>
                            </div>
                            @elseif(Session::has('add_feedback'))
                            <div class="card-footer p-1 text-center text-success">
                                <i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i> <small><strong>{{ Session::get('add_feedback') }}</strong></small>
                            </div>
                            @endif
                            <div class="card-footer text-right">
                                <button class="btn btn-sm btn-secondary"><i class="fa fa-paper-plane-o fa-lg" aria-hidden="true"></i> Submit</button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                    @endif
                </div>

                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')

