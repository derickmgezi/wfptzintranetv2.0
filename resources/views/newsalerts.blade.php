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
                                    <!-- <i class="fa fa-commenting-o" aria-hidden="true"></i> --> Media Alerts

                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-secondary">
                                            Order By
                                        </button>
                                        
                                        <div class="btn-group" role="group">
                                                @if(Request::is('newsalerts'))
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
                                       <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add New Post
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


  <style>
 .hovereffect {
    width: 100%;
    height: 100%;
    float: left;
    overflow: hidden;
    position: relative;
    text-align: center;
    cursor: pointer;
    background: rgb(0, 0, 0);
   

   /* background-color: black;*/
}

.hovereffect .overlay {

    width: 100%;
    position: absolute;
    overflow: hidden;
    left: 0;
    top: auto;
    bottom: 0; 
    -webkit-transition: -webkit-transform 0.35s;
    transition: transform 0.35s;
    -webkit-transform: translate3d(0,100%,0);
    transform: translate3d(0,100%,0);
    visibility: hidden;
    opacity: 1;

}

.hovereffect img {
    display: block;
    position: relative;
    -webkit-transition: -webkit-transform 0.35s;
    transition: transform 0.35s;
}

.hovereffect:hover img {
-webkit-transform: translate3d(0,-10%,0);
    transform: translate3d(0,-10%,0);
}

.hovereffect h2 {
    color: #fff;
    text-align: center;
    position: relative;
    font-size: 17px;
    float: left;
    margin: 0px;
    display: inline-block;
    /*margin-bottom: 7px;*/


}

.hovereffect a.info {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    text-transform: uppercase;
    color: #fff;
    border: 1px solid #fff;
    margin: 50px 0 0 0;
    background-color: transparent;
}
.hovereffect a.info:hover {
    box-shadow: 0 0 5px #fff;
}


.hovereffect p.icon-links a {
    float: right;
    color:white;
    font-size: 1.4em;
}

.hovereffect:hover p.icon-links a:hover,
.hovereffect:hover p.icon-links a:focus {
    color: #252d31;
}

.hovereffect h2,
.hovereffect p.icon-links a {
    -webkit-transition: -webkit-transform 0.35s;
    transition: transform 0.35s;
    -webkit-transform: translate3d(0,200%,0);
    transform: translate3d(0,200%,0);
    visibility: visible;
}

.hovereffect p.icon-links a span:before {
    display: inline-block;
    padding: 8px 10px;
    speak: none;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}


.hovereffect:hover .overlay,
.hovereffect:hover h2,
.hovereffect:hover p.icon-links a {
    -webkit-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
}

.hovereffect:hover h2 {
    -webkit-transition-delay: 0.05s;
    transition-delay: 0.05s;
}

.hovereffect:hover p.icon-links a:nth-child(3) {
    -webkit-transition-delay: 0.1s;
    transition-delay: 0.1s;
}

.hovereffect:hover p.icon-links a:nth-child(2) {
    -webkit-transition-delay: 0.15s;
    transition-delay: 0.15s;
}

.hovereffect:hover p.icon-links a:first-child {
    -webkit-transition-delay: 0.2s;
    transition-delay: 0.2s;
}
</style>

