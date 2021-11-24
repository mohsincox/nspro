<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Brand;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::with(['category'])->get();
        return view('brand.index', compact('brands'));
    }

    public function create()
    {
        $categoryList = Category::pluck('name', 'id');

        return view('brand.create', compact('categoryList'));
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:brands',
            'category_id' => 'required'
        ];
        $messages = [
            'name.required' => 'The Brand Name field is required.',
            'name.unique' => 'The Brand Name already exist.',
            'category_id.required' => 'The Category Name field is required.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $brand->created_by = Auth::id();
        $brand->save();
        flash()->success($brand->name.' Brand Name created successfully');
        return redirect('brand');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $categoryList = Category::pluck('name', 'id');

        return view('brand.edit', compact('brand', 'categoryList'));
    }
    
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:brands,name,'.$brand->id,
            'category_id' => 'required'
        ];
        $messages = [
            'name.required' => 'The Brand Name field is required.',
            'name.unique' => 'The Brand Name already exist.',
            'category_id.required' => 'The Category Name field is required.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $brand->updated_by = Auth::id();
        $brand->save();
        flash()->success($brand->name.' Brand Name updated successfully');
        return redirect('brand');
    }
}
