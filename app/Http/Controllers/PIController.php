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

class PIController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_post() {
        Session::flash('create_post', 'Create Post Message');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_post(Request $request) {
        //
        $validator = Validator::make($request->all(), [
                    'header' => 'required',
                    'image' => 'required|mimes:jpeg,bmp,png,bmp,gif,svg',
                    'description' => 'required',
                    'story' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('new_post_error', 'Post Creation Error');
            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            //Upload the file in storage public folder
            $request->image->store('public/pi_posts');

            //Upload the file in storage thumbnail public folder
            $request->image->store('public/thumbnails/pi_posts');

            //Get uploaded image name from the thumbnails
            $image_name = $request->image->store('thumbnails/pi_posts');

            //Load the image into Intervention Package for manipulation
            $path = public_path('storage/' . $image_name);
            Image::make('storage/' . $image_name)->fit(3840, 1920)->save($path);


            //store the post credentials in database
            $post = new Post;
            $post->header = $request->header;
            $post->description = Purifier::clean($request->description);
            $post->story = Purifier::clean($request->story);
            $post->type = 'PI_post';
            $post->image = $request->image->store('pi_posts');
            $post->created_by = Auth::id();
            $post->edited_by = Auth::id();
            $post->save();

            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_post($id) {
        $post = Post::find($id);
        Session::flash('read_post', $id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_post($id) {
        Session::flash('post_id', $id);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_post(Request $request, $id) {
        //
        $validator = Validator::make($request->all(), [
                    'header' => 'required',
                    'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
                    'description' => 'required',
                    'story' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('post_id', $id);
            Session::flash('edit_post_error', 'Post Edition Error');
            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            if ($request->image) {
                //Upload the file in storage public folder
                $request->image->store('public/pi_posts');

                //Upload the file in storage thumbnail public folder
                $request->image->store('public/thumbnails/pi_posts');

                //get uploaded image name
                $image_name = $request->image->store('thumbnails/pi_posts');

                //Get the uploaded image from the thumbnails into the Intervention Package for manipulation
                $path = public_path('storage/' . $image_name);
                Image::make('storage/' . $image_name)->fit(3840, 1920)->save($path);

                //edit the the post credentials in database
                $post = Post::find($id);
                $post->header = $request->header;
                $post->description = Purifier::clean($request->description);
                $post->story = Purifier::clean($request->story);
                $post->image = $request->image->store('pi_posts');
                $post->edited_by = Auth::id();
                $post->save();

                Session::flash('read_post', $id);
                return back();
            } else {
                //edit the the post credentials in database
                $post = Post::find($id);
                $post->header = $request->header;
                $post->description = Purifier::clean($request->description);
                $post->story = Purifier::clean($request->story);
                $post->edited_by = Auth::id();
                $post->save();

                Session::flash('read_post', $id);
                return back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_post($id) {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();

        return redirect('/home');
    }

    public function create_news_post() {
        Session::flash('create_news_post', 'Create News Post Message');
        return back();
    }

    public function store_news_post(Request $request) {
        //
        $validator = Validator::make($request->all(), [
                    'header' => 'required',
                    'image' => 'required|mimes:jpeg,bmp,png,bmp,gif,svg',
                    'source' => 'required',
                    'description' => 'required',
                    'story' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('new_news_post_error', 'News Post Creation Error');
            return redirect('/home')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            //Upload the file in storage/app/public/pi_news folder 
            $request->image->store('public/pi_news');

            //Upload the file in storage thumbnail public folder
            $request->image->store('public/thumbnails/pi_news');

            //Get uploaded image name from the thumbnails
            $image_name = $request->image->store('thumbnails/pi_news');

            //Load the image into the Image Intervention Package for manipulation
            $path = public_path('storage/' . $image_name);
            Image::make('storage/' . $image_name)->fit(3840, 1920)->save($path);


            //store the post credentials in database
            $post = new News;
            $post->header = $request->header;
            $post->description = Purifier::clean($request->description);
            $post->story = Purifier::clean($request->story);
            $post->source = $request->source;
            $post->type = 'PI_news';
            $post->image = $request->image->store('pi_news');
            $post->created_by = Auth::id();
            $post->edited_by = Auth::id();
            $post->save();

            return redirect('/home');
        }
    }

    public function show_news_post($id) {
        $news_post = News::find($id);
        Session::flash('read_news_post', $id);
        return back();
    }

    public function edit_news_post($id) {
        Session::flash('news_post_id', $id);
        return back();
    }

    public function update_news_post(Request $request, $id) {
        //
        $validator = Validator::make($request->all(), [
                    'header' => 'required',
                    'source' => 'required',
                    'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
                    'description' => 'required',
                    'story' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('news_post_id', $id);
            Session::flash('edit_news_post_error', 'News Post Edition Error');
            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            if ($request->image) {
                //Upload the file in storage/app/public/pi_news folder 
                $request->image->store('public/pi_news');

                //Upload the file in storage thumbnail public folder
                $request->image->store('public/thumbnails/pi_news');

                //Get uploaded image name from the thumbnails
                $image_name = $request->image->store('thumbnails/pi_news');

                //Load the image into the Image Intervention Package for manipulation
                $path = public_path('storage/' . $image_name);
                Image::make('storage/' . $image_name)->fit(3840, 1920)->save($path);

                //edit the the post credentials in database
                $post = News::find($id);
                $post->header = $request->header;
                $post->source = $request->source;
                $post->description = Purifier::clean($request->description);
                $post->story = Purifier::clean($request->story);
                $post->image = $request->image->store('pi_news');
                $post->edited_by = Auth::id();
                $post->save();

                Session::flash('read_news_post', $id);
                return back();
            } else {
                //edit the the post credentials in database
                $post = News::find($id);
                $post->header = $request->header;
                $post->source = $request->source;
                $post->description = Purifier::clean($request->description);
                $post->story = Purifier::clean($request->story);
                $post->edited_by = Auth::id();
                $post->save();

                Session::flash('read_news_post', $id);
                return back();
            }
        }
    }

    public function delete_news_post($id) {
        $post = News::find($id);
        $post->status = 0;
        $post->save();

        return redirect('/home');
    }

}
