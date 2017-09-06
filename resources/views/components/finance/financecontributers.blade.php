<?php

$editors = DB::table('users')->join('editors','editors.editor','=','users.id')
                                ->where('users.dutystation',$dutystation)
                                ->where('users.department',$department)
                                ->where('editors.function','editor')
                                ->where('editors.status',1)
                                ->get();
$editor_count = $editors->count();

?>
@if($editor_count != 0)
<h1 class="text-center featurette-heading">
    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editor
</h1>

<!-- Three columns of text below the carousel -->
<div class="row justify-content-md-center">
    @foreach($editors as $editor)
    <div class="col-lg-4">
        <img class="img-fluid img-thumbnail rounded-circle" alt="Responsive image" src="{{ strlen($editor->image) != 0? url('/storage/thumbnails/'.$editor->image):url('/image/default_profile_picture.jpg') }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
        <h2>{{ $editor->firstname.' '.$editor->secondname }}</h2>
        <p>
            <a class="btn btn-warning"  href="{{URL::to('/view_user_bio/'.$editor->editor)}}" role="button">
                <i class="fa fa-eye" aria-hidden="true"></i> View Bio
            </a>
        </p>
    </div><!-- /.col-lg-4 -->
    @endforeach
</div><!-- /.row -->
@endif
