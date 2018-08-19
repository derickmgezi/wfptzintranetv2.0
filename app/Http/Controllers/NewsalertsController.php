<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsalertsController extends Controller
{
    public function index(){
    	
    	  return view('newsalerts');
    }
}
