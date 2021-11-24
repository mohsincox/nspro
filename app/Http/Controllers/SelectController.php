<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Select;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class SelectController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$selects = Select::get();
    	return view('select.index', compact('selects'));
    }

    public function create()
    {
    	return view('select.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:selects'
	    ];
	    $messages = [
            'name.required' => 'The Select Name field is required.',
            'name.unique' => 'The Select Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $select = new Select;
        $select->name = $request->name;
        $select->created_by = Auth::id();
        $select->save();
        flash()->success($select->name.' Select Name created successfully');
    	return redirect('select');
    }

    public function edit($id)
    {
    	$select = Select::find($id);
    	return view('select.edit', compact('select'));
    }
    
    public function update(Request $request, $id)
    {
    	$select = Select::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:selects,name,'.$select->id,
	    ];
	    $messages = [
            'name.required' => 'The Select Name field is required.',
            'name.unique' => 'The Select Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $select->name = $request->name;
        $select->updated_by = Auth::id();
        $select->save();
        flash()->success($select->name.' Select Name updated successfully');
    	return redirect('select');
    }
}
