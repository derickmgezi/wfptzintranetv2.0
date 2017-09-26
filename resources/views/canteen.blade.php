@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

            <div class="container-fluid marketing">         

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#breakFast" role="tab">Break Fast</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#lunch" role="tab">Lunch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#manageMeals" role="tab">Manage Meals</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="card-block tab-pane fade show active" id="breakFast" role="tabpanel">
                            <div class="card-deck">
                                <div class="card m-2" style="width: 20rem;">
                                    <img class="card-img-top img-fluid" src="{{url('/image/20160726_085020_resized.jpg')}}" alt="Card image cap">
                                    <div class="card-block">
                                        <h5 class="card-title">Eggs with Tangarine and Pawpaw</h5>
                                        <p class="card-text">
                                            Price <button class="btn btn-sm btn-primary">2,000 Tzs</button> 
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">Posted 3 mins ago</small>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Make your Order now</a>
                                    </div>
                                    <div class="card-footer text-center">
                                        <span class="form-group row">
                                            <label for="example-number-input" class="col-4 col-form-label">
                                                <strong>Quantity</strong>
                                            </label>
                                            <input class="col-3 form-control" type="number" min="1" value="1" id="example-number-input">
                                            <div class="col-5">
                                                <a href="#" class="btn btn-success"><i class="fa fa-sliders" aria-hidden="true">
                                                    </i> Order
                                                </a>
                                            </div>

                                        </span>
                                    </div>
                                </div>
                                <div class="card m-2" style="width: 20rem;">
                                    <img class="card-img-top img-fluid" src="{{url('/image/20160720_094210_resized_1.jpg')}}" alt="Card image cap">
                                    <div class="card-block">
                                        <h5 class="card-title">Eggs with Tangerine and Watermelons</h5>
                                        <p class="card-text">
                                            Price <button class="btn btn-sm btn-primary">3,000 Tzs</button> 
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">Posted 3 mins ago</small>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Make your Order now</a>
                                    </div>
                                </div>
                                <div class="card m-2" style="width: 20rem;">
                                    <img class="card-img-top img-fluid" src="{{url('/image/IMG_2787.jpg')}}" alt="Card image cap">
                                    <div class="card-block">
                                        <h5 class="card-title">Fruit Mixture</h5>
                                        <p class="card-text">
                                            Price <button class="btn btn-sm btn-primary">2,000 Tzs</button> 
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">Posted 3 mins ago</small>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Make your Order now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-block tab-pane fade" id="lunch" role="tabpanel">
                            <div class="card-deck">
                                <div class="card m-2" style="width: 20rem;">
                                    <img class="card-img-top img-fluid" src="{{url('/image/2016-10-21 12.20.10_resized.jpg')}}" alt="Card image cap">
                                    <div class="card-block">
                                        <h5 class="card-title">Roasted Bananas with Chicken Salad</h5>
                                        <p class="card-text">
                                            Price <button class="btn btn-sm btn-primary">5,000 Tzs</button> 
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">Posted 3 mins ago</small>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Make your Order now</a>
                                    </div>
                                </div>
                                <div class="card m-2" style="width: 20rem;">
                                    <img class="card-img-top img-fluid" src="{{url('/image/20170531_130529_resized.png')}}" alt="Card image cap">
                                    <div class="card-block">
                                        <h5 class="card-title">Rice with roasted meat mixed with kachumbari and mchicha</h5>
                                        <p class="card-text">
                                            Price <button class="btn btn-sm btn-primary">5,000 Tzs</button> 
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">Posted 3 mins ago</small>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Make your Order now</a>
                                    </div>
                                </div>
                                <div class="card m-2" style="width: 20rem;">
                                    <img class="card-img-top img-fluid" src="{{url('/image/20170428_125613.png')}}" alt="Card image cap">
                                    <div class="card-block">
                                        <h5 class="card-title">Potatoes with Goat Meat and salad</h5>
                                        <p class="card-text">
                                            Price <button class="btn btn-sm btn-primary">5,000 Tzs</button> 
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">Posted 3 mins ago</small>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Make your Order now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-block tab-pane fade" id="manageMeals" role="tabpanel">
                            <h4 class="card-title">Manage</h4>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                </div>

                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')