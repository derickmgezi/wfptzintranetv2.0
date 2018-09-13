@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <!--            @include('components/pi/picarousel')-->

            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container-fluid marketing">                        

                <div class="row">
                    <div class="col-md-9">
                        @if($news->count() != 0)
                        <div class="d-flex justify-content-start">
                            <h1>
                                <span class="small">News</span>
                            </h1>
                            <h1 class="ml-auto mr-3">
                                <span class="smaller font-weight-bold">Recently posted</span>
                            </h1>
                        </div>
                        
                        <div class="row no-gutters align-items-center">
                            @foreach($news as $news_update)
                            <div class="col-md-4">
                                <div v-on:mouseover="changenewscolor" v-on:mouseleave="changebacknewscolor" class="card card-primary mr-3 mb-3" v-bind:class="[ newscardcolor ]">
                                    <a href="{{URL::to('/news')}}">
                                        <img class="card-img-top img-fluid" src="{{ url('/storage/thumbnails/'.$news_update->image) }}" alt="Card image cap">
                                    </a>
                                    <div class="card-block">
                                        <a href="{{URL::to('/news')}}" class="card-text" v-bind:class="[ newstextcolor ]">
                                            <strong>{{ substr(strip_tags($news_update->header),0,35) }}{{ strlen(strip_tags($news_update->header)) > 35 ? "...":"" }}</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if($stories->count() != 0)
                        <div class="d-flex justify-content-start">
                            <h1>
                                <span class="small">Stories</span>
                            </h1>
                            <h1 class="ml-auto mr-3">
                                <span class="smaller font-weight-bold">Recently posted</span>
                            </h1>
                        </div>

                        <div class="row no-gutters align-items-center">
                            @foreach($stories as $story)
                            <div class="col-md-4">
                                <div v-on:mouseover="changestorycolor" v-on:mouseleave="changebackstorycolor" class="card card-primary mr-3 mb-3" v-bind:class="[ storycardcolor ]">
                                    <a href="{{URL::to('/storiyangu')}}">
                                        <img class="card-img-top img-fluid" src="{{ url('/storage/thumbnails/'.$story->image) }}" alt="Card image cap">
                                    </a>
                                    <div class="card-block">
                                        <a href="{{URL::to('/storiyangu')}}" class="card-text" v-bind:class="[ storytextcolor ]">
                                            <strong>{{ substr(strip_tags($story->caption),0,35) }}{{ strlen(strip_tags($story->caption)) > 35 ? "...":"" }}</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        @if($recent_media_alerts_date->count() > 0)
                        <div class="d-flex justify-content-start">
                            <h1>
                                <span class="small">Media Alerts</span>
                            </h1>
                            <h1 class="ml-auto">
                                <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                <?php $date = new Jenssegers\Date\Date($recent_media_alerts_date->date); ?>
                                <span class="smaller"><strong>Posted on</strong> {{ $date->format('M j, Y') }}</span>
                            </h1>
                        </div>
                        
                            <div class="panel panel-default mb-4">

                                <div id="media-alert-accordion" role="tablist" aria-multiselectable="true">
                                    @foreach($mediaalerts as $mediaalert)
                                        <?php $date = new Jenssegers\Date\Date($mediaalert->date); ?>
                                        @if($date->format('d F Y') == $recent_media_alerts_date->date)
                                        <div class="card mb-1">
                                            <div class="card-header d-flex" role="tab" id="heading{{ $mediaalert->id }}">
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#media-alert-accordion" href="#collapse{{ $mediaalert->id }}" aria-expanded="true" aria-controls="collapse{{ $mediaalert->id }}">
                                                        <small>{{ $mediaalert->header }}</small>
                                                    </a>
                                                    <br>
                                                    <span class="badge badge-success smaller font-italic">{{ $mediaalert->source }}</span>
                                                    @if($mediaalert->type == 'Link')
                                                    <span class="badge badge-primary smaller font-italic">External link</span>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div id="collapse{{ $mediaalert->id }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $mediaalert->id }}">
                                                @if($mediaalert->type == 'Image')
                                                <a role="button" v-on:click="showModal({{$mediaalert}})" data-toggle="modal" data-target="#media-alert-modal" >
                                                    <img class="img-fluid img-responsive img-thumbnail" src="{{ URL::to('imagecache/original/'.$mediaalert->mediacontent) }}" alt="Image Alt" style="width: 100%;">
                                                </a>
                                                @elseif($mediaalert->type == 'Link')
                                                <div class="card-block">
                                                    <a class="btn btn-sm btn-primary" target="_blank" href='{{ $mediaalert->mediacontent }}'>
                                                        Click to view external media link
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- Start of Media alert Popup Modal -->
                        <div class="modal fade" id="media-alert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">
                                            @{{header}}
                                            <span class="badge badge-success font-italic">@{{ source }}</span>
                                        </h6>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="">
                                        <img class="img-fluid img-responsive img-thumbnail" v-bind:src="image" alt="Image Alt" style="width: 100%;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- End of Media alert Popup Modal -->
                    </div>

                    <div class="col-md-3">
                         <div class="d-flex justify-content-start">
                            <h1>
                                <span class="small">Links</span>
                            </h1>
                            <h1 class="ml-auto">
                                <span class="smaller font-weight-bold">Most visited</span>
                            </h1>
                        </div>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/internaldirectory')}}" class="card-link">
                                Telephone Bills
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/resource#hr')}}" class="card-link">
                                HR Forms
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/resource#sop')}}" class="card-link">
                                SOPs
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/resource#sop')}}" class="card-link">
                                WFPgo
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/resource#sop')}}" class="card-link">
                                WINGSII
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Three columns of text below the carousel -->
                <hr>

                <!-- FOOTER -->
                @include('frames/footer')

