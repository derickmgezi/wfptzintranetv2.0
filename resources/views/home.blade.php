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
                    <div class="col-md-8">
                        @if($recent_posts->count() != 0)
                        <h1 class="text-center featurette-heading">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i> Latest Posts
                        </h1>
                        <div class="card-deck">
                            @foreach($recent_posts as $recent_post)
                            <div class="card m-1">
                                <img class="card-img-top img-fluid" src="{{ url('/storage/thumbnails/'.$recent_post->image) }}" alt="Card image cap">
                                <div class="card-block">
                                    <a href="{{URL::to('/read_update/'.$recent_post->id)}}" class="card-text text-primary">
                                        <strong>{{ substr(strip_tags($recent_post->header),0,65) }}{{ strlen(strip_tags($recent_post->header)) > 65 ? "...":"" }}</strong>
                                    </a>
                                    <?php $date = new Jenssegers\Date\Date($recent_post->created_at); ?>
                                    <p class="card-text"><small class="text-muted">Posted {{ $date->ago() }}</small></p>
                                </div>
                                <?php
                                $unique_views = App\View::select('viewed_by','created_at')->where('view_id', $recent_post->id)->orderBy('created_at')->get();
                                $unique_views = $unique_views->unique('viewed_by');
                                $total_unique_view_count = $unique_views->count();
                                ?>
                                <div class="card-footer text-center">
                                    <a href="#" class="btn btn-sm btn-warning {{ Auth::user()->username == 'derick.ruganuza'? '':'disabled' }}" data-delay="300" data-trigger="{{ Auth::user()->username == 'derick.ruganuza'? 'hover':'' }}" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Viewed By" data-content="@if($total_unique_view_count == 0) No Views @else @foreach($unique_views as $view) {{ App\User::find($view->viewed_by)->firstname.' '.App\User::find($view->viewed_by)->secondname }} <br>@endforeach @endif"><i class="fa fa-eye" aria-hidden="true"></i> {{ $total_unique_view_count }} {{ $total_unique_view_count == 1?'viewer':'viewers' }}</a>
                                    <a href="{{URL::to('/read_update/'.$recent_post->id)}}" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i> Read</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        @if($most_viewed_posts->count() != 0)
                        <h1 class="text-center featurette-heading">
                            <i class="fa fa-eye" aria-hidden="true"></i> Most viewed Posts
                        </h1>
                        
                        <div class="card-deck">
                            @foreach($most_viewed_posts as $most_viewed_post)
                            <div class="card m-1">
                                <img class="card-img-top img-fluid" src="{{ url('/storage/thumbnails/'.$most_viewed_post->image) }}" alt="Card image cap">
                                <div class="card-block">
                                    <a href="{{URL::to('/read_update/'.$most_viewed_post->view_id)}}" class="card-text text-primary">
                                        <strong>{{ substr(strip_tags($most_viewed_post->header),0,65) }}{{ strlen(strip_tags($most_viewed_post->header)) > 65 ? "...":"" }}</strong>
                                    </a>
                                    <?php $date = new Jenssegers\Date\Date($most_viewed_post->created_at); ?>
                                    <p class="card-text"><small class="text-muted">Posted {{ $date->ago() }}</small></p>
                                </div>
                                <?php
                                $unique_views = App\View::select('viewed_by','created_at')->where('view_id', $most_viewed_post->view_id)->orderBy('created_at')->get();
                                $unique_views = $unique_views->unique('viewed_by');
                                $total_unique_view_count = $unique_views->count();
                                ?>
                                <div class="card-footer text-center">
                                    <a href="#" class="btn btn-sm btn-warning {{ Auth::user()->username == 'derick.ruganuza'? '':'disabled' }}" data-delay="300" data-trigger="{{ Auth::user()->username == 'derick.ruganuza'? 'hover':'' }}" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Viewed By" data-content="@if($total_unique_view_count == 0) No Views @else @foreach($unique_views as $view) {{ App\User::find($view->viewed_by)->firstname.' '.App\User::find($view->viewed_by)->secondname }} <br>@endforeach @endif"><i class="fa fa-eye" aria-hidden="true"></i> {{ $most_viewed_post->viewed_by }} {{ $most_viewed_post->viewed_by == 1?'viewer':'viewers' }}</a>
                                    <a href="{{URL::to('/read_update/'.$most_viewed_post->view_id)}}" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i> Read</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                                    <?php $date = new Jenssegers\Date\Date(App\News::find(Session::get('read_update'))->created_at); ?>
                                                    <footer class="text-success"><small>{{ $date->format('l j F Y').' at '.$date->format('h:i A') }}</small></footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-inverse text-white">
                                        <a class="btn btn-primary" href="{{URL::to('/like_update/'.App\News::find(Session::get('read_update'))->id)}}" role="button">
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> like
                                        </a>
                                        <a class="btn btn-danger" data-dismiss="modal" role="button">
                                            <i class="fa fa-close fa-lg" aria-hidden="true"></i> Close
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.end News Modal -->
                        @endif

