<div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="card">
        <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-sm btn-success">
                    Today's Menu
                </a>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-block">
                <table class="table table-sm table-hover">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Meal Description</th>
                            <th class="text-center">Available From</th>
                            <th class="text-center">Orders Made</th>
                            <th class="text-center">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="#viewMenuMealModal" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="text-primary">
                                    <em>Eggs with Tangarine and Pawpaw</em>
                                </a>
                            </td>
                            <td class="text-center">
                                <em>8 O'clock</em>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-secondary disabled">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> None
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="#viewOrderMenuMealModal" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="btn btn-sm btn-success">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order now
                                </a>
                            </td>
                        </tr>
                        <tr class="table-success">
                            <td>
                                <a href="#viewOrderedMealModal" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="text-primary"><em>Fruit Mixture</em></a>
                            </td>
                            <td class="text-center">
                                <em>8 O'clock</em>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success disabled">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> 1 Order Made
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="#viewReorderMealModal" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="btn btn-sm btn-warning">
                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Re-order
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="text-primary"><em>Rice with roasted meat mixed with kachumbari and mchicha</em></a>
                            </td>
                            <td class="text-center">
                                <em>12 O'clock</em>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success disabled">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> 2 Orders Made
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Re-order
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="text-primary">
                                    <em>Roasted Bananas with Chicken Salad</em>
                                </a>
                            </td>
                            <td class="text-center">
                                <em>12 O'clock</em>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-secondary disabled">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> None
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order now
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="text-primary"><em>Potatoes with Goat Meat and salad</em></a>
                            </td>
                            <td class="text-center">
                                <em>12 O'clock</em>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-secondary disabled">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> None
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order now
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0">
                <a class="collapsed btn btn-sm btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Yesterday's Menu
                </a>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-block">
                
                
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" role="tab" id="headingThree">
            <h5 class="mb-0">
                <a class="collapsed btn btn-sm btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Previous Menus
                </a>
            </h5>
        </div>
        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="card-block">
                
            </div>
        </div>
    </div>
</div>



<!-- start of Meal Menu Modal -->
<div class="modal fade viewMenuMealModal" id="viewMenuMealModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 25rem;">
        <div class="modal-content">
            <div class="card">
                <img class="img-fluid" src="{{url('/image/20160726_085020_resized.jpg')}}" alt="Card image cap">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <a href="#" class="btn btn-sm btn-success"><i class="fa fa-cart-arrow-down fa-lg" aria-hidden="true"></i> Order now</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of Meal Menu Modal -->

<!-- start of Order Meal Modal -->
<div class="modal fade viewOrderMenuMealModal" id="viewOrderMenuMealModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 25rem;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="row">
                        <label for="example-number-input" class=" col-6 col-form-label text-right">
                            <h6>Quantity</h6>
                        </label>
                        <input class="col-3 form-control" type="number" min="1" value="1" id="example-number-input">
                    </span>
                </div>
                <img class="img-fluid" src="{{url('/image/20160726_085020_resized.jpg')}}" alt="Card image cap">
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
                    <a href="#" class="btn btn-sm btn-success">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i> Order
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of Order Meal Modal -->

<!-- start of Ordered Meal Modal -->
<div class="modal fade viewOrderedMealModal" id="viewOrderedMealModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 25rem;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="row">
                        <label for="example-number-input" class="col-6 col-form-label text-right">
                            <h6>Quantity</h6>
                        </label>
                        <a class="col-3 btn btn-secondary disabled">2</a>
                    </span>
                </div>
                <img class="img-fluid" src="{{url('/image/20160726_085020_resized.jpg')}}" alt="Card image cap">
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
                    <h3><span class="badge badge-success">Total 4,000 Tzs</span></h3>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of Ordered Meal Modal -->

<!-- start of Reorder Meal Modal -->
<div class="modal fade viewReorderMealModal" id="viewReorderMealModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 25rem;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="row">
                        <label for="example-number-input" class=" col-6 col-form-label text-right">
                            <h6>Quantity</h6>
                        </label>
                        <input class="col-3 form-control" type="number" min="1" value="2" id="example-number-input">
                    </span>
                </div>
                <img class="img-fluid" src="{{url('/image/20160726_085020_resized.jpg')}}" alt="Card image cap">
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
                    <a href="#" class="btn btn-sm btn-warning">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Re-order
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of Reorder Meal Modal -->