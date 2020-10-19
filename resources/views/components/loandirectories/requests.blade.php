<div class="alert alert-info font-weight-bold" role="alert">
    You have no pending requests
</div>

<div class="card-header" style="background-color:">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs card-header-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#approved" role="tab">Approved</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pending" role="tab">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#notApproved" role="tab">Not Approved</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cancelled" role="tab">Cancelled</a>
        </li>
    </ul>
</div><!-- end card header -->   

<div class="card-block">
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="approved" role="tabpanel">
            <div class="alert alert-info font-weight-bold" role="alert">
                List of items that have been approved for assignment
            </div>
        </div>
        <div class="tab-pane" id="pending" role="tabpanel">
            <div class="alert alert-info font-weight-bold" role="alert">
                List of items pending approval
            </div>
        </div>
        <div class="tab-pane" id="notApproved" role="tabpanel">
            <div class="alert alert-info font-weight-bold" role="alert">
                List of items that have not been approved with reasons
            </div>
        </div>
        <div class="tab-pane" id="cancelled" role="tabpanel">
            <div class="alert alert-info font-weight-bold" role="alert">
                List of request that have been cancelled with reasons
            </div>
        </div>
    </div><!-- end Tab panes -->

</div><!-- end card block -->   