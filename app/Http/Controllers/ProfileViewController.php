<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;
use Validator;
use Illuminate\Support\Facades\Input;
use Excel;

class ProfileViewController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function profileView()
    {
    	$profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->orderBy('id', 'desc')->paginate(20);

    	return view('profile_report.all_view', compact('profiles'));
    }

    public function profileViewDownload()
    {
        $profileCount = Profile::count();
    	$profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->orderBy('id', 'desc')->paginate(10000);

    	return view('profile_report.all_view_download', compact('profiles', 'profileCount'));
    }
}
