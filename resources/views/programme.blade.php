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

                @include('components/finance/financenews')

                <!-- /END THE FEATURETTES -->

                @include('components/finance/financecontributers')

                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')

