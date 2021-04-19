<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use App\Editor;
use App\ResourceManager;
use App\ResourceType;
use App\AccessLog;
use Illuminate\Validation\Rule;
use Session;

class ManageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if(Auth::user()->department == "IT"){
            $users = User::orderBy('id','desc')->get();
            $editors = Editor::orderBy('id','desc')->get();
            $resource_types = ResourceType::where('status',1)->get();
            $managed_resources = ResourceManager::select('user','resource_type_id','status')->get();
            $resource_managers = ResourceManager::select('user')->groupBy('user')->get();

            $access_log = new AccessLog;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Accessed User Managment Page";
            $access_log->user = Auth::user()->username;
            $access_log->action_details = "Redirected to Admin Page";
            $access_log->save();

            if(!(Session::has('add_user_error') || Session::has('add_user_status') || Session::has('edit_user') || Session::has('edit_user_status') || Session::has('edit_user_error') || Session::has('user_status') || Session::has('add_editor_error') || Session::has('add_editor_status') || Session::has('edit_editor') || Session::has('edit_editor_status') || Session::has('edit_editor_error') || Session::has('editor_status') || Session::has('add_resource_manager_error') || Session::has('add_resource_manager_status') || Session::has('edit_resource_manager') || Session::has('edit_resource_manager_status') || Session::has('edit_resource_manager_error') || Session::has('resource_manager_status'))){
                Session::flash('view_users','All registered users');
            }

            return view('manage')->withUsers($users)
                                ->withEditors($editors)
                                ->withResourcetypes($resource_types)
                                ->withResourcemanagers($resource_managers)
                                ->withManagedresources($managed_resources);
        }else{
            return back();
        }
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

    public function storeResourceManager(Request $request) {
        //
        $validator = Validator::make($request->all(), [
                    'username' => 'required|unique:resourcemanagers,user',
                    'resource' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                            ->withInput()
                            ->with('add_resource_manager_error', 'Validation Error');
        } else {
            //add new user into resource manager table
            foreach($request->resource as $resource){
                $resource_manager = new ResourceManager;
                $resource_manager->user = $request->username;
                $resource_manager->resource_type_id = $resource;
                $resource_manager->created_by = Auth::id();
                $resource_manager->edited_by = Auth::id();
                $resource_manager->save();
            }
            

            return back()->with('add_resource_manager_status', 'Resource Manager has been created successfuly');
        }
    }

    public function editResourceManager($id) {
        //
        $resource_manager = ResourceManager::where('user',$id)->get();

        return back()->with('edit_resource_manager',$resource_manager);
    }

    public function changeResourceManager(Request $request,$id) {
        //Get all managed resources assigned to user 
        $managed_resources = ResourceManager::where('user',$id)->where('status',1)->get();

        //Get all un-managed resources previously assigned to user
        $unmanaged_resources = ResourceManager::where('user',$id)->where('status',0)->get();

        //Get all managed and unmanaged resources
        $all_resources = ResourceManager::select('resource_type_id')->where('user',$id)->get();

        //Update status of managed resources to 0
        $update_managed_resources = $managed_resources->whereNotIn('resource_type_id' , $request->resource);

        foreach($update_managed_resources as $update_managed_resource){
            $unmanage_resource = ResourceManager::find($update_managed_resource->id);
            $unmanage_resource->status = 0;
            $unmanage_resource->save();
        }

        //Update status of unmanaged resources to 1
        $unmanaged_resources = $unmanaged_resources->whereIn('resource_type_id' , $request->resource);

        foreach($unmanaged_resources as $unmanaged_resource){
            $manage_resource = ResourceManager::find($unmanaged_resource->id);
            $manage_resource->status = 1;
            $manage_resource->save();
        }

        //Add new managed resource
        $form_resources = collect($request->resource);
        $new_resources = $form_resources->diff($all_resources->pluck('resource_type_id'));

        foreach($new_resources as $new_resource){
            $add_resource = new ResourceManager;
            $add_resource->user = $id;
            $add_resource->resource_type_id = $new_resource;
            $add_resource->created_by = Auth::id();
            $add_resource->edited_by = Auth::id();
            $add_resource->save();
        }

        return back()->with('edit_resource_manager_status', 'Resource Manager has been edited successfuly');
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
