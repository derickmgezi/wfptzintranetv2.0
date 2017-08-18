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

    @if(Session::has('view_user_bio'))
    <div class="modal fade" id="user-bio-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">{{ App\user::find(Session::get('view_user_bio'))->firstname }}'s Bio</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-inverse text-white">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid img-thumbnail rounded-circle" src="{{ strlen(App\User::find(Session::get('view_user_bio'))->image) != 0? url('/storage/thumbnails/'.App\User::find(Session::get('view_user_bio'))->image):url('/image/default_profile_picture.jpg') }}" alt="Responsive image" src="" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
                            <h6 class="display-4">{{ App\user::find(Session::get('view_user_bio'))->firstname.' '.App\user::find(Session::get('view_user_bio'))->secondname }}</h6>
                        </div>
                        <div class="col-12">
                            <hr style="background-color: white">
                                @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0 &&  Auth::user()->id == Session::get('view_user_bio'))
                            <div class="alert alert-info" role="alert">
                                <strong>Heads up!</strong> Please update your Bio.
                            </div>
                            @elseif(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0)
                            <div class="alert alert-info" role="alert">
                                <strong>{{ App\user::find(Session::get('view_user_bio'))->firstname.' '.App\user::find(Session::get('view_user_bio'))->secondname }}'s</strong> Bio hasn't been updated.
                            </div>
                            @else
                            <p class="text-justify">{!! App\user::find(Session::get('view_user_bio'))->bio !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(Auth::user()->id == Session::get('view_user_bio'))
                    @if(strlen(strip_tags(App\user::find(Session::get('view_user_bio'))->bio)) == 0)
                    <a role="button" class="btn btn-success" href="{{URL::to('/add_bio/'.Auth::user()->id)}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Bio
                    </a>
                    @else
                    <a role="button" class="btn btn-warning" href="{{URL::to('/edit_bio/'.Auth::user()->id)}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Bio
                    </a>
                    @endif
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close" aria-hidden="true"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @elseif(Session::has('add_user_bio'))
    <div class="modal fade" id="user-bio-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{ Form::open(array('url' => '/update_bio/'.Auth::user()->id,'enctype' => "multipart/form-data",'role' => 'form')) }}
                <div class="modal-header bg-faded">
                    <h2 class="modal-title" id="exampleModalLabel">Update Your Bio</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image"><strong>Change Image</strong></label><br>
                                <img class="img-fluid img-thumbnail" alt="Responsive image" src="{{ url('/storage/'.App\User::find(Session::get('add_user_bio'))->image) }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
                                <hr style="background-color: white">
                                @if(old('image'))
                                <input type="file" name='image' value="{{ (old('image')) }}" id="image" class="form-control">
                                @elseif(Session::has('add_user_bio'))
                                <input type="file" name='image' value="{{ App\User::find(Session::get('add_user_bio'))->image }}" id="image" class="form-control">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="headerText"><strong>Update Bio</strong></label>
                                @if(old('bio'))
                                <textarea class="simple-tinymce form-control" name='bio' id="exampleTextarea" rows="10">{{ (old('description')) }}</textarea>
                                @elseif(Session::has('add_user_bio'))
                                <textarea class="simple-tinymce form-control" name='bio' id="exampleTextarea" rows="10">{{ App\User::find(Session::get('add_user_bio'))->bio }}</textarea>
                                @endif
                            </div>
                            @if(Session::has('add_bio_error'))
                            <div class="alert alert-danger" role="alert">
                                <small><strong>{{$errors->first()}}</strong></small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-faded">
                    @if(Auth::user()->id == Session::get('add_user_bio'))
                        @if(strlen(strip_tags(App\user::find(Session::get('add_user_bio'))->bio)) == 0)
                        <button type="submit" role="button" class="btn btn-success">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Bio
                        </button>
                        @else
                        <button type="submit" role="button" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Bio
                        </button>
                        @endif
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close" aria-hidden="true"></i> Close
                    </button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @endif
</div><!-- /.row -->
