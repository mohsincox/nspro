<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use Excel;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
    	return view('upload.create');
    }

    public function store(Request $request)
	{
		$input = Input::all();
	    $rules = [
	    	'file' => 'required|max:1024|mimes:xlsx,xls'
	    	// 'file' => 'required|max:600|mimes:xlsx,xls'
	    	//'file' => 'required|mimes:xlsx,xls,csv,txt'
	    ];
	    $messages = [];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

		if(Input::hasFile('file')){
			$path = Input::file('file')->getRealPath();
			$results=Excel::load($path)->get();
			//print_r($results);
			$duplicateCount = 0;
			$successCount = 0;
			foreach ($results as $row) {

				if(strlen($row['phone_number']) == 10) {
					$phoneNumber = '0'.$row['phone_number'];

					$duplicateNumber = Profile::where('phone_number', $phoneNumber)->first();

					if (isset($duplicateNumber)) {
						$duplicateCount += 1;
					} else {
						Profile::create([
					        'phone_number' => $phoneNumber,
					        'consumer_name' => $row->consumer_name,
					        'consumer_age' => $row->consumer_age,
					        'consumer_gender' => $row->consumer_gender,
					        'profession' => $row->profession,
					        'division_id' => $row->division_id,
					        'address' => $row->address,
					        'brand_id' => $row->brand_id,
					        'activity_campaign_name' => $row->activity_campaign_name,
					        'sec' => $row->sec,
					        'interested_in_crm' => $row->interested_in_crm,
					        'interested_in_fnm' => $row->interested_in_fnm,
					        'kids_age' => $row->kids_age,
					        'created_by' => Auth::id()
					    ]);
					    $successCount += 1;
					}
				  	


			    }

			}
  			flash()->success('Success: ' . $successCount . ', Duplicate: ' . $duplicateCount . ', Excel file imported successfully');
   			return redirect()->back();
		}
		flash()->error('Something Wrong.');
        return redirect()->back();
	}
}
