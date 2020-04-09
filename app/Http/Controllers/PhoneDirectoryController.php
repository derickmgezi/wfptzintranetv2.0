<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Imports\PhoneDirectoryImport;
use App\Imports\PhoneBillImport;
use Maatwebsite\Excel\Facades\Excel;
use App\PhoneDirectory;
use App\PhoneBill;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use App\AccessLog;

class PhoneDirectoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $duty_stations = PhoneDirectory::select('duty_station')->where('status','Active')->groupBy('duty_station')->get();
        $duty_station_count = $duty_stations->count();
        $active_link_status = 1;

        $months_of_user_phone_bill = PhoneBill::select(DB::raw("DATE_FORMAT(date_time,'%M %Y') as date,date_time"))
                ->orderBy('date_time', 'desc')
                ->get();
        
        $months_of_user_phone_bill = $months_of_user_phone_bill->unique('date');

        $user_phone_bill = PhoneBill::select(DB::raw("id,user_name,number,type,date_time,duration,cost,created_at,DATE_FORMAT(date_time,'%M %Y') as date"))
                ->where('user_name', Auth::user()->firstname . ' ' . Auth::user()->secondname)
                ->get();

        $user_phone_bill_total_cost = PhoneBill::select(DB::raw("user_name,DATE_FORMAT(date_time,'%M %Y') as date,SUM(cost) as total_cost"))
                ->groupBy('user_name', 'date')
                ->where('user_name', Auth::user()->firstname . ' ' . Auth::user()->secondname)
                ->where(function($query){
                    $query->where('type', NULL)
                          ->orWhere('type', 'Private');
                })
                ->get();

        $all_users_phone_bill = PhoneBill::select(DB::raw("user_name,ext_no,DATE_FORMAT(date_time,'%M %Y') as date,SUM(cost) as total_cost"))
                                         ->groupBy('user_name', 'date', 'ext_no')
                                         ->whereRaw('timestampdiff(day,created_at,now()) > 14')
                                         ->where(function($query){
                                             $query->where('type', NULL)
                                                   ->orWhere('type', 'Private');
                                         })
                                         ->orderBy('total_cost', 'desc')
                                         ->get();

        $all_users_phone_bill_total_cost = PhoneBill::select(DB::raw("DATE_FORMAT(date_time,'%M %Y') as date,SUM(cost) as total_cost"))
                ->whereRaw('timestampdiff(day,created_at,now()) > 14')
                ->where(function($query){
                    $query->where('type', NULL)
                          ->orWhere('type', 'Private');
                })
                ->groupBy('date')
                ->get();

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->user = Auth::user()->username;
        $access_log->action_taken = "Access Phone Directory Page";
        $access_log->action_details = "Redirected to Phone Directory Page";
        if(!Session::has('upload_message') && !Session::has('unfound_ext') && !Session::has('edit_bill_message'))
        $access_log->save();

        return view('internaldirectory', compact('duty_stations','duty_station_count','active_link_status','months_of_user_phone_bill', 'user_phone_bill', 'user_phone_bill_total_cost', 'all_users_phone_bill', 'all_users_phone_bill_total_cost'));
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
    public function import(Request $request){
        //
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->user = Auth::user()->username;
        $access_log->action_taken = "Upload File";

        $validator = Validator::make($request->all(), [
                    'file' => 'required',
        ]);

        if ($validator->fails()) {
            $access_log->action_details = "Upload File to update Contacts List or the Phone Bills. No File was selected for Uploaded";
            $access_log->action_status = "Failed";
            $access_log->save();

            Session::flash('upload_message', 'No File was Uploaded');
            return redirect('/internaldirectory')->withErrors($validator)->withInput();
        } else {
            //Get file Extension
            $file_extension = $request->file->getClientOriginalExtension();

            //Get file name ->pathinfor was used to trim/remove the extension from the filename
            $file_name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);

            //Check if extensions correspond to excel formats
            if ($file_extension == 'xls' || $file_extension == 'xlsx') {

                if (str_contains($file_name, 'Phone Bill')) {
                    $import = new PhoneBillImport();
                    $import->import($request->file);
                    $failures = $import->failures();
                    $errors = $import->errors();

                    if($errors->isNotEmpty()){
                        $access_log->action_details = 'The file named '.$file_name.' was uploaded but with errors';
                        $access_log->save();

                        Session::flash('upload_message', 'Phone Bill partially or not uploaded with errors');
                        return redirect('internaldirectory')->with('errors', $errors);

                    }elseif($failures->isNotEmpty()){
                        $access_log->action_details = 'The file named '.$file_name.' was uploaded but with failures';
                        $access_log->save();

                        Session::flash('upload_message', 'Phone Bill partially or not uploaded with failures');
                        return redirect('internaldirectory')->with('failures', $failures);

                    }else{
                        $access_log->action_details = 'Phone Bill File with name '.$file_name.' uploaded';
                        $access_log->save();

                        Session::flash('upload_message', 'File Uploaded Succesfully');
                        return redirect('internaldirectory');
                    }

                }elseif(str_contains($file_name, 'WFP Tanzania Contact List')){
                    $import = new PhoneDirectoryImport();
                    $import->import($request->file);
                    $failures = $import->failures();
                    $errors = $import->errors();

                    if($failures->isNotEmpty()){
                        $access_log->action_details = 'File with name '.$file_name.' was uploaded but with failures';
                        $access_log->save();

                        Session::flash('upload_message', 'File was Uploaded with failures');
                        return redirect('internaldirectory')->with('failures', $failures);
                    }elseif($errors->isNotEmpty()){
                        $access_log->action_details = 'File with name '.$file_name.' was uploaded but with errors';
                        $access_log->save();

                        Session::flash('upload_message', 'File was Uploaded with errors');
                        return redirect('internaldirectory')->with('errors', $errors);
                    }else{
                        $access_log->action_details = 'File with name '.$file_name.' was uploaded succesfully';
                        $access_log->save();

                        Session::flash('upload_message', 'File Uploaded Succesfully');
                        return redirect('internaldirectory');
                    }
                }else{
                    
                    $access_log->action_details = 'Upload File to update Contacts List or the Phone Bills. Uploaded Excel File has an invalid name';
                    $access_log->action_status = "Failed";
                    $access_log->save();

                    Session::flash('upload_message', 'Uploaded Excel File has an invalid name. Please upload Excel File with a valid name');
                    return redirect('internaldirectory');
                }
                
            } else {
                
                $access_log->action_details = 'Upload File to update Contacts List or the Phone Bills. File Uploaded was .' . $file_extension . ' which is not an Excel File';
                $access_log->action_status = "Failed";
                $access_log->save();

                Session::flash('upload_message', 'File Uploaded was .' . $file_extension . ', please upload an Excel File');
                return redirect('internaldirectory');
            }
        }
    }

    public function store_contacts(Request $request) {
        //
        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->user = Auth::user()->username;
        $access_log->action_taken = "Upload File";

        $validator = Validator::make($request->all(), [
                    'file' => 'required',
        ]);

        if ($validator->fails()) {
            $access_log->action_details = "Upload File to update Contacts List or the Phone Bills. No File was selected for Uploaded";
            $access_log->action_status = "Failed";
            $access_log->save();

            Session::flash('upload_message', 'No File was Uploaded');
            return redirect('/internaldirectory')->withErrors($validator)->withInput();
        } else {
            //Get file Extension
            $file_extension = $request->file->getClientOriginalExtension();

            //Get file name ->pathinfor was used to trim/remove the extension from the filename
            $file_name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);

            //Check if extensions correspond to excel formats
            if ($file_extension == 'xls' || $file_extension == 'xlsx') {

                if (str_contains($file_name, 'Phone Bill')) {
                    Excel::load($request->file, function($reader) {

                        // Getting all results
                        // ->all() is a wrapper for ->get() and will work the same
                        $results = $reader->all();

                        foreach ($results as $result) {
                            // Get Sheet Titile
                            $sheet_title = $result->getTitle();

                            foreach ($result as $row) {

                                try {
                                    $user_name = PhoneDirectory::where('ext_no', $row->ext)->firstOrFail()->name;
                                } catch (ModelNotFoundException $ex) {
                                    Session::flash('unfound_ext',$row->ext);
                                }

                                try{
                                    if(!Session::has('unfound_ext')){
                                        $phonebill = new PhoneBill();
                                        $phonebill->ext_no = trim($row->ext);
                                        $phonebill->user_name = $user_name;
                                        $phonebill->line = trim($row->line);
                                        $phonebill->type = null;
                                        $phonebill->number = trim($row->number);
                                        $phonebill->date_time = trim($row->datetime);
                                        $phonebill->duration = trim($row->duration);
                                        $phonebill->cost = trim($row->cost);
                                        $phonebill->save();
                                    } 
                                }catch(\Illuminate\Database\QueryException $ex){
                                    continue;
                                }
                            }
                        }
                    });
                    if(Session::has('unfound_ext')){
                        $access_log->action_details = 'Extension number '.Session::get('unfound_ext').' in the Phone Bill file named '.$file_name.' does not exist';
                        $access_log->action_status = "Failed";
                        $access_log->save();
                        Session::flash('upload_message', 'Phone Bill partially or not uploaded');
                        return redirect('internaldirectory')->with('unfound_ext', Session::get('unfound_ext'));
                    }else{
                        $access_log->action_details = 'Phone Bill File with name '.$file_name.' uploaded';
                        $access_log->save();
                        Session::flash('upload_message', 'Phone Bill has been updated succesfully');
                        return redirect('internaldirectory');
                    }

                }elseif(str_contains($file_name, 'WFP Phone Directory')){
                    Excel::load($request->file, function($reader) {

                        // Getting all results
                        // ->all() is a wrapper for ->get() and will work the same
                        $results = $reader->all();
    
                        foreach ($results as $result) {
                            // Get Sheet Titile
                            $sheet_title = $result->getTitle();
    
                            if ($sheet_title == 'Country Office' || $sheet_title == 'Dar es salaam Port' || $sheet_title == 'Dodoma Main Office' || $sheet_title == 'Dodoma Warehouse' || $sheet_title == 'Kibondo' || $sheet_title == 'Isaka' || $sheet_title == 'Kasulu' || $sheet_title == 'Kigoma' || $sheet_title == 'Tanga') {
                                foreach ($result as $row) {
    
                                    $mobile_type = 'Official';
                                    if (strlen($row->mobile_no) == 0)
                                        $mobile_type = 'Personal';
    
                                    if (strlen($row->ext_no) != 0) {
                                        try{
                                            $update_phonedirectory = PhoneDirectory::where('ext_no', $row->ext_no)
                                                                                    ->update([
                                                                                                'name' => $row->staff_name,
                                                                                                'function' => $row->function,
                                                                                                'department' => $row->department,
                                                                                                'number' => $row->mobile_no,
                                                                                                'type' => $mobile_type,
                                                                                                'location' => $sheet_title
                                                                                            ]);
                                        }catch(\Illuminate\Database\QueryException $ex){
                                            $remove_duplicate_number = PhoneDirectory::where('number', $row->mobile_no)
                                                                                    ->update(['number' => NULL]);
                                            if($remove_duplicate_number){
                                                $update_phonedirectory = PhoneDirectory::where('ext_no', $row->ext_no)
                                                                                        ->update([
                                                                                                    'name' => $row->staff_name,
                                                                                                    'function' => $row->function,
                                                                                                    'department' => $row->department,
                                                                                                    'number' => $row->mobile_no,
                                                                                                    'type' => $mobile_type,
                                                                                                    'location' => $sheet_title
                                                                                                ]);
                                            }
                                        }
                                            
                                    } elseif (strlen($row->mobile_no) != 0) {
                                        $update_phonedirectory = PhoneDirectory::where('number', $row->mobile_no)
                                                                                ->update([
                                                                                            'name' => $row->staff_name,
                                                                                            'function' => $row->function,
                                                                                            'department' => $row->department,
                                                                                            'ext_no' => $row->ext_no,
                                                                                            'type' => $mobile_type,
                                                                                            'location' => $sheet_title
                                                                                        ]);
                                    }
    
                                    if (!$update_phonedirectory) {
                                        $phonedirectory = new PhoneDirectory;
                                        $phonedirectory->name = $row->staff_name;
                                        $phonedirectory->function = $row->function;
                                        $phonedirectory->department = $row->department;
                                        $phonedirectory->ext_no = $row->ext_no;
                                        $phonedirectory->number = $row->mobile_no;
                                        $phonedirectory->type = $mobile_type;
                                        $phonedirectory->location = $sheet_title;
                                        $phonedirectory->save();
                                    }
                                }
                            }
                        }
                    });
                    
                    $access_log->action_details = 'Phone Directory File with name '.$file_name.' uploaded';
                    $access_log->save();

                    Session::flash('upload_message', 'File Uploaded Succesfully');
                    return redirect('internaldirectory');
                }else{
                    
                    $access_log->action_details = 'Upload File to update Contacts List or the Phone Bills. Uploaded Excel File has an invalid name';
                    $access_log->action_status = "Failed";
                    $access_log->save();

                    Session::flash('upload_message', 'Uploaded Excel File has an invalid name. Please upload Excel File with a valid name');
                    return redirect('internaldirectory');
                }
                
            } else {
                
                $access_log->action_details = 'Upload File to update Contacts List or the Phone Bills. File Uploaded was .' . $file_extension . ' which is not an Excel File';
                $access_log->action_status = "Failed";
                $access_log->save();

                Session::flash('upload_message', 'File Uploaded was .' . $file_extension . ', please upload an Excel File');
                return redirect('internaldirectory');
            }
        }
    }

    public function make_call_private($id) {
        $edit_call_type = PhoneBill::find($id);
        $date = new Date($edit_call_type->date_time);
        $date_month = $date->format('m');
        $date_year = $date->format('Y');
        $edit_call_type_for_same_number = PhoneBill::whereMonth('date_time', $date_month)
                ->where('user_name', Auth::user()->firstname . ' ' . Auth::user()->secondname)
                ->whereYear('date_time', $date_year)
                ->where('number', $edit_call_type->number)
                ->update(['type' => 'Private']);
        Session::flash('edit_bill_message', 'Bill edited');

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->user = Auth::user()->username;
        $access_log->action_taken = $edit_call_type->number. " identified as personal";
        $access_log->action_details = "Identify Personal Calls";
        $access_log->save();

        return redirect('internaldirectory');
    }

    public function make_call_public($id) {
        $edit_call_type = PhoneBill::find($id);
        $date = new Date($edit_call_type->date_time);
        $date_month = $date->format('m');
        $date_year = $date->format('Y');
        $edit_call_type_for_same_number = PhoneBill::whereMonth('date_time', $date_month)
                ->where('user_name', Auth::user()->firstname . ' ' . Auth::user()->secondname)
                ->whereYear('date_time', $date_year)
                ->where('number', $edit_call_type->number)
                ->update(['type' => 'Official']);
        Session::flash('edit_bill_message', 'Bill edited');

        $access_log = new AccessLog;
        $access_log->link_accessed = str_replace(url('/'),"",url()->current());
        $access_log->user = Auth::user()->username;
        $access_log->action_taken = $edit_call_type->number. " identified as official";
        $access_log->action_details = "Identify Personal Calls";
        $access_log->save();

        return redirect('internaldirectory');
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
