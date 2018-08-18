@include('frames/header')
<div class="container-fluid">
   <div class="row">

    @include('frames/sidebar')

    <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">


        <div class="row">
           <div class="col-12">
            <h1>
             <div class="container">               
              <div class="row">
                <div class="col-sm-6">
                   Innovation 
                   <div class="btn-group" role="group" aria-label="Button group with nested dropdown" >
                        <button type="button" class="btn btn-secondary" >
                             Order By
                        </button>

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            @if(Request::is('innovation'))

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

                           </div>
                      </div>
                 </div>

            </div>

            <div class="col-sm-6">
             <a class="btn btn-success" @if(Session::has('edit_story') || Session::has('edit_story_error')) href="{{URL::to('/addstory/')}}" @else data-toggle="modal" data-target="#add-story-modal" href="#"  @endif  role="button" style="margin-left: 20%;" >
              <i class="fa fa-plus-square faa-vertical faa-slow animated" aria-hidden="true"></i> Add New Post
         </a>


         <a class="btn btn-success" @if(Session::has('edit_story') || Session::has('edit_story_error')) href="{{URL::to('/addstory/')}}" @else data-toggle="modal" data-target="#add-announcement" href="#"  @endif  role="button">
           <i class="fa fa-envelope faa-shake faa-slow animated" aria-hidden="true"></i> Post Announcement
      </a>

 </div>
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
      Edit Post
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
      <label for="recipient-name" class="form-control-label"><strong>Image</strong></label><br>
      @if(Session::has('edit_story'))
      <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/large/'.Session::get('edit_story')->image) }}" alt="Card image cap">
      @elseif(Session::has('edit_story_error'))
      <img class="card-img-top img-fluid" src="{{ URL::to('imagecache/large/'.Session::get('edit_story_error')->image) }}" alt="Card image cap">
      @endif
      <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
 </div>

 <div class="form-group">
      <label for="message-text" class="form-control-label"><strong>Image Caption</strong></label>
      <textarea class="form-control simple-tinymce" name='caption' id="exampleTextarea" rows="5">
       @if(Session::has('edit_story'))
       {!! Session::get('edit_story')->caption !!}
       @elseif(Session::has('edit_story_error'))
       {!! Session::get('edit_story_error')->caption !!}
       @else
       {{ (old('caption')) }}
       @endif
  </textarea>

</div>
</div>
<div class="modal-footer">
     <button type="button" class="btn btn-danger" data-dismiss="modal">
      <i class="fa fa-times" aria-hidden="true"></i> Close
 </button>
 <button type="submit" class="btn btn-success">
      <i class="fa fa-paper-plane" aria-hidden="true"></i> Publish
 </button>
</div>
</div>
</div>
</div>



<div class="modal fade add-story-modal" id="add-announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
    <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">
      @if(Session::has('edit_story') || Session::has('edit_story_error'))
      Edit Announcement
      @else
      Publish Announcement
      @endif
 </h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
 </button>
</div>

<div class="modal-body">


     <div class="form-group">
      <label for="message-text" class="form-control-label"><strong>Announce</strong></label>
      <textarea class="form-control simple-tinymce" name='caption' id="exampleTextarea" rows="5">
       @if(Session::has('edit_story'))
       {!! Session::get('edit_story')->caption !!}
       @elseif(Session::has('edit_story_error'))
       {!! Session::get('edit_story_error')->caption !!}
       @else
       {{ (old('caption')) }}
       @endif
  </textarea>
</div>
</div>

<div class="modal-footer">
     <button type="button" class="btn btn-danger" data-dismiss="modal">
      <i class="fa fa-times" aria-hidden="true"></i> Close
 </button>
 <button type="submit" class="btn btn-success">
      <i class="fa fa-paper-plane" aria-hidden="true"></i> Post Announcement
 </button>
</div>
</div>
</div>
</div>


{{Form::token()}}
{{Form::close()}}<!-- end Add Story Modal -->
</div>
</div>


