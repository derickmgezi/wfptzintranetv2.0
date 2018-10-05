<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Post;
use Auth;
use Purifier;
use Image;
use App\News;
use Session;
use App\User;
use App\View;
use App\Like;
use Storage;
use DB;
use App\Editor;
use Schema;
use Route;
use Illuminate\Database\Eloquent\Builder;
use App\AccessLog;

class UpdateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->user = Auth::user()->username;
        $access_log->action_taken = "Access News Update Page";

        if(session('newsurl') == 'newsupdateviews'){
            $access_log->action_details = "Most visited News Updates displayed";
            
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

        }elseif(session('newsurl') == 'newsupdatelikes'){
            $access_log->action_details = "Most liked News Updates displayed";

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

        }elseif(session('newsurl') == 'newsupdatecomments'){
            $access_log->action_details = "Most commented on News Updates displayed";

            $recent_posts = DB::table('news')->join('comments','news.id', '=', 'comments.news_id')
                                           ->select(DB::raw('news.*,count(comments.comment_by) as comments'))
                                           ->groupBy('comments.news_id')
                                           ->where('news.status', 1)
                                           ->orderBy('comments','desc')
                                           ->paginate(9);
            
        }elseif(session('newsurl') == NULL || session('newsurl') == 'latestnewsupdates'){
            $access_log->action_details = "Recent WFP Updates displayed";

            $recent_posts = News::where('status',1)->orderBy('created_at','desc')
                                                   ->paginate(9);
            
        }elseif(session('newsurl') == 'mynewsupdate'){
            $access_log->action_details = "News updates uploaded by the user displayed";

            $recent_posts = News::where('status', 1)->where('created_by',Auth::id())
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(9);
        }elseif(session('newsurl') == 'unreadnewsupdate'){
            $access_log->action_details = "Unread News updates displayed";

            //$recent_posts = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
            
            $recent_posts = DB::table('views')->select('view_id')->where('viewed_by',Auth::id())->groupBy('view_id');
            
            $recent_posts = DB::table('news')->leftJoin(DB::raw("({$recent_posts->toSql()}) as readposts"), 'readposts.view_id', 'news.id')
                                             ->mergeBindings($recent_posts)
                                             ->whereNull('readposts.view_id')
                                             ->where('status',1)
                                             ->orderBy('id','desc')
                                             ->paginate(9);
        }
        
        $unique_likes = Like::select('view_id','liked_by')->orderBy('created_at', 'asc')->get();
        $unique_views = View::select('view_id','viewed_by')->orderBy('created_at', 'asc')->get();
        $editors = Editor::where('status',1)->get();
        
        $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadnewsupdates' => count($unreadnewsupdates)]);
        
        $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = " . Auth::id() . " GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadstories' => count($unreadstories)]);
        
        if(!Session::has('read_update') && !Session::has('add_update') && !Session::has('new_update_error') && !Session::has('new_update') && !Session::has('update_id') && !Session::has('delete_update'))
        $access_log->save();

        return view('updates', compact('recent_posts', 'editors', 'unique_likes', 'unique_views', 'unreadstories'));
    }
    
    public function latestnewsupdates() {
        session(['newsurl' => 'latestnewsupdates']);
        return $this->index();
    }
    
    public function unreadnewsupdate(){
        session(['newsurl' => 'unreadnewsupdate']);
        return $this->index();
    }
    
    public function newsupdateviews(){
        session(['newsurl' => 'newsupdateviews']);
        return $this->index();
    }
    
    public function newsupdatelikes() {
        session(['newsurl' => 'newsupdatelikes']);
        return $this->index();
    }
    
    public function newsupdatecomments(){
        session(['newsurl' => 'newsupdatecomments']);
        return $this->index();
    }
    
    public function mynewsupdate(){
        session(['newsurl' => 'mynewsupdate']);
        return $this->index();
    }

    public function create_update() {
        Session::flash('create_update', 'Create Update Message');
        return back();
    }
    
    public function add_update() {
        Session::flash('add_update', 'Add an update Message');

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Add Wfp Update";
        $access_log->action_details = 'Add WFP update Modal displayed';
        $access_log->save();

        return back();
    }

    public function store_update(Request $request, $department, $dutystation) {
        //
        $validator = Validator::make($request->all(), [
                    'header' => 'required',
                    'image' => 'required|mimes:jpeg,bmp,png,bmp,gif,svg',
                    'source' => 'required',
                    'description' => 'required',
                    'story' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('new_update_error', 'News Post Creation Error');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store Wfp Update";
            $access_log->action_details = 'Storing of new WFP update interrupted due to validation errors';
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            //Upload the file in storage/app/public/pi_news folder 
            $image_name = (string) ($request->image->store('public/pi_news'));
            $image_name = str_replace('public/', '', $image_name);

            //Upload the file in storage thumbnail public folder
            $thumb_image_name = (string) ($request->image->store('public/thumbnails/pi_news'));

            //Get full path of uploaded image from the thumbnails
            $path = storage_path('app/' . $thumb_image_name);

            //Load the image into the Image Intervention Package for manipulation
            Image::make($path)->fit(540, 304)->save($path);


            //store the post credentials in database
            $post = new News;
            $post->header = $request->header;
            $post->description = Purifier::clean($request->description, 'youtube');
            $post->story = Purifier::clean($request->story, 'youtube');
            $post->source = $request->source;
            $post->type = $department;
            $post->office = $dutystation;
            $post->image = $image_name;
            $post->created_by = Auth::id();
            $post->edited_by = Auth::id();
            $post->save();

            Session::flash('new_update', 'News Post Created');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store Wfp Update";
            $access_log->action_details = 'New WFP update stored';
            $access_log->save();

            return redirect('news');
        }
    }

    public function show_update($id) {
        //Record the view in the Database
        $view = new View;
        $view->view_id = $id;
        $view->viewed_by = Auth::id();
        $view->save();
        
        $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadnewsupdates' => count($unreadnewsupdates)]);

        $update = News::find($id);
        Session::flash('read_update', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Diaplay Wfp Update";
        $access_log->action_details = 'Wfp update with id "'.$id.'" displayed';
        $access_log->save();

        return redirect('news');
    }

    public function edit_update($id) {
        Session::flash('update_id', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Edit Wfp Update";
        $access_log->action_details = 'Edit WFP Update modal for update with id "'.$id.'" displayed';
        $access_log->save();

        return back();
    }

    public function update_update(Request $request, $id) {
        //
        $validator = Validator::make($request->all(), [
                    'header' => 'required',
                    'source' => 'required',
                    'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
                    'description' => 'required',
                    'story' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('update_id', $id);
            Session::flash('edit_update_error', 'News Post Edition Error');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Edit Wfp Update";
            $access_log->action_details = 'Edit WFP Update with id "'.$id.'" interrupted due to validation errors';
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            if ($request->image) {
                //Upload the file in storage/app/public/pi_news folder 
                $image_name = (string) ($request->image->store('public/pi_news'));
                $image_name = str_replace('public/', '', $image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/pi_news'));

                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/' . $thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(540, 304)->save($path);

                //edit the the post credentials in database
                $post = News::find($id);
                $post->header = $request->header;
                $post->source = $request->source;
                $post->description = Purifier::clean($request->description, 'youtube');
                $post->story = Purifier::clean($request->story, 'youtube');
                $post->image = $image_name;
                $post->edited_by = Auth::id();
                $post->save();

                Session::flash('read_update', $id);

                $access_log = new AccessLog;
                $access_log->user = Auth::user()->username;
                $access_log->link_accessed = str_replace(url('/'),"",url()->current());
                $access_log->action_taken = "Edit Wfp Update";
                $access_log->action_details = 'WFP Update with id "'.$id.'" updated';
                $access_log->save();

                return back();
            } else {
                //edit the the post credentials in database
                $post = News::find($id);
                $post->header = $request->header;
                $post->source = $request->source;
                $post->description = Purifier::clean($request->description, 'youtube');
                $post->story = Purifier::clean($request->story, 'youtube');
                $post->edited_by = Auth::id();
                $post->save();

                Session::flash('read_update', $id);

                $access_log = new AccessLog;
                $access_log->user = Auth::user()->username;
                $access_log->link_accessed = str_replace(url('/'),"",url()->current());
                $access_log->action_taken = "Edit Wfp Update";
                $access_log->action_details = 'WFP Update with id "'.$id.'" updated';
                $access_log->save();

                return back();
            }
        }
    }

    public function like_update($id) {
        $like = new Like;
        $like->view_id = $id;
        $like->liked_by = Auth::id();
        $like->save();

        Session::flash('read_update', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Like Wfp Update";
        $access_log->action_details = 'Wfp update with id "'.$id.'" liked';
        $access_log->save();

        return back();
    }

    public function delete_update($id) {
        $post = News::find($id);
        $post->status = 0;
        $post->save();

        Session::flash('delete_update', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Delete Wfp Update";
        $access_log->action_details = 'WFP Update with id "'.$id.'" deleted';
        $access_log->save();

        return back();
    }
    
    public function resizenewsthumbnails() {
        //Delete all news thumnails
        $allimagethumbnails = Storage::files('public/thumbnails/pi_news');
        foreach($allimagethumbnails as $imagethumbnail){
            Storage::delete($imagethumbnail);
        }
        
        //Create thumnails from original image folder
        $allimages = Storage::files('public/pi_news');
        foreach($allimages as $image){
            $imagepath = storage_path('app/'.$image);
            $imagename = Image::make($imagepath)->basename;
            $imagethumbnailpath = storage_path('app/public/thumbnails/pi_news/' . $imagename);
            Image::make($imagepath)->fit(540, 304)->save($imagethumbnailpath);
        }
        
        return back();
    }

}
