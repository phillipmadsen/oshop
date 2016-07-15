<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use App\Section;
use App\Cart;
use Session;
use Auth;
use \Illuminate\Database\Eloquent\Collection;
use \Ecommerce\helperFunctions;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin', ['except' => [
            'show',
        ]]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'page_title' => 'required',
            'page_name' => 'required|unique:pages',
            'page_source' => 'required',
        ]);
        Page::create($request->all());
        return \Redirect('/admin/pages')->with([
            'flash_message' => 'Page Successfully Created'
        ]);
    }

    public function show($page_name)
    {
        $page = Page::where('page_name', $page_name)->first();
        helperFunctions::getPageInfo($sections,$cart,$total);
        return view('site.page', compact('page', 'total', 'cart', 'sections'));
    }

    public function edit(Request $request, $page_name)
    {
        Page::where('page_name', $page_name)->update([
            'page_title' => $request->page_title,
            'page_name' => $request->page_name,
            'page_source' => $request->page_source
        ]);

        return \Redirect()->back()->with([
            'flash_message' => 'Page Edited successfully'
        ]);
    }

    public function delete($page_name)
    {
        Page::where('page_name', $page_name)->delete();
        return \Redirect('/admin/pages')->with([
            'flash_message' => 'Page has been Successfully removed',
            'flash-warning' => true
        ]);
        ;
        ;
    }
}
