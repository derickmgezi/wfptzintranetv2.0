
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

        <!-- Custom Java Script styles for Tinymce Text Editor -->
        {{HTML::script("js/tinymce.min.js")}}

        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wyyhqvqudtv7t15hz9pi66r0w72zwogypai1cfhf1s7ba4co"></script>
        
        <script>
            var editor_config = {
              path_absolute : "{{ URL::to('/') }}/",
              selector: "textarea",
              menubar: false,
              plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
              relative_urls: true,
              file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                  cmsURL = cmsURL + "&type=Images";
                } else {
                  cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                  file : cmsURL,
                  title : 'Filemanager',
                  width : x * 0.8,
                  height : y * 0.8,
                  resizable : "yes",
                  close_previous : "no"
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
                <img class="img-fluid" src="{{ URL::to('image/wfp_logo08.png') }}" alt="Responsive image" alt="Generic placeholder image" width="35" data-src="holder.js/25x25/auto"> intranet.tz
            </a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
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
                    </li>
                </ul>

                <a class="navbar-brand">
                    <img class="img-fluid" src="{{ strlen(Auth::user()->image) != 0? url('/storage/'.Auth::user()->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="{{ strlen(Auth::user()->image) != 0? '27':'35' }}" data-src="holder.js/25x25/auto">
                </a>

                <div class="btn-group navbar-nav navbar-brand">
                    <button type="button" class="btn btn-warning">{{ Auth::user()->firstname}}</button>
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{URL::to('/view_user_bio/'.Auth::user()->id)}}"><i class="fa fa-eye"></i> View Bio</a>
<!--                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{URL::to('/signout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </div>
                
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
            </div>
        </nav>
