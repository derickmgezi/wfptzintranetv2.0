<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Helper;
use App\AccessLog;
use App\ResourceType;
use App\ResourceSubfolder;
use App\ResourceManager;
use Route;
use Auth;
use Redirect;
use App\Resource;
use Image;
Use App\ResourceCategory;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = "Access WFP Resources Page";
        $access_log->action_details = "Redirected to Resources Page";
        $access_log->user = Auth::user()->username;
        $access_log->save();

        $resource_types = ResourceType::select('id','resource_type')->where('status',1)->get();
        $resource_subfolders = ResourceSubfolder::select('id','resource_type','subfolder_name')->where('status',1)->orderBy('created_at')->get();
        $all_resources = Resource::where('status',1)->orderBy('position','desc')->get();
        $resource_managers= ResourceManager::where('status',1)->get();

        return view('resources')->with('all_resources',$all_resources)->with('resource_subfolders',$resource_subfolders)->with('resource_types',$resource_types)->with('resource_managers',$resource_managers);
    }

    public function resourcetabs() {

        $quick_links = DB::table('resourcecategory')
                         ->join('resourcetypes','resourcecategory.id','=','resourcetypes.category_id')
                         ->join('resourcesubfolders','resourcetypes.id','=','resourcesubfolders.resource_type_id')
                         ->join('resources','resourcesubfolders.id','=','resources.subfolder_id')
                         ->where('resourcecategory.category','Quick links')
                         ->where('resourcecategory.status',1)
                         ->where('resourcetypes.status',1)
                         ->where('resourcesubfolders.status',1)
                         ->where('resources.status',1)
                         ->orderBy('resources.id')
                         ->select('resourcecategory.category','resourcetypes.resource_type','resources.resource_name','resources.resource_location','resources.external_link')
                         ->get();
        //dd($quick_links);

        $resource_categories = ResourceCategory::where('status',1)->orderBy('position')->get();
        $resource_supporting_units = ResourceType::select('id','resource_type','image','category_id')->where('status',1)->get();

        return view('resourcetabsnew')->with('resource_supporting_units',$resource_supporting_units)->with('resource_categories',$resource_categories)->with('quick_links',$quick_links);
    }

    public function resourcesnew() {
        return view('resourcesnew');
    }
    
    public function resourcestabs($id) {

        $resource_type = ResourceType::find($id);
        $resource_supporting_units_subfolders = ResourceSubfolder::select('id','resource_type_id','subfolder_name','image')->where('resource_type_id',$id)->where('status',1)->orderBy('position')->get();
        $supporting_unit_resources = Resource::all();

        return view('resourcestabs')->with('resource_type',$resource_type)->with('resource_supporting_units_subfolders',$resource_supporting_units_subfolders)->with('supporting_unit_resources',$supporting_unit_resources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcategory(){
        return back()->with('add_resource_category','Add new resource category');
    }

    public function addtab($id) {
        //
        $category = ResourceCategory::find($id);

        if($category->category == 'Quick links'){
            return back()->with('add_quick_link','Add new Quick link resource tab')->with('category',$category);
        }else{
            return back()->with('add_resource_tab','Add new resource tab')->with('category',$category);
        }
        
    }

    public function edittab($id) {
        //
        $resourcetype = ResourceType::find($id);
        //dd($resourcetype->image);
        
        return back()->with('edit_resource_tab',$resourcetype);
    }

    public function changetab(Request $request,$id) {
        //
        $resourcetype = ResourceType::find($id);

        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
            'resource_tab_name' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('edit_resource_tab_error', 'Edit Resource Tab Validation Failed');

            // $access_log = new AccessLog;
            // $access_log->user = Auth::user()->username;
            // $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            // $access_log->action_taken = "Store ".$type." Resource";
            // $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            // $access_log->action_status = "Failed";
            // $access_log->save();

            return back()->withErrors($validator)->withInput()->with('edit_resource_tab', $resourcetype);
        }else{
            $image_name = '';

            if ($request->image) {
                //Upload the file in storage/app/public/profile_pictures folder
                $image_name = (string) ($request->image->store('public/resource_unit_images'));
                $image_name = str_replace('public/','',$image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/resource_unit_images'));
                
                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/'.$thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(300, 300)->save($path);

            }
            //dd($request->image);

            $resourcetype->resource_type = $request->resource_tab_name;
            $resourcetype->edited_by = Auth::id();
            if($request->image){
                $resourcetype->image = $image_name;
            }
            $resourcetype->save();

            if($request->image){
                $null_subfolder = ResourceSubfolder::where('subfolder_name',NULL)
                                                    ->where('resource_type_id',$id)
                                                    ->update(['image' => $image_name]);
            }
            
            return back()->with('resource_type',$resourcetype);
        }
    }

    public function deletetab($id) {
        //
        $resourcetype = ResourceType::find($id);
        
        return back()->with('delete_resource_tab',$resourcetype);
    }

    public function removetab($id) {
        //
        $resourcetype = ResourceType::find($id);
        $resourcetype->status = 0;
        $resourcetype->edited_by = Auth::id();
        $resourcetype->save();
        
        return back();
    }

    public function createfolder($type) {
        //
        Session::flash('add_resource_folder', 'Create new resource subfolder');

        return back()->with('resourcetype',$type);
    }

    public function editfolder($id) {
        //
        $resource_subfolder = ResourceSubfolder::find($id);
        
        return back()->with('edit_resource_folder',$resource_subfolder);
    }

    public function changefolder(Request $request,$id) {
        //
        $resource_subfolder = ResourceSubfolder::find($id);

        $validator = Validator::make($request->all(), [
            'subfolder_name' => 'required|unique:resourcesubfolders,subfolder_name',
        ]);

        if ($validator->fails()) {
            Session::flash('edit_resource_folder_error', 'Edit Subfolder Validation Failed');

            // $access_log = new AccessLog;
            // $access_log->user = Auth::user()->username;
            // $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            // $access_log->action_taken = "Store ".$type." Resource";
            // $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            // $access_log->action_status = "Failed";
            // $access_log->save();

            return back()->withErrors($validator)->withInput()->with('edit_resource_folder', $resource_subfolder);
        }else{
                $resource_subfolder->subfolder_name = $request->subfolder_name;
                $resource_subfolder->edited_by = Auth::id();
                $resource_subfolder->save();
                
                return back();
        }
    }

    public function deletefolder($id) {
        //
        $resource_subfolder = ResourceSubfolder::find($id);
        
        return back()->with('delete_resource_folder',$resource_subfolder);
    }

    public function removefolder($id) {
        //
        $resource_subfolder = ResourceSubfolder::find($id);
        $resource_subfolder->status = 0;
        $resource_subfolder->edited_by = Auth::id();
        $resource_subfolder->save();
        
        return back();
    }

    public function create($type) {
        //
        Session::flash('add_resource', 'Add new resource');
        $resource_types = ResourceType::where('status',1)->get();
        $resource_subfolders = ResourceSubfolder::where('status',1)->get();

        return back()->with('resourcetype',$type)->with('resource_types',$resource_types)->with('resource_subfolders',$resource_subfolders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storefolder(Request $request,$type) {
        $validator = Validator::make($request->all(), [
            'subfolder_name' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('add_resource_folder_error', 'New Resource Tab Validation Failed');

            // $access_log = new AccessLog;
            // $access_log->user = Auth::user()->username;
            // $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            // $access_log->action_taken = "Store ".$type." Resource";
            // $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            // $access_log->action_status = "Failed";
            // $access_log->save();

            return back()->withErrors($validator)->withInput()->with('resourcetype',$type);
        }else{
            $resource_type_id = ResourceType::where('resource_type',$type)->where('status',1)->value('id');

            $count_resource_subfolder = ResourceSubfolder::where('resource_type_id',$resource_type_id)->where('status',1)->count();

            $new_subfolder = new ResourceSubfolder;
            $new_subfolder->resource_type_id = $resource_type_id;
            $new_subfolder->subfolder_name = $request->subfolder_name;
            $new_subfolder->position = $count_resource_subfolder + 1;
            $new_subfolder->created_by = Auth::id();
            $new_subfolder->edited_by = Auth::id();
            $new_subfolder->save();

            return back();
        }
    }

    public function storecategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,bmp,png,bmp,gif,svg',
            'resource_category_name' => 'required|unique:resourcecategory,category',
        ]);

        if ($validator->fails()) {
            Session::flash('add_resource_category_error', 'New Resource Category Validation Failed');
            
            // $access_log = new AccessLog;
            // $access_log->user = Auth::user()->username;
            // $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            // $access_log->action_taken = "Store ".$type." Resource";
            // $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            // $access_log->action_status = "Failed";
            // $access_log->save();

            return back()->withErrors($validator)->withInput()->with('add_resource_category_error', 'New Resource Category Validation Failed');
        }else{

            if ($request->image) {
                //Upload the file in storage/app/public/profile_pictures folder
                $image_name = (string) ($request->image->store('public/resource_category_images'));
                $image_name = str_replace('public/','',$image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/resource_category_images'));
                
                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/'.$thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(300, 300)->save($path);

            }
            //Count number of active Resource Categories
            $count_resource_categories = ResourceCategory::where('status',1)->count();

            $new_category = new ResourceCategory;
            $new_category->category = $request->resource_category_name;
            $new_category->position = $count_resource_categories + 1;
            $new_category->created_by = Auth::id();
            $new_category->edited_by = Auth::id();
            if ($request->image){
                $new_category->image = $image_name;
            }
            $new_category->save();
            
            return back();
        }
    }

    public function storequicklink(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,bmp,png,bmp,gif,svg',
            'resource_category' => 'required',
            'resource_tab_name' => 'required|unique:resourcetypes,resource_type',
            'resourceislink' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            // $access_log = new AccessLog;
            // $access_log->user = Auth::user()->username;
            // $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            // $access_log->action_taken = "Store ".$type." Resource";
            // $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            // $access_log->action_status = "Failed";
            // $access_log->save();

            return back()->withErrors($validator)->withInput()->with('add_quick_link_error', 'New Quick Link Validation Failed');
        }else{

            if ($request->image) {
                //Upload the file in storage/app/public/profile_pictures folder
                $image_name = (string) ($request->image->store('public/resource_unit_images'));
                $image_name = str_replace('public/','',$image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/resource_unit_images'));
                
                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/'.$thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(300, 300)->save($path);

            }
            $resource_category = ResourceCategory::where('category',$request->resource_category)->first();

            $count_resource_types = ResourceType::where('status',1)->where('category_id',$resource_category->id)->count();            

            $new_tab = new ResourceType;
            $new_tab->resource_type = $request->resource_tab_name;
            $new_tab->position = $count_resource_types + 1;
            $new_tab->category_id = $resource_category->id;
            $new_tab->created_by = Auth::id();
            $new_tab->edited_by = Auth::id();
            $new_tab->image = $image_name;
            $new_tab->save();

            $count_resource_subfolders = ResourceSubfolder::where('resource_type_id',$new_tab->id)->count();
            
            $new_null_folder = new ResourceSubfolder;
            $new_null_folder->subfolder_name = NULL;
            $new_null_folder->position = $count_resource_subfolders + 1;
            $new_null_folder->resource_type_id = $new_tab->id;
            $new_null_folder->created_by = Auth::id();
            $new_null_folder->edited_by = Auth::id();
            $new_null_folder->image = $image_name;
            $new_null_folder->save();

            $new_quick_link = new Resource;
            
            
            return back();
        }
    }

    public function storetab(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,bmp,png,bmp,gif,svg',
            'resource_category' => 'required',
            'resource_tab_name' => 'required|unique:resourcetypes,resource_type',
        ]);

        if ($validator->fails()) {
            Session::flash('add_resource_tab_error', 'New Resource Tab Validation Failed');

            // $access_log = new AccessLog;
            // $access_log->user = Auth::user()->username;
            // $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            // $access_log->action_taken = "Store ".$type." Resource";
            // $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            // $access_log->action_status = "Failed";
            // $access_log->save();

            return back()->withErrors($validator)->withInput()->with('add_resource_tab_error', 'New Resource Tab Validation Failed');
        }else{

            if ($request->image) {
                //Upload the file in storage/app/public/profile_pictures folder
                $image_name = (string) ($request->image->store('public/resource_unit_images'));
                $image_name = str_replace('public/','',$image_name);

                //Upload the file in storage thumbnail public folder
                $thumb_image_name = (string) ($request->image->store('public/thumbnails/resource_unit_images'));
                
                //Get full path of uploaded image from the thumbnails
                $path = storage_path('app/'.$thumb_image_name);

                //Load the image into the Image Intervention Package for manipulation
                Image::make($path)->fit(300, 300)->save($path);

            }
            $resource_category = ResourceCategory::where('category',$request->resource_category)->first();

            $count_resource_types = ResourceType::where('status',1)->where('category_id',$resource_category->id)->count();            

            $new_tab = new ResourceType;
            $new_tab->resource_type = $request->resource_tab_name;
            $new_tab->position = $count_resource_types + 1;
            $new_tab->category_id = $resource_category->id;
            $new_tab->created_by = Auth::id();
            $new_tab->edited_by = Auth::id();
            $new_tab->image = $image_name;
            $new_tab->save();

            $count_resource_subfolders = ResourceSubfolder::where('resource_type_id',$new_tab->id)->count();
            
            $new_null_folder = new ResourceSubfolder;
            $new_null_folder->subfolder_name = NULL;
            $new_null_folder->position = $count_resource_subfolders + 1;
            $new_null_folder->resource_type_id = $new_tab->id;
            $new_null_folder->created_by = Auth::id();
            $new_null_folder->edited_by = Auth::id();
            $new_null_folder->image = $image_name;
            $new_null_folder->save();
            
            return back();
        }
    }

    public function store(Request $request,$type) {
        //
        if($type == 'null'){
            if($request->resourceislink == "No"){
                $validator = Validator::make($request->all(), [
                    'resource_name' => 'required',
                    'subfolder_id' => 'required',
                    'resource_type' => 'required',
                    'file' => 'required|mimes:pdf,xls,xlsm,xlsx,doc,docx,ppt,pptm,pptx,jpeg,bmp,png,bmp,gif,svg',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'resource_name' => 'required',
                    'subfolder_id' => 'required',
                    'resource_type' => 'required',
                    'file' => 'required|url',
                ]);
            }
        }else{
            if($request->resourceislink == "No"){
                $validator = Validator::make($request->all(), [
                    'resource_name' => 'required',
                    'subfolder_id' => 'required',
                    'file' => 'required|mimes:pdf,xls,xlsm,xlsx,doc,docx,ppt,pptm,pptx,jpeg,bmp,png,bmp,gif,svg',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'resource_name' => 'required',
                    'subfolder_id' => 'required',
                    'file' => 'required|url',
                ]);
            }
        }

        if ($validator->fails()) {
            Session::flash('add_resource_error', 'Resource Validation Failed');

            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Store ".$type." Resource";
            $access_log->action_details = "Storing of new ".$type." Resource interrupted due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            $resource_types = ResourceType::where('status',1)->get();

            return back()->withErrors($validator)->withInput()->with('resourcetype',$type)->with('resource_types',$resource_types);
        }else{
            if($request->resourceislink == "Yes"){
                $file_name = $request->file;
            }else{
                //Upload the resource file in storage/app/public/resources folder 
                $file_name = (string) ($request->file->store('public/resources'));
                $file_name = str_replace('public/', '', $file_name);
            }

            $new_resource = new Resource;
            $new_resource->resource_name = $request->resource_name;
            $new_resource->subfolder_id = $request->subfolder_id;

            //if($type == 'null')
            //$new_resource->resource_type = $request->resource_type;
            //else
            //$new_resource->resource_type = $type;

            $file_position = Resource::where('subfolder_id',$request->subfolder_id)->where('status',1)->count();

            $new_resource->position = $file_position+1;

            $new_resource->resource_location = $file_name;
            if($request->resourceislink == "Yes")
            $new_resource->external_link = $request->resourceislink;
            $new_resource->uploaded_by = Auth::id();
            $new_resource->edited_by = Auth::id();
            $new_resource->save();

            //$delete_files = Resource::where('resource_type',$type)
            //                        ->where('status',0)
            //                        ->get();
            //
            //foreach($delete_files as $delete_file){
            //    $file = Resource::find($delete_file->id);
            //    $file->position = $delete_file->position + 1;
            //    $file->save();
            //}

            return back()->with('resouce','Resource was succesfully uploaded')->with('resoucetype',$type);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type,$link,$url) {
        if($link == "Yes"){
            $decrepted_url = (string) decrypt($url);

            $access_log = new AccessLog;
            $access_log->link_accessed = $decrepted_url;
            $access_log->action_taken = 'View "'.$type.'" Resource';
            $access_log->action_details = 'Accessed '.$type.' resource';
            $access_log->link_type = "External";
            $access_log->user = Auth::user()->username;
            $access_log->save();

            return Redirect::to($decrepted_url);
        }else{
            //$output = null;
            //exec('"C:\Program Files (x86)\Adobe\Reader 10.0\Reader\AcroRd32.exe" \\10.11.74.12\Public\IT Unit\LTA-citizen_2CAD.pdf',$output);
            //dd($output);
            
            //$decrepted_url = (string) decrypt($url);
            $filetype = 'valid';
            
            if(!Str::contains($url, ['.pdf', '.jpeg'])){
                $filetype = 'invalid';
            }
            $access_log = new AccessLog;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = 'View "'.$type.'" Resource';
            $access_log->action_details = 'Accessed '.$type.' resource';
            $access_log->user = Auth::user()->username;
            $access_log->save();
            
            return view('resource')->with('resource',$url)->with('filetype',$filetype);
            //echo '<iframe src="public/resource/'.$decrepted_url.'" width="100%" style="height:100%"></iframe>';
        }
        
    }

    public function show_external_link($name,$url) {
        //
        $decrepted_url = (string) decrypt($url);

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->action_taken = 'Access '.$name;
        $access_log->action_details = 'Redirected to '.$name;
        $access_log->user = Auth::user()->username;
        $access_log->link_type = 'External';
        $access_log->save();

        return Redirect::to($decrepted_url);
    }

    public function position($direction,$id) {
        //
        $resource = Resource::find($id);
        $current_position = $resource->position;
        $resource_type = $resource->resource_type;
        $number_of_all_resources = Resource::where('resource_type',$resource_type)->count();

        if($direction == 'up'){
            if($current_position < $number_of_all_resources){
                $new_position = $current_position+1;

                //Find resource that was in the new position
                $edit_resource_position = Resource::where('resource_type',$resource_type)
                                                  ->where('position',$new_position)
                                                  ->update(['position' => $current_position]);
                
                $resource->position = $new_position;
                $resource->save();
            }
        }elseif($direction == 'down'){
            if($current_position > 1){
                $new_position = $current_position-1;

                //Find resource that was in the new position
                $edit_resource_position = Resource::where('resource_type',$resource_type)
                                                  ->where('position',$new_position)
                                                  ->update(['position' => $current_position]);
                
                $resource->position = $new_position;
                $resource->save();
            }
        }
        
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $resource = Resource::find($id);
        return back()->with('editresource',$resource);
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
        $resource = Resource::find($id);
        if($request->resourceislink == "No"){
            if($resource->external_link == "Yes"){
                $validator = Validator::make($request->all(), [
                    'resource_name' => 'required',
                    'file' => 'required|mimes:pdf,xls,xlsm,xlsx,doc,docx,ppt,pptm,pptx,jpeg,bmp,png,bmp,gif,svg',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'resource_name' => 'required',
                ]);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'resource_name' => 'required',
                'file' => 'required|url',
            ]);
        }

        if ($validator->fails()) {
            $access_log = new AccessLog;
            $access_log->user = Auth::user()->username;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Edit ".$resource->resource_type." Resource";
            $access_log->action_details = "Editing of ".$resource->resource_type." Resource interrupted due to validation errors";
            $access_log->action_status = "Failed";
            $access_log->save();

            return back()->withErrors($validator)->withInput()->with('editresource',$resource);
        }else{
            if($request->resourceislink == "No"){
                if($request->file){
                    //Upload the resource file in storage/app/public/resources folder 
                    $file_name = (string) ($request->file->store('public/resources'));
                    $file_name = str_replace('public/', '', $file_name);
    
                    $edit_resource = Resource::find($id);
                    $edit_resource->resource_name = $request->resource_name;
                    $edit_resource->resource_location = $file_name;
                    $edit_resource->external_link = $request->resourceislink;
                    $edit_resource->subfolder_id = $request->subfolder_id;
                    $edit_resource->save();
                }else{
                    $edit_resource = Resource::find($id);
                    $edit_resource->resource_name = $request->resource_name;
                    $edit_resource->external_link = $request->resourceislink;
                    $edit_resource->subfolder_id = $request->subfolder_id;
                    $edit_resource->save();
                }
            }else{
                $edit_resource = Resource::find($id);
                $edit_resource->resource_name = $request->resource_name;
                $edit_resource->resource_location = $request->file;
                $edit_resource->external_link = $request->resourceislink;
                $edit_resource->subfolder_id = $request->subfolder_id;
                $edit_resource->save();
            }            
            
            return back()->with('resouce','Resource was succesfully uploaded')->with('resoucetype',$resource->resource_type);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        //
        $resource = Resource::find($id);
        return back()->with('delete_resource',$resource);
    }

    public function destroy($id) {
        //
        $deleted_resource = Resource::find($id);
        
        $all_resources_before_delete = Resource::where('resource_type',$deleted_resource->resource_type)
                                               ->where('status',1)
                                               ->get();

        $deleted_resource_position = $deleted_resource->position;
        $deleted_resource->status = 0;
        $deleted_resource->position = $all_resources_before_delete->count();
        $deleted_resource->save();

        $update_resources = Resource::where('resource_type',$deleted_resource->resource_type)
                                              ->where('status',1)
                                              ->where('position','>',$deleted_resource_position)
                                              ->get();
                         
        foreach($update_resources as $update_resource){
            $resource = Resource::find($update_resource->id);
            $resource->position = $update_resource->position - 1;
            $resource->save();
        }

        return back();
    }

}
