<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Image;
use App\Post;
use Purifier;
use Auth;

class ITController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return view('it')->with('dutystation','Country Office');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
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
            //Upload the file in storage public folder and get its name
            $image_name = $request->image->store('public/it_posts');
            $image_name = str_replace('public/','',$image_name);

            //Upload the file in storage thumbnail public folder and get uploaded image name
            $image_thumnail_name = $request->image->store('public/thumbnails/it_posts');
            $image_thumnail_name = str_replace('public/','',$image_thumnail_name);

            //Get the uploaded image full path
            $image_path = public_path('storage/' . $image_name);
            $image_thumbnail_path = public_path('storage/' . $image_thumnail_name);
            
            //Get the uploaded image from the thumbnails into the Intervention Package for manipulation
            Image::make($image_thumbnail_path)->fit(3840, 1920)->save($image_thumbnail_path);

            //store the post credentials in database
            $post = new Post;
            $post->header = $request->header;
            $post->description = Purifier::clean($request->description);
            $post->story = Purifier::clean($request->story);
            $post->type = 'IT_post';
            $post->image = $image_name;
            $post->created_by = Auth::id();
            $post->edited_by = Auth::id();
            $post->save();

            return redirect('/it');
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
                //Upload the file in storage public folder and get its name
                $image_name = $request->image->store('public/it_posts');
                $image_name = str_replace('public/','',$image_name);

                //Upload the file in storage thumbnail public folder and get uploaded image name
                $image_thumnail_name = $request->image->store('public/thumbnails/it_posts');
                $image_thumnail_name = str_replace('public/','',$image_thumnail_name);

                //Get the uploaded image full path
                $image_path = public_path('storage/' . $image_name);
                $image_thumbnail_path = public_path('storage/' . $image_thumnail_name);
                
                //Get the uploaded image from the thumbnails into the Intervention Package for manipulation
                Image::make($image_thumbnail_path)->fit(3840, 1920)->save($image_thumbnail_path);

                //edit the the post credentials in database
                $post = Post::find($id);
                $post->header = $request->header;
                $post->description = Purifier::clean($request->description);
                $post->story = Purifier::clean($request->story);
                $post->image = $image_name;
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
    public function destroy_post($id) {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();

        return redirect('/it');
    }

}
