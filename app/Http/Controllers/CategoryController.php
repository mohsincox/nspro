<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$categories = Category::get();
    	return view('category.index', compact('categories'));
    }

    public function create()
    {
    	return view('category.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:categories'
	    ];
	    $messages = [
            'name.required' => 'The Category Name field is required.',
            'name.unique' => 'The Category Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $category = new Category;
        $category->name = $request->name;
        $category->created_by = Auth::id();
        $category->save();
        flash()->success($category->name.' Category Name created successfully');
    	return redirect('category');
    }

    public function edit($id)
    {
    	$category = Category::find($id);
    	return view('category.edit', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
    	$category = Category::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:categories,name,'.$category->id,
	    ];
	    $messages = [
            'name.required' => 'The Category Name field is required.',
            'name.unique' => 'The Category Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $category->name = $request->name;
        $category->updated_by = Auth::id();
        $category->save();
        flash()->success($category->name.' Category Name updated successfully');
    	return redirect('category');
    }
}
