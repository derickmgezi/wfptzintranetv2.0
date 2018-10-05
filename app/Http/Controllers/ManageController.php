<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Editor;
use Illuminate\Validation\Rule;

class ManageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $users = User::all();
        $editors = Editor::all();
        return view('manage')->withUsers($users)
                            ->withEditors($editors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return back()->with('add_user', 'Create new User');
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
                    'firstname' => 'required',
                    'secondname' => 'required',
                    'username' => 'required|unique:users,username',
                    'email' => 'required|email',
                    'title' => 'required',
                    'department' => 'required',
                    'dutystation' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                            ->withInput()
                            ->with('add_user_error', 'Validation Error');
        } else {
            //add new user into users Table
            $user = new User;
            $user->firstname = $request->firstname;
            $user->secondname = $request->secondname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->title = $request->title;
            $user->title = $request->title;
            $user->department = $request->department;
            $user->dutystation = $request->dutystation;
            $user->password = bcrypt('Welcome@123');
            $user->save();

            return back()->with('add_user_status', 'User has been created successfuly');
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
        $edit_user = User::find($id);
        return back()->with('edit_user', $edit_user);
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
        $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'secondname' => 'required',
                    'username' => ['required', Rule::unique('users')->ignore($id),],
                    'email' => 'required|email',
                    'title' => 'required',
                    'department' => 'required',
                    'dutystation' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                            ->withInput()
                            ->with('edit_user_error', $id);
        } else {
            //edit user
            $edit_user = User::find($id);
            $edit_user->firstname = $request->firstname;
            $edit_user->secondname = $request->secondname;
            $edit_user->username = $request->username;
            $edit_user->email = $request->email;
            $edit_user->title = $request->title;
            $edit_user->department = $request->department;
            $edit_user->dutystation = $request->dutystation;
            $edit_user->save();
            
            return back()->with('edit_user_status', 'User has been edited successfuly');
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
        $user = User::find($id);
        if($user->status){
            $user->status = 0;
            $user->save();
            $user_status = "User's access has been locked";
        }else{
            $user->status = 1;
            $user->save();
            $user_status = "User's access has been unlocked";
        }
        return back()->with('user_status', $user_status);
    }

}
