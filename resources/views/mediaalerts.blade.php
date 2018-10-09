@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <!-- Marketing messaging and featurettes
                ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="row">
                <div class="col-12">
                    <h1>
                        <div class="d-flex justify-content-start  hidden-sm-down">
                            <div class="">
                                <span class="small">News Alerts</span>
                            </div>
                            @if(Auth::user()->department == "Comms")
                            <div class="ml-auto">
                                <a class="btn btn-success" data-toggle="modal" data-target="#add-media-alert-modal" href="#" role="button">
                                   <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add Media Post
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-start hidden-md-up">
                            <div class="">
                                <span class="small">News Alerts</span>
                            </div>
                            @if(Auth::user()->department == "Comms")
                            <div class="ml-auto">
                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-media-alert-modal" href="#"  role="button">
                                   <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Media Post
                                </a>
                            </div>
                            @endif
                        </div>
                    </h1>
                    <!-- Add Media Alert Modal -->
                    {{Form::open(array('url' => '/store_media_alert','enctype' => "multipart/form-data",'role' => 'form'))}}
                    <div class="modal fade add-media-alert-modal" id="add-media-alert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Add Media Alert
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group @if($errors->has('header')){{ 'has-danger' }}@elseif(old('header')){{ 'has-success' }}@endif">
                                        <label for="headerText"><strong>Header</strong></label>
                                        <input class="form-control @if($errors->has('header')){{ 'form-control-danger' }}@elseif(old('header')){{ 'form-control-success' }}@endif" type="text" name='header' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->header:(old('header')) }}" id="headerText" aria-describedby="text" placeholder="Media alert header">
                                        @if($errors->first('header'))<div class="form-control-feedback"><em>Header should be filled</em></div>
                                        @elseif(old('header'))<div class="form-control-feedback"><em>Success! Header has been captured.</em></div>@endif
                                    </div>

                                    <div class="form-group @if($errors->has('source')){{ 'has-danger' }}@elseif(old('source')){{ 'has-success' }}@endif">
                                        <label for="source"><strong>Source</strong></label>
                                        <input class="form-control @if($errors->has('source')){{ 'form-control-danger' }}@elseif(old('source')){{ 'form-control-success' }}@endif" type="text" name='source' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->source:(old('source')) }}" placeholder="e.g The Guardian">
                                        @if($errors->has('source'))<div class="form-control-feedback"><em>Source should be filled</em></div>
                                        @elseif(old('source'))<div class="form-control-feedback"><em>Success! Source has been captured.</em></div>@endif
                                    </div>
                                    
                                    <fieldset class="form-group row @if($errors->has('mediatype')){{ 'has-danger' }}@elseif(old('mediatype')){{ 'has-success' }}@endif">
                                        <legend class="col-form-legend col-12"><strong>Media alert type</strong></legend>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" v-model="mediatype" name="mediatype" value="Link">
                                                    External link
                                                </label>
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" v-model="mediatype" name="mediatype" value="Image">
                                                    Image
                                                </label>
                                            </div>
                                        </div>
                                        @if($errors->has('mediatype'))<div class="col-sm-12 form-control-feedback"><em>Please select Media alert type {{ $errors->first('mediatype') }}</em></div>
                                        @elseif(old('mediatype'))<div class="col-sm-12 form-control-feedback"><em>Success! Media alert type selected</em></div>@endif
                                    </fieldset>
                                    
                                    <div v-if ="mediatype == 'Link'" class="form-group @if($errors->has('mediacontent')){{ 'has-danger' }}@elseif(old('mediacontent')){{ 'has-success' }}@endif">
                                        <label for="source"><strong>External Link</strong></label>
                                        <input class="form-control @if($errors->has('mediacontent')){{ 'form-control-danger' }}@elseif(old('mediacontent')){{ 'form-control-success' }}@endif" type="url" name='mediacontent' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->source:(old('mediacontent')) }}" placeholder="https://example.com">
                                        @if($errors->has('mediacontent') && old('mediatype') == 'Link')<div class="form-control-feedback"><em>Externa link should be filled</em></div>
                                        @elseif(old('mediacontent'))<div class="form-control-feedback"><em>Success! Externa link has been captured</em></div>@endif
                                    </div>

                                    <div v-else-if ="mediatype == 'Image'" class="form-group {{ ($errors)?'has-danger':'' }}">
                                        <label for="recipient-name" class="form-control-label"><strong>Image</strong></label><br>
                                        <input class="form-control form-control-danger" type="file" name='mediacontent' value="{{ (old('image')) }}" id="image">
                                        @if($errors)<div class="form-control-feedback"><em>Please choose an image</em></div>@endif
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fa fa-times" aria-hidden="true"></i> Close
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Upload Media Alert
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::token()}}
                    {{Form::close()}}<!-- end Add Media Alert Modal -->
                    
                    <!-- Edit Media Alert Modal -->
                    <form method="POST" v-bind:action="mediaid" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
                    <div class="modal fade edit-media-alert-modal" id="edit-media-alert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Edit Media Alert
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group @if($errors->has('header')){{ 'has-danger' }}@elseif(old('header')){{ 'has-success' }}@endif">
                                        <label for="headerText"><strong>Header</strong></label>
                                        <input class="form-control @if($errors->has('header')){{ 'form-control-danger' }}@elseif(old('header')){{ 'form-control-success' }}@endif" type="text" name='header' v-model="header" id="headerText" aria-describedby="text" placeholder="Media alert header">
                                        @if($errors->first('header'))<div class="form-control-feedback"><em>Header should be filled</em></div>
                                        @elseif(old('header'))<div class="form-control-feedback"><em>Success! Header has been captured.</em></div>@endif
                                    </div>

                                    <div class="form-group @if($errors->has('source')){{ 'has-danger' }}@elseif(old('source')){{ 'has-success' }}@endif">
                                        <label for="source"><strong>Source</strong></label>
                                        <input class="form-control @if($errors->has('source')){{ 'form-control-danger' }}@elseif(old('source')){{ 'form-control-success' }}@endif" type="text" name='source' v-model="source" placeholder="e.g The Guardian">
                                        @if($errors->has('source'))<div class="form-control-feedback"><em>Source should be filled</em></div>
                                        @elseif(old('source'))<div class="form-control-feedback"><em>Success! Source has been captured.</em></div>@endif
                                    </div>
                                    
                                    <fieldset class="form-group row @if($errors->has('type')){{ 'has-danger' }}@elseif(old('type')){{ 'has-success' }}@endif">
                                        <legend class="col-form-legend col-12"><strong>Media alert type</strong></legend>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" v-model="type" name="type" value="Link">
                                                    External link
                                                </label>
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" v-model="type" name="type" value="Image">
                                                    Image
                                                </label>
                                            </div>
                                        </div>
                                        @if($errors->has('type'))<div class="col-sm-12 form-control-feedback"><em>Please select Media alert type {{ $errors->first('type') }}</em></div>
                                        @elseif(old('type'))<div class="col-sm-12 form-control-feedback"><em>Success! Media alert type selected</em></div>@endif
                                    </fieldset>
                                    
                                    <div v-if ="type == 'Link'" class="form-group @if($errors->has('mediacontent')){{ 'has-danger' }}@elseif(old('mediacontent')){{ 'has-success' }}@endif">
                                        <label for="source">
                                            <strong>External Link</strong>
                                        </label>

                                        <input class="form-control @if($errors->has('mediacontent')){{ 'form-control-danger' }}@elseif(old('mediacontent')){{ 'form-control-success' }}@endif" type="url" name='mediacontent' v-model="mediacontent" placeholder="https://example.com">

                                        @if($errors->has('mediacontent') && old('type') == 'Link')
                                        <div class="form-control-feedback">
                                            <em>Externa link should be filled</em>
                                        </div>
                                        @elseif(old('mediacontent'))
                                        <div class="form-control-feedback">
                                            <em>Success! Externa link has been captured</em>
                                        </div>
                                        @endif
                                    </div>

                                    <div v-else-if ="type == 'Image'" class="form-group {{ ($errors->has('mediacontent'))?'has-danger':'' }}">
                                        <label for="recipient-name" class="form-control-label">
                                            <strong>Image</strong>
                                        </label>
                                        <br>
                                        <img v-if="mediaisimage" class="card-img-top img-fluid mb-1" v-bind:src="mediacontent" alt="Card image cap">
                                        <input class="form-control @if($errors->has('mediacontent')){{ 'form-control-danger' }}@elseif(old('mediacontent')){{ 'form-control-success' }}@endif" type="file" name='mediacontent' value="{{ (old('image')) }}" id="image">
                                        
                                        @if($errors->has('mediacontent') && old('type') == 'Image')
                                        <div class="form-control-feedback">
                                            <em>Please select an image</em>
                                        </div>
                                        @elseif(old('mediacontent'))
                                        <div class="form-control-feedback">
                                            <em>Success! Image has been selected</em>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fa fa-times" aria-hidden="true"></i> Close
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Upload Media Alert
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::token()}}
                    {{Form::close()}}<!-- end Edit Media Alert Modal -->

                    <!-- Start Delete Medial Alert Modal -->
                    <div class="modal fade delete-media-alert-modal" id="delete-media-alert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Media Alert</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="card-title ">
                                    <a v-if="mediaislink" :href="mediacontent" target="_blank">@{{ header }}</a>
                                    <a v-if="mediaisimage" href="">@{{ header }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                        @{{ source }}
                                </h6>
                                <p class="card-text">
                                    <img v-if="mediaisimage" class="card-img-top img-fluid mb-1" v-bind:src="mediacontent" alt="Card image cap">
                                </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> No</button>
                              <a :href="mediaid" class="btn btn-sm btn-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i> Yes</a>
                            </div>
                          </div>
                        </div>
                    </div><!-- End Delete Medial Alert Modal -->
                </div>
            </div>

            <div class="container-fluid">

                <div class="row"> 

                    <div class="col-sm-8">
                        @if($days_of_media_alerts->count() > 0)
                            @foreach($days_of_media_alerts as $day)
                            <div class="panel panel-default mb-4">
                                <div class="panel-heading">
                                    <?php $date = new Jenssegers\Date\Date($day->date); ?>
                                    <!--  <h5>{{ $date->format('l j F Y, h:i A') }}</h5> -->
                                    <h5>
                                        <span class="badge badge-default">{{ $date->format('l jS F, Y') }}</span>
                                    </h5>
                                </div>

                                <div id="media-alert-accordion" role="tablist" aria-multiselectable="true">
                                    @foreach($mediaalerts as $mediaalert)
                                        <?php $date = new Jenssegers\Date\Date($mediaalert->date); ?>
                                        @if($date->format('d F Y') == $day->date)
                                        <div class="card mb-1">
                                            <div class="card-header" role="tab" id="heading{{ $mediaalert->id }}">
                                                <h5 class="mb-0">
                                                    <div class="d-flex">
                                                            @if($mediaalert->type == 'Link')
                                                            <span><i class="fa fa-external-link p-1 text-primary" aria-hidden="true"></i></span>
                                                            @else
                                                            <span><i class="fa fa-newspaper-o p-1  text-primary" aria-hidden="true"></i></span>
                                                            @endif
                                                            <a data-toggle="collapse" data-parent="#media-alert-accordion" href="#collapse{{ $mediaalert->id }}" aria-expanded="true" aria-controls="collapse{{ $mediaalert->id }}">
                                                                <small>{{ $mediaalert->header }}</small>
                                                                <!-- <small class="font-weight-bold">{{ $mediaalert->header }}</small> -->
                                                            </a>
                                                    </div>
                                                    <span class="badge badge-primary smaller font-italic">{{ $mediaalert->source }}</span>
                                                    @if(Auth::user()->department == "Comms")
                                                    <div class="float-right">
                                                        <a v-on:click="editModal({{$mediaalert}})" role="button" class="text-warning" data-toggle="modal" data-target="#edit-media-alert-modal">
                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                        </a>
                                                        <a v-on:click="deleteModal({{$mediaalert}})" role="button" class="text-danger" data-toggle="modal" data-target="#delete-media-alert-modal">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div id="collapse{{ $mediaalert->id }}" class="collapse show" role="tabpanel" aria-labelledby="heading{{ $mediaalert->id }}">
                                                @if($mediaalert->type == 'Image')
                                                <a role="button" v-on:click="showModal({{$mediaalert}})" data-toggle="modal" data-target="#media-alert-modal" >
                                                    <img class="img-fluid img-responsive img-thumbnail" src="{{ URL::to('imagecache/original/'.$mediaalert->mediacontent) }}" alt="Image Alt" style="width: 100%;">
                                                </a>
                                                @elseif($mediaalert->type == 'Link')
                                                <div class="">
                                                    <!-- <iframe class="embed-responsive-item" src="{{ $mediaalert->mediacontent }}">
                                                        alternative content for browsers which do not support iframe.
                                                    </iframe> -->
                                                    <a class="badge badge-success m-3" target="_blank" href='{{ $mediaalert->mediacontent }}'>
                                                        {{ substr(strip_tags($mediaalert->mediacontent),0,40) }}{{ strlen(strip_tags($mediaalert->mediacontent)) > 40 ? "...":"" }}
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="alert alert-info mb-4" role="alert">
                            <h4 class="alert-heading">Welcome to News Alerts Page</h4>
                            <strong>Currently</strong> no news alerts have been posted yet.
                            <a href="#" class="alert-link">Soon our communication unit</a>, will start posting news alerts daily.
                        </div>
                        @endif

                        @if($days_of_media_alerts->hasPages())
                        <div class="col-12 mb-4">
                            <nav aria-label="Page navigation example">
                                {{ $days_of_media_alerts->links('vendor.pagination.bootstrap-4') }}
                                {{ $days_of_media_alerts->links('vendor.pagination.bootstrap-4-small') }}
                            </nav>
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

                    <div class="col-sm-4">
                        <a class="twitter-timeline" data-height="500" href="https://twitter.com/WFP_Tanzania">
                            Tweets by WFP_Tanzania
                        </a> 
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>
                
            <h1></h1>

            <!-- FOOTER -->
            @include('frames/footer')
