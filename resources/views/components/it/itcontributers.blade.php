<?php 

$it_editors = DB::table('users')->join('editors','editors.editor','=','users.id')
                                ->where('users.dutystation',$dutystation)
                                ->where('users.department','IT')
                                ->where('editors.function','editor')
                                ->where('editors.status',1)
                                ->get();

?>
<div class="row justify-content-md-center">
    @foreach($it_editors as $it_editor)
    <div class="col-lg-4">
        <img class="img-fluid img-thumbnail rounded-circle" alt="Responsive image" src="{{ strlen($it_editor->image) != 0? url('/storage/thumbnails/'.$it_editor->image):url('/image/default_profile_picture.jpg') }}" alt="Generic placeholder image" width="140" height="140" data-src="holder.js/140x140/auto">
        <h2>{{ $it_editor->firstname.' '.$it_editor->secondname }}</h2>
        <p>
            <a class="btn btn-warning"  href="{{URL::to('/view_user_bio/'.$it_editor->editor)}}" role="button">
                <i class="fa fa-eye" aria-hidden="true"></i> View Bio
            </a>
        </p>
    </div><!-- /.col-lg-4 -->
    @endforeach
</div><!-- /.row -->
