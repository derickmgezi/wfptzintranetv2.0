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
    
    public function add_update() {
        Session::flash('add_update', 'Add an update Message');
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
            Image::make($path)->fit(3840, 1920)->save($path);


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
                $image_name = (string) ($request->image->store('public/pi_news'));
                $image_name = str_replace('public/', '', $image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/pi_news'));

                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/' . $thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(3840, 1920)->save($path);

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
                $Update_bio->image = $image_name;
                $Update_bio->bio = Purifier::clean($request->bio, 'youtube');
                $Update_bio->save();

                Session::flash('view_user_bio', $id);
                return back();
            } else {
                //Update User Bio
                $Update_bio = User::find($id);
                $Update_bio->bio = Purifier::clean($request->bio, 'youtube');
                $Update_bio->save();

                Session::flash('view_user_bio', $id);
                return back();
            }
        }
    }

}