<div class="container">
  <div class="row"> 
    <div class="col-sm-8"> 
        <!-- 16:9 aspect ratio -->
        <div class="panel panel-default" style="margin-bottom: 28%;">
          <!-- Default panel contents -->
          <div class="panel-heading" style="color:black;"><h5>Today's Media Alerts</h5></div>
          <div class="panel-body">

            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      WFP IS ABOUT TO SOLVE MALNUTRITION PROBLEM
                  </button>
              </h5>
          </div>

          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">

                  <div class="hovereffect">
                    <img class="img-responsive" src="./image/nice.png" alt="picture" style="width: 100%;">
                    <div class="overlay">

                        <h2><div class="btn-group btn-group-md" style="height: 45px;">
                          <button type="button" class="btn btn-success">
                            80 <i class="fa fa-eye" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-primary">
                                40 <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-warning">
                                    <i class="fa fa-edit" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-default">
                                        <i class="fa fa-comments" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </div></h2>

                                        <p class="icon-links">
                                            <a href="#">
                                                <span class="fa fa-twitter"></span>
                                            </a>
                                            <a href="#">
                                                <span class="fa fa-facebook"></span>
                                            </a>
                                            <a href="#">
                                                <span class="fa fa-instagram"></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class=""><i><b>Source: </b></i>   <a href="www.wfp.org">www.wfp.org</a></div><br>
                                <div class="container">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>

                                
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              MPINA FURIOUS OVER HIGH SPEED PRICES 
                          </button>
                      </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body"><br>
                       
                      </div>
                      <div class="test">
                          <img src="./image/gazet.jpg" alt="picture" style="width: 100%;">
                          
                      </div>
                      <div><i><b>Source: </b></i>   <a href="www.wfp.org">www.wfp.org</a></div><br>

                  </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsethree" aria-expanded="false" aria-controls="collapseTwo">
                        IRRIGATION STRESSED AS AGRICULTURAL DYNAMO.
                    </button>
                </h5>
            </div>
            <div id="collapsethree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

               <div class="test">
                  <img src="./image/gazet1.png" alt="picture" style="width: 100%;">
                  <div class="overlay">My Name is John</div>
              </div>

              <div><i><b>Source: </b></i>   <a href="www.wfp.org">www.wfp.org</a></div><br>
              
              <div class="test">
                <img src="./image/gazet2.jpg" alt="picture" style="width: 100%;border-radius: 6px;">
                <div class="overlay">My Name is John</div>
            </div>

            <div><i><b>Source: </b></i>   <a href="www.wfp.org">www.wfp.org</a></div><br>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsenne" aria-expanded="false" aria-controls="collapseTwo">
           ACACIA TEAMS UP WITH / SOON IN DODOMA
       </button>
   </h5>
</div>
<div id="collapsenne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
  <div class="card-body">
    
   <img src="./image/gazet3.jpg" alt="picture" style="width: 100%;">
   <div><i><b>Source: </b></i>   <a href="www.wfp.org">www.wfp.org</a></div><br>
   
   <img src="./image/gazet4.jpg" alt="picture" style="width: 100%;border-radius: 6px;">
   <div><i><b>Source: </b></i>   <a href="www.wfp.org">www.wfp.org</a></div><br>
   <div class="container">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
</div>
</div>
</div>
</div>
<div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapseTwo">
         WFP IS ABOUT TO SOLVE MALNUTRITION PROBLEM
     </button>
 </h5>
</div>
<div id="collapsefive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
  <div class="card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
</div>
</div>
</div>
<div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapseTwo">
          WFP IS ABOUT TO SOLVE MALNUTRITION PROBLEM
      </button>
  </h5>
</div>
<div id="collapsesix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
  <div class="card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
</div>
</div>
</div>

</div>


</div>

 <div class="panel-footer"></div>
</div>

</div>

  <div class="col-sm-4" style="margin-top: 3%;">

    <a class="twitter-timeline" data-height="500" href="https://twitter.com/WFP_Tanzania">
                            Tweets by WFP_Tanzania
                        </a> 
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
   
    <div class="jumbotron jumbotron-fluid" style="border-radius: 9px;padding-top: 16px;">
    <div class="container">
               
               <button type="button" class="btn btn-primary btn-md btn-block" data-toggle="tooltip" title="Get to know the previous news" style="margin-bottom: 10px;"><h5><i class="fa fa-external-link faa-tada animated" aria-hidden="true"></i>  Previous News</h5></button>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

   <div class="card" style="width: 17rem;border-radius:10px;margin-left: 18px;">
  <div class="card-body">
  <p class="card-text">
    <marquee  behavior="scroll"  onmouseover="this.stop();"
           onmouseout="this.start();" direction="up">
    <pre>
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a>   
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a>  
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
  <a href="https://www.hrw.org/news/2018/08/08/burundi-call-renew-mandate-commission-inquiry ">&diams; Call to Renew the Mandate</a> 
    </pre>
</marquee>
  </p>
    
  </div>
</div>
  </div>
</div>
</div>

</div>
</div>
</div>
                    
<hr class="featurette-divider">

     <!-- FOOTER -->
@include('frames/footer')
                    