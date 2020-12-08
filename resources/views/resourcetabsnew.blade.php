@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">
                
                <h4>
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="lead text-primary">Key Resources</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">

                    <div class="col-2 p-1">
                        <div class="card card-outline-primary">
                            <div class="caption">
                                <a href="{{URL::to('/resourcesnew')}}">
                                    <img class="img-fluid" src="{{ URL::to('image/dashboard.png') }}" >
                                    <h2 class="text-center">
                                        CO MANAGMENT DASHBOARD
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 p-1">
                        <div class="card card-outline-primary">
                            <div class="caption">
                                <a href="#">
                                    <img class="img-fluid" src="{{ URL::to('image/TZ CSP.png') }}" >
                                    <h2 class="text-center">
                                        COUNTRY SRATEGIC PLAN
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="col-2 p-1">
                        <div class="card card-outline-primary">
                            <div class="caption">
                                <a href="#">
                                    <img class="img-fluid" src="{{ URL::to('image/dashboard.png') }}" >
                                    <h2 class="text-center">
                                        WFP TZ Dashboard
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>-->
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <a href="#">
                                <img class="card-img-top img-fluid" src="{{ URL::to('image/implementation plan.png') }}" alt="Card image cap">
                            </a>
                        </div>
                    </div>
                    
                </div>
                
                <h4 class="mt-2">
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="lead text-primary">Resources by Strategic Outcome</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO1.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <a href="{{URL::to('/resourcestabs')}}">
                                <img class="card-img-top img-fluid" src="{{ URL::to('image/SO2.png') }}" alt="Card image cap">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO3.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO4.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO5.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/COVID-19.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                </div>
                
                <h4 class="mt-2">
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="lead text-primary">Resources by Supporting Unit</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">
                    
                    @foreach ($resource_supporting_units as $resource_supporting_unit)
                    <div class="col-2 p-1">
                        <div class="card card-outline-primary">
                            <div class="caption">
                                <a href="{{URL::to('/resourcestabs/'.$resource_supporting_unit->resource_type)}}">
                                    <img class="img-fluid" src="{{ URL::to('image/finance.jpg') }}" >
                                    <h2 class="text-center">
                                        {{ $resource_supporting_unit->resource_type }}
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    {{-- <div class="col-2 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/ict.jpg') }}" alt="Card image cap">
                        </div>
                    </div> --}}
                    
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