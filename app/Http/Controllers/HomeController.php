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
        
        if(Route::current()->uri == 'newsupdateviews'){            
            $recent_posts = DB::table('news')->join('views','views.view_id', '=', 'news.id')
                                           ->select(DB::raw('news.id,news.header,news.description,news.story,news.image,news.source,news.type,news.created_by,news.created_at,views.view_id,views.viewed_by'))
                                           ->groupBy('views.view_id','views.viewed_by')
                                           ->where('news.status', 1);

            $recent_posts = DB::table(DB::raw("({$recent_posts->toSql()}) as news"))
                         ->mergeBindings($recent_posts)
                         ->select(DB::raw('news.id,news.header,news.description,news.story,news.image,news.source,news.type,news.created_by,news.created_at,count(news.viewed_by) as views'))
                         ->groupBy('news.view_id')
                         ->orderBy('views','desc')
                         ->paginate(9);

        }elseif(Route::current()->uri == 'newsupdatelikes'){
            $recent_posts = DB::table('news')->join('likes','news.id', '=', 'likes.view_id')
                                           ->select(DB::raw('news.id,news.header,news.description,news.story,news.image,news.source,news.type,news.created_by,news.created_at,likes.view_id,likes.liked_by'))
                                           ->groupBy('likes.view_id','likes.liked_by')
                                           ->where('news.status', 1);

            $recent_posts = DB::table(DB::raw("({$recent_posts->toSql()}) as news"))
                         ->mergeBindings($recent_posts)
                         ->select(DB::raw('news.id,news.header,news.description,news.story,news.image,news.source,news.type,news.created_by,news.created_at,count(news.liked_by) as views'))
                         ->groupBy('news.view_id')
                         ->orderBy('views','desc')
                         ->paginate(9);
            
//            $recent_posts = DB::table('news')->join('likes','news.id', '=', 'likes.view_id')
//                                           ->select(DB::raw('news.*,count(likes.liked_by) as likes'))
//                                           ->groupBy('likes.view_id')
//                                           ->where('news.status', 1)
//                                           ->orderBy('likes','desc')
//                                           ->paginate(9);

        }elseif(Route::current()->uri == 'newsupdatecomments'){
            $recent_posts = DB::table('news')->join('comments','news.id', '=', 'comments.news_id')
                                           ->select(DB::raw('news.*,count(comments.comment_by) as comments'))
                                           ->groupBy('comments.news_id')
                                           ->where('news.status', 1)
                                           ->orderBy('comments','desc')
                                           ->paginate(9);
            
        }elseif(Route::current()->uri == 'home'){
            $recent_posts = News::where('status',1)->orderBy('created_at','desc')
                                                   ->paginate(9);
            
        }elseif(Route::current()->uri == 'mynewsupdate'){
            $recent_posts = News::where('status', 1)->where('created_by',Auth::id())
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(9);
        }
        
        $unique_likes = Like::select('view_id','liked_by')->orderBy('created_at', 'asc')->get();
        $unique_views = View::select('view_id','viewed_by')->orderBy('created_at', 'asc')->get();
        $editors = Editor::where('status',1)->get();
        
        return view('updates', compact('recent_posts', 'editors', 'unique_likes', 'unique_views', 'unreadstories'));
    }

}
