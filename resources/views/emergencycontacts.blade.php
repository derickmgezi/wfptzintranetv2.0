@include('frames/header')
        <div class="container-fluid">
            <div class="row">
                
                @include('frames/sidebar')

                <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

                    <!-- Marketing messaging and featurettes
                    ================================================== -->
                    <!-- Wrap the rest of the page in another container to center all the content. -->

                    <div class="container-fluid marketing">

                        @if($emergecy_contacts->count() > 0)
                        <table class="table table-responsive text-center">
                            <thead>
                                <tr>
                                    <td><small><strong class="h5"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i><br><a href="#">#</a></strong></small></td>
                                    <td><small><strong><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><br><a href="#">Name</a></strong></small></td>
                                    <td><small><strong><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><br><a href="#">Email</a></strong></small></td>
                                    <td><small><strong><i class="fa fa-header fa-2x" aria-hidden="true"></i><br><a href="#">Title</a></strong></small></td>
                                    <td><small><strong><i class="fa fa-building-o fa-2x" aria-hidden="true"></i><br><a href="#">Department</a></strong></small></td>
                                    <td><small><strong><i class="fa fa-home fa-2x" aria-hidden="true"></i><br><a href="#">Duty Station</a></strong></small></td>
                                    <td><small><strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i><br><a href="#">Emergency Contacts</a></strong></small></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row_color = array('table-active', 'table-success', 'table-info', 'table-danger', 'table-warning');
                                $color_id = 0;
                                $row_status = 1;
                                $count = 1;
                                ?>
                                @foreach($emergecy_contacts as $emergecy_contact)
                                @if($row_status)
                                <tr class="{{ array_get($row_color,$color_id) }}">
                                    <td><small>{{ $count++ }}</td>
                                    <td><small>{{ $emergecy_contact->firstname.' '.$emergecy_contact->secondname }}</td>
                                    <td><small>{{ $emergecy_contact->email }}</small></td>
                                    <td><small>{{ $emergecy_contact->title }}</small></td>
                                    <td><small>{{ $emergecy_contact->department }}</small></td>
                                    <td><small>{{ $emergecy_contact->dutystation }}</small></td>
                                    <td><a role="button" target="_blank" href="{{ url('/storage/'.$emergecy_contact->emergencycontactform) }}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
                                </tr>
                                <?php
                                ($color_id > 3) ? $color_id = 0 : ++$color_id;
                                $row_status = 0;
                                ?>
                                @else
                                <tr>
                                    <td><small>{{ $count++ }}</td>
                                    <td><small>{{ $emergecy_contact->firstname.' '.$emergecy_contact->secondname }}</th>
                                    <td><small>{{ $emergecy_contact->email }}</small></td>
                                    <td><small>{{ $emergecy_contact->title }}</small></td>
                                    <td><small>{{ $emergecy_contact->department }}</small></td>
                                    <td><small>{{ $emergecy_contact->dutystation }}</small></td>
                                    <td><a role="button" target="_blank" href="{{ url('/storage/'.$emergecy_contact->emergencycontactform) }}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
                                </tr>
                                <?php
                                $row_status = 1;
                                ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-info mt-3" role="alert">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>No Emergency Contant Form has been uploaded</strong>
                        </div>
                        @endif

                    </div><!-- /.container-fluid -->
                    
                    <hr class="featurette-divider">

                    <!-- FOOTER -->
                    @include('frames/footer')
                    