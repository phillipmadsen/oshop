<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Section::create($request->all());
        return \Redirect('/admin/sections')->with([
            'flash_message' => 'Section Successfully Created'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Section::find($id)->update($request->all());
        return \Redirect()->back()->with([
            'flash_message' => 'Section Successfully Edited'
        ]);
    }

    public function delete($id)
    {
        Section::destroy($id);
        return \Redirect('/admin/sections')->with([
            'flash_message' => 'Section has been Successfully removed',
            'flash-warning' => true
        ]);
        ;
    }
}
