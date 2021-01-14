@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <div class="container-fluid marketing">

                <div class="row mt-2">
                    <div class="col-3">
                        <ul class="nav nav-pills flex-column" role="tablist" style="position: sticky;top: 80px;">
                            
                            <li class="nav-item" style="margin-bottom: 2.5px">
                                <a class="nav-link active" data-toggle="pill" role="tab" href="#updates" style="padding: 0">
                                    <div class="card card-outline-primary">
                                        <div class="caption">
                                            <img class="img-fluid" src="{{ URL::to('image/dashboard.png') }}" >
                                            <h2 class="text-center">
                                                CO Managment Dashboard
                                            </h2>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item card" style="margin-bottom: 2.5px">
                                <a class="nav-link" data-toggle="pill" role="tab"
                                   href="#stories">
                                    Security
                                </a>
                            </li>
                            <li class="nav-item card" style="margin-bottom: 2.5px">
                                <a class="nav-link" data-toggle="pill" role="tab" href="#resources">
                                    Administration
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="col-9 tab-content card border-right-0 border-bottom-0 border-top-0">
                        <div class="tab-pane fade show active" id="updates" role="tabpanel">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Resources Management Committee</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Revised WFP Committee Members List - Jan-Dec 2020</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> COMET-LESS reconciliation SO1 2020</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> COMET-LESS reconciliation SO2 2020</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Petty Cash</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> SOP Travel</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Communication Equipment</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Vendor and Customer Master Data management</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Cash and Voucher Working Group TORs</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Invoice management</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Cooperating Partners Committee WFP Tanzania Country Office</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Access Control</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Guidelines on Media</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Use of WFP vehicles</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="stories" role="tabpanel">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Essential staff list 2020</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Approved Residential Security Measures (RSM)</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Security Plan</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> WFP Tanzania Warden System</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="resources" role="tabpanel">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Report of loss or damage or unserviceability of property</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Private Use of Office Vehicles</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Waiver of Liability Form</a>
                                    </li>
                                </ul>
                            </div>
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
