
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

        <!-- Custom Java Script styles for Tinymce Text Editor -->
        {{HTML::script("js/tinymce.min.js")}}

        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wyyhqvqudtv7t15hz9pi66r0w72zwogypai1cfhf1s7ba4co"></script>

        <!-- Custom Java Script styles for My Tinymce Text Editor -->
        {{HTML::script("js/mytinymce.js")}}

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
                        <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            | <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i> {{ Auth::user()->firstname}} <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if(Auth::user()->title != 'Administrator')
                            <a class="dropdown-item" href="{{URL::to('/view_user_bio/'.Auth::user()->id)}}"><i class="fa fa-eye"></i> View Bio</a>
                            <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{URL::to('/signout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </li>
                    @endif
                </ul>

                <!--                <a class="navbar-brand">
                                    <img class="img-fluid" src="{{ strlen(Auth::user()->image) != 0? url('/storage/'.Auth::user()->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" alt="Generic placeholder image" width="{{ strlen(Auth::user()->image) != 0? '29':'35' }}" data-src="holder.js/25x25/auto">
                                </a>-->

                @if(Auth::user()->title != 'Administrator')
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
                @endif
            </div>
        </nav>
