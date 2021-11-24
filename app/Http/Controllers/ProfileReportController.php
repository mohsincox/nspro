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

class ProfileReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function childAgeFormOld()
    {
    	return view('profile_report.child_age_form_old');
    }

    public function childAgeShowOld(Request $request)
    {
    	//return $request->all();
    	$input = Input::all();
	    $rules = [
	    	'start_date' => 'required',
	    	'end_date' => 'required',
	    	'child_start_date' => 'required',
	    	'child_end_date' => 'required'
	    ];
	    $messages = [
            
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;
        $childStartDate = $request->child_start_date;
        $childEndDate = $request->child_end_date;
        $intervalAge1 = date_diff(date_create(), date_create($childStartDate));
		$childStartAge = $intervalAge1->format("Year: %Y, Month: %M, Day: %D");
		$intervalAge2 = date_diff(date_create(), date_create($childEndDate));
		$childEndAge = $intervalAge2->format("Year: %Y, Month: %M, Day: %D");
    	$profiles = Profile::with(['division', 'district', 'policeStation'])
    							->whereBetween('updated_at', [$startDate, $endDate])
								->where(function ($query) use ($childStartDate, $childEndDate) {
        							$query->whereBetween('child1_DOB', [$childStartDate, $childEndDate])
        							->orWhereBetween('child2_DOB', [$childStartDate, $childEndDate])
        							->orWhereBetween('child3_DOB', [$childStartDate, $childEndDate]);	
    							})
								->get();
		
        return view('profile_report.child_age_show_old', compact('profiles', 'startDateShow', 'endDateShow', 'childStartAge', 'childEndAge'));
    }

    public function getYMD(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth;
        $interval = date_diff(date_create(), date_create($dateOfBirth));
        return $interval->format("Year: %Y, Month: %M, Day: %D");
    }

    public function childAgeForm()
    {
    	return view('profile_report.child_age_form');
    }

    public function childAgeShow(Request $request)
    {
    	//return $request->all();
        $fromYear = $request->from_year;
        $fromMonth = $request->from_month;
        $toYear = $request->to_year;
        $toMonth = $request->to_month;

    	$fromYearToDay = 365 * $fromYear;
    	$fromMonthToDay = 31 * $fromMonth;
    	$fromTotalDay = $fromYearToDay + $fromMonthToDay;
    	$fromDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$fromTotalDay." day"));

    	$toYearToDay = 365 * $toYear;
    	$toMonthToDay = 30 * $toMonth;
    	$toTotalDay = $toYearToDay + $toMonthToDay;
    	$toDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$toTotalDay." day"));

    	//Note: $fromDate is Greater than $toDate
    	$profiles = Profile::with(['division', 'district', 'policeStation'])
    							->whereBetween('child1_DOB', [$toDate, $fromDate])
    							->orWhereBetween('child2_DOB', [$toDate, $fromDate])
    							->orWhereBetween('child3_DOB', [$toDate, $fromDate])
								->get();
		
        return view('profile_report.child_age_show', compact('profiles', 'fromYear', 'fromMonth', 'toYear', 'toMonth'));
    }

    public function childAgeFormExcel()
    {
        return view('profile_report.child_age_form_excel');
    }

    public function childAgeShowExcel(Request $request)
    {
        $fromYear = $request->from_year;
        $fromMonth = $request->from_month;
        $toYear = $request->to_year;
        $toMonth = $request->to_month;
        $type = $request->type;

        $fromYearToDay = 365 * $fromYear;
        $fromMonthToDay = 31 * $fromMonth;
        $fromTotalDay = $fromYearToDay + $fromMonthToDay;
        $fromDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$fromTotalDay." day"));

        $toYearToDay = 365 * $toYear;
        $toMonthToDay = 30 * $toMonth;
        $toTotalDay = $toYearToDay + $toMonthToDay;
        $toDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$toTotalDay." day"));
       
        Excel::create('child', function($excel) use ($toDate,  $fromDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($toDate,  $fromDate, $type) {

                //Note: $fromDate is Greater than $toDate
                $profiles = Profile::with(['division', 'district', 'policeStation'])
                                ->whereBetween('child1_DOB', [$toDate, $fromDate])
                                ->orWhereBetween('child2_DOB', [$toDate, $fromDate])
                                ->orWhereBetween('child3_DOB', [$toDate, $fromDate])
                                ->get();

                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }
                    

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Created 0r Updated At'
                    )

                );

            });

        })->export($type);
    }

    public function childAgeAndDateWiseShowExcel(Request $request)
    {
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $fromYear = $request->from_year;
        $fromMonth = $request->from_month;
        $toYear = $request->to_year;
        $toMonth = $request->to_month;
        $type = $request->type;

        $fromYearToDay = 365 * $fromYear;
        $fromMonthToDay = 31 * $fromMonth;
        $fromTotalDay = $fromYearToDay + $fromMonthToDay;
        $fromDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$fromTotalDay." day"));

        $toYearToDay = 365 * $toYear;
        $toMonthToDay = 30 * $toMonth;
        $toTotalDay = $toYearToDay + $toMonthToDay;
        $toDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$toTotalDay." day"));
       
        Excel::create('child'.$request->start_date.'to'.$request->end_date, function($excel) use ($toDate,  $fromDate, $type, $startDate, $endDate) {

            $excel->sheet('Sheet1', function($sheet) use ($toDate,  $fromDate, $type, $startDate, $endDate) {

                //Note: $fromDate is Greater than $toDate
                $profiles = Profile::with(['division', 'district', 'policeStation'])
                                ->whereBetween('updated_at', [$startDate, $endDate])
                                ->where(function ($query) use ($toDate, $fromDate) {
                                    $query->whereBetween('child1_DOB', [$toDate, $fromDate])
                                    ->orWhereBetween('child2_DOB', [$toDate, $fromDate])
                                    ->orWhereBetween('child3_DOB', [$toDate, $fromDate]);   
                                })
                                ->get();
                                
                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }
                    

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Created 0r Updated At'
                    )

                );

            });

        })->export($type);
    }

    public function divisionAllShow(Request $request)
    {   
        
        $profiles = Profile::with(['division', 'district', 'policeStation'])->get();

        if (count($profiles)) {
            return view('profile_report.division_all_show', compact('profiles'));
        } else {
            flash()->error('There is no data of all Divisions');
            return redirect()->back();             
        }
    }

    public function divisionAllDownloadExcel(Request $request)
    {
        Excel::create('AllDivision', function($excel) {

            $excel->sheet('Sheet1', function($sheet) {

                $profiles = Profile::with(['division', 'district', 'policeStation'])->get();

                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Created or Updated'
                    )

                );

            });

        })->export('xlsx');
    }

    public function divisionWiseForm()
    {
        $divisionList = Division::pluck('name', 'id');
        return view('profile_report.division_wise_form', compact('divisionList'));
    }

    public function divisionWiseShow(Request $request)
    {
        $profiles = Profile::with(['division', 'district', 'policeStation'])
                                ->where('division_id', $request->division_id)
                                ->get();

        if (count($profiles)) {
            return view('profile_report.division_wise_show', compact('profiles'));
        } else {
            flash()->error('There is no data of this Division');
            return redirect()->back();
                      
        }
        
    }

    public function divisionWiseFormExcel()
    {
        $divisionList = Division::pluck('name', 'id');
        return view('profile_report.division_wise_form_excel', compact('divisionList'));
    }

    public function divisionWiseShowExcel(Request $request)
    {
        // return $request->all();
        // $startDate = $request->start_date.' 00:00:00';
        // $endDate = $request->end_date.' 23:59:59';
        $divisionId = $request->division_id;
        $type = $request->type;
       
        Excel::create('divisionWise', function($excel) use ($divisionId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($divisionId, $type) {

                $profiles = Profile::with(['division', 'district', 'policeStation'])->where('division_id', $divisionId)->get();

                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Created At'
                    )

                );

            });

        })->export($type);
    }

    public function divisionAndDateWiseShowExcel(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $divisionId = $request->division_id;
        $type = $request->type;
       
        Excel::create('divisionWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $type, $startDate, $endDate) {

            $excel->sheet('Sheet1', function($sheet) use ($divisionId, $type, $startDate, $endDate) {

                $profiles = Profile::with(['division', 'district', 'policeStation'])->where('division_id', $divisionId)->whereBetween('updated_at', [$startDate, $endDate])->get();

                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Created At'
                    )

                );

            });

        })->export($type);
    }

    public function districtWiseForm()
    {
        $divisionList = Division::pluck('name', 'id');
        //$districtList = District::pluck('name', 'id');
        return view('profile_report.district_wise_form', compact('divisionList'));
    }

    public function divisionDistrictShow(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->get();
        foreach ($districts as $district) {
            $divWiseDistrictList[$district->id] = $district->name;
        }
        return view('profile_report.division_district', compact('divWiseDistrictList'));
    }

    public function districtWiseShow(Request $request)
    {
        //return $request->all();
        $profiles = Profile::with(['division', 'district', 'policeStation'])
                                ->where('district_id', $request->district_id)
                                ->get();
        
        if (count($profiles)) {
            return view('profile_report.district_wise_show', compact('profiles'));
        } else {
            flash()->error('There is no data of this District');
            return redirect()->back();           
        } 
    }

    public function districtWiseFormExcel()
    {
        $divisionList = Division::pluck('name', 'id');
        return view('profile_report.district_wise_form_excel', compact('divisionList'));
    }

    public function districtWiseShowExcel(Request $request)
    {
        // return $request->all();
        // $startDate = $request->start_date.' 00:00:00';
        // $endDate = $request->end_date.' 23:59:59';
        $districtId = $request->district_id;
        $type = $request->type;
       
        Excel::create('districtWise', function($excel) use ($districtId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($districtId, $type) {

                $profiles = Profile::with(['division', 'district', 'policeStation'])->where('district_id', $districtId)->get();

                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Updated or Created At'
                    )

                );

            });

        })->export($type);
    }

    public function psWiseForm()
    {
        //$divisionList = Division::pluck('name', 'id');
        $districtList = District::pluck('name', 'id');
        return view('profile_report.ps_wise_form', compact('districtList'));
    }

    public function districtPsShow(Request $request)
    {   
        $pss = PoliceStation::where('district_id', $request->district_id)->get();
        foreach ($pss as $ps) {
            $disWisePsList[$ps->id] = $ps->name;
        }
        return view('profile_report.district_ps', compact('disWisePsList'));
    }

    public function psWiseShow(Request $request)
    {
        //return $request->all();
        $profiles = Profile::with(['division', 'district', 'policeStation'])
                                ->where('police_station_id', $request->police_station_id)
                                ->get();
        
        if (count($profiles)) {
            return view('profile_report.ps_wise_show', compact('profiles'));
        } else {
            flash()->error('There is no data of this Police Station');
            return redirect()->back();           
        } 
    }

    public function psWiseFormExcel()
    {
        $districtList = District::pluck('name', 'id');
        return view('profile_report.ps_wise_form_excel', compact('districtList'));
    }

    public function psWiseShowExcel(Request $request)
    {
        $psId = $request->police_station_id;
        $type = $request->type;
       
        Excel::create('PoliceStationWise', function($excel) use ($psId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($psId, $type) {

                $profiles = Profile::with(['division', 'district', 'policeStation'])->where('police_station_id', $psId)->get();

                $arr =array();
                foreach($profiles as $profile) {
                    if (isset($profile->division->name)) {
                        $division = $profile->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($profile->district->name)) {
                        $district = $profile->district->name;
                    } else {
                        $district = null;
                    }
                    if (isset($profile->policeStation->name)) {
                        $policeStation = $profile->policeStation->name;
                    } else {
                        $policeStation = null;
                    }
                    if ($profile->child1_DOB == null) {
                        $child1Age = null;
                    } else {
                        $child1_DOB = $profile->child1_DOB;
                        $interval1 = date_diff(date_create(), date_create($child1_DOB));
                        $child1Age = $interval1->format("%yy, %mm, %dd");
                    }
                    
                    if ($profile->child2_DOB == null) {
                        $child2Age = null;
                    } else {
                        $child2_DOB = $profile->child2_DOB;
                        $interval2 = date_diff(date_create(), date_create($child2_DOB));
                        $child2Age = $interval2->format("%yy, %mm, %dd");
                    }

                    if ($profile->child3_DOB == null) {
                        $child3Age = null;
                    } else {
                        $child3_DOB = $profile->child3_DOB;
                        $interval3 = date_diff(date_create(), date_create($child3_DOB));
                        $child3Age = $interval3->format("%yy, %mm, %dd");
                    }

                    $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $profile->prefered_brand, $profile->agent, $profile->updated_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Agent', 'Updated or Created At'
                    )

                );

            });

        })->export($type);
    }
}