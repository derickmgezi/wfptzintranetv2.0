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
        $news = News::where('status',1)->orderBy('created_at','desc')->take(6)->get();
        
        $stories = Story::where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();
        
        $recent_media_alerts_date = MediaAlert::select(DB::raw("DATE_FORMAT(created_at,'%d %M %Y') as date"))
                                          ->where('status',1)
                                          ->orderBy('created_at', 'desc')
                                          ->first();
        
        $mediaalerts = MediaAlert::select(DB::raw("id,header,mediacontent,type,source,created_at,DATE_FORMAT(created_at,'%d %M %Y') as date"))
                                            ->where('status',1)
                                            ->get();
        
        $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadnewsupdates' => count($unreadnewsupdates)]);
        
        $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = ".Auth::id()." GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadstories' => count($unreadstories)]);

        return view('home')->with('mediaalerts', $mediaalerts)
                           ->with('recent_media_alerts_date',$recent_media_alerts_date)
                           ->with("news",$news)
                           ->with('stories',$stories);
    }
}
