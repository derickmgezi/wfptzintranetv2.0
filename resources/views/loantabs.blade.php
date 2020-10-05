@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container-fluid pt-3">

                <div class="card mt-3">

                    <div class="card-header" style="background-color:">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#items" role="tab">Assigned Items</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#requests" role="tab">Request Status</a>
                            </li>
<!--                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#returned" role="tab">Returned Items</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
                            </li>-->
                        </ul>
                    </div><!-- end card header -->   

                    <div class="card-block">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="items" role="tabpanel">
                                @include('components/loandirectories/loaneditems')
                            </div>
                            <div class="tab-pane" id="requests" role="tabpanel">
                                @include('components/loandirectories/requests')
                            </div>
<!--                            <div class="tab-pane" id="returned" role="tabpanel">...</div>
                            <div class="tab-pane" id="settings" role="tabpanel">...</div>-->
                        </div><!-- end Tab panes -->

                    </div><!-- end card block -->   

                </div><!-- end card -->

            </div><!-- /.container -->

            <hr class="featurette-divider">

            <!-- FOOTER -->
            @include('frames/footer')