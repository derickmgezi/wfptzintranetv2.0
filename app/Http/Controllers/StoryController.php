<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Story;
use App\Storycomment;
use App\Storylike;
use App\Storyview;
use Auth;
use Purifier;
use Image;
use Session;
use Route;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\AccessLog;

class StoryController extends Controller {

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
        $access_log->action_taken = "Access Stori Yangu Page";
        
        if (session('storyurl') == 'storyviews') {
            $access_log->action_details = "Most visited Stories displayed";

            $stories = DB::table('stories')->join('storyviews', 'storyviews.story_id', '=', 'stories.id')
                    ->select(DB::raw('stories.id,stories.caption,stories.posted_by,stories.image,stories.created_at,storyviews.story_id,storyviews.viewed_by'))
                    ->groupBy('storyviews.story_id', 'storyviews.viewed_by')
                    ->where('stories.status', 1);

            $stories = DB::table(DB::raw("({$stories->toSql()}) as stories"))
                    ->mergeBindings($stories)
                    ->select(DB::raw('stories.id,stories.caption,stories.posted_by,stories.image,stories.created_at,count(stories.viewed_by) as views'))
                    ->groupBy('stories.story_id')
                    ->orderBy('views', 'desc')
                    ->paginate(9);
        } elseif (session('storyurl') == 'storylikes') {
            $access_log->action_details = "Most liked Stories displayed";

            $stories = DB::table('stories')->join('storylikes', 'stories.id', '=', 'storylikes.story_id')
                    ->select(DB::raw('stories.*,count(storylikes.liked_by) as likes'))
                    ->groupBy('storylikes.story_id')
                    ->where('stories.status', 1)
                    ->orderBy('likes', 'desc')
                    ->paginate(9);
        } elseif (session('storyurl') == 'storycomments') {
            $access_log->action_details = "Most commented on Stories displayed";

            $stories = DB::table('stories')->join('storycomments', 'stories.id', '=', 'storycomments.story_id')
                    ->select(DB::raw('stories.*,count(storycomments.comment_by) as comments'))
                    ->groupBy('storycomments.story_id')
                    ->where('stories.status', 1)
                    ->orderBy('comments', 'desc')
                    ->paginate(9);
        } elseif (session('storyurl') == NULL || session('storyurl') == 'lateststory') {
            $access_log->action_details = "Recent Story Yangu displayed";

            $stories = Story::where('status', 1)->orderBy('created_at', 'desc')
                    ->paginate(9);
        } elseif (session('storyurl') == 'mystory') {
            $access_log->action_details = "Stories uploaded by the user displayed";

            $stories = Story::where('status', 1)->where('posted_by', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);
        } elseif (session('storyurl') == 'unreadstory') {
            $access_log->action_details = "Unread Stories displayed";

            //$stories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = " . Auth::id() . " GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
            //$stories = Story::hydrate($stories);
            //$stories = new \Illuminate\Support\Collection($stories);
            //dd($stories);
            
            $stories = DB::table('storyviews')->select('story_id')->where('viewed_by',Auth::id())->groupBy('story_id');
            
            $stories = DB::table('stories')->leftJoin(DB::raw("({$stories->toSql()}) as readstories"), 'readstories.story_id', 'stories.id')
                                           ->mergeBindings($stories)
                                           ->whereNull('readstories.story_id')
                                           ->where('status',1)
                                           ->orderBy('id','desc')
                                           ->paginate(9);
        }

        $likes = Storylike::select("story_id", "liked_by")->orderBy('created_at')->get();
        $comments = Storycomment::select("story_id", "comment_by")->get();
        $views = Storyview::select("story_id", "viewed_by", "created_at")->orderBy('created_at', 'asc')->get();

        $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadnewsupdates' => count($unreadnewsupdates)]);
            
        $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = " . Auth::id() . " GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
        session(['unreadstories' => count($unreadstories)]);

        if(!Session::has('create_story') && !Session::has('new_story') && !Session::has('new_story_error') && !Session::has('edit_story_error') && !Session::has('delete_story'))
        $access_log->save();

