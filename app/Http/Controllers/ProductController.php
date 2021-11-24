<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Product;
use App\Models\Brand;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$products = Product::with(['brand'])->get();
    	return view('product.index', compact('products'));
    }

    public function create()
    {
    	$brandList = Brand::pluck('name', 'id');
    	return view('product.create', compact('brandList'));
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required',
	    	'sku' => 'required',
	    	'brand_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The Product Name field is required.',
            'sku.required' => 'The SKU field is required.',
            'brand_id.required' => 'The Brand Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $productExist = Product::where('name', $request->name)->where('sku', $request->sku)->first();
        if($productExist) {
        	flash()->error('Product '.$productExist->name.' and SKU '.$productExist->sku.' already exists.');
    		return redirect()->back()->withInput();
        }

        $product = new Product;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->brand_id = $request->brand_id;
        $product->created_by = Auth::id();
        $product->save();

        flash()->success($product->name.' Product Name Created Successfully');
    	return redirect('product');
    }

    public function edit($id)
    {
    	$product = Product::find($id);
    	$brandList = Brand::pluck('name', 'id');
    	return view('product.edit', compact('product', 'brandList'));
    }

    public function update(Request $request, $id)
    {
    	$product = Product::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required',
	    	'sku' => 'required',
	    	'brand_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The Product Name field is required.',
            'sku.required' => 'The SKU field is required.',
            'brand_id.required' => 'The Brand Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $productExist = Product::where('name', $request->name)->where('sku', $request->sku)->where('id', '<>', $product->id)->first();
        if($productExist) {
        	flash()->error('Product '.$productExist->name.' and SKU '.$productExist->sku.' already exists.');
    		return redirect()->back()->withInput();
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->brand_id = $request->brand_id;
        $product->updated_by = Auth::id();
        $product->save();

        flash()->success($product->name.' Product Name Updated Successfully');
    	return redirect('product');
    }
}
