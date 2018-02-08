<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Excel;
use App\PhoneDirectory;
use App\PhoneBill;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class PhoneDirectoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $months_of_user_phone_bill = PhoneBill::select(DB::raw("DATE_FORMAT(date_time,'%M %Y') as date"))
                                                ->groupBy('date')
                                                ->orderBy('date','desc')
                                                ->get();
        
        $user_phone_bill = PhoneBill::where('user_name',Auth::user()->firstname.' '.Auth::user()->secondname)
                                    ->get();
        
        $user_phone_bill_total_cost = PhoneBill::select(DB::raw("user_name,DATE_FORMAT(date_time,'%M %Y') as date,SUM(cost) as total_cost"))
                                                ->groupBy('user_name','date')
                                                ->where('user_name',Auth::user()->firstname.' '.Auth::user()->secondname)
                                                ->where('type',NULL)
                                                ->orWhere('type','Private')
                                                ->get();
        
        $all_users_phone_bill = PhoneBill::select(DB::raw("user_name,ext_no,DATE_FORMAT(date_time,'%M %Y') as date,SUM(cost) as total_cost"))
                                        ->groupBy('user_name','date','ext_no')
                                        ->whereRaw('timestampdiff(day,created_at,now()) > 14')
                                        ->whereNull('type')
                                        ->orWhere('type','Private')
                                        ->orderBy('total_cost','desc')
                                        ->get();
        
        $all_users_phone_bill_total_cost = PhoneBill::select(DB::raw("DATE_FORMAT(date_time,'%M %Y') as date,SUM(cost) as total_cost"))
                                                    ->whereRaw('timestampdiff(day,created_at,now()) > 14')
                                                    ->whereNull('type')
                                                    ->orWhere('type','Private')
                                                    ->groupBy('date')
                                                    ->get();
        
        return view('internaldirectory', compact('months_of_user_phone_bill','user_phone_bill','user_phone_bill_total_cost','all_users_phone_bill','all_users_phone_bill_total_cost'));
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
    public function store_contacts(Request $request) {
        //
        $validator = Validator::make($request->all(), [
                    'file' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('upload_message', 'No File was Uploaded');
            return redirect('/internaldirectory')
                            ->withErrors($validator)
                            ->withInput();
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

                        $unfound_ext = '';

                        foreach ($results as $result) {
                            // Get Sheet Titile
                            $sheet_title = $result->getTitle();

                            foreach ($result as $row) {

                                try {
                                    $user_name = PhoneDirectory::where('ext_no', $row->ext)->firstOrFail()->name;
                                } catch (ModelNotFoundException $ex) {
                                    $unfound_ext = $row->ext;
                                    return redirect('internaldirectory')->with('unfound_ext', $unfound_ext);
                                    break;
                                }

                                try {
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
                                }catch (\Illuminate\Database\QueryException $ex) {
                                    continue;
                                }
                            }
                        }
                        Session::flash('upload_message', 'Phone Bill has been updated succesfully');
                        return redirect('internaldirectory');
                    });
                }

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

                                $update_phonedirectory = PhoneDirectory::where('ext_no', $row->ext_no)
                                        ->update([
                                    'name' => $row->staff_name,
                                    'function' => $row->function,
                                    'department' => $row->department,
                                    'number' => $row->mobile_no,
                                    'type' => $mobile_type,
                                    'location' => $sheet_title
                                ]);

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
                Session::flash('upload_message', 'File Uploaded Succesfully');
                return redirect('internaldirectory');
            } else {
                Session::flash('upload_message', 'FIle Uploaded was ' . $file_extension . '. Upload an Excel File');
                return redirect('internaldirectory');
            }
        }
    }
    
    public function make_call_private($id){
        $edit_call_type = PhoneBill::find($id);
        $date = new Date($edit_call_type->date_time);
        $date_month = $date->format('m');
        $date_year = $date->format('Y');
        $edit_call_type_for_same_number = PhoneBill::whereMonth('date_time',$date_month)
                                                    ->where('user_name',Auth::user()->firstname.' '.Auth::user()->secondname)
                                                    ->whereYear('date_time',$date_year)
                                                    ->where('number',$edit_call_type->number)
                                                    ->update(['type' => 'Private']);
        Session::flash('edit_bill_message', 'Bill edited');
        return redirect('internaldirectory');
    }
    
    public function make_call_public($id){
        $edit_call_type = PhoneBill::find($id);
        $date = new Date($edit_call_type->date_time);
        $date_month = $date->format('m');
        $date_year = $date->format('Y');
        $edit_call_type_for_same_number = PhoneBill::whereMonth('date_time',$date_month)
                                                    ->where('user_name',Auth::user()->firstname.' '.Auth::user()->secondname)
                                                    ->whereYear('date_time',$date_year)
                                                    ->where('number',$edit_call_type->number)
                                                    ->update(['type' => 'Official']);
        Session::flash('edit_bill_message', 'Bill edited');
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
