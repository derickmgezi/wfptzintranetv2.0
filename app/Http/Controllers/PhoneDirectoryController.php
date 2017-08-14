<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Excel;
use App\PhoneDirectory;
use App\User;

class PhoneDirectoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('internaldirectory');
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

            //Check if extensions correspond to excel formats
            if ($file_extension == 'xls' || $file_extension == 'xlsx') {
                Excel::load($request->file, function($reader) {

                    // Getting all results
//                    $results = $reader->get();
                    // ->all() is a wrapper for ->get() and will work the same
                    $results = $reader->all();

                    foreach ($results as $result) {
                        // Get Sheet Titile
                        $sheet_title = $result->getTitle();
                        
                        foreach ($result as $row) {
                            //dd($row);
                            
                            $update_user = User::where('username', $row->username)
                                        ->update([
                                    'title' => $row->title,
                                    'department' => $row->department,
                                    'dutystation' => $row->dutystation,
                                ]);
                            
                            if (!$update_user) {
                                    $user = new User;
                                    $user->firstname = $row->firstname;
                                    $user->secondname = $row->secondname;
                                    $user->username = $row->username;
                                    $user->email = $row->username.'@wfp.org';
                                    $user->password = bcrypt('Welcome@123');
                                    $user->title = $row->title;
                                    $user->department = $row->department;
                                    $user->dutystation = $row->dutystation;
                                    $user->save();
                                }
                        }

//                        if ($sheet_title == 'CO' || $sheet_title == 'Dodoma Main Office' || $sheet_title == 'Dodoma Warehouse') {
//                            foreach ($result as $row) {
//                                
//                                $mobile_type = 'Official';
//                                if(strlen($row->mobile_no) == 0)
//                                    $mobile_type = 'Personal';
//                                
//                                $update_phonedirectory = PhoneDirectory::where('ext_no', $row->ext_no)
//                                        ->update([
//                                    'name' => $row->staff_name,
//                                    'function' => $row->function,
//                                    'department' => $row->department,
//                                    'number' => $row->mobile_no,
//                                    'type' => $mobile_type,
//                                    'location' => $sheet_title
//                                ]);
//
//                                if (!$update_phonedirectory) {
//                                    $phonedirectory = new PhoneDirectory;
//                                    $phonedirectory->name = $row->staff_name;
//                                    $phonedirectory->function = $row->function;
//                                    $phonedirectory->department = $row->department;
//                                    $phonedirectory->ext_no = $row->ext_no;
//                                    $phonedirectory->number = $row->mobile_no;
//                                    $phonedirectory->type = $mobile_type;
//                                    $phonedirectory->location = $sheet_title;
//                                    $phonedirectory->save();
//                                }
//                            }
//                        }
                    }
                });
                Session::flash('upload_message','File Uploaded Succesfully');
                return back();
            } else {
                Session::flash('upload_message', 'FIle Uploaded was ' . $file_extension . '. Upload an Excel File');
                return back();
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
