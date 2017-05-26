
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
        <link href="./css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for Dashboard Template -->
        <link href="./css/dashboard.css" rel="stylesheet">

        <!-- Custom styles for Caousel template -->
        <link href="./css/carousel.css" rel="stylesheet">
        
        <!-- Custom styles for Font Awesome template -->
        <link href="./css/font-awesome.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-primary">
            <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">tznewsalert.wfp.org</a>

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
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="home.html">PI <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">News Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="it.html">IT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="finance.html">Finance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.html">Administration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="internaldirectory.html">
                                <i class="fa fa-phone-square fa-lg" aria-hidden="true"></i> Phone Directory
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <div class="container">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#edit" role="tab">Edit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#delete" role="tab">Delete</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#manage" role="tab">Manage</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#cancel" role="tab">Cancel</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="edit" role="tabpanel">Edit</div>
                            <div class="tab-pane" id="delete" role="tabpanel">Delete</div>
                            <div class="tab-pane" id="manage" role="tabpanel">Manage</div>
                            <div class="tab-pane" id="cancel" role="tabpanel">Cancel</div>
                        </div>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">Profile</div>
                            <div class="tab-pane" id="messages" role="tabpanel">Message</div>
                            <div class="tab-pane" id="settings" role="tabpanel">Settings</div>
                        </div>

                        <hr class="featurette-divider">

                        <!-- /END THE FEATURETTES -->


                        <!-- FOOTER -->
                        <footer>
                            <p class="float-right"><a href="#">Back to top</a></p>
                            <p>&copy; 2017 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
                        </footer>
                    </div>
                </div><!-- /.container -->
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="./js/jquery.min.js"><\/script>')</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="./js/holder.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="./js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
