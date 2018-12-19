@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

            <div class="container-fluid marketing">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-example">
                            <nav id="navbar-example2">
                                <a class="navbar-brand" href="#">WFP Resources</a>
                                <ul id="navbar-example2" class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link" href="#security">Security</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#sop">SOPs</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#hr">HR</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#programme">Programme</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#finance">Finance</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#admin">Admin</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#it">IT</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="#comms">Communication</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#supplychain">Supply Chain</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#dashboard">Dashboard</a></li>
<!--                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#one">one</a>
                                            <a class="dropdown-item" href="#two">two</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#three">three</a>
                                        </div>
                                    </li>-->
                                </ul>
                            </nav>
                            <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="scrollspy-example" style="position: relative; height: 310px; overflow-y: scroll">
                                <h4 id="security" class="text-primary">Security</h4>
                                <p>
                                    <i class="fa fa-shield" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Security/'.encrypt('Security Plan - Tanzania 14 July 2017.pdf'))}}">Security Plan</a><br>
                                    <i class="fa fa-shield" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Security/'.encrypt('Approved Residential Security Measures (RSM) - Tanzania 15 March 2018.pdf'))}}">Approved Residential Security Measures (RSM)</a><br>
                                    <i class="fa fa-shield" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Security/'.encrypt('WFP Warden.pdf'))}}">WFP Tanzania Warden System</a><br>
                                   
                                   
                                </p>
                                <h4 id="sop" class="text-primary">SOP</h4>
                                <p>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP ACCESS CONTROL CO DAR ES SALAAM.pdf'))}}">Access control CO Dar es salaam</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP - TRAVEL TANZANIA COUNTRY OFFICE AND SUB OFFICES.pdf'))}}">Travel Tanzania Country Office and Sub Offices</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP for communication equipment.pdf'))}}">Communication Equipment</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('WFPtz Guidelines on Media.pdf'))}}">WFP TZ Guidelines on Media</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP - USE OF WFP VEHICLES.pdf'))}}">Use of WFP Vehicles</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP for the Cooperating Partners Committee WFP Tanzania Country Office.pdf'))}}">Cooperating Partners Committee</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('Office committees 2018.pdf'))}}">Office committees 2018</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP INVOICE MANAGEMENT TZCO.pdf'))}}">Invoice Management</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('SOP_MDR_COMET_LESS _ Invoice_ reconciliation - FINAL - 2018.04.18.pdf'))}}">MDR COMET LESS  Invoice reconciliation</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/SOP/'.encrypt('C&V Working Group TORs_01Dec17.pdf'))}}">TORs for Cash and Voucher Working Group</a><br>
                                </p>
                                <h4 id="hr" class="text-primary">Human Resources</h4>
                                <p>
                                   <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/HR/'.encrypt('Leave Application Form for All National Staff.doc'))}}">Leave Application Form for all National Staff</a><br> 
                                </p>
                                <h4 id="programme" class="text-primary">Programme</h4>
                                <p>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('Tanzania-Country Operations Management Plan 2018.pdf'))}}">Tanzania-Country Operations Management Plan 2018</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('United Republic of Tanzania CSP 2017 - 2021.pdf'))}}">CSP - United Republic of Tanzania  (2017-2021)</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('TZ01 BR2_Revised CSP narrative_7June2018_budget revision 2.pdf'))}}">CSP - United Republic of Tanzania  (2017-2021) - budget revision 2</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('WFP TZ CO Guidance on partnerships with Non-Government Organisations.pdf'))}}">WFP TZ CO Guidance on partnerships with Non-Government Organisations</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('United Nations Development Assistance (UNDAP) 2016-2021.pdf'))}}">United Nations Development Assistance (UNDAP) 2016-2021</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('2017_04_05 - Tanzania line of sight_FINAL.jpg'))}}">Tanzania CSP (2017-2021) line of sight</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('Tanzania CO_CSP ME Plan_budget_FINAL.pdf'))}}">Tanzania CO CSP Monitoring, Review and Evaluation Plan</a><br>
                                </p>
                                <h4 id="finance" class="text-primary">Finance</h4>
                                <p>
                                    
                                </p>
                                <h4 id="admin" class="text-primary">Administration</h4>
                                <p>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('Report of loss or damage or unserviceability of property.doc'))}}">Loss or Damage Form</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('Waiver of Liability.pdf'))}}">Waiver of Liability Form</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Administration/'.encrypt('Private Use of Office Vehicle 15.doc'))}}">Private Use of Office Vehicle Form</a><br>
                                </p>
                                <h4 id="it" class="text-primary">IT</h4>
                                <p>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/IT/'.encrypt('Request Form for Mobile or thuraya phones.doc'))}}">Request Form for Mobile or thuraya phones</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/IT/'.encrypt('IT Loan Form.doc'))}}">Loan Form</a><br>
                                    <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/IT/'.encrypt('Corporate Information and IT Security Policy.pdf'))}}">Information and IT Security policy</a><br>
                                </p>
                                <h4 id="comms" class="text-primary">Communication</h4>
                                <p>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Communication/'.encrypt('Word document with all logos for easy copy paste.docx'))}}">WFP Logos</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Communication/'.encrypt('Official WFP Letter Head - new.docx'))}}">WFP Letter Head</a><br>
                                    <i class="fa fa-file-text" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Communication/'.encrypt('WFP PowerPoint Template.pptx'))}}">WFP PowerPoint Template</a><br>
                                </p>
                                <h4 id="supplychain" class="text-primary">Supply Chain</h4>
                                <p>
                                        <i class="fa fa-book" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Supply-Chain/'.encrypt('SUPPLY CHAIN STRATEGY Jun18.pdf'))}}">Supply Chain Strategy</a><br>
                                </p>
                                <h4 id="dashboard" class="text-primary">Dashboard</h4>
                                <p>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard OCTOBER 2018.pdf'))}}">Monthly Dashboard OCTOBER</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard SEPTEMBER  2018.pdf'))}}">Monthly Dashboard SEPTEMBER</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard AUGUST 2018.pdf'))}}">Monthly Dashboard AUGUST</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard JULY 20.08.2018.pdf'))}}">Monthly Dashboard JULY</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard JUNE 2018.pdf'))}}">Monthly Dashboard JUNE</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard MAY 2018.pdf'))}}">Monthly Dashboard MAY</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard APR 18.pdf'))}}">Monthly Dashboard APRIL</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard MARCH 2018.pdf'))}}">Monthly Dashboard MARCH</a><br>
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <a class="text-muted font-italic" href="{{URL::to('/resource/Dashboard/'.encrypt('TZCO Monthly Dashboard FEBRUARY 2018.pdf'))}}">Monthly Dashboard FEBRUARY</a><br>
                                </p>
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

