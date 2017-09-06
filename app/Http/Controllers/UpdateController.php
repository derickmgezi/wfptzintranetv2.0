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

class UpdateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    public function create_update() {
        Session::flash('create_update', 'Create Update Message');
        return back();
    }

    public function store_update(Request $request,$department,$dutystation) {
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
            return back()
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
            $post->type = $department;
            $post->office = $dutystation;
            $post->image = $request->image->store('pi_news');
            $post->created_by = Auth::id();
            $post->edited_by = Auth::id();
            $post->save();

            return back();
        }
    }

    public function show_update($id) {
        //Record the view in the Database
        $view = new View;
        $view->view_id = $id;
        $view->viewed_by = Auth::id();
        $view->save();
        
        $update = News::find($id);
        Session::flash('read_update', $id);
        return back();
    }

    public function edit_update($id) {
        Session::flash('update_id', $id);
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

                Session::flash('read_update', $id);
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

                Session::flash('read_update', $id);
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
        return back();
    }

    public function delete_update($id) {
        $post = News::find($id);
        $post->status = 0;
        $post->save();

        return back();
    }

    public function show_user_bio($id) {
        Session::flash('view_user_bio', $id);
        return back();
    }

    public function add_user_bio($id) {
        Session::flash('add_user_bio', $id);
        return back();
    }

    public function update_user_bio(Request $request, $id) {
        //
        $validator = Validator::make($request->all(), [
                    'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
        ]);

        if ($validator->fails()) {
            Session::flash('add_user_bio', $id);
            Session::flash('add_bio_error', 'Bio Update Error');
            return back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            if ($request->image) {
                //Upload the file in storage public folder
                $request->image->store('public/profile_pictures');

                //Update User Bio
                $Update_bio = User::find($id);
                $Update_bio->image = $request->image->store('profile_pictures');
                $Update_bio->bio = Purifier::clean($request->bio);
                $Update_bio->save();

                Session::flash('view_user_bio', $id);
                return back();
            } else {
                //Update User Bio
                $Update_bio = User::find($id);
                $Update_bio->bio = Purifier::clean($request->bio);
                $Update_bio->save();
                
                Session::flash('view_user_bio', $id);
                return back();
            }
        }
    }

}
