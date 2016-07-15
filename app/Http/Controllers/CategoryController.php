<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Section;
use App\Cart;
use Session;
use Auth;
use \Illuminate\Database\Eloquent\Collection;
use \Ecommerce\helperFunctions;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin', ['except' => [
            'show',
        ]]);
    }

    public function show($id, Request $request)
    {
        $category = Category::find($id);
        if (strtoupper($request->sort) == 'NEWEST') {
            $products = $category->products()->orderBy('created_at', 'desc')->paginate(40);
        } elseif (strtoupper($request->sort) == 'HIGHEST') {
            $products = $category->products()->orderBy('price', 'desc')->paginate(40);
        } elseif (strtoupper($request->sort) == 'LOWEST') {
            $products = $category->products()->orderBy('price', 'asc')->paginate(40);
        } else {
            $products = $category->products()->paginate(40);
        }
        helperFunctions::getPageInfo($sections,$cart,$total);
        return view('site.category', compact('sections', 'cart', 'total', 'category', 'products'));
    }

    public function delete($id)
    {
        Category::destroy($id);
        return \Redirect('/admin/categories')->with([
            'flash_message' => 'Category has been Successfully removed',
            'flash-warning' => true
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'section_id' => 'required'
        ]);
        Category::create($request->all());
        return \Redirect('/admin/categories')->with([
            'flash_message' => 'Category successfully Created'
        ]);
    }

    public function edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'section_id' => 'required'
        ]);
        Category::find($id)->update($request->all());
        return \Redirect()->back()->with([
            'flash_message' => 'Category Successfully Edited'
        ]);
    }
}
