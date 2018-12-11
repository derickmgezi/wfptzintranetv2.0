
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
        {{ Html::style('css/my-css.css') }}

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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <!-- Select2-Bootstrap-Themes core CSS -->
        {{ Html::style('css/select2-bootstrap.css') }}
        <!-- {{ Html::style('css/select2-bootstrap4.css') }} -->

        <!-- XZOOM JQUERY PLUGIN  -->
        {{HTML::script("js/jquery.min.js")}}

        <!-- jQuery-->
        {{HTML::script("js/jquery.min.js")}}

        <!-- Custom Java Script styles for Tinymce Text Editor -->
        {{HTML::script("js/tinymce.min.js")}}
        
        <!-- Vue.js library -->
        {{HTML::script("js/vue.js")}}

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.6.6/tinymce.min.js"></script> -->

        <!-- Custom Java Script styles for My Tinymce Text Editor -->
        <!-- <script src="http://wazo.wfp.org/js/mytinymce.js"></script> -->


        <script>
            var editor_config = {
                path_absolute: "{{ URL::to('/') }}/",
                selector: ".complete-tinymce",
                skin: 'charcoal',
                height: 300,
                menubar: true,
                theme: 'modern',
                browser_spellcheck: true,
                plugins: [
                    "advlist autolink lists link image media charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                toolbar2: "preview | forecolor backcolor | emoticons | codesample",
                relative_urls: true,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                }
            };

            tinymce.init(editor_config);

            var editor_config = {
                path_absolute: "{{ URL::to('/') }}/",
                selector: ".simple-tinymce",
                skin: 'charcoal',
                height: 100,
                menubar: false,
                theme: 'modern',
                browser_spellcheck: true,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "insertfile undo redo | alignleft aligncenter alignright alignjustify | outdent indent | bold italic | styleselect |  bullist numlist | emoticons | forecolor backcolor | codesample | link | preview",
                relative_urls: true,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                }
            };

            tinymce.init(editor_config);
        </script>

    </head>

    <body data-spy="scroll" data-target="#news-navbar">
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

                <div class="navbar-brand">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-fluid rounded-circle" src="{{ strlen(Auth::user()->image) != 0? url('/storage/thumbnails/'.Auth::user()->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="29" data-src="holder.js/25x25/auto"> 
                            {{ Auth::user()->firstname.' '.Auth::user()->secondname}} <i class="fa fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if(Auth::user()->title != 'Administrator')
                            <a class="dropdown-item" href="{{URL::to('/view_user_bio/'.Auth::user()->id)}}">
                                <i class="fa fa-user-circle" aria-hidden="true"></i> Manage Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{URL::to('/signout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </div>
                </div>

                <!--                @if(Auth::user()->title != 'Administrator')
                                {{Form::open(array('url' => '/search','class' => 'form-inline mt-2 mt-md-0','role' => 'form'))}}
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                {{Form::close()}}
                                @endif-->
            </div>
        </nav>

        @if(Session::has('view_user_bio'))
        <div class="modal fade" id="user-bio-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">{{ App\user::find(Session::get('view_user_bio'))->firstname }}'s Bio</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-inverse text-white">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid img-thumbnail rounded-circle" src="{{ strlen(App\User::find(Session::get('view_user_bio'))->image) != 0? url('/storage/thumbnails/'.App\User::find(Session::get('view_user_bio'))->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" src="" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
                                <h6 class="display-4">{{ App\user::find(Session::get('view_user_bio'))->firstname.' '.App\user::find(Session::get('view_user_bio'))->secondname }}</h6>
                            </div>
                            <div class="col-12">
                                <hr style="background-color: white">
                                @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0 &&  Auth::user()->id == Session::get('view_user_bio'))
                                <div class="alert alert-info" role="alert">
                                    <strong>Heads up!</strong> Please update your Bio.
                                </div>
                                @elseif(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0)
                                <div class="alert alert-info" role="alert">
                                    <strong>{{ App\user::find(Session::get('view_user_bio'))->firstname.' '.App\user::find(Session::get('view_user_bio'))->secondname }}'s</strong> Bio hasn't been updated.
                                </div>
                                @else
                                <p class="text-justify">{!! App\user::find(Session::get('view_user_bio'))->bio !!}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(Auth::user()->id == Session::get('view_user_bio'))
                        @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0)
                        <a role="button" class="btn btn-success" href="{{URL::to('/add_bio/'.Auth::user()->id)}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Bio
                        </a>
                        @else
                        <a role="button" class="btn btn-warning" href="{{URL::to('/edit_bio/'.Auth::user()->id)}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Bio
                        </a>
                        @endif
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-close" aria-hidden="true"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @elseif(Session::has('add_user_bio'))
        <div class="modal fade" id="user-bio-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{ Form::open(array('url' => '/update_bio/'.Auth::user()->id,'enctype' => "multipart/form-data",'role' => 'form')) }}
                    <div class="modal-header bg-faded">
                        <h2 class="modal-title" id="exampleModalLabel">Update Your Bio</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="image"><strong>Change Image</strong></label><br>
                                    <img class="img-fluid img-thumbnail" alt="Responsive image" src="{{ url('/storage/'.App\User::find(Session::get('add_user_bio'))->image) }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
                                    <hr style="background-color: white">
                                    @if(old('image'))
                                    <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
                                    @elseif(Session::has('add_user_bio'))
                                    <input type="file" name='image' value="{{ App\User::find(Session::get('add_user_bio'))->image }}" id="image" class="form-control">
                                    @endif
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
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Bio
                        </button>
                        @else
                        <button type="submit" role="button" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Bio
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
        <!-- Start of Announcement Modal -->
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
                            "Survivors need specialized assistance. But all humanitarian respondents and civil society have the responsibility to protect and support survivors"
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
