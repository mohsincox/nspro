<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Models\Profile;

class SearchController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function phoneNumberWiseProfile(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'phone_number' => 'required|numeric|digits_between:11,11',
	    ];

	    $messages = [];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error("<b>" . $request->phone_number . "</b>" . ' Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $profile = Profile::where('phone_number', $request->phone_number)->first();
        if (isset($profile)) {
        	return view('search.phone_number', compact('profile'));
        } else {
        	flash()->error("<b>" . $request->phone_number . "</b>" . ' does not exists.');
    		return redirect()->back()->withInput();
        }
    	
    	
    }
}
