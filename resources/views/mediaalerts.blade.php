@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

            <!-- Marketing messaging and featurettes
                ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="row">
                <div class="col-12">
                    <h1>
                        <div class="row  hidden-sm-down">
                            <div class="col-lg-9 col-md-8">
                                Media Alerts
                            </div>

                            <div class="col-lg-3 col-md-4 text-right">
                                <a class="btn btn-success" @if(Session::has('edit_story') || Session::has('edit_story_error')) href="{{URL::to('/addstory/')}}" @else data-toggle="modal" data-target="#add-story-modal" href="#"  @endif  role="button">
                                   <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add Media Post
                                </a>
                            </div>
                        </div>
                        <div class="row hidden-md-up">
                            <div class="col-sm-9">
                                Media Alerts
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
                                        Add New Post
                                        @endif
                                    </h5>
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
                                        <label for="source"><strong>Source</strong></label>
                                        <input type="text" name='source' value="{{ Session::has('update_id')?App\News::find(Session::get('update_id'))->source:(old('source')) }}" class="form-control" id="source" aria-describedby="text" placeholder="Enter Source">
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label"><strong>Image</strong></label><br>
                                        @if(Session::has('edit_story'))
                                        <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/large/'.Session::get('edit_story')->image) }}" alt="Card image cap">
                                        @elseif(Session::has('edit_story_error'))
                                        <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/large/'.Session::get('edit_story_error')->image) }}" alt="Card image cap">
                                        @endif
                                        <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
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

            <div class="container">

                <div class="row"> 

                    <div class="col-sm-8"> 

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Today's Media Alerts</h5>
                            </div>
                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a style="text-decoration: none" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <small>Wfp is about to solve malnutrition problem</small>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="">
                                            <div class="">
                                                <a href="./image/nice.png" class="light-zoom">
                                                    <img class="img-responsive light-zoom" src="./image/nice.png" alt="Image Alt" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a style="text-decoration: none" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <small>Mpina furious over high speed prices</small>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="">
                                            <div class="test">
                                                <a href="./image/gazet.jpg" class="light-zoom">
                                                    <img class="img-responsive" src="./image/gazet.jpg" alt="Image Alt" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h5 class="mb-0">
                                            <a style="text-decoration: none" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <small>Irrigation stressed as agricultural dynamo</small>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="">
                                            <div class="test">
                                                <a href="./image/gazet1.png" class="light-zoom">
                                                    <img class="img-responsive" src="./image/gazet1.png" alt="Image Alt" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
