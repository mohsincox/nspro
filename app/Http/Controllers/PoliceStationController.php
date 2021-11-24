<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\PoliceStation;
use App\Models\District;
use App\Models\Division;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PoliceStationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$policeStations = PoliceStation::with(['division', 'district'])->get();
    	return view('police_station.index', compact('policeStations'));
    }

    public function create()
    {
    	$divisionList = Division::pluck('name', 'id');
    	$districtList = District::pluck('name', 'id');
    	return view('police_station.create', compact('divisionList', 'districtList'));
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:police_stations',
	    	'division_id' => 'required',
	    	'district_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The Police Station Name field is required.',
            'name.unique' => 'The Police Station Name already exist.',
            'division_id.required' => 'The Division Name field is required.',
            'district_id.required' => 'The District Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $policeStation = new PoliceStation;
        $policeStation->name = $request->name;
        $policeStation->division_id = $request->division_id;
        $policeStation->district_id = $request->district_id;
        $policeStation->created_by = Auth::id();
        $policeStation->save();

        flash()->success($policeStation->name.' Name Created Successfully');
    	return redirect('police-station');
    }

    public function edit($id)
    {
    	$policeStation = PoliceStation::find($id);
    	$divisionList = Division::pluck('name', 'id');
    	$districtList = District::pluck('name', 'id');
    	return view('police_station.edit', compact('policeStation', 'divisionList', 'districtList'));
    }

    public function update(Request $request, $id)
    {
    	$policeStation = PoliceStation::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:police_stations,name,'.$policeStation->id,
	    	'division_id' => 'required',
	    	'district_id' => 'required'
	    ];

	    $messages = [
            'name.required' => 'The Police Station Name field is required.',
            'name.unique' => 'The Police Station Name already exist.',
            'division_id.required' => 'The Division Name field is required.',
            'district_id.required' => 'The District Name field is required.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $policeStation->name = $request->name;
        $policeStation->division_id = $request->division_id;
        $policeStation->district_id = $request->district_id;
        $policeStation->updated_by = Auth::id();
        $policeStation->save();

        flash()->success($policeStation->name.' Name Updated Successfully');
    	return redirect('police-station');
    }

    public function testing()
    {
        $divisionId = $_GET["division_id"];
        $districts = District::where('division_id', $divisionId)->get();
        $outp ='{"district_records":'.$districts.'}';
        echo($outp);
    }

    public function divisionDistrictShow(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->get();
        foreach ($districts as $district) {
            $divWiseDistrictList[$district->id] = $district->name;
        }

        //print_r($divWiseDistrictList);
        return view('police_station.division_district', compact('divWiseDistrictList'));
    }
}
