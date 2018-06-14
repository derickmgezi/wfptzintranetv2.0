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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class StoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if(Route::current()->uri == 'storyviews'){
            $stories = DB::table('stories')->join('storyviews','storyviews.story_id', '=', 'stories.id')
                                           ->select(DB::raw('stories.id,stories.caption,stories.posted_by,stories.image,stories.created_at,storyviews.story_id,storyviews.viewed_by'))
                                           ->groupBy('storyviews.story_id','storyviews.viewed_by')
                                           ->where('stories.status', 1);

            $stories = DB::table(DB::raw("({$stories->toSql()}) as stories"))
                         ->mergeBindings($stories)
                         ->select(DB::raw('stories.id,stories.caption,stories.posted_by,stories.image,stories.created_at,count(stories.viewed_by) as views'))
                         ->groupBy('stories.story_id')
                         ->orderBy('views','desc')
                         ->paginate(9);

        }elseif(Route::current()->uri == 'storylikes'){
            $stories = DB::table('stories')->join('storylikes','stories.id', '=', 'storylikes.story_id')
                                           ->select(DB::raw('stories.*,count(storylikes.liked_by) as likes'))
                                           ->groupBy('storylikes.story_id')
                                           ->where('stories.status', 1)
                                           ->orderBy('likes','desc')
                                           ->paginate(9);

        }elseif(Route::current()->uri == 'storycomments'){
            $stories = DB::table('stories')->join('storycomments','stories.id', '=', 'storycomments.story_id')
                                           ->select(DB::raw('stories.*,count(storycomments.comment_by) as comments'))
                                           ->groupBy('storycomments.story_id')
                                           ->where('stories.status', 1)
                                           ->orderBy('comments','desc')
                                           ->paginate(9);
            
        }elseif(Route::current()->uri == 'storiyangu'){
            $stories = Story::where('status', 1)->orderBy('created_at', 'desc')
                                                ->paginate(9);
            
        }elseif(Route::current()->uri == 'mystory'){
            $stories = Story::where('status', 1)->where('posted_by',Auth::id())
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(9);
        }
        
        $likes = Storylike::select("story_id","liked_by")->orderBy('created_at')->get();
        $comments = Storycomment::select("story_id","comment_by")->get();
        $views = Storyview::select("story_id", "viewed_by","created_at")->orderBy('created_at', 'asc')->get();

        //dd($views->toArray());

        return view('storiyangu', compact('stories', 'likes', 'comments', 'views'));
    }

    public function storyindex() {
        //
        if (Session::has('story_id')) {
            $story = Story::find(Session::get('story_id'));
            $likes = Storylike::where('story_id', Session::get('story_id'))->count();
            $comments = Storycomment::where('story_id', Session::get('story_id'))->orderBy('created_at', 'asc')->get();
            $storyliked = Storylike::where('story_id', Session::get('story_id'))->where('liked_by', Auth::id())->get()->count();
            $views = Storyview::select('story_id', 'viewed_by','created_at')->where('story_id', Session::get('story_id'))->orderBy('created_at')->get();

            if ($storyliked != 0) {
                $liked = 1;
            } else {
                $liked = 0;
            }
            Session::flash('story_id', Session::get('story_id'));
            return view('stori' , compact('story', 'likes', 'liked', 'comments', 'views'));
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
            Image::make($path)->fit(3840, 1920)->save($path);


            //store the post credentials in database
            $story = new Story;
            $story->caption = Purifier::clean($request->caption, 'youtube');
            $story->image = $image_name;
            $story->posted_by = Auth::id();
            $story->save();

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
            return back()->withErrors($validator)->withInput();
        } else {
            $comment = new Storycomment;
            $comment->comment = Purifier::clean($request->comment, 'youtube');
            $comment->story_id = $id;
            $comment->comment_by = Auth::id();
            $comment->save();
        }

        return $this->show($id);
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
                Image::make($path)->fit(3840, 1920)->save($path);

                $story->image = $image_name;
            }

            $story->save();

            return redirect('/storiyangu/' . $id);
        }
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

        return back();
    }

}
