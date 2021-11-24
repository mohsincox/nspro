<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Brand;
use App\Models\Division;
use App\Models\Option;
use App\Models\Profile;
use App\Models\Crm;
use Excel;

class ReportMultiDivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportMultiDivisionFormExcel()
    {
        $brandList = Brand::pluck('name', 'id');
        $divisionList = Division::where('id', '<>', 9)->pluck('name', 'id');
        $consumerAge = Option::where('select_id', 1)->pluck('name', 'name');
        $gender = Option::where('select_id', 2)->pluck('name', 'name');
        $sec = Option::where('select_id', 4)->pluck('name', 'name');
        $actOrCmpName = Option::where('select_id', 12)->pluck('name', 'name');
        $interestedInCrm = Option::where('select_id', 9)->pluck('name', 'name');
        $interestedInFnm = Option::where('select_id', 19)->pluck('name', 'name');

        return view('report_multi_division.form_excel', compact('brandList', 'divisionList', 'consumerAge', 'gender', 'sec', 'actOrCmpName', 'interestedInCrm', 'interestedInFnm'));
    }
    
    public function reportMultiDivisionShowExcel(Request $request)
    {
        // echo (Request::getPathInfo() . (Request::getQueryString() ? ('?' . Request::getQueryString()) : ''));
        // return \Request::getRequestUri();

        // start_date: "2018-11-14",
        // end_date: "2018-11-14",
        // division_id: "",
        // district_id: "",
        // police_station_id: "",
        // consumer_age: "",
        // from_year: "",
        // from_month: "",
        // to_year: "",
        // to_month: "",
        // consumer_gender: "",
        // activity_campaign_name: "",
        // brand_id: "",
        // sec: "",
        // type: "xlsx"

        //return $request->all();

        // $startDate = $request->start_date.' 00:00:00';
     //    $endDate = $request->end_date.' 23:59:59';
     //    // $districtId = $request->district_id;
     //    // $districtId = 0;
     //    $type = $request->type;

        // return $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('district_id', $districtId)->whereBetween('updated_at', [$startDate, $endDate])->get();

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only date';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $type = $request->type;
            $startDateShow = $request->start_date;
            $endDateShow = $request->end_date;

            // return $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->whereBetween('updated_at', [$startDate, $endDate])->get();

            Excel::create('AllProfile_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   //End Date Wise

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only Division';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $type = $request->type;
           
            Excel::create('DivisionWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->whereIn('division_id', $divisionId)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   //End Division


        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only District';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $districtId = $request->district_id;
            $type = $request->type;
           
            Excel::create('DistrictWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($districtId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($districtId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('district_id', $districtId)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Camp. Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End District


        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only police station';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $psId = $request->police_station_id;
            $type = $request->type;
           
            Excel::create('ThanaWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($psId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($psId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('police_station_id', $psId)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   //End Police Station

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only consumer_age';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $consumerAge = $request->consumer_age;
            $type = $request->type;
           
            Excel::create('ConsumerAgeWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($consumerAge, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($consumerAge, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('consumer_age', $consumerAge)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);


        }   //End Consumer Age

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year != null) && ($request->from_month != null) && ($request->to_year != null) && ($request->to_month != null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only child_age';

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
           
            Excel::create('ChildAgeWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($toDate,  $fromDate, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($toDate,  $fromDate, $type, $startDate, $endDate) {

                    //Note: $fromDate is Greater than $toDate
                    $profiles = Profile::with(['division', 'district', 'policeStation'])
                                    ->whereBetween('updated_at', [$startDate, $endDate])
                                    ->where(function($query) use ($toDate,  $fromDate, $type) {
                                          $query->whereBetween('child1_DOB', [$toDate, $fromDate]);
                                          $query->orWhereBetween('child2_DOB', [$toDate, $fromDate]);
                                          $query->orWhereBetween('child3_DOB', [$toDate, $fromDate]);
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }
                        
                        

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   //End Child Age

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only consumer_gender';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $consumerGender = $request->consumer_gender;
            $type = $request->type;
           
            Excel::create('ConsumerGenderWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($consumerGender, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($consumerGender, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('consumer_gender', $consumerGender)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   //End Consumer Gender

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name != null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only activity_campaign_name';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $actOrCmp = $request->activity_campaign_name;
            $type = $request->type;
           
            Excel::create('ActOrCampWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($actOrCmp, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($actOrCmp, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('activity_campaign_name', $actOrCmp)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End Activity Campaign Name

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id != null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only brand_id';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $brandId = $request->brand_id;
            $type = $request->type;
           
            Excel::create('BrandWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($brandId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($brandId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('brand_id', $brandId)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End Brand

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec != null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only sec';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $sec = $request->sec;
            $type = $request->type;
           
            Excel::create('SECwise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($sec, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($sec, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('sec', $sec)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End SEC

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm != null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'only interested_in_crm';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $interested_in_crm = $request->interested_in_crm;
            $type = $request->type;
           
            Excel::create('CRMintWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($interested_in_crm, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($interested_in_crm, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('interested_in_crm', $interested_in_crm)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End Interested in CRM


        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm != null) ) 
        {
            //echo 'only interested_in_fnm';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $interested_in_fnm = $request->interested_in_fnm;
            $type = $request->type;
           
            Excel::create('FNMintWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($interested_in_fnm, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($interested_in_fnm, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('interested_in_fnm', $interested_in_fnm)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End Interested in FNM

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & consumer_age';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $consumerAge = $request->consumer_age;
            $type = $request->type;
           
            Excel::create('DivAndConAgeWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $consumerAge, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $consumerAge, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('consumer_age', $consumerAge)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & consumer_age

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year != null) && ($request->from_month != null) && ($request->to_year != null) && ($request->to_month != null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & child_age';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $fromYear = $request->from_year;
            $fromMonth = $request->from_month;
            $toYear = $request->to_year;
            $toMonth = $request->to_month;
            $type = $request->type;
            $divisionId = $request->division_id;

            $fromYearToDay = 365 * $fromYear;
            $fromMonthToDay = 31 * $fromMonth;
            $fromTotalDay = $fromYearToDay + $fromMonthToDay;
            $fromDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$fromTotalDay." day"));

            $toYearToDay = 365 * $toYear;
            $toMonthToDay = 30 * $toMonth;
            $toTotalDay = $toYearToDay + $toMonthToDay;
            $toDate = date('Y-m-d',strtotime(date("Y-m-d", time()) . " - ".$toTotalDay." day"));
           
            Excel::create('DivWiseChild_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $toDate,  $fromDate, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $toDate,  $fromDate, $type, $startDate, $endDate) {

                    //Note: $fromDate is Greater than $toDate
                    $profiles = Profile::with(['division', 'district', 'policeStation'])
                                    ->whereIn('division_id', $divisionId)
                                    ->whereBetween('updated_at', [$startDate, $endDate])
                                    ->where(function($query) use ($toDate,  $fromDate, $type) {
                                          $query->whereBetween('child1_DOB', [$toDate, $fromDate]);
                                          $query->orWhereBetween('child2_DOB', [$toDate, $fromDate]);
                                          $query->orWhereBetween('child3_DOB', [$toDate, $fromDate]);
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }
                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & child_age

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & consumer_gender';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $consumerGender = $request->consumer_gender;
            $type = $request->type;
           
            Excel::create('DivAndConGenWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $consumerGender, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $consumerGender, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('consumer_gender', $consumerGender)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & consumer_gender

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name != null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & activity_campaign_name';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $actOrCmpName = $request->activity_campaign_name;
            $type = $request->type;
           
            Excel::create('DivAndActCmpWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $actOrCmpName, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $actOrCmpName, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('activity_campaign_name', $actOrCmpName)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & activity_campaign_name

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id != null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & brand_id';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $brandId = $request->brand_id;
            $type = $request->type;
           
            Excel::create('DivAndBrandWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $brandId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $brandId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('brand_id', $brandId)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & brand_id

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec != null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & sec';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $sec = $request->sec;
            $type = $request->type;
           
            Excel::create('DivAndSecWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $sec, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $sec, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('sec', $sec)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & sec

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm != null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & interested_in_crm';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $interested_in_crm = $request->interested_in_crm;
            $type = $request->type;
           
            Excel::create('DivAndCRMwise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $interested_in_crm, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $interested_in_crm, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('interested_in_crm', $interested_in_crm)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & interested_in_crm

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm != null) ) 
        {
            //echo 'division_id & interested_in_fnm';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $interested_in_fnm = $request->interested_in_fnm;
            $type = $request->type;
           
            Excel::create('DivAndFNMwise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $interested_in_fnm, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $interested_in_fnm, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('interested_in_fnm', $interested_in_fnm)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & interested_in_fnm

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) && ($request->interested_in_crm == null) && ($request->interested_in_fnm == null) ) 
        {
            //echo 'division_id & consumer_gender';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $consumerGender = $request->consumer_gender;
            $consumerAge = $request->consumer_age;
            $type = $request->type;
           
            Excel::create('DivAgeGenderWise_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($divisionId, $consumerGender, $consumerAge, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $consumerGender, $consumerAge, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->whereIn('division_id', $divisionId)
                        ->where('consumer_gender', $consumerGender)
                        ->where('consumer_age', $consumerAge)
                        ->whereBetween('updated_at', [$startDate, $endDate])
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

                        if (isset($profile->brand->name)) {
                            $brandName = $profile->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($profile->createdBy->name)) {
                            $createdBy = $profile->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if ($profile->agent != null) {
                            $agent = $profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        
                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->interested_in_crm, $profile->interested_in_fnm, $profile->agent, $profile->updated_at);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'CRM interested', 'FNM Interested', 'Agent', 'CreatedOrUpdated At'
                        )

                    );

                });

            })->export($type);

        }   // End division_id & consumer_age & consumer_gender


        else {
            // echo 'Developing this Report';
            flash()->error('To many combination of fields does not support in Large Scale Data!');
            return redirect()->back();
        }

        // exit();
    }
}
