
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="{{ asset('image/wfp_logo05.png') }}">

        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">

        <!--  <script src="//code.jquery.com/jquery.min.js"></script> -->

        <title>Wazo</title>

        <!-- My CSS -->
        {{ Html::style('css/mycss.css') }}

        <!-- Bootstrap core CSS -->
        {{ Html::style('css/bootstrap.css') }}

        <!-- Custom styles for Dashboard Template -->
        {{ Html::style('css/dashboard.css') }}

        <!-- Custom styles for Caousel template -->
        {{ Html::style('css/carousel.css') }}

        <!-- Custom styles for Font Awesome template -->
        {{ Html::style('css/font-awesome.min.css') }}

        <!-- Custom styles for Font Awesome animation template -->
        {{ Html::style('css/font-awesome-animation.css') }}

        <!-- Custom styles for sticky footer template -->
        {{ Html::style('css/sticky-footer-navbar.css') }}

        <!-- Custom styles for SB Admin -->

        {{ Html::style('css/sb-admin.css') }}

        <!-- for zooming image-->
        {{ Html::style('css/xzoom.css') }}

        <!-- Animated CSS Library from https://daneden.github.io/animate.css/ -->
        {{ Html::style('css/animate.css') }}

        <!-- Select2 core CSS -->
        {{ Html::style('css/select2.min.css') }}

        <!-- Select2-Bootstrap-Themes core CSS -->
        {{ Html::style('css/select2-bootstrap.css') }}
        {{-- {{ Html::style('css/select2-bootstrap4.css') }} --}}

        <!-- XZOOM JQUERY PLUGIN  -->
        {{HTML::script("js/jquery.min.js")}}

        <!-- jQuery-->
        {{HTML::script("js/jquery.min.js")}}

        <!-- Custom Java Script styles for Tinymce4 Text Editor -->
        <!-- {{HTML::script("js/tinymce.min.js")}} -->
        
        <!-- Vue.js library -->
        {{HTML::script("js/vue.js")}}

        <!-- Custom Java Script styles for My Tinymce Text Editor -->
        <!-- {{HTML::script("js/mytinymce.js")}} -->

        <!-- Custom Java Script CDN styles for Tinymce5 Text Editor -->
        <script src="https://cdn.tiny.cloud/1/wyyhqvqudtv7t15hz9pi66r0w72zwogypai1cfhf1s7ba4co/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Custom Java Script styles for Tinymce5 Text Editor -->
        <!-- {{HTML::script("js/tinymce5.min.js")}} -->
        <script >
            var editor_config = {
                path_absolute: "{{ URL::to('/') }}/",
                selector: 'textarea.complete-tinymce',
                height: 500,
                relative_urls: false,
                plugins: [
                    "advlist autolink lists link image media charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                toolbar2: "preview | forecolor backcolor | emoticons | codesample",
                file_picker_callback: function (callback, value, meta) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                    if (meta.filetype == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.openUrl({
                        url: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no",
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    });
                }
            };

        tinymce.init(editor_config); 
        
        var editor_config = {
                path_absolute: "{{ URL::to('/') }}/",
                selector: 'textarea.simple-tinymce',
                height: 200,
                menubar: false,
                browser_spellcheck: true,
                relative_urls: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "insertfile undo redo | styleselect | outdent indent | bold italic |  bullist numlist | emoticons | forecolor backcolor | codesample | link | preview",
                file_picker_callback: function (callback, value, meta) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                    if (meta.filetype == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.openUrl({
                        url: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no",
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    });
                }
            };

        tinymce.init(editor_config); 
        </script>

    </head>

    <body class="container" data-spy="scroll" data-target="#news-navbar">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-primary">
            <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}">
                <img class="img-fluid" src="{{ URL::to('image/wfp_logo080.png') }}" alt="Responsive image" alt="Generic placeholder image" width="35" data-src="holder.js/25x25/auto"> wazo
            </a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    @if(Auth::user()->title != 'Administrator')
                    <li class="nav-item">
                        <a class="nav-link active" href="{{URL::to('/home')}}">
                            | <i class="fa fa-home fa-lg {{((Request::is('home'))? 'faa-tada faa-slow animated':'')}}" aria-hidden="true"></i> <small>Home</small> <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{URL::to('/news')}}">
                            | <i class="fa fa-television fa-lg {{((Request::is('news'))? 'faa-tada faa-slow animated':'')}}" aria-hidden="true"></i> <small>WFP Updates</small> <span class="sr-only">(current)</span> @if(session('unreadnewsupdates')>0)<span class="badge" style="background-color: red;" data-toggle="tooltip" data-placement="bottom" title="{{ session('unreadnewsupdates') }} unread News Updat{{ session('unreadnewsupdates') != 1?"es":"e" }}">{{ session('unreadnewsupdates') }}+</span>@endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{URL::to('/storiyangu')}}">
                            | <i class="fa fa-commenting-o fa-lg {{((Request::is('storiyangu'))? 'faa-tada faa-slow animated':'')}}" aria-hidden="true"></i> <small>Stori Yangu</small> <span class="sr-only">(current)</span> @if(session('unreadstories')>0)<span class="badge" style="background-color: red;" data-toggle="tooltip" data-placement="bottom" title="{{ session('unreadstories') }} unread Stor{{ session('unreadstories') != 1?"ies":"y" }}">{{ session('unreadstories') }}+</span>@endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{URL::to('/newsalerts')}}">
                            | <i class="fa fa-newspaper-o fa-lg {{((Request::is('newsalerts'))? 'faa-tada faa-slow animated':'')}}" aria-hidden="true"></i> <small>News Alerts</small> <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link active" href="{{URL::to('/innovation')}}">
                            | <i class="fa fa-lightbulb-o fa-lg {{Request::is('innovation')}} 'faa-tada faa-slow animated':'')}}" aria-hidden="true"></i> <small>Innovation Corner</small> <span class="badge" style="background-color: red;">99+</span>
                        </a>
                    </li> -->
                    @endif
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-fluid rounded-circle" src="{{ strlen(Auth::user()->image) != 0? url('/storage/thumbnails/'.Auth::user()->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="29" data-src="holder.js/25x25/auto"> 
                                {{ Auth::user()->firstname.' '.Auth::user()->secondname}} <i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if(Auth::user()->title != 'Administrator')
                                <a class="dropdown-item" href="{{URL::to('/view_user_bio/'.Auth::user()->id)}}">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i> My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                @endif
                                @if(Auth::user()->department == 'IT')
                                <a class="dropdown-item" href="{{URL::to('/manage')}}">
                                    <i class="fa fa-users" aria-hidden="true"></i> Manage Users
                                </a>
                                {{-- <div class="dropdown-divider"></div> --}}
                                @endif
                                {{-- <a class="dropdown-item" href="{{URL::to('/signout')}}"><i class="fa fa-sign-out"></i> Logout</a> --}}
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{URL::to('/signout')}}">
                            <i class="fa fa-fw fa-sign-out"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        @if(Session::has('view_user_bio'))
        <div class="modal fade" id="user-bio-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{ App\user::find(Session::get('view_user_bio'))->firstname }}'s Profile</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <div class="modal-body bg-inverse text-white">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid img-thumbnail rounded-circle" src="{{ strlen(App\User::find(Session::get('view_user_bio'))->image) != 0? url('/storage/thumbnails/'.App\User::find(Session::get('view_user_bio'))->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" src="" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
                                
                                <h2 class="lead">{{ App\user::find(Session::get('view_user_bio'))->firstname.' '.App\user::find(Session::get('view_user_bio'))->secondname }}</h2>
                                
                                <h2 class="lead">{{ App\user::find(Session::get('view_user_bio'))->title }}</h2>

                                @if(Auth::user()->id == Session::get('view_user_bio'))
                                    @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0)
                                        <a role="button" class="btn btn-sm btn-warning" href="{{URL::to('/add_bio/'.Auth::user()->id)}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </a>
                                    @else
                                        <a role="button" class="btn btn-sm btn-warning" href="{{URL::to('/edit_bio/'.Auth::user()->id)}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                        </a>
                                    @endif
                                @endif
                                
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-close" aria-hidden="true"></i> Close
                                </button>
                            </div>
                            <div class="col-12">

                                <hr style="background-color: white">

                                <div class="row no-gutters">
                                    <div class="col-2 offset-2 text-center"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    <div class="col-8 text-left lead">{{ App\user::find(Session::get('view_user_bio'))->email }}</div>
                                </div>

                                {{-- <div class="row no-gutters">
                                    <div class="col-2 offset-2 text-center font-weight-bold">VSAT</div>
                                    <div class="col-8 text-left">1340-7387</div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-2 offset-2 text-center"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                    <div class="col-8 text-left">+255-692-197-387</div>
                                </div> --}}

                                <div class="row no-gutters">
                                    <div class="col-2 offset-2 text-center"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="col-8 text-left lead">
                                        {{ App\user::find(Session::get('view_user_bio'))->dutystation }} {{ strlen(App\user::find(Session::get('view_user_bio'))->country) != 0?', '.App\user::find(Session::get('view_user_bio'))->country:'' }} {{ strlen(App\user::find(Session::get('view_user_bio'))->region) != 0 ?', '.App\user::find(Session::get('view_user_bio'))->region:'' }}
                                    </div>
                                </div>

                                @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) != 0 || strlen(App\user::find(Session::get('view_user_bio'))->emergencycontactform) != 0)
                                    <hr style="background-color: white">

                                    @if(strlen(App\user::find(Session::get('view_user_bio'))->emergencycontactform) != 0)
                                        <div class="row no-gutters">
                                            <div class="col-2 offset-2 text-center"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                                            <div class="col-8 text-left lead">
                                                <a target="_blank" href="{{ url('/storage/'.App\user::find(Session::get('view_user_bio'))->emergencycontactform) }}">
                                                    <u>Emergency Contacts</u>
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) != 0)
                                        <div class="row no-gutters">
                                            <div class="col-2 offset-2 text-center"><i class="fa fa-bold" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i> <i class="fa fa-opera" aria-hidden="true"></i></div>
                                            <div class="col-8 text-left">{!! App\user::find(Session::get('view_user_bio'))->bio !!}</div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                        @if(Auth::user()->id == Session::get('view_user_bio'))
                        @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0)
                        <a role="button" class="btn btn-success" href="{{URL::to('/add_bio/'.Auth::user()->id)}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile
                        </a>
                        @else
                        <a role="button" class="btn btn-warning" href="{{URL::to('/edit_bio/'.Auth::user()->id)}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile
                        </a>
                        @endif
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-close" aria-hidden="true"></i> Close
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
        @elseif(Session::has('add_user_bio'))
        <div class="modal fade" id="user-bio-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{ Form::open(array('url' => '/update_bio/'.Auth::user()->id,'enctype' => "multipart/form-data",'role' => 'form')) }}
                    <div class="modal-header bg-faded">
                        <h4 class="modal-title" id="exampleModalLabel">Update Your Profile</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <img class="img-fluid img-thumbnail  rounded-circle" alt="Responsive image" src="{{ strlen(App\User::find(Session::get('add_user_bio'))->image) != 0? url('/storage/thumbnails/'.App\User::find(Session::get('add_user_bio'))->image):url('/image/default_profile_picture.jpg') }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto"><br>
                                    
                                    <label for="image"><strong>Change photo</strong></label>
                                    
                                    @if(old('image'))
                                    <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control-file">
                                    @elseif(Session::has('add_user_bio'))
                                    <input type="file" name='image' value="{{ App\User::find(Session::get('add_user_bio'))->image }}" id="image" class="form-control-file">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title"><strong>Change Title</strong></label>
                                    
                                    @if(old('title'))
                                    <input type="text" name='title' value="{{ (old('title')) }}" id="title" class="form-control">
                                    @elseif(Session::has('add_user_bio'))
                                    <input type="text" name='title' value="{{ App\User::find(Session::get('add_user_bio'))->title }}" id="title" class="form-control">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title"><strong>Upload Emergency Contact Form</strong></label>
                                    
                                    @if(old('title'))
                                    <input type="file" name='emergencycontactform' value="{{ (old('emergency_contact_form')) }}" id="title" class="form-control">
                                    @elseif(Session::has('add_user_bio'))
                                    <input type="file" name='emergencycontactform' value="{{ App\User::find(Session::get('add_user_bio'))->emergencycontactform }}" id="title" class="form-control-file">
                                    @endif
                                    <small id="emailEmergencycontactform" class="form-text text-muted">
                                        Make sure that the Emergency Contact Form is filled, signed and scaned to your computer.<br>
                                        Go to the <strong class="text-primary">Resource TAB (located on the left side bar)</strong> then <strong class="text-primary">HR resources</strong> to access the Emergecy Contact Form.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="headerText"><strong>Update Bio</strong></label>
                                    @if(old('bio'))
                                    <textarea class="simple-tinymce form-control" name='bio' id="exampleTextarea" rows="10">{{ (old('description')) }}</textarea>
                                    @elseif(Session::has('add_user_bio'))
                                    <textarea class="simple-tinymce form-control" name='bio' id="exampleTextarea" rows="10">{{ App\User::find(Session::get('add_user_bio'))->bio }}</textarea>
                                    @endif
                                </div>
                                @if(Session::has('add_bio_error'))
                                <div class="alert alert-danger" role="alert">
                                    <small><strong>{{$errors->first()}}</strong></small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-faded">
                        @if(Auth::user()->id == Session::get('add_user_bio'))
                        @if(strlen(strip_tags(App\user::find(Session::get('add_user_bio'))->bio)) == 0)
                        <button type="submit" role="button" class="btn btn-success">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile
                        </button>
                        @else
                        <button type="submit" role="button" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile
                        </button>
                        @endif
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-close" aria-hidden="true"></i> Close
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @endif
        
        @if(!Session::has('announcement'))
        <!-- Start of Announcement Modal
        <div class="modal hide fade in" id="announcementModal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: orange;">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-bullhorn faa-tada animated fa-lg" aria-hidden="true"></i> Gender Based Violence Facts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <div class="modal-body" style="background: url('../image/Copyright WFP Jen Kunz.jpg') no-repeat center center fixed;"> --}}
                    <div class="modal-body">
                        <img class="img-fluid" src="{{ URL::to('image/stop violence against women.jpg') }}">
                        <p class="font-weight-bold font-italic">
                            "Addressing GBV saves lives. Sexual violence is often fatal and its consequences prevent victims form reaching life-saving services"
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{URL::to('/announcement')}}" class="btn btn-success"><i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i> Now I am aware</a>
                        {{-- <button type="button" class="btn btn-primary">Save Announcements</button> --}}
                    </div>
                </div>
            </div>
        </div><!-- End of Announcement Modal -->
        @endif
