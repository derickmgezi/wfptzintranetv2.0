@include('components/loandirectories/loanform')

<div class="alert alert-info font-weight-bold" role="alert">
    You have no items assigned
</div>

<div class="card-header" style="background-color:">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs card-header-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#acknowledged" role="tab">Acknowledged</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pendingAcknowledgement" role="tab">Pending Acknowledgement</a>
        </li>
    </ul>
</div><!-- end card header -->   

<div class="card-block">
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="acknowledged" role="tabpanel">
            <div class="alert alert-info font-weight-bold" role="alert">
                List of items under your possession
            </div>
        </div>
        <div class="tab-pane" id="pendingAcknowledgement" role="tabpanel">
            <div class="alert alert-info font-weight-bold" role="alert">
                Confirm only if the item has been assigned and handed over to you
            </div>
        </div>
    </div><!-- end Tab panes -->

</div><!-- end card block -->   