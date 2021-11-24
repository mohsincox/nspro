<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Option;
use App\Models\Select;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$options = Option::with(['select'])->get();
    	return view('option.index', compact('options'));
    }

    public function create()
    {
    	$selectList = Select::pluck('name', 'id');
    	return view('option.create', compact('selectList'));
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required',
	    	'select_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The Option Name field is required.',
            'select_id.required' => 'The Select Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $optionExist = Option::with('select')->where('name', $request->name)->where('select_id', $request->select_id)->first();
        if($optionExist) {
        	flash()->error('Option '.$optionExist->name.' in '.$optionExist->select->name.' Select already exists.');
    		return redirect()->back()->withInput();
        }

        $option = new Option;
        $option->name = $request->name;
        $option->select_id = $request->select_id;
        $option->created_by = Auth::id();
        $option->save();

        flash()->success($option->name.' Option Name Created Successfully');
    	return redirect('option');
    }

    public function edit($id)
    {
    	$option = Option::find($id);
    	$selectList = Select::pluck('name', 'id');
    	return view('option.edit', compact('option', 'selectList'));
    }

    public function update(Request $request, $id)
    {
    	$option = Option::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required',
	    	'status' => 'required',
	    	'select_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The Option Name field is required.',
            'select_id.required' => 'The Select Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $optionExist = Option::with('select')->where('name', $request->name)->where('select_id', $request->select_id)->where('id', '<>', $option->id)->first();
        if($optionExist) {
        	flash()->error('Option '.$optionExist->name.' in '.$optionExist->select->name.' Select already exists.');
    		return redirect()->back()->withInput();
        }

        $option->name = $request->name;
        $option->status = $request->status;
        $option->select_id = $request->select_id;
        $option->updated_by = Auth::id();
        $option->save();

        flash()->success($option->name.' Option Name Updated Successfully');
    	return redirect('option');
    }
}
