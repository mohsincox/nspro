<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Division;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$divisions = Division::get();
    	return view('division.index', compact('divisions'));
    }

    public function create()
    {
    	return view('division.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:divisions'
	    ];
	    $messages = [
            'name.required' => 'The Division Name field is required.',
            'name.unique' => 'The Division Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $division = new Division;
        $division->name = $request->name;
        $division->created_by = Auth::id();
        $division->save();
        flash()->success($division->name.' Division Name created successfully');
    	return redirect('division');
    }

    public function edit($id)
    {
    	$division = Division::find($id);
    	return view('division.edit', compact('division'));
    }
    
    public function update(Request $request, $id)
    {
    	$division = Division::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:divisions,name,'.$division->id,
	    ];
	    $messages = [
            'name.required' => 'The Division Name field is required.',
            'name.unique' => 'The Division Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $division->name = $request->name;
        $division->updated_by = Auth::id();
        $division->save();
        flash()->success($division->name.' Division Name updated successfully');
    	return redirect('division');
    }
}
