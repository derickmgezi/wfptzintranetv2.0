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
                                <a class="nav-link active" data-toggle="tab" href="#breakFast" role="tab">Canteen Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#orders" role="tab">Orders Made</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#manageMeals" role="tab">Manage Meals</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="card-block tab-pane fade show active" id="breakFast" role="tabpanel">
                            @include('components/canteen/menu')
                        </div>
                        <div class="card-block tab-pane fade" id="orders" role="tabpanel">
                            @include('components/canteen/orders')
                        </div>
                        <div class="card-block tab-pane fade" id="manageMeals" role="tabpanel">
                            @include('components/canteen/managemeals')
                        </div>
                    </div>

                </div>

                <!-- start of Add Meal Modal -->
                <div class="modal fade addMealModal" id='addMealModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success">Create New Meal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-3 col-form-label text-primary">Meal Picture</label>
                                    <div class="col-9">
                                        <label class="custom-file">
                                            <input type="file" id="file" class="custom-file-input">
                                            <span class="custom-file-control"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-3 col-form-label text-primary">Meal Name</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="Enter Meal Descriptiop" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-3 col-form-label text-primary">Meal Type</label>
                                    <div class="col-9">
                                        <select class="custom-select">
                                            <option selected>Choose...</option>
                                            <option value="Break Fast">Break Fast</option>
                                            <option value="Lunch">Lunch</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-3 col-form-label text-primary">Price in Tzs</label>
                                    <div class="col-9">
                                        <input class="form-control" type="number" placeholder="Enter Meal Price" id="example-text-input">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm">
                                    <i class="fa fa-save" aria-hidden="true"></i> save
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i> close
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.end Add Meal Modal -->

                <!-- start of View Meal Modal -->
                <div class="modal fade viewMealModal" id='viewMealModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width: 25rem;">
                        <div class="modal-content">
                            <div class="modal-content">
                                <img class="card-img-top img-fluid" src="{{url('/image/2016-10-21 12.20.10_resized.jpg')}}" alt="Card image cap">
                            </div>
                            <div class="modal-body text-left">
                                <h5 class="card-title">Roasted Bananas with Chicken Salad</h5>
                                <p class="card-text">
                                    Price <button class="btn btn-sm btn-primary">Tzs 5,000</button> 
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">Posted 3 mins ago</small>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit" aria-hidden="true"></i> edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i> close
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.end View Meal Modal -->

                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')