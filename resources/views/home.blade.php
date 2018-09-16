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
                        <div class="justify-content-start">
                            <h1 class="mr-3">
                                <span class="small">WFP Updates</span>
                            </h1>
                        </div>
                        
                        <div class="row no-gutters align-items-center">
                            <div v-for="news_update in news" v-on:mouseover="changenewscolor(news_update.id)" v-on:mouseleave="changebacknewscolor(news_update.id)" class="col-md-4">
                                <div class="card card-primary m-1 card-outline-primary">
                                    <a href="{{URL::to('/news')}}">
                                        <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('storage/thumbnails')) }} + '/' + news_update.image" alt="Card image cap">
                                    </a>
                                    <transition
                                    name="news-block-appear" 
                                    enter-active-class="animated flipInX"
                                    leave-active-class="animated flipOutX">
                                        <div v-if="showNewsBlock == news_update.id" class="card-block">
                                            <a href="{{URL::to('/news')}}" class="card-text text-primary">
                                                <strong v-if="news_update.header.length > 35">@{{ news_update.header.substring(0,35) + '...' }}</strong>
                                                <strong v-else>@{{ news_update.header }}</strong>
                                            </a>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($stories->count() != 0)
                        <div class="justify-content-start">
                            <h1 class="mr-3">
                                <span class="small">Stori Yangu</span>
                            </h1>
                        </div>

                        <div class="row no-gutters align-items-center">
                            <div v-for="story in stories" v-on:mouseover="changestorycolor(story.id)" v-on:mouseleave="changebackstorycolor(story.id)" class="col-md-4">
                                <div class="card card-primary mr-3 mb-3 card-outline-primary">
                                    <a href="{{URL::to('/storiyangu')}}">
                                        <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('storage/thumbnails')) }} + '/' + story.image" alt="Card image cap">
                                    </a>
                                    <transition
                                    name="story-block-appear" 
                                    enter-active-class="animated flipInX"
                                    leave-active-class="animated flipOutX">
                                        <div v-if="showStoryBlock == story.id" class="card-block">
                                            <a href="{{URL::to('/storiyangu')}}" class="card-text text-primary">
                                                <strong v-if="story.caption.length > 45" v-html="story.caption.substring(0,45) + '...'"></strong>
                                                <strong v-else v-html="story.caption"></strong>
                                            </a>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($recent_media_alerts_date->count() > 0)
                        <div class="justify-content-start">
                            <h1 class="mr-3">
                                <span class="small">News Alerts</span>
                                <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                <?php $date = new Jenssegers\Date\Date($recent_media_alerts_date->date); ?>
                                <span class="smaller"><strong>Posted on</strong> {{ $date->format('M j, Y') }}</span>
                            </h1>
                        </div>
                        
                            <div class="panel panel-default mb-4 mr-3">
                                <div id="media-alert-accordion" role="tablist" aria-multiselectable="true">
                                    @foreach($mediaalerts as $mediaalert)
                                        <?php $date = new Jenssegers\Date\Date($mediaalert->date); ?>
                                        @if($date->format('d F Y') == $recent_media_alerts_date->date)
                                        <div class="card mb-1">
                                            <div class="card-header" role="tab" id="heading{{ $mediaalert->id }}">
                                                <h5 class="mb-0">
                                                    @if($mediaalert->type == 'Link')
                                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                                    @else
                                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                                    @endif
                                                    <a data-toggle="collapse" data-parent="#media-alert-accordion" href="#collapse{{ $mediaalert->id }}" aria-expanded="true" aria-controls="collapse{{ $mediaalert->id }}">
                                                        <small>{{ $mediaalert->header }}</small>
                                                    </a>
                                                    <br>
                                                    <span class="badge badge-default smaller font-italic">{{ $mediaalert->source }}</span>
                                                    <div class="float-right">
                                                        <a v-on:click="editModal({{$mediaalert}})" role="button" class="text-warning" data-toggle="modal" data-target="#edit-media-alert-modal">
                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                        </a>
                                                        <a v-on:click="deleteModal({{$mediaalert}})" role="button" class="text-danger" data-toggle="modal" data-target="#delete-media-alert-modal">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapse{{ $mediaalert->id }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $mediaalert->id }}">
                                                @if($mediaalert->type == 'Image')
                                                <a role="button" v-on:click="showModal({{$mediaalert}})" data-toggle="modal" data-target="#media-alert-modal" >
                                                    <img class="img-fluid img-responsive img-thumbnail" src="{{ URL::to('imagecache/original/'.$mediaalert->mediacontent) }}" alt="Image Alt" style="width: 100%;">
                                                </a>
                                                @elseif($mediaalert->type == 'Link')
                                                <div class="">
                                                    <a class="badge badge-success m-3" target="_blank" href='{{ $mediaalert->mediacontent }}'>
                                                        {{ substr(strip_tags($mediaalert->mediacontent),0,35) }}{{ strlen(strip_tags($mediaalert->mediacontent)) > 35 ? "...":"" }}
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
                                        <img class="img-fluid img-responsive img-thumbnail" v-bind:src="mediacontent" alt="Image Alt" style="width: 100%;">
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

