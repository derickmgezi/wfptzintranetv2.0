<div class="card mt-3">
    <div class="card-header" style="background-color:">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ Session::has('upload_message') || Session::has('edit_bill_message')? '':'active' }}" data-toggle="tab" href="#extension" role="tab">VSAT Extensions <i class="fa fa-plus" aria-hidden="true"></i> Mobile Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Session::has('edit_bill_message')? 'active':'' }}" data-toggle="tab" href="#bill" role="tab">My Phone Bill</a>
            </li>
            @if(Auth::user()->department == 'Finance')
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#telephoneBills" role="tab">Telephone Bills</a>
            </li>
            @endif
            @if(Auth::user()->department == 'IT')
            <li class="nav-item">
                <a class="nav-link {{ Session::has('upload_message')? 'active':'' }}" data-toggle="tab" href="#manage" role="tab">Manage Numbers <i class="fa fa-plus" aria-hidden="true"></i> Bills</a>
            </li>
            @endif
        </ul>
    </div>
    <div class="card-block">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade show {{ Session::has('upload_message') || Session::has('edit_bill_message')? '':'active' }}" id="extension" role="tabpanel">
                @include('components/phonedirectories/tanzaniaextensions')
            </div>
            <div class="tab-pane fade show {{ Session::has('edit_bill_message')? 'active':'' }}" id="bill" role="tabpanel">
                @include('components/phonedirectories/userbill')
            </div>
            @if(Auth::user()->department == 'Finance')
            <div class="tab-pane fade" id="telephoneBills" role="tabpanel">
                @include('components/phonedirectories/telephonebill')
            </div>
            @endif
            @if(Auth::user()->department = 'IT')
            <div class="tab-pane fade show {{ Session::has('upload_message')? 'active':'' }}" id="manage" role="tabpanel">
                @include('components/phonedirectories/manageextensions')
            </div>
            @endif
        </div><!-- end Tab panes -->
    </div><!-- end card block -->   
</div><!-- end card -->
