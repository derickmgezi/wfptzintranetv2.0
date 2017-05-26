@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <div class="container">
                <!-- START THE FEATURETTES -->
                <div class="row featurette align-items-center" style="background-color:">
                    <div class="col-md-6">
                        <span class="featurette-heading text-justify">WFP cash assistance has big potential for boosting <span class="text-muted">local economy.</span></span>
                        <p class="text-justify lead">At the forefront in many of these disasters is the United Nations World Food Programme (WFP), the leading humanitarian organization providing food assistance and promoting food security.</p>
                        <footer class="blockquote-footer">Source <cite title="Source Title">The Citizen</cite></footer>
                    </div>
                    <div class="col-md-6 text-center" style="background-color:">
                        <img class="featurette-image img-fluid mx-auto" src="./image/WFP cbt.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                    </div>
                </div>

                <hr class="featurette-divider">

                <!-- /END THE FEATURETTES -->


                <!-- FOOTER -->
                @include('frames/footer')