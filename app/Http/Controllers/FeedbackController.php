<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Feedback;
use Auth;
use Purifier;

class FeedbackController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $feedback = Feedback::orderBy('id','desc')->paginate(5);
        return view('feedback')->with('feedback',$feedback);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Store Feedback
        $validator = Validator::make($request->all(), [
                    'feedback' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                   ->withErrors($validator)
                   ->withInput();
        }else{
            //store the post credentials in database
            $feedback = new Feedback;
            $feedback->feedback_by = Auth::id();
            $feedback->feedback = Purifier::clean($request->feedback, 'youtube');
            $feedback->save();

            return back()->with('add_feedback','Your feedback has been received');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
