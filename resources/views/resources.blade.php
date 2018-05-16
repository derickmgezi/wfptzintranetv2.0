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
                                    <li class="nav-item"><a class="nav-link" href="#sop">SOPs</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="#comms">Communication</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#it">IT</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#admin">Admin</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#finance">Finance</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#hr">HR</a></li>
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
                                <h4 id="sop">SOPs</h4>
                                <p>
                                    <a href="{{URL::to('/resource/'.encrypt('Office committees 2018.pdf'))}}">Office committees 2018</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('SOP - TRAVEL TANZANIA COUNTRY OFFICE AND SUB OFFICES.pdf'))}}">Travel Tanzania Country Office and Sub Offices</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('SOP - USE OF WFP VEHICLES.pdf'))}}">Use of WFP Vehicles</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('SOP for communication equiment.pdf'))}}">Communication Equiment</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('SOP INVOICE MANAGEMENT TZCO.pdf'))}}">Invoice Management</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('SOP_MDR_COMET_LESS _ Invoice_ reconciliation.pdf'))}}">MDR COMET LESS  Invoice reconciliation</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('C&V Working Group TORs.pdf'))}}">C&V Working Group TORs</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('SUPPLY CHAIN - CARGO ALLOCATION.pdf'))}}">Supply Chain - Cargo Allocation</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('WFPtz Guidelines on Media.pdf'))}}">WFP TZ Guidelines on Media</a><br>
                                </p>
                                <h4 id="comms">Communication</h4>
                                <p>
                                    <a href="https://docs.google.com/spreadsheets/d/1YNeP4ltjH2tELuwxS_50cJYkAGbGhxCicmmrFnRGOO8/edit?usp=sharing" target="_blank">WFP Mission Calender</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('Word document with all logos for easy copy paste.docx'))}}">WFP Logos</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('Official WFP Letter Head - new.docx'))}}">WFP Letter Head</a><br>
                                    <a href="{{URL::to('/resource/'.encrypt('WFP PowerPoint Template.pptx'))}}">WFP PowerPoint Template</a><br>
                                </p>
                                <h4 id="it">IT</h4>
                                <p>
                                    <a href="{{URL::to('/resource/'.encrypt('Corporate Information and IT Security Policy.pdf'))}}">Information and IT Security policy</a><br>
                                </p>
                                <h4 id="admin">Administration</h4>
                                <p>
                                    
                                </p>
                                <h4 id="finance">Finance</h4>
                                <p>
                                    
                                </p>
                                <h4 id="hr">Human Resources</h4>
                                <p>
                                    
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