        return view('storiyangu', compact('stories', 'likes', 'comments', 'views', 'unreadstories'));
    }
    
    public function lateststory() {
        session(['storyurl' => 'lateststory']);
        return $this->index();
    }

    public function unreadstory() {
        session(['storyurl' => 'unreadstory']);
        return $this->index();
    }
    
    public function storyviews() {
        session(['storyurl' => 'storyviews']);
        return $this->index();
    }
    
    public function storylikes() {
        session(['storyurl' => 'storylikes']);
        return $this->index();
    }
    
    public function storycomments() {
        session(['storyurl' => 'storycomments']);
        return $this->index();
    }
    
    public function mystory() {
        session(['storyurl' => 'mystory']);
        return $this->index();
    }

    public function storyindex() {
        //
        if (Session::has('story_id')) {
            $story = Story::find(Session::get('story_id'));
            $likes = Storylike::where('story_id', Session::get('story_id'))->count();
            $comments = Storycomment::where('story_id', Session::get('story_id'))->orderBy('created_at', 'asc')->get();
            $storyliked = Storylike::where('story_id', Session::get('story_id'))->where('liked_by', Auth::id())->get()->count();
            $views = Storyview::select('story_id', 'viewed_by', 'created_at')->where('story_id', Session::get('story_id'))->orderBy('created_at')->get();

            if ($storyliked != 0) {
                $liked = 1;
            } else {
                $liked = 0;
            }
            Session::flash('story_id', Session::get('story_id'));

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Display Story";
            $access_log->action_details = 'Story with id "'.Session::get('story_id').'" displayed';
            if(!Session::has('new_story') && !Session::has('like_story') && !Session::has('add_story_comment_error') && !Session::has('story_comment'))
            $access_log->save();

            return view('stori', compact('story', 'likes', 'liked', 'comments', 'views'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        Session::flash('create_story', 'Story Addition');

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Add Story";
        $access_log->action_details = 'Add Story Modal displayed';
        $access_log->save();

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $validator = Validator::make($request->all(), [
                    'image' => 'required|mimes:jpeg,bmp,png,bmp,gif,svg',
                    'caption' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('new_story_error', 'Story Creation Error');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store Story";
            $access_log->action_details = 'Storing of new story interrupted due to validation errors';
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput();
        } else {
            //Upload the file in storage public folder
            $image_name = (string) ($request->image->store('public/stories'));
            $image_name = str_replace('public/', '', $image_name);

            //Upload the file in storage thumbnail public folder
            $thumb_image_name = (string) ($request->image->store('public/thumbnails/stories'));

            //Get full path of uploaded image from the thumbnails
            $path = storage_path('app/' . $thumb_image_name);

            //Load the image into Intervention Package for manipulation
            Image::make($path)->fit(432, 432)->save($path);


            //store the post credentials in database
            $story = new Story;
            $story->caption = Purifier::clean($request->caption, 'youtube');
            $story->image = $image_name;
            $story->posted_by = Auth::id();
            $story->save();

            Session::flash('new_story', 'New Story cretaed');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store Story";
            $access_log->action_details = 'New story stored';
            $access_log->save();

            return redirect('/storiyangu');
        }
    }

    public function storecomment(Request $request, $id) {
        //
        $validator = Validator::make($request->all(), [
                    'comment' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('add_story_comment_error', 'Comment Empty');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store Comment";
            $access_log->action_details = 'Storing of new comment in story with id "'.$id.'" interrupted due to validation errors';
            $access_log->action_status = "Failed";
            $access_log->save();

            return $this->show($id)->withErrors($validator)->withInput();
        } else {
            $comment = new Storycomment;
            $comment->comment = Purifier::clean($request->comment, 'youtube');
            $comment->story_id = $id;
            $comment->comment_by = Auth::id();
            $comment->save();

            Session::flash('story_comment', $id);

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store Comment";
            $access_log->action_details = 'New comment in story with id "'.$id.'" stored';
            $access_log->save();

            return $this->show($id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $view = new Storyview;
        $view->story_id = $id;
        $view->viewed_by = Auth::id();
        $view->save();

        $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = " . Auth::id() . " GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");

        session(['unreadstories' => count($unreadstories)]);
        Session::flash('story_id', $id);
        return redirect('story');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $editstory = Story::find($id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Edit Story";
        $access_log->action_details = 'Edit Story modal for story with id "'.$id.'" displayed';
        $access_log->save();

        return back()->with('edit_story', $editstory);
    }

    public function like($id) {
        //
        $storyliked = Storylike::where('story_id', $id)->where('liked_by', Auth::id())->get()->count();

        if ($storyliked == 0) {
            $likestory = new Storylike;
            $likestory->story_id = $id;
            $likestory->liked_by = Auth::id();
            $likestory->save();
        }

        Session::flash('like_story', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Like Story";
        $access_log->action_details = 'Story with id "'.$id.'" liked';
        $access_log->save();

        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'caption' => 'required',
        ]);

        if ($validator->fails()) {
            $editstory = Story::find($id);
            Session::flash('edit_story_error', $editstory);

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Edit Story";
            $access_log->action_details = 'Editing story with id "'.$id.'" interrupted due to validation errors';
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput();
        } else {
            //store the post credentials in database
            $story = Story::find($id);
            $story->caption = Purifier::clean($request->caption, 'youtube');

            if ($request->image) {
                //Upload the file in storage public folder
                $image_name = (string) ($request->image->store('public/stories'));
                $image_name = str_replace('public/', '', $image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/stories'));

                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/' . $thumb_image_name);

                //Load the image into Intervention Package for manipulation
                Image::make($path)->fit(432, 432)->save($path);

                $story->image = $image_name;
            }

            $story->save();

            Session::flash('edit_story', $id);

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Edit Story";
            $access_log->action_details = 'Story with id "'.$id.'" edited';
            $access_log->save();

            return redirect('/storiyangu/' . $id);
        }
    }

    public function resizethumbnails() {
        //Delete all image thumnails
        $allimagethumbnails = Storage::files('public/thumbnails/stories');
        foreach ($allimagethumbnails as $imagethumbnail) {
            Storage::delete($imagethumbnail);
        }

        //Create thumnails from original image folder
        $allimages = Storage::files('public/stories');
        foreach ($allimages as $image) {
            $imagepath = storage_path('app/' . $image);
            $imagename = Image::make($imagepath)->basename;
            $imagethumbnailpath = storage_path('app/public/thumbnails/stories/' . $imagename);
            Image::make($imagepath)->fit(432, 432)->save($imagethumbnailpath);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $story = Story::find($id);
        $story->status = 0;
        $story->save();

        Session::flash('delete_story', $id);

        $access_log = new AccessLog;
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Delete Story";
        $access_log->action_details = 'Story with id "'.$id.'" deleted';
        $access_log->save();

        return back();
    }

}
