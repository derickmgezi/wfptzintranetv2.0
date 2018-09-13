<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\View;
use App\Like;
use App\User;
use App\Editor;
use Auth;
use Schema;
use Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Story;
use App\MediaAlert;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Old home Page code
        $news = News::where('status',1)->orderBy('created_at','desc')->take(3)->get();
        
        $stories = Story::where('status', 1)->orderBy('created_at', 'desc')->take(3)->get();
        
        $recent_media_alerts_date = MediaAlert::select(DB::raw("DATE_FORMAT(created_at,'%d %M %Y') as date"))
                                          ->where('status',1)
                                          ->orderBy('created_at', 'desc')
                                          ->first();
        
        $mediaalerts = MediaAlert::select(DB::raw("id,header,mediacontent,type,source,created_at,DATE_FORMAT(created_at,'%d %M %Y') as date"))
                                            ->where('status',1)
                                            ->get();
                               
        return view('home')->with('mediaalerts', $mediaalerts)
                           ->with('recent_media_alerts_date',$recent_media_alerts_date)
                           ->with("news",$news)
                           ->with('stories',$stories);
    }
}