<div class="row">
 <div class="col-sm-7">
  <div class="row">
     <div class="container">
          <div class="grid">
             <div class="block two"> <img src="./image/p1.png" alt="picture" class="image" style="width: 100%;border-radius: 16px;">
               <div class="overlay">
                    <div class="text1"><a href="#"><p>hellow innovation</p></a></div>
                    <div class="text">
                         <div class="btn-group btn-group-md">
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
                               </div>
                          </div>
                     </div>
                </div>
                <div class="block two"> <img src="./image/p12.jpg" alt="picture" class="image" style="width: 100%;border-radius: 16px;">
                    <div class="overlay">
                         <div class="text">
                              <div class="btn-group btn-group-md">
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
                                    </div>
                               </div>
                          </div>
                     </div>
                     
                     <div class="block two"> <img src="./image/p8.jpg" alt="picture" class="image" style="width: 100%;border-radius: 16px;">
                         <div class="overlay">
                              <div class="text">
                                   <div class="btn-group btn-group-md">
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
                                         </div>
                                    </div>                    </div>
                               </div>
                               <div class="block two"> <img src="./image/p4.jpg" alt="picture" class="image" style="width: 100%;border-radius: 16px;">
                                   <div class="overlay">
                                    <div class="text">
                                        <div class="btn-group btn-group-md">
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
                                              </div>
                                         </div>
                                    </div>
                               </div>
                               <div class="block two"> <img src="./image/p3.jpg" alt="picture" class="image" style="width: 100%;border-radius: 16px;">
                                   <div class="overlay">
                                        <div class="text">
                                             <div class="btn-group btn-group-md">
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
                                                   </div>
                                              </div>                    </div>
                                         </div>
                                         <div class="block two"> <img src="./image/p5.jpg" alt="picture" class="image" style="width: 100%;border-radius: 16px;">
                                             <div class="overlay">
                                                  <div class="text">
                                                       <div class="btn-group btn-group-md">
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
                                                             </div>
                                                        </div>                    </div>
                                                   </div>
                                                   

                                              </div>
                                         </div>
                                    </div>
                               </div>


                               <style>

                               .grid {
                                -webkit-column-count: 3;
                                -webkit-column-gap: 10px;
                                -webkit-column-fill: auto;
                                -moz-column-count: 3;
                                -moz-column-gap: 10px;
                                -moz-column-fill: auto;
                                column-count: 2;
                                column-gap: 15px;
                                column-fill: auto;
                           }
                           .block {
                                background-color:#efe9e6;
                                display: block;
                                border-radius: 10px;
                                padding: 15px;
                                word-wrap: break-word;
                                margin-bottom: 20px;
                                -webkit-column-break-inside: avoid;
                                -moz-column-break-inside: avoid;
                                column-break-inside: avoid;
                                position: relative;
                                
                           }

                           .image {
                            display: block;
                            width: 100%;
                            height: auto;
                       }

                       .overlay {
                            position: absolute;
                            bottom: 100%;
                            left: 0;
                            right: 0;
                            overflow: hidden;
                            width: 100%;
                            height:0;
                            transition: .5s ease;
                            border-radius: 16px;
                            opacity: 1;
                            background: rgba(39, 42, 43, 0.8);
                       }

                       .block:hover .overlay {
                            bottom: 0;
                            height: 100%;
                       }

                       .text {
                            color: white;
                            font-size: 20px;
                            position: absolute;
                            top: 92%;
                            left: 50%;
                            -webkit-transform: translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);
                            transform: translate(-50%, -50%);
                            
                       }
                       .text1 a{
                            color: white;
                            font-size: 20px;
                            position: absolute;
                            top: 10%;
                            left: 20%;
                            text-align: center;
                       }
                  </style>



                  <div class="col-sm-5">
                      <div class="row"> 
                           <div class="container">
                              <div class="card text-center">
                                 <div class="card-header">
                                    <button type="button" class="btn btn-primary btn-md btn-block" data-toggle="tool" title="Get to know the previous news"><h5><i class="fa faa-pulse fa-lg  animated" aria-hidden="true">😍 Share your idea with us 😍</i></h5></button>  
                               </div>
                               <div class="card-body" style="background-color: black;height:500px;">
                                  <p id="demo" style="font-family: 'Gloria Hallelujah', cursive; font-size: 25px;color: yellow;line-height:40px;"></p>     
                             </div>
                        </div>

                        <div class="card-footer text-muted">
                         <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="text" class="sr-only"></label>
                                <textarea class="form-control" rows="3"  id="myInput" oninput="myFunction()" placeholder="Share IDEAs"></textarea>
                           </div>
                           <button type="submit" class="btn btn-primary  mb-2" style="width: 150px;">Save</button>
                      </form>
                 </div>
            </div>
       </div>
  </div>
</div>



<div class="col-12">
 <nav aria-label="Page navigation example" style="margin: 5% auto;">
    <ul class="pagination pagination-lg justify-content-center">
     <li class="page-item"><a class="page-link" href="#">Previous</a></li>
     <li class="page-item active"><a class="page-link" href="#">1</a></li>
     <li class="page-item"><a class="page-link" href="#">2</a></li>
     <li class="page-item"><a class="page-link" href="#">3</a></li>
     <li class="page-item"><a class="page-link" href="#">4</a></li>
     <li class="page-item"><a class="page-link" href="#">5</a></li>
     <li class="page-item"><a class="page-link" href="#">6</a></li>
     <li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul>
</nav>
</div>



</div>

<hr class="featurette-divider">

<!-- FOOTER -->
@include('frames/footer')

