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
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Notification;
use App\Notifications\UserProfileCreated;
use App\Notifications\UserProfileUpdated;
use Date;

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

    public function autoCreate() {
        //Get data from WFP HR API
        // Create a client with a base URI
        $client = new Client([
            'base_uri' => env('WFP_GLASS_BASE_URI')
            ]);

        // Get Glass User info from API usign POST
        //$response = $client->request('GET', '?q=email:eunice.mosha@wfp.org', [
        $response = $client->request('POST', '', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer '.env('WFP_GLASS_BEARER_TOKEN')
            ],
            RequestOptions::JSON => [
                "size" => 10,
                "query" => [
                    "match" => [
                        'country_name' => Auth::user()->country,
                    ]
                ]
            ]
        ]);
        
        //Get Body will all users
        //dd($response);
        //dd($response->getStatusCode());
        //dd($response->getReasonPhrase());
        //dd($response->getHeaders());
        //dd($response->getBody());
        //dd((string) $response->getBody());
        //dd($response->getBody()->read(10));
        //dd($response->getBody()->getContents());
        
        //Convert JSON Data into an Array
        $array_response = json_decode($response->getBody(), true);
        
        //Convert Array into a collection
        $collection_response = collect($array_response);
        
        //Data
        //dd($collection_response);

        // Now we loop until the scroll "cursors" are exhausted
        while (isset($collection_response['hits']['hits']) && count($collection_response['hits']['hits']) > 0) {
        
            //Multiple Actual User Data
            $glass_users= collect($collection_response['hits']['hits']);
            //dd($glass_users);
            
            //Single Actual User Data
            //$glass_user= collect($collection_response['hits']['hits'][0]['_source']);
            //dd($glass_user);
            //dd($glass_user->get('nte'));
            
            //Update Local database User details incase they differ with details from Azure
            // if($localuser->country != $azureuser->user['country'] || $localuser->region != $azureuser->user['department']){
            //     $user = User::find($localuser->id);
            //     $user->country = $azureuser->user['country'];
            //     $user->region = $azureuser->user['department'];
            //     $user->save();
            // }
            
            //Update Local database User details incase they differ with details from Glass
            foreach($glass_users as $glass_user){
                //Convert Array into a collection
                //$glass_user = collect($glass_user);

                //Multiple Actual User Data
                $glass_user= collect( $glass_user['_source']);
                //dd($glass_user);
                //dd($glass_user->get('nte'));

                //If Glass User doesn't exist Create User in Local database
                $glassusernte = new Date($glass_user->get('nte'));
                $glassusernte = $glassusernte->format("Y-m-d H:i:s");

                try{
                    $user = User::firstOrCreate(
                        ['email' => $glass_user->get('email')],
                        [
                            'firstname' => $glass_user->get('first_name'),
                            'secondname' => $glass_user->get('last_name'),
                            'username' => $glass_user->get('login_name'),
                            'title' => $glass_user->get('position_title'),
                            'department' => $glass_user->get('org_unit_description'),
                            'dutystation' => $glass_user->get('location_hierarchy'),
                            'country' => $glass_user->get('country_name'),
                            'region' => $glass_user->get('region_code'),
                            'nte' => $glassusernte,
                            'password' => bcrypt('Welcome@123')
                        ]
                    );

                    if($user->wasRecentlyCreated){
                        try{
                            //Send Email Notification to user after account has been created in Wazo
                            Notification::send($user, new UserProfileCreated($user));
                        }catch(\Exception $e){
                            //dd($e->getMessage());
                        }
                    }
                }catch (\Illuminate\Database\QueryException $exception) {
                    //dd($exception->getMessage());
                }
            }
        
            // When done, get the new scroll_id
            // You must always refresh your _scroll_id!  It can change sometimes
            $scroll_id = $collection_response['_scroll_id'];
            //dd($scroll_id);
        
            // Execute a Scroll request and repeat
            $response = $client->request('POST', '', [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer '.env('WFP_GLASS_BEARER_TOKEN')
                ],
                RequestOptions::QUERY => [
                    'scroll_id' => $scroll_id,  //...using our previously obtained _scroll_id
                ]
            ]);

            //Convert JSON Data into an Array
            $array_response = json_decode($response->getBody(), true);
                    
            //Convert Array into a collection
            $collection_response = collect($array_response);
            //dd($collection_response);
        }
        
        return back()->with('add_user_status', 'Users have automatically been added successfuly');
    }

    public function autoUpdateAllUsers() {
        //Retrive all users in the user database in a chunk of 50 and update details from Glass databse
        User::chunk(50, function ($localusers) {
            foreach ($localusers->sortBy('created_at') as $localuser) {
                //Get data from WFP HR API
                // Create a client with a base URI
                $client = new Client([
                    'base_uri' => env('WFP_GLASS_BASE_URI')
                    ]);
                
                // Get Glass User info from API
                //$response = $client->request('GET', '?q=email:martine.nicole', [
                $response = $client->request('GET', '?q=email:'.$localuser->email, [
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.env('WFP_GLASS_BEARER_TOKEN')
                    ],
                //    RequestOptions::QUERY => [
                //        'email' => 'derick.ruganuza@wfp.org'
                //    ]
                ]);
                
                //Get Body will all users
                //dd($response);
                //dd($response->getStatusCode());
                //dd($response->getReasonPhrase());
                //dd($response->getHeaders());
                //dd($response->getBody());
                //dd((string) $response->getBody());
                //dd($response->getBody()->read(10));
                //dd($response->getBody()->getContents());
                
                //Convert JSON Data into an Array
                $array_response = json_decode($response->getBody(), true);
                
                //Convert Array into a collection
                $collection_response = collect($array_response);
                
                //Data
                //dd($collection_response)
    
                //Multiple Actual User Data
                //$glass_users= collect($collection_response['hits']['hits']);
                //dd($glass_users);
                
                try{
                    //Single Actual User Data
                    $glass_user= collect($collection_response['hits']['hits'][0]['_source']);
                    //dd($glass_user);
                    //dd($glass_user->get('nte'));
                }catch(\Exception $exception){
                    //If user doesn't exist in Glass set nte to NULL
                    $glass_user = collect(['nte' => NULL, 'email' => $localuser->email]);
                    //dd($exception->getMessage());
                    //dd($glass_user);
                    //dd($localuser->email);
                }
                
                //Update Local database User details incase they differ with details from Glass
                $localusernte = new Date($localuser->nte);
                $localusernte = $localusernte->format("Y-m-d H:i:s");
    
                $glassusernte = new Date($glass_user->get('nte'));
                $glassusernte = $glassusernte->format("Y-m-d H:i:s");
    
                if($localusernte != $glassusernte && $glassusernte != NULL){
                    $user = User::find($localuser->id);
                    if($glass_user->get('position_title'))
                    $user->title = $glass_user->get('position_title');
                    $user->country = $glass_user->get('country_name');
                    $user->region = $glass_user->get('region_code');
                    $user->nte = $glassusernte;
                    if($glass_user->get('position_number')){
                        $user->account_status = "Active";
                    }else{
                        $user->account_status = "Inactive";
                    }
                    $user->save();

                    //Notify user if and only if user is in the same country as the local IT office
                    if($glass_user->get('country_name') == Auth::user()->country){
                        try{
                            //Send Email Notification to user that profile has been updated
                            Notification::send($user, new UserProfileUpdated($user));
                        }catch(\Exception $e){
                            //dd($e->getMessage());
                        }
                    }
                    
                }
            }
        });

        return back()->with('edit_user_status', 'Users details have been updated successfuly');
    }

    public function autoUpdateUser($id) {
        //Retrive all users in the user database and update details from Glass databse
        $localuser = User::find($id);
        
        //Get data from WFP HR API
        // Create a client with a base URI
        $client = new Client([
            'base_uri' => env('WFP_GLASS_BASE_URI')
            ]);
        
        // Get Glass User info from API
        //$response = $client->request('GET', '?q=email:wendy.bigham@wfp.org', [
        $response = $client->request('GET', '?q=email:'.$localuser->email, [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer '.env('WFP_GLASS_BEARER_TOKEN')
            ],
        //    RequestOptions::QUERY => [
        //        'email' => 'derick.ruganuza@wfp.org'
        //    ]
        ]);
        
        //Get Body will all users
        //dd($response);
        //dd($response->getStatusCode());
        //dd($response->getReasonPhrase());
        //dd($response->getHeaders());
        //dd($response->getBody());
        //dd((string) $response->getBody());
        //dd($response->getBody()->read(10));
        //dd($response->getBody()->getContents());
        
        //Convert JSON Data into an Array
        $array_response = json_decode($response->getBody(), true);
        
        //Convert Array into a collection
        $collection_response = collect($array_response);
        
        //Data
        //dd($collection_response)
        //Multiple Actual User Data
        //$glass_users= collect($collection_response['hits']['hits']);
        //dd($glass_users);
        
        try{
            //Single Actual User Data
            $glass_user= collect($collection_response['hits']['hits'][0]['_source']);
            //dd($glass_user);
            //dd($glass_user->get('nte'));
        }catch(\Exception $exception){
            //If user doesn't exist in Glass set nte to NULL
            $glass_user = collect(['email' => NULL]);
            //dd($exception->getMessage());
            //dd($glass_user);
            //dd($localuser->email);
        }
        
        //Update Local database User details incase they differ with details from Glass
        $localusernte = new Date($localuser->nte);
        $localusernte = $localusernte->format("Y-m-d H:i:s");

        $glassusernte = new Date($glass_user->get('nte'));
        $glassusernte = $glassusernte->format("Y-m-d H:i:s");

        if($localusernte != $glassusernte && $glass_user->get('email') != NULL){
            $user = User::find($localuser->id);
            if($glass_user->get('position_title'))
            $user->title = $glass_user->get('position_title');
            $user->country = $glass_user->get('country_name');
            $user->region = $glass_user->get('region_code');
            $user->nte = $glassusernte;
            if($glass_user->get('position_number')){
                $user->account_status = "Active";
            }else{
                $user->account_status = "Inactive";
            }
            $user->save();

            //Notify user if and only if user is in the same country as the local IT office
            if($glass_user->get('country_name') == Auth::user()->country){
                try{
                    //Send Email Notification to user that profile has been updated
                    Notification::send($user, new UserProfileUpdated($user));
                }catch(\Exception $e){
                    //dd($e->getMessage());
                }
            }
        }
        
        return back()->with('edit_user_status', 'User details have been updated successfuly');
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
