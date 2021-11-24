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

class ReportSingleController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function reportSingleFormExcel()
    {
    	$brandList = Brand::pluck('name', 'id');
        $divisionList = Division::pluck('name', 'id');
        $consumerAge = Option::where('select_id', 1)->pluck('name', 'name');
        $gender = Option::where('select_id', 2)->pluck('name', 'name');
        $sec = Option::where('select_id', 4)->pluck('name', 'name');
        $actOrCmpName = Option::where('select_id', 12)->pluck('name', 'name');

    	return view('report_single.form', compact('brandList', 'divisionList', 'consumerAge', 'gender', 'sec', 'actOrCmpName'));
    }

    public function reportSingleShowExcel(Request $request)
    {
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
        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only date';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $type = $request->type;
            $startDateShow = $request->start_date;
            $endDateShow = $request->end_date;

            //return $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'createdBy'])->whereBetween('created_at', [$startDate, $endDate])->get();
           
            Excel::create('CrmProfile'.$startDateShow.$endDateShow, function($excel) use ($startDate,  $endDate, $type) {

                $excel->sheet('Sheet1', function($sheet) use ($startDate,  $endDate, $type) {

                    $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'createdBy'])->where('agent', null)->whereBetween('created_at', [$startDate, $endDate])->get();

                    $arr =array();
                    foreach($crms as $crm) {
                        if (isset($crm->profile->division->name)) {
                            $division = $crm->profile->division->name;
                        } else {
                            $division = null;
                        }
                        if (isset($crm->profile->district->name)) {
                            $district = $crm->profile->district->name;
                        } else {
                            $district = null;
                        }
                        if (isset($crm->profile->policeStation->name)) {
                            $policeStation = $crm->profile->policeStation->name;
                        } else {
                            $policeStation = null;
                        }
                        if ($crm->profile->child1_DOB == null) {
                            $child1Age = null;
                        } else {
                            $child1_DOB = $crm->profile->child1_DOB;
                            $interval1 = date_diff(date_create(), date_create($child1_DOB));
                            $child1Age = $interval1->format("%yy, %mm, %dd");
                        }
                        
                        if ($crm->profile->child2_DOB == null) {
                            $child2Age = null;
                        } else {
                            $child2_DOB = $crm->profile->child2_DOB;
                            $interval2 = date_diff(date_create(), date_create($child2_DOB));
                            $child2Age = $interval2->format("%yy, %mm, %dd");
                        }

                        if ($crm->profile->child3_DOB == null) {
                            $child3Age = null;
                        } else {
                            $child3_DOB = $crm->profile->child3_DOB;
                            $interval3 = date_diff(date_create(), date_create($child3_DOB));
                            $child3Age = $interval3->format("%yy, %mm, %dd");
                        }
                        if (isset($crm->brand->name)) {
                            $brandName = $crm->brand->name;
                        } else {
                            $brandName = null;
                        }

                        if (isset($crm->createdBy->name)) {
                            $createdBy = $crm->createdBy->name;
                        } else {
                            $createdBy = null;
                        }

                        if (isset($crm->profile->agent)) {
                            $agent = $crm->profile->agent;
                        } else {
                            $agent = $createdBy;
                        }

                        $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $agent, $crm->created_at, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);


        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only Division';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $type = $request->type;
           
            Excel::create('divisionWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])->where('division_id', $divisionId)->whereBetween('updated_at', [$startDate, $endDate])->get();

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);


        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only District';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $districtId = $request->district_id;
            $type = $request->type;
           
            Excel::create('districtWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($districtId, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Camp. Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only police station';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $psId = $request->police_station_id;
            $type = $request->type;
           
            Excel::create('thanaWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($psId, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only consumer_age';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $consumerAge = $request->consumer_age;
            $type = $request->type;
           
            Excel::create('consumerAgeWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($consumerAge, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);


        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year != null) && ($request->from_month != null) && ($request->to_year != null) && ($request->to_month != null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
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
           
            Excel::create('child'.$request->start_date.'to'.$request->end_date, function($excel) use ($toDate,  $fromDate, $type, $startDate, $endDate) {

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
                        
                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);
        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only consumer_gender';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $consumerGender = $request->consumer_gender;
            $type = $request->type;
           
            Excel::create('consumerGenderWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($consumerGender, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);


        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name != null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'only activity_campaign_name';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $actOrCmp = $request->activity_campaign_name;
            $type = $request->type;
           
            Excel::create('actOrCmpWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($actOrCmp, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);
        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id != null) && ($request->sec == null) ) 
        {
            //echo 'only brand_id';

            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $brandId = $request->brand_id;
            $type = $request->type;
           
            Excel::create('brandWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($brandId, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);
        }

        else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id == null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec != null) ) 
        {
            //echo 'only sec';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $sec = $request->sec;
            $type = $request->type;
           
            Excel::create('secWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($sec, $type, $startDate, $endDate) {

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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        } else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'division_id & consumer_age';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $consumerAge = $request->consumer_age;
            $type = $request->type;
           
            Excel::create('divAndConAgeWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $consumerAge, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $consumerAge, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->where('division_id', $divisionId)
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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        } else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year != null) && ($request->from_month != null) && ($request->to_year != null) && ($request->to_month != null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
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
           
            Excel::create('divWiseChild'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $toDate,  $fromDate, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $toDate,  $fromDate, $type, $startDate, $endDate) {

                    //Note: $fromDate is Greater than $toDate
                    $profiles = Profile::with(['division', 'district', 'policeStation'])
                                    ->where('division_id', $divisionId)
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
                        
                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        } else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'division_id & consumer_gender';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $consumerGender = $request->consumer_gender;
            $type = $request->type;
           
            Excel::create('divAndConGenWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $consumerGender, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $consumerGender, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->where('division_id', $divisionId)
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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        } else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name != null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            //echo 'division_id & activity_campaign_name';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $actOrCmpName = $request->activity_campaign_name;
            $type = $request->type;
           
            Excel::create('divAndActCmpWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $actOrCmpName, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $actOrCmpName, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->where('division_id', $divisionId)
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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        } else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id != null) && ($request->sec == null) ) 
        {
            //echo 'division_id & brand_id';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $brandId = $request->brand_id;
            $type = $request->type;
           
            Excel::create('divAndBrandWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $brandId, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $brandId, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->where('division_id', $divisionId)
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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        } else if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id == null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec != null) ) 
        {
            //echo 'division_id & sec';
            $startDate = $request->start_date.' 00:00:00';
            $endDate = $request->end_date.' 23:59:59';
            $divisionId = $request->division_id;
            $sec = $request->sec;
            $type = $request->type;
           
            Excel::create('divAndSecWise'.$request->start_date.'to'.$request->end_date, function($excel) use ($divisionId, $sec, $type, $startDate, $endDate) {

                $excel->sheet('Sheet1', function($sheet) use ($divisionId, $sec, $type, $startDate, $endDate) {

                    $profiles = Profile::with(['division', 'district', 'policeStation', 'brand'])
                        ->where('division_id', $divisionId)
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

                        $crm = Crm::where('profile_id', $profile->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'DESC')->first();

                        $data =  array($profile->id, $profile->phone_number,  $profile->consumer_name, $profile->consumer_age, $profile->consumer_gender, $division, $district, $policeStation, $profile->address, $profile->alternative_phone_number, $profile->profession, $profile->sec, $profile->number_of_child, $profile->total_family_member, $child1Age, $child2Age, $child3Age, $brandName, $profile->product, $profile->prefered_brand, $profile->activity_campaign_name, $profile->agent, $profile->updated_at, $crm->competition_brand_usage, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->quiz_question, $crm->quiz_ans_given, $crm->quiz_ans_status, $crm->supervisor_name, $crm->husband_name, $crm->product_sold, $crm->supervisor_visited, $crm->permission_contact);
                        array_push($arr, $data);
                    }
                    
                    //set the titles
                    $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                            'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Brand', 'Product', 'Prefered Brand', 'Act or Cmp Name', 'Agent', 'CreatedOrUpdated At', 'competition_brand_usage', 'source_of_knowing', 'ccid', 'sales_force', 'consumer_satisfaction_index', 'interested_in_crm', 'reasons_of_call', 'call_category', 'verbatim', 'quiz_question', 'quiz_ans_given', 'quiz_ans_status', 'supervisor_name', 'husband_name', 'product_sold', 'supervisor_visited', 'permission_contact'
                        )

                    );

                });

            })->export($type);

        }

        else {
            echo 'Developing this Report';
        }

        exit();

    

        



        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'district_id & consumer_age';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year != null) && ($request->from_month != null) && ($request->to_year != null) && ($request->to_month != null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'district_id & child _age';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'district_id & consumer_gender';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name != null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'district_id & activity_campaign_name';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id != null) && ($request->sec == null) ) 
        {
            echo 'district_id & brand_id';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id == null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec != null) ) 
        {
            echo 'district_id & sec';
        }




        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age != null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'police_station_id & consumer_age';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year != null) && ($request->from_month != null) && ($request->to_year != null) && ($request->to_month != null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'police_station_id & child _age';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender != null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'police_station_id & consumer_gender';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name != null) && ($request->brand_id == null) && ($request->sec == null) ) 
        {
            echo 'police_station_id & activity_campaign_name';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id != null) && ($request->sec == null) ) 
        {
            echo 'police_station_id & brand_id';
        }

        if ( ($request->start_date != null) && ($request->end_date != null) && ($request->type != null) && ($request->division_id != null) && ($request->district_id != null) && ($request->police_station_id != null) && ($request->consumer_age == null) && ($request->from_year == null) && ($request->from_month == null) && ($request->to_year == null) && ($request->to_month == null) && ($request->consumer_gender == null) && ($request->activity_campaign_name == null) && ($request->brand_id == null) && ($request->sec != null) ) 
        {
            echo 'police_station_id & sec';
        }
    }
}
