<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\District;
use App\Models\Division;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$districts = District::with(['division'])->get();
    	return view('district.index', compact('districts'));
    }

    public function create()
    {
    	$divisionList = Division::pluck('name', 'id');
    	return view('district.create', compact('divisionList'));
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:districts',
	    	'division_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The District Name field is required.',
            'name.unique' => 'The District Name already exist.',
            'division_id.required' => 'The Division Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $district = new District;
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->created_by = Auth::id();
        $district->save();

        flash()->success($district->name.' District Name Created Successfully');
    	return redirect('district');
    }

    public function edit($id)
    {
    	$district = District::find($id);
    	$divisionList = Division::pluck('name', 'id');
    	return view('district.edit', compact('district', 'divisionList'));
    }

    public function update(Request $request, $id)
    {
    	$district = District::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:districts,name,'.$district->id,
	    	'division_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The District Name field is required.',
            'name.unique' => 'The District Name already exist.',
            'division_id.required' => 'The Division Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->updated_by = Auth::id();
        $district->save();

        flash()->success($district->name.' District Name Updated Successfully');
    	return redirect('district');
    }
}
