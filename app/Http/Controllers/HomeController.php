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
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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
//        $recent_posts = News::where('status',1)->orderBy('created_at','desc')->paginate(3);
//        
//        $unique_views = DB::table('views')
//                               ->select('view_id','viewed_by')
//                               ->groupBy('view_id','viewed_by')
//                               ->orderBy('view_id');
//        
//        $news = DB::table('news')->select('id','header','status','image','created_at')
//                    ->whereRaw('timestampdiff(day,created_at,now()) <= 120');
//        
//        $most_viewed_posts = DB::table(DB::raw("({$unique_views->toSql()}) as views"))
//                               ->join(DB::raw("({$news->toSql()}) as news"),'news.id','=','views.view_id')
//                               ->select(DB::raw('view_id,count(*) as viewed_by,news.header,news.image,news.created_at'))
//                               ->where('news.status',1)
//                               ->orderBy('viewed_by','desc')
//                               ->groupBy('view_id')
//                               ->paginate(3);
//                               
//        return view('home')->with('dutystation', 'Country Office')
//                           ->with("recent_posts",$recent_posts)
//                           ->with('most_viewed_posts',$most_viewed_posts);
        
        $recent_posts = News::where('status',1)->orderBy('created_at','desc')->paginate(9);
        $unique_likes = Like::select('view_id','liked_by')->orderBy('created_at')->get();
        $unique_views = View::select('view_id','viewed_by')->orderBy('created_at', 'asc')->get();
        $editors = Editor::where('status',1)->get();
        
        //dd($editors->toArray());
        
        return view('updates', compact('recent_posts', 'editors', 'unique_likes', 'unique_views'));
    }

}
