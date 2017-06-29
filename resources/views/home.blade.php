@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

<!--            @include('components/pi/picarousel')-->

            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container-fluid marketing">                        

                @include('components/pi/pinews')

                <!-- /END THE FEATURETTES -->

                <h1 class="text-center featurette-heading">Contributers</h1>

                <!-- Three columns of text below the carousel -->
                @include('components/pi/picontributers')

                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')

