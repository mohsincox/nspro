<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Brand;
use App\Models\Division;
use App\Models\Option;
use App\Models\Profile;
use Illuminate\Support\Facades\Input;

class ReportTabToXlsProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportForm()
    {
        $brandList = Brand::pluck('name', 'id');
        $divisionList = Division::where('id', '<>', 9)->pluck('name', 'id');
        $consumerAge = Option::where('select_id', 1)->pluck('name', 'name');
        $gender = Option::where('select_id', 2)->pluck('name', 'name');
        $sec = Option::where('select_id', 4)->pluck('name', 'name');
        $actOrCmpName = Option::where('select_id', 12)->pluck('name', 'name');
        $interestedInCrm = Option::where('select_id', 9)->pluck('name', 'name');
        $interestedInFnm = Option::where('select_id', 19)->pluck('name', 'name');
        $maritalStatusList = Option::where('select_id', 17)->pluck('name', 'name');
        $professionList = Option::where('select_id', 3)->pluck('name', 'name');

        return view('table_excel.form', compact('brandList', 'divisionList', 'consumerAge', 'gender', 'sec', 'actOrCmpName', 'interestedInCrm', 'interestedInFnm', 'maritalStatusList', 'professionList'));
    }

    public function reportShow(Request $request)
    {
         // return $request->all();
    	$startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';

        $fields = [
            "division_id" => "whereIn",
            "consumer_gender" => "where",
            "consumer_age" => "where",
            "activity_campaign_name" => "where",
            "brand_id" => "where",
            "sec" => "where",
            "interested_in_crm" => "where",
            "interested_in_fnm" => "where",
            "marital_status" => "where",
            "profession" => "where",
        ];

        $query = Profile::with(['division', 'district', 'policeStation', 'brand']);

        foreach($fields as $key => $value) {
            if($request->{$key} != null) {
                if($value == 'whereIn') {
                    $query->whereIn($key, $request->{$key});
                } else if($value == 'where') {
                    $query->where($key, $request->{$key});   
                }
            }
        }



        if( ($request->start_date != null) && ($request->end_date != null) ) {
            $query->whereBetween('updated_at', [$startDate, $endDate]);
        }

        $profiles = $query->paginate(10000);

        $profileCount = $profiles->total();

        return view('table_excel.show',[
            'profiles' => $profiles->appends(Input::except('page'))
        ], compact('profiles', 'profileCount'));
    }
}
