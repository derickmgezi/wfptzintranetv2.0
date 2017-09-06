<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Editor;
use App\User;

class EditorController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        //
        $validator = Validator::make($request->all(), [
                    'username' => 'required|unique:editors,editor',
                    'function' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                            ->withInput()
                            ->with('add_editor_error', 'Validation Error');
        }else{
            //add new editor
            $editor = new Editor;
            $editor->editor = $request->username;
            $editor->function = $request->function;
            $editor->save();

            return back()->with('add_editor_status', 'Editor has been created successfuly');
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
        $edit_editor = Editor::find($id);
        return back()->with('edit_editor', $edit_editor);
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
                    'function' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                            ->withInput()
                            ->with('edit_editor_error', $id);
        } else {
            //edit editor
            $edit_editor = Editor::find($id);
            $edit_editor->function = $request->function;
            $edit_editor->save();
            
            return back()->with('edit_editor_status', 'Page editor has been edited successfuly');
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
        $editor = Editor::find($id);
        if($editor->status){
            $editor->status = 0;
            $editor->save();
            $editor_status = User::find(Editor::find($id)->editor)->firstname.' '.User::find(Editor::find($id)->editor)->secondname." editor's access has been denied";
        }else{
            $editor->status = 1;
            $editor->save();
            $editor_status = User::find(Editor::find($id)->editor)->firstname.' '.User::find(Editor::find($id)->editor)->secondname." editor's access has been granted";
        }
        return back()->with('editor_status', $editor_status);
    }

}
