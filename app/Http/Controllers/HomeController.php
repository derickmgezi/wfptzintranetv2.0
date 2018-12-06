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
use App\AccessLog;
use Validator;
use Purifier;
use Image;
use Session;

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
        //Old Home Page code
        $news = News::where('status',1)->orderBy('created_at','desc')->take(6)->get();
        //dd($news);

        $stories = Story::where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();
        
        //$recent_media_alerts_date = MediaAlert::select(DB::raw("DATE_FORMAT(created_at,'%d %M %Y') as date"))
        //                                  ->where('status',1)
        //                                  ->orderBy('created_at', 'desc')
        //                                  ->first();
        
        $mediaalerts = MediaAlert::select(DB::raw("id,header,mediacontent,type,source,created_at,DATE_FORMAT(created_at,'%d %M %Y') as date"))
                                            ->where('status',1)
                                            ->get();
        
        $accessed_links = DB::table('access_logs')->get();
        $accessed_links = $accessed_links->unique('action_details');                             

        $frequent_visited_links = DB::table('access_logs')->select('id','action_details')
                                       ->where('user',Auth::user()->username)
                                       ->whereNotIn('action_details', ['Redirected to Home Page','Personal Biography update modal accessed','Biography plus profile picture changed','Biography plus profile picture not changed'])
                                       //->whereNotIn('action_taken', ['Edit Personal Biography','Update Personal Biography'])
                                       ->where('action_status','Success');
                                       //->groupBy('action_taken')
         
        $frequent_visited_links = DB::table(DB::raw("({$frequent_visited_links->toSql()}) as access_logs"))
                                ->mergeBindings($frequent_visited_links)
                                ->select(DB::raw('access_logs.action_details,count(access_logs.action_details) as access_count'))
                                ->groupBy('access_logs.action_details')
                                ->orderBy('access_count', 'desc')
                                ->take(5)
                                ->get();
        //dd($frequent_visited_links);                                   
        
        $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadnewsupdates' => count($unreadnewsupdates)]);
        
        $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = ".Auth::id()." GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadstories' => count($unreadstories)]);

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Access Home Page";
        $access_log->action_details = "Redirected to Home Page";
        $access_log->user = Auth::user()->username;
        if(!Session::has('view_user_bio') && !Session::has('add_user_bio'))
        $access_log->save();

        return view('home')->with('mediaalerts', $mediaalerts)
                           //->with('recent_media_alerts_date',$recent_media_alerts_date)
                           ->with("news",$news)
                           ->with('stories',$stories)
                           ->with('accessed_links',$accessed_links)
                           ->with('links',$frequent_visited_links);
    }

    public function show_user_bio($id) {
        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Access Personal Biography";
        $access_log->action_details = "Personal Biography displayed";
        $access_log->save();

        Session::flash('view_user_bio', $id);
        return back();
    }

    public function add_user_bio($id) {
        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Edit Personal Biography";
        $access_log->action_details = "Personal Biography update modal accessed";
        $access_log->save();

        Session::flash('add_user_bio', $id);
        return back();
    }

    public function update_user_bio(Request $request, $id) {
        //
        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Update Personal Biography";

        $validator = Validator::make($request->all(), [
                    'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
        ]);

        if ($validator->fails()) {
            $access_log->action_details = "Attemp to update Bio interrupted due to image validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            Session::flash('add_user_bio', $id);
            Session::flash('add_bio_error', 'Bio Update Error');
            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            if ($request->image) {
                //Upload the file in storage/app/public/profile_pictures folder
                $image_name = (string) ($request->image->store('public/profile_pictures'));
                $image_name = str_replace('public/','',$image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/profile_pictures'));
                
                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/'.$thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(300, 300)->save($path);
                
                //Update User Bio
                $Update_bio = User::find($id);
                $user_bio = $Update_bio->bio;
                $Update_bio->image = $image_name;
                $Update_bio->bio = Purifier::clean($request->bio, 'youtube');
                $Update_bio->save();
                if($user_bio == Purifier::clean($request->bio, 'youtube')){
                $access_log->action_details = "Profile picture changed";
                }else{
                $access_log->action_details = "Biography plus profile picture changed";   
                }
                $access_log->save();

                Session::flash('view_user_bio', $id);
                return back();
            } else {
                //Update User Bio
                $Update_bio = User::find($id);
                $user_bio = $Update_bio->bio;
                $Update_bio->bio = Purifier::clean($request->bio, 'youtube');
                $Update_bio->save();
                if($user_bio == Purifier::clean($request->bio, 'youtube')){
                    $access_log->action_details = "Biography plus profile picture not changed";
                }else{
                    $access_log->action_details = "Biography updated";
                }
                
                $access_log->save();

                Session::flash('view_user_bio', $id);
                return back();
            }
        }
    }
}