<!--                        <h1 class="text-center featurette-heading">
                            <i class="fa fa-list" aria-hidden="true"></i> Canteen
                        </h1>

                        <div class="card-deck">
                            <div class="card card-inverse card-success">
                                <a href="{{URL::to('/canteen/break_fast')}}" style="text-decoration: none;">
                                    <div class="card-block">
                                        <h3 class="card-title">Break Fast</h3>
                                    </div>
                                </a>
                                <img class="card-img-bottom img-fluid" src="{{url('/image/breakfast-recipes-that-include-english-muffins.jpg')}}" alt="Card image cap">
                            </div>
                            <div class="card card-inverse card-primary">
                                <img class="card-img-top img-fluid" src="{{url('/image/pexels-photo-70497.jpeg')}}" alt="Card image cap">
                                <a href="{{URL::to('/canteen/lunch')}}" style="text-decoration: none;">
                                    <div class="card-block">
                                        <h3 class="card-title">Lunch</h3>
                                    </div>
                                </a>
                            </div>
                        </div>-->

                    </div>

                    <div class="col-md-4">
                        <h1 class="text-center featurette-heading">
                            <i class="fa fa-link" aria-hidden="true"></i> Links
                        </h1>

                        <div class="card m-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" style="background-color: ">
                                    <a target="_blank" href="http://newgo.wfp.org/documents/daily-subsistence-allowance-dsa?country=tanzania-united-rep-of-shilling#block--dsa-rates" class="card-link"><i class="fa fa-link" aria-hidden="true"></i> DSA Rates</a>
                                </li>
                                <li class="list-group-item">
                                    <a target="_blank" href="https://treasury.un.org/operationalrates/OperationalRates.php#T" class="card-link"><i class="fa fa-link" aria-hidden="true"></i> UN Exchange Rates</a>
                                </li>
                                <li class="list-group-item">
                                    <a target="_blank" href="https://trip.dss.un.org/dssweb/WelcometoUNDSS/tabid/105/Default.aspx?returnurl=%2fdssweb%2f" class="card-link"><i class="fa fa-link" aria-hidden="true"></i> Security Clearance</a>
                                </li>
                                <li class="list-group-item">
                                    <a target="_blank" href="https://wga.wfp.org/accounts/Reset" class="card-link"><i class="fa fa-link" aria-hidden="true"></i> Reset your Password</a>
                                </li>
                            </ul>
                        </div>

                        <a class="twitter-timeline" data-height="500" href="https://twitter.com/WFP_Tanzania">
                            Tweets by WFP_Tanzania
                        </a> 
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>

                <!-- /END THE FEATURETTES -->

                <!--                <h1 class="text-center featurette-heading">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editor
                                </h1>-->

                <!-- Three columns of text below the carousel -->


                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')

