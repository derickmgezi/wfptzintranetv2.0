<?php
$department_staff = App\User::where('department', $department)->get(); 
$staff_count = $department_staff->count();
?>
@if($staff_count != 0)
<h1 class="text-center featurette-heading">
    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editor
</h1>

<!-- Three columns of text below the carousel -->
<div class="row justify-content-md-center">
    @foreach($department_staff as $staff)
    <div class="col-lg-4">
        <img class="img-fluid img-thumbnail rounded-circle" alt="Responsive image" src="{{ strlen(App\User::find($staff->id)->image) != 0? url('/storage/thumbnails/'.App\User::find($staff->id)->image):url('/image/default_profile_picture.jpg') }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
        <h2>{{ $staff->firstname.' '.$staff->secondname }}</h2>
        <p>
            <a class="btn btn-warning"  href="{{URL::to('/view_user_bio/'.$staff->id)}}" role="button">
                <i class="fa fa-eye" aria-hidden="true"></i> View Bio
            </a>
        </p>
    </div><!-- /.col-lg-4 -->
    @endforeach
</div><!-- /.row -->
@endif
