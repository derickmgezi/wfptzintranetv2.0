@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <div class="container">
                
                <!-- START THE FEATURETTES -->
                @include('components/search/searchresults')

                <hr class="featurette-divider">

                <!-- /END THE FEATURETTES -->


                <!-- FOOTER -->
                @include('frames/footer')