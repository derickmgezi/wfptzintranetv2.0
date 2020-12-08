@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">
                
                <h4>
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="small">Key Resources</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">
                    
                    <div class="col-4 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/management dashboard.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-4 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/country csp.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <!--<div class="col-4 p-1">
                        <div class="card card-outline-primary">
                            <div class="caption">
                                <a href="#">
                                    <img class="img-fluid" src="{{ URL::to('image/dashboard.png') }}" >
                                    <h2>
                                        WFP TZ Dashboard
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>-->
                    
                    <div class="col-4 p-1">
                        <div class="card card-outline-primary" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/implementation plan.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                </div>
                
                <h4>
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="small">Resources by Supporting Unit</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">
                    
                    <div class="col-3 p-1">
                        <div class="card card-outline-warning" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SOPs Finance & Admin.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <!--<div class="col-3 p-1">
                        <div class="card card-outline-warning">
                            <div class="caption">
                                <a href="#">
                                    <img class="img-fluid" src="{{ URL::to('image/admin.jpg') }}" >
                                    <h2>
                                        Administration
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>-->
                    
                    <div class="col-3 p-1">
                        <div class="card card-outline-warning" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/ICT.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-3 p-1">
                        <div class="card card-outline-warning" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SUPPLY CHAIN.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-3 p-1">
                        <div class="card card-outline-warning" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/VAM and M&E.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-3 p-1">
                        <div class="card card-outline-warning" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/HR.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                </div>
                
                <h4>
                    <div class="d-flex justify-content-start  hidden-sm-down">
                        <div class="">
                            <span class="small">Resources by Strategic Outcome</span>
                        </div>
                    </div>
                </h4>
                
                <div class="row no-gutters">
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-success" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO1.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-success" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO2.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-success" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO3.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-success" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO4.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
                    <div class="col-2 p-1">
                        <div class="card card-outline-success" style="">
                            <img class="card-img-top img-fluid" src="{{ URL::to('image/SO5.png') }}" alt="Card image cap">
                        </div>
                    </div>
                    
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