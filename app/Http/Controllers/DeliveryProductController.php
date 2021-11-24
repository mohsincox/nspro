<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\DeliveryProduct;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class DeliveryProductController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$deliveryProducts = DeliveryProduct::get();
    	return view('delivery_product.index', compact('deliveryProducts'));
    }

    public function create()
    {
    	return view('delivery_product.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:delivery_products',
	    	'price' => 'required|numeric',
	    	'mrp' => 'required|numeric',
	    ];
	    $messages = [
            'name.required' => 'The Home Delivery Product field is required.',
            'name.unique' => 'The Home Delivery Product already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $deliveryProduct = new DeliveryProduct;
        $deliveryProduct->name = $request->name;
        $deliveryProduct->price = $request->price;
        $deliveryProduct->mrp = $request->mrp;
        $deliveryProduct->remarks = $request->remarks;
        $deliveryProduct->created_by = Auth::id();
        $deliveryProduct->save();
        flash()->success($deliveryProduct->name.' Home Delivery Product created successfully');
    	return redirect('home-delivery-product');
    }

    public function edit($id)
    {
    	$deliveryProduct = DeliveryProduct::find($id);
    	return view('delivery_product.edit', compact('deliveryProduct'));
    }
    
    public function update(Request $request, $id)
    {
    	$deliveryProduct = DeliveryProduct::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:delivery_products,name,'.$deliveryProduct->id,
	    	'price' => 'required|numeric',
	    	'mrp' => 'required|numeric',
	    	'status' => 'required',
	    	'offer' => 'required',
	    ];
	    $messages = [
            'name.required' => 'The Home Delivery Product field is required.',
            'name.unique' => 'The Home Delivery Product already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $deliveryProduct->name = $request->name;
        $deliveryProduct->price = $request->price;
        $deliveryProduct->mrp = $request->mrp;
        $deliveryProduct->remarks = $request->remarks;
        $deliveryProduct->status = $request->status;
        $deliveryProduct->offer = $request->offer;
        $deliveryProduct->updated_by = Auth::id();
        $deliveryProduct->save();
        flash()->success($deliveryProduct->name.' Home Delivery Product updated successfully');
    	return redirect('home-delivery-product');
    }
}
