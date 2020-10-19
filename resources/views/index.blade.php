<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ asset('image/wfp_logo05.png') }}">

        <title>Login into Wazo</title>

        <!-- Bootstrap core CSS -->
        {{ Html::style('css/bootstrap.css') }}

        <!-- Custom styles for this template -->
        {{ Html::style('css/cover.css') }}

        <!-- Custom styles for signin template -->
        {{ Html::style('css/signin.css') }}

        <!-- Custom styles for Font Awesome template -->
        {{ Html::style('css/font-awesome.min.css') }}
        
        <!-- Vue.js library -->
        {{HTML::script("js/vue.js")}}
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

        <div class="container-fluid" id="index">

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
<!--                        <a class="twitter-timeline" data-height="500" href="https://twitter.com/WFP_Tanzania">
                            Tweets by WFP_Tanzania
                        </a> 
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>-->
                    </div>
                </div>
            </div>

            <!-- New Login Modal -->
            <div class="modal fade loginModal modal-position" data-backdrop="static" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title" id="exampleModalLabel">
                                <img class="img-fluid" src="{{ URL::to('image/wfp_logo09.png') }}" alt="Responsive image" alt="Generic placeholder image" width="50" data-src="holder.js/25x25/auto"> wazo.tza.wfp.org
                            </h3>
                        </div>
                        <div class="modal-body" style="background-color: ">
                            <i v-if="logingin" class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: black"></i>

                            <a v-else v-on:click="login()" href="{{URL::to('/logon')}}" class="btn btn-lg btn-success btn-block"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Login with Single sign-on</a>
                            <br>
                            @if(Session::has('error'))
                            <div v-if="!logingin" class="alert alert-danger alert-dismissible fade show" role="alert">
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
            
            <!-- Old Login Modal -->
<!--            <div class="modal fade loginModal modal-position" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title" id="exampleModalLabel">
                                <img class="img-fluid" src="{{ URL::to('image/wfp_logo09.png') }}" alt="Responsive image" alt="Generic placeholder image" width="50" data-src="holder.js/25x25/auto"> wazo.wfp.org
                            </h3>
                        </div>
                        <div class="modal-body" style="background-color: ">
                            <i v-if="logingin" class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: black"></i>
                            
                            {{ Form::open(array('url' => '/signin','class' => 'form-signin','role' => 'form', 'v-else' => 'logingin')) }}
                            <label for="inputUsername" class="sr-only">Username</label>
                            <input type="text" name="username" value="{{(old('username'))? e(old('username')):''}}" id="inputUserName" class="form-control" placeholder="Username eg. john.doe" autofocus>
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" name="password" value="{{(old('password'))? e(old('password')):''}}" id="inputPassword" class="form-control" placeholder="Password">
                            <button v-on:click="login()" class="btn btn-lg btn-success btn-block" type="submit"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Login</button>
                            {{Form::token()}}
                            {{ Form::close() }}

                            @if(Session::has('error'))
                            <div v-if="!logingin" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                </button>
                                <i class="fa fa-exclamation " aria-hidden="true"></i> {{Session::get('error')}}
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>-->

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
        {{HTML::script("js/jquery-3.1.1.slim.min.js")}}
        
        <!-- jQuery Library -->
        {{HTML::script("js/jquery-3.3.1.min.js")}}
        
        <!-- Tether Library -->
        {{HTML::script("js/tether.min.js")}}
        
        <!-- Bootstrap Library -->
        {{HTML::script("js/bootstrap.min.js")}}

        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        {{HTML::script("js/holder.min.js")}}
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        {{HTML::script("js/ie10-viewport-bug-workaround.js")}}
        
        <script>
            var vm = new Vue ({
                el:"#index",
                data:{
                    logingin:false
                },
                methods:{
                    login: function(){
                        this.logingin = true;
                    }
                }
            });
        </script>
        
        @if(!Auth::check())
        <script>$('#loginModal').modal('show');</script>
        @endif
    </body>
</html>
