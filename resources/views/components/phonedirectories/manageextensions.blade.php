{{ Form::open(array('url' => '/update_contacts','class' => 'form-signin','role' => 'form','files' => 'true')) }}
<div class="input-group">
    <input type="file" name="file" value="{{ (old('file')) }}" class="form-control">
    <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Upload File</button>
    </span>
</div>
{{Form::token()}}
{{ Form::close() }}
<br>
@if(Session::has('unfound_ext'))
<div class="alert alert-{{ Session::has('unfound_ext')? 'danger':'success' }} alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
    </button>
    <h4 class="alert-heading"> <i class="fa fa-exclamation " aria-hidden="true"></i> Upload of Phone Bill was interrupted</h4>
    <p>Extension {{ Session::get('unfound_ext') }} has not been assigned to a user</p>
    <p class="mb-0"><strong>Make sure you assign the extension to the correct user</strong></p>
</div>
@elseif(Session::has('upload_message'))
<div class="alert alert-{{ Session::get('upload_message') == 'File Uploaded Succesfully'? 'success':'danger' }} alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
    </button>
    <i class="fa fa-exclamation " aria-hidden="true"></i> {{Session::get('upload_message')}}
</div>
@else
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">Manage Numbers</h4>
    <p>Under this section you will be able to add, edit and remove contact details</p>
    <p class="mb-0"><strong>Make sure you upload the correct file extension</strong></p>
</div>
@endif