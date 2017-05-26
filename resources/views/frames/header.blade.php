
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Dashboard Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        {{ Html::style('css/bootstrap.css') }}

        <!-- Custom styles for Dashboard Template -->
        {{ Html::style('css/dashboard.css') }}

        <!-- Custom styles for Caousel template -->
        {{ Html::style('css/carousel.css') }}

        <!-- Custom styles for Font Awesome template -->
        {{ Html::style('css/font-awesome.min.css') }}

        {{HTML::script("js/tinymce.min.js")}}

        <script>
            tinymce.init({
                selector: 'textarea',
                theme: 'modern',
                menubar: false,
                plugins: [
                    'advlist autolink lists link charmap hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality',
                    'paste textcolor colorpicker textpattern toc'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                image_advtab: true,
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        </script>

    </head>

    <body data-spy="scroll" data-target="#news-navbar">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-primary">
            <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}"><i class="fa fa-spinner fa-spin"></i> tznewsalert.wfp.org</a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a target="_blank" class="nav-link" href="http://go.wfp.org">WFP Go<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" class="nav-link" href="http://mfapps.wfp.org">WINGS</a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" class="nav-link" href="http://mail.wfp.org">WEB Mail</a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" class="nav-link" href="http://pace.wfp.org">PACE</a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" class="nav-link" href="http://info.wfp.org">WFP Info</a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0" action="{{URL::to('/search')}}" method="post">
                    {{ csrf_field() }}
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </nav>
