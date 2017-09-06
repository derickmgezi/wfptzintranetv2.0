
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ asset('image/wfp_logo05.png') }}">

        <title>Dashboard Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        {{ Html::style('css/bootstrap.css') }}

        <!-- Custom styles for Dashboard Template -->
        {{ Html::style('css/dashboard.css') }}

        <!-- Custom styles for Caousel template -->
        {{ Html::style('css/carousel.css') }}

        <!-- Custom styles for Font Awesome template -->
        {{ Html::style('css/font-awesome.min.css') }}

        <!-- Custom styles for sticky footer template -->
        {{ Html::style('css/sticky-footer-navbar.css') }}

        <!-- Custom styles for SB Admin -->
        {{ Html::style('css/sb-admin.css') }}

        <!-- Custom Java Script styles for Tinymce Text Editor -->
        {{HTML::script("js/tinymce.min.js")}}

        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wyyhqvqudtv7t15hz9pi66r0w72zwogypai1cfhf1s7ba4co"></script>

        <!-- Custom Java Script styles for My Tinymce Text Editor -->
        <!--        {{HTML::script("js/mytinymce.js")}}-->

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
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
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
                <img class="img-fluid" src="{{ URL::to('image/wfp_logo08.png') }}" alt="Responsive image" alt="Generic placeholder image" width="35" data-src="holder.js/25x25/auto"> wazo
            </a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <!--                    <li class="nav-item active">
                                            <a target="_blank" class="nav-link" href="http://go.wfp.org">WFP Go<span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item active">
                                            <a target="_blank" class="nav-link" href="http://mfapps.wfp.org">WINGS</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a target="_blank" class="nav-link" href="http://mail.wfp.org">WEB Mail</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a target="_blank" class="nav-link" href="http://pace.wfp.org">PACE</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a target="_blank" class="nav-link" href="http://info.wfp.org">WFP Info</a>
                                        </li>-->
                    @if(Auth::user()->title != 'Administrator')
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('home'))? 'active':'')}}" href="{{URL::to('/home')}}">
                            | <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> <small>Comms</small> <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('it'))? 'active':'')}}" href="{{URL::to('/it')}}">
                            | <i class="fa fa-laptop fa-lg" aria-hidden="true"></i> <small>IT</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('finance'))? 'active':'')}}" href="{{URL::to('/finance')}}">
                            | <i class="fa fa-bank" aria-hidden="true"></i> <small>Finance</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('administration'))? 'active':'')}}" href="{{URL::to('/administration')}}">
                            | <i class="fa fa-cog fa-lg" aria-hidden="true"></i> <small>Admin</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('hr'))? 'active':'')}}" href="{{URL::to('/hr')}}">
                            | <i class="fa fa-male fa-lg" aria-hidden="true"></i> <small>HR</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('supplychain'))? 'active':'')}}" href="{{URL::to('/supplychain')}}">
                            | <i class="fa fa-truck fa-lg" aria-hidden="true"></i> <small>Supply Chain</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{((Request::is('programme'))? 'active':'')}}" href="{{URL::to('/programme')}}">
                            | <i class="fa fa-file-text fa-lg" aria-hidden="true"></i> <small>Programme</small>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link {{((Request::is('dodoma') || Request::is('kibondo'))? 'active':'')}}" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            | <i class="fa fa-building-o fa-lg" aria-hidden="true"></i> 
                            @if(Request::is('dodoma')){{ 'Dodoma' }}@elseif(Request::is('kibondo')){{ 'Kibondo' }}@elseif(Request::is('kasulu')){{ 'Kasulu' }}@elseif(Request::is('kigoma')){{ 'Kigoma' }}@elseif(Request::is('isaka')){{ 'Isaka' }}@else {{ 'Suboffice' }} @endif <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{URL::to('/dodoma')}}">
                                <i class="fa fa-building-o fa-lg" aria-hidden="true"></i> Dodoma
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{URL::to('/kibondo')}}">
                                <i class="fa fa-building-o fa-lg" aria-hidden="true"></i> Kibondo
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{URL::to('/kasulu')}}">
                                <i class="fa fa-building-o fa-lg" aria-hidden="true"></i> Kasulu
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{URL::to('/kigoma')}}">
                                <i class="fa fa-building-o fa-lg" aria-hidden="true"></i> Kigoma
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{URL::to('/isaka')}}">
                                <i class="fa fa-building-o fa-lg" aria-hidden="true"></i> Isaka
                            </a>
                        </div>
                    </li>
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
                            <a class="dropdown-item" href="{{URL::to('/view_user_bio/'.Auth::user()->id)}}"><i class="fa fa-eye"></i> View Bio</a>
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