@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">
                
                <h4>
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="lead text-primary">{{ $resource_type }}</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">

                    @foreach ($resource_supporting_units_subfolders as $resource_supporting_units_subfolder)
                    <?php 
                    $resources = $supporting_unit_resources->where('subfolder_id',$resource_supporting_units_subfolder->id);
                    ?>
                        @if ($resources->isNotEmpty())
                        <div class="col-3 p-1">
                            <div class="card card-outline-primary">
                                <div class="caption">
                                    <a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        <img class="img-fluid" src="{{ URL::to('image/dashboard.png') }}" >
                                        <h2 class="text-center">
                                            @if($resource_supporting_units_subfolder->subfolder_name == NULL)
                                            Resources 
                                            @else
                                            {{ $resource_supporting_units_subfolder->subfolder_name }}
                                            @endif
                                        </h2>
                                    </a>
                                </div>
                                <div class="collapse show" id="collapse1">
                                    <div class="card" @if($resources->count() >= 4)style="height: 320px; overflow-y: scroll"@endif>
                                        <ul class="list-group list-group-flush">
                                            @foreach ($resources as $resource)
                                            <li class="list-group-item">
                                                <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> {{ $resource->resource_name }}</a>
                                            </li> 
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    
                </div>
                
                <hr>

                <!-- FOOTER -->
                @include('frames/footer')

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */