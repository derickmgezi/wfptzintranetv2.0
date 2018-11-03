<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Redirect;
use Illuminate\Http\Request;
use Adldap;
use App\User;
use Browser;
use DB;
use App\AccessLog;
use Route;
use Session;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(!Session::has('intended_url')){
            session(['intended_url' => str_replace(url('/'),"",url()->previous())]);
        }else{
            if(str_replace(url('/'),"",url()->previous()) != '' && str_replace(url('/'),"",url()->previous()) != '/'){
                session(['intended_url' => str_replace(url('/'),"",url()->previous())]);
            }
        }

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"/",url()->current());
        $access_log->action_taken = "Access Login Page";

        if (Auth::check()) {
            $access_log->user = Auth::user()->username;

            if(Browser::isIE()){
                $access_log->action_details = "Redirected to Internet Explorer error page";
                $access_log->action_status = "Failed";
                if(!Session::has('error'))
                $access_log->save();

                return view('errors.browser');
            }elseif(Auth::user()->title == 'Administrator'){
                // User is Administrator
                $access_log->action_details = "Redirected to Admin page";
                $access_log->save();

                return redirect('/manage');
            }else{
                // The user has already logged in...
                $access_log->action_details = "Redirected to Home page";
                if(!Session::has('error'))
                $access_log->save();

                return redirect('/home');
            }
        }else{
            // User has not logged in
            if(Browser::isIE()){
                $access_log->action_details = "Redirected to Internet Explorer error page";
                $access_log->action_status = "Failed";
                if(!Session::has('error'))
                $access_log->save();

                return view('errors.browser');
            }else{
                // Redirect to Login Page
                $access_log->action_details = "Redirected to Login page";
                if(!Session::has('error'))
                $access_log->save();

                return view('index');
            }
        }
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
        $access_log = new AccessLog;
        if(Auth::check())
        $access_log->user = Auth::user()->username;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Sign out of Wazo";
        $access_log->action_details = "Redirected to Sign in Page";
        $access_log->save();

        Auth::logout();
        session()->flush();
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request) {
        //if(Session::get('intended_url') == '')
        //session(['intended_url' => '/']);

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Sign in to Wazo";

        $validator = Validator::make($request->all(), [
                    'username' => 'required',
                    'password' => 'required',
        ]);

        if ($validator->fails()) {
            $access_log->user = $request->username;
            $access_log->action_details = "Redirected back to Sign in Page due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();
            
            return redirect('/')->withErrors($validator)->withInput()->with('error', 'Enter your Username and Password');
        } else {
            //Authenticate using normal Auth ruteen and Always Remember Users
            //$remember = true;
            //
            //if (Auth::attempt($request->only(['username', 'password']), $remember)) {
            //            // Authentication passed...
            //            return redirect()->intended('/home');
            //        } else {
            //            return back()->withInput()
            //                            ->with('error', 'Username and Password Authentication Failed');
            //        }

            // Check if string is WFP email address
            if (str_contains($request->username, '@wfp.org')) {
                $request->username = str_replace("@wfp.org","",$request->username);
            }
            
            // Catch exception if LDAP server is not available
            try{
                // Authenticating against your LDAP server.
                if (Adldap::auth()->attempt($request->username, $request->password)) {
                    // AD Authentication Passed!
                    // Update User Table with AD Password
                    $user_password_update = User::where('username', $request->username)->where('status',1)->update(['password' => bcrypt($request->password)]);

                    if ($user_password_update) {
                        // Always Remember Users
                        $remember = true;

                        // if (Auth::attempt($request->only(['username', 'password']), $remember)) {
                        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
                            // Authentication passed...
                            if(Auth::user()->title == 'Administrator'){
                                // User is Administrator
                                $access_log->user = Auth::user()->username;
                                $access_log->action_details = "Redirected to Admin Page";
                                $access_log->save();

                                return redirect('/manage');
                            }else{
                                $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
                                session(['unreadnewsupdates' => count($unreadnewsupdates)]);
                                
                                $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = ".Auth::id()." GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
                                session(['unreadstories' => count($unreadstories)]);
                                
                                $access_log->user = Auth::user()->username;
                                $access_log->action_details = "Redirected to Home Page";
                                $access_log->save();

                                //dd(Session::get('intended_url'));
                                return redirect()->intended(Session::get('intended_url'));
                            }
                            
                        } else {
                            $access_log->user = $request->username;
                            $access_log->action_details = "Redirected back to Sign in Page due to failed Wazo database authentication after LDAP Authentication was passed";
                            $access_log->action_status = "Failed";
                            $access_log->save();

                            return back()->withInput()->with('error', 'Username and Password Authentication Failed');
                        }
                    } else {
                        $access_log->user = $request->username;
                        $access_log->action_details = "Redirected back to Sign in Page; Access Denied";
                        $access_log->action_status = "Failed";
                        $access_log->save();

                        return back()->withInput()->with('error', 'Access Denied. Please inform your local IT forcal person or contant tanzania.itservicedesk@wfp.org');
                    }
                } else {
                    // AD Authentication failled!
                    $access_log->user = $request->username;
                    $access_log->action_details = "Redirected back to Sign in Page due to failed LDAP Authentication";
                    $access_log->action_status = "Failed";
                    $access_log->save();

                    return back()->withInput()->with('error', 'Username or Password Incorect');
                }
            // Try to Authenticate locally if Domain Server is not reachable
            } catch(\Exception $e){
                // Always Remember Users
                $remember = true;

                if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
                    // Authentication passed...
                    if(Auth::user()->title == 'Administrator'){
                        // User is Administrator
                        $access_log->user = Auth::user()->username;
                        $access_log->action_details = "Redirected to Admin Page after Wazo database Authentication. LDAP Server was not reachable";
                        $access_log->save();
                        
                        return redirect('/manage');
                    }
                    $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
                    session(['unreadnewsupdates' => count($unreadnewsupdates)]);
                    
                    $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = ".Auth::id()." GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
                    session(['unreadstories' => count($unreadstories)]);
                    
                    $access_log->user = Auth::user()->username;
                    $access_log->action_details = "Redirected to Home Page after Wazo database Authentication. LDAP Server was not reachable";
                    $access_log->save();
                    
                    //dd(Session::get('intended_url'));
                    return redirect()->intended(Session::get('intended_url'));
                } else {
                    $access_log->user = $request->username;
                    $access_log->action_details = "Redirected back to Sign in Page due to failed Wazo database Authentication after LDAP Server was not reachable or Adm credentials are invalid.";
                    $access_log->action_status = "Failed";
                    $access_log->save();
                    return back()->withInput()->with('error', 'Domain Server not reachable');
                }
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
