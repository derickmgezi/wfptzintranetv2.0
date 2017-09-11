<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ asset('image/wfp_logo05.png') }}">

        <title>Cover Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        {{ Html::style('css/bootstrap.css') }}

        <!-- Custom styles for this template -->
        {{ Html::style('css/cover.css') }}

        <!-- Custom styles for signin template -->
        {{ Html::style('css/signin.css') }}

        <!-- Custom styles for Font Awesome template -->
        {{ Html::style('css/font-awesome.min.css') }}
    </head>

    <body>
        <div class="container-fluid clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="row inner">
                        <div class="col-lg-6 col-md-4 col-sm-12">
                            <h3 class="">
<!--                                <img class="img-fluid" src="{{ URL::to('image/wfp_logo08.png') }}" alt="Responsive image" alt="Generic placeholder image" width="35" data-src="holder.js/25x25/auto"> 
                                intranet.tz-->
                            </h3>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <nav class="nav">
<!--                                <a target="_blank" class="nav-link" href="http://go.wfp.org">WFP Go</a>
                                <a target="_blank" class="nav-link" href="http://mfapps.wfp.org">WINGS</a>
                                <a target="_blank" class="nav-link" href="http://mail.wfp.org">WEB Mail</a>
                                <a target="_blank" class="nav-link" href="http://info.wfp.org">WFP Info</a>
                                <a target="_blank" class="nav-link" href="http://pace.wfp.org">PACE</a>-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="inner cover">
                <div class="row align-items-center">
                    <div class="col-md-3 col-xl-3 hidden-sm-down">

                    </div>
                    <div class="col-md-6 col-xl-5">

                        <div class="col-md-12 col-lg-12">
<!--                            <h1 class="cover-heading">
                                Welcome 
                                @if(Auth::check())
                                <i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->firstname}}
                                @endif

                            </h1>-->
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <p class="lead text-justify">
<!--                                tznewsalert.wfp.org offers you the best WFP news coverage in Tanzania, 
                                by making sure you are well informed of what is happening around WFP.-->
                            </p>
                        </div>

                        <div class="col-md-12 col-lg-12">
<!--                            <p class="lead">
                                <a href="{{URL::to('/home')}}" class="btn btn-lg btn-secondary">Continue <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i></a>
                            </p>-->
                        </div>

                    </div>
                    <div class="col-md-3 col-xl-4 hidden-sm-down">
                        <a class="twitter-timeline" data-height="500" href="https://twitter.com/WFP_Tanzania">
                            Tweets by WFP_Tanzania
                        </a> 
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade loginModal modal-position" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title" id="exampleModalLabel">
                                <img class="img-fluid" src="{{ URL::to('image/wfp_logo08.png') }}" alt="Responsive image" alt="Generic placeholder image" width="50" data-src="holder.js/25x25/auto"> wazo.tz.net
                            </h3>
                        </div>
                        <div class="modal-body" style="background-color: ">
                            {{ Form::open(array('url' => '/signin','class' => 'form-signin','role' => 'form')) }}
                            <label for="inputUsername" class="sr-only">Username</label>
                            <input type="text" name="username" value="{{(old('username'))? e(old('username')):''}}" id="inputUserName" class="form-control" placeholder="Username eg. john.doe" required autofocus>
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" name="password" value="{{(old('password'))? e(old('password')):''}}" id="inputPassword" class="form-control" placeholder="Password" required>
                            <button class="btn btn-lg btn-success btn-block" type="submit"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Login</button>
                            {{Form::token()}}
                            {{ Form::close() }}

                            @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                </button>
                                <i class="fa fa-exclamation " aria-hidden="true"></i> {{Session::get('error')}}
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="mastfoot">
                <div class="inner">
                    <p>Created by <a href="https://getbootstrap.com">World Food Programme</a>, Tanzania CO <a href="https://twitter.com/mdo">@2017</a>.</p>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="./js/ie10-viewport-bug-workaround.js"></script>
        @if(!Auth::check())
        <script>$('#loginModal').modal('show');</script>
        @endif
    </body>
</html>
