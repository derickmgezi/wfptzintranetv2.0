<?php $pi_staff = App\User::where('department', 'IT')->get(); ?>
<div class="row justify-content-md-center">
    @foreach($pi_staff as $staff)
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
