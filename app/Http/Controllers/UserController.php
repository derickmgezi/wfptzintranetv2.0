<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Redirect;
use Illuminate\Http\Request;
use Adldap;
use App\User;
use Browser;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Browser::isIE()){
            return view('errors.browser');
        }
        
        if (Auth::check()) {
            if(Auth::user()->title == 'Administrator'){
                //User is Administrator
                return redirect('/manage');
            }
            // The user is logged in...
            return redirect('/home');
        }
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function logout() {
        //
        Auth::logout();
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'username' => 'required',
                    'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            //Authenticate using normal Auth ruteen and Always Remember Users
//            $remember = true;
//            
//            if (Auth::attempt($request->only(['username', 'password']), $remember)) {
//                        // Authentication passed...
//                        return redirect()->intended('/home');
//                    } else {
//                        return back()->withInput()
//                                        ->with('error', 'Username and Password Authentication Failed');
//                    }
            //Check if string is WFP email address
            if (str_contains($request->username, '@wfp.org')) {
                $request->username = str_replace("@wfp.org","",$request->username);
            }
            // Authenticating against your LDAP server.
            if (Adldap::auth()->attempt($request->username, $request->password)) {
                // AD Authentication Passed!
                //Update User Table with AD Password
                $user_password_update = User::where('username', $request->username)->where('status',1)->update(['password' => bcrypt($request->password)]);

                if ($user_password_update) {
                    // Always Remember Users
                    $remember = true;

//                    if (Auth::attempt($request->only(['username', 'password']), $remember)) {
                    if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
                        // Authentication passed...
                        if(Auth::user()->title == 'Administrator'){
                            //User is Administrator
                            return redirect('/manage');
                        }
                        return redirect()->intended('/home');
                    } else {
                        return back()->withInput()
                                        ->with('error', 'Username and Password Authentication Failed');
                    }
                } else {
                    return back()->withInput()
                                    ->with('error', 'Access Denied');
                }
            } else {
                // AD Authentication failled!
                return back()->withInput()
                                ->with('error', 'Username or Password Incorect');
            }
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
