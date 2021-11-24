<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Option;
use App\Models\Profile;
use App\Models\Crm;
use Excel;

class CrmProfileReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function crmReportForm()
    {

        return view('crm_profile.report.form');
    }

    public function crmReportShow(Request $request)
    {
        //return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc')->get();
        return view('crm_profile.report.index', compact('crms', 'startDateShow', 'endDateShow'));
    }

    public function crmReportFormExcel()
    {

        return view('crm_profile.report.form_excel');
    }

    public function crmReportShowExcel(Request $request)
    {
        //return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $type = $request->type;
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;

        //return $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'createdBy'])->whereBetween('created_at', [$startDate, $endDate])->get();
       
        Excel::create('CrmProfile'.$startDateShow.$endDateShow, function($excel) use ($startDate,  $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($startDate,  $endDate, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'createdBy'])->whereBetween('created_at', [$startDate, $endDate])->get();

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
                    if (isset($crm->profile)) {
                        if ($crm->profile->child1_DOB == null) {
                            $child1Age = null;
                        } else {
                            $child1_DOB = $crm->profile->child1_DOB;
                            $interval1 = date_diff(date_create(), date_create($child1_DOB));
                            $child1Age = $interval1->format("%yy, %mm, %dd");
                        }
                    } else {
                        $child1Age = null;
                    }

                    if (isset($crm->profile)) {
                        if ($crm->profile->child2_DOB == null) {
                            $child2Age = null;
                        } else {
                            $child2_DOB = $crm->profile->child2_DOB;
                            $interval2 = date_diff(date_create(), date_create($child2_DOB));
                            $child2Age = $interval2->format("%yy, %mm, %dd");
                        }
                    } else {
                        $child2Age = null;
                    }

                    if (isset($crm->profile)) {
                        if ($crm->profile->child3_DOB == null) {
                            $child3Age = null;
                        } else {
                            $child3_DOB = $crm->profile->child3_DOB;
                            $interval3 = date_diff(date_create(), date_create($child3_DOB));
                            $child3Age = $interval3->format("%yy, %mm, %dd");
                        }
                    } else {
                        $child3Age = null;
                    }

                    if (isset($crm->category->name)) {
                        $categoryName = $crm->category->name;
                    } else {
                        $categoryName = null;
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

                    if (isset($crm->profile)) {
                        $consumer_name = $crm->profile->consumer_name;
                        $consumer_age = $crm->profile->consumer_age;
                        $consumer_gender = $crm->profile->consumer_gender;
                        $address = $crm->profile->address;
                        $alternative_phone_number = $crm->profile->alternative_phone_number;
                        $profession = $crm->profile->profession;
                        $sec = $crm->profile->sec;
                        $number_of_child = $crm->profile->number_of_child;
                        $total_family_member = $crm->profile->total_family_member;
                        $ccid = $crm->profile->ccid;
                    } else {
                        $consumer_name = null;
                        $consumer_age = null;
                        $consumer_gender = null;
                        $address = null;
                        $alternative_phone_number = null;
                        $profession = null;
                        $sec = null;
                        $number_of_child = null;
                        $total_family_member = null;
                        $ccid = null;
                    }


                    $data =  array($crm->id, $crm->created_at, $crm->agent, $crm->phone_number, $consumer_name, $consumer_gender, $child1Age, $address, $division, $child2Age, $consumer_age, $crm->product, $crm->multi_product, $crm->call_type, $crm->call_quality, $crm->contact_qualification, $crm->verbatim, $district, $crm->interested_in_crm, $policeStation, $ccid, $alternative_phone_number, $profession, $crm->profile_id, $crm->service_level, $number_of_child, $crm->source_of_knowing, $total_family_member, $crm->quiz_question, $child3Age, $categoryName, $brandName, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->sales_force, $crm->quiz_ans_given, $crm->quiz_ans_status);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'SL No', 'Date', 'Agent Name', 'Consumer Phone Number', 'Consumer Name', 'Consumer Gender', 'Child1 Age', 'Address', 'Division', 'Child2 Age', 'Consumer Age', 'Product', 'Multi Product', 'Call Type', 'Call Quality', 'Contact Qualification', 'Verbatim', 'District', 'Interested CRM', 'Police Station', 'CCID', 'Alternative No.', 'Profession', 'Consumer ID', 'Service Level', 'Child No.', 'Source of Knowing', 'Family Member', 'quiz_question', 'Child3 Age', 'Category', 'Brand', 'Competition Brand Usage', 'Activity or Campaign Name', 'Sales Force', 'quiz_ans_given', 'quiz_ans_status'
                    )

                );

            });

        })->export($type);
    }

    public function brandWiseForm()
    {
        $brandList = Brand::pluck('name', 'id');
        return view('crm_profile.report.brand_wise_form', compact('brandList'));
    }

    public function brandWiseShow(Request $request)
    {
        //return $request->all();
        $brand = Brand::find($request->brand_id);
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('brand_id', $request->brand_id)->orderBy('id', 'desc')->get();
        return view('crm_profile.report.brand_wise_show', compact('crms', 'startDateShow', 'endDateShow', 'brand'));
    }

    public function brandWiseFormExcel()
    {
        $brandList = Brand::pluck('name', 'id');
        return view('crm_profile.report.brand_wise_form_excel', compact('brandList'));
    }

    public function brandWiseShowExcel(Request $request)
    {
        //return $request->all();
        $brandId = $request->brand_id;
        $type = $request->type;
       
        Excel::create('BrandWise', function($excel) use ($brandId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($brandId, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('brand_id', $brandId)->get();

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

                    $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->profile->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At'
                    )
                );
            });
        })->export($type);
    }

    public function brandAndDivWiseForm()
    {
        $brandList = Brand::pluck('name', 'id');
        $divisionList = Division::pluck('name', 'id');
        return view('crm_profile.report.brand_and_div_wise_form', compact('brandList', 'divisionList'));
    }

    public function brandAndDivWiseShow(Request $request)
    {
        $divisionId = $request->division_id;
        $brandId = $request->brand_id;
        $brand = Brand::find($brandId);
        $division = Division::find($divisionId);
        $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->whereHas('profile', function ($query) use($divisionId) {
                $query->where('division_id', $divisionId);
            })->where('brand_id', $brandId)
            ->orderBy('id', 'desc')->get();

        return view('crm_profile.report.brand_and_div_wise_show', compact('crms', 'brand', 'division'));
    }

    public function brandAndDivWiseFormExcel()
    {
        $brandList = Brand::pluck('name', 'id');
        $divisionList = Division::pluck('name', 'id');
        return view('crm_profile.report.brand_and_div_wise_form_excel', compact('brandList', 'divisionList'));
    }

    public function brandAndDivWiseShowExcel(Request $request)
    {
        //return $request->all();
        $brandId = $request->brand_id;
        $divisionId = $request->division_id;
        $type = $request->type;
       
        Excel::create('BrandAndDivisionWise', function($excel) use ($brandId, $divisionId, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($brandId, $divisionId, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'category'])->whereHas('profile', function ($query) use($divisionId) {
                         $query->where('division_id', $divisionId);
                    })->where('brand_id', $brandId)
                      ->get();

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

                    $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->profile->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At'
                    )
                );
            });
        })->export($type);
    }

    public function brandAndDateWiseShowExcel(Request $request)
    {
        //return $request->all();
        $brandId = $request->brand_id;
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $type = $request->type;
       
        Excel::create('BrandWise'.$request->start_date. 'to' .$request->end_date, function($excel) use ($brandId, $startDate, $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($brandId, $startDate, $endDate, $type) {

                $crms = Crm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])
                    ->where('brand_id', $brandId)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->get();

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

                    $data =  array($crm->id, $crm->phone_number,  $crm->profile->consumer_name, $crm->profile->consumer_age, $crm->profile->consumer_gender, $division, $district, $policeStation, $crm->profile->address, $crm->profile->alternative_phone_number, $crm->profile->profession, $crm->profile->sec, $crm->profile->number_of_child, $crm->profile->total_family_member, $child1Age, $child2Age, $child3Age, $crm->profile->prefered_brand, $brandName, $crm->product, $crm->competition_brand_usage, $crm->activity_campaign_name, $crm->source_of_knowing, $crm->ccid, $crm->sales_force, $crm->consumer_satisfaction_index, $crm->interested_in_crm, $crm->reasons_of_call, $crm->call_category, $crm->verbatim, $crm->profile->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Con Phone Number', 'Con Name', 'Con Age', 'Con Gender', 'Division', 'District', 'Police Station', 'Address', 'Alt. Ph No', 'Profession', 'SEC', 'Child No.', 'Family Mem.', 'Child1 Age', 'Child2 Age', 'Child3 Age', 'Prefered Brand', 'Brand', 'Product', 'Com. Brand Usage', 'Act or Camp. Name', 'Source of Knowing', 'CCID', 'Sales Force', 'CSI', 'Interested CRM', 'Reasons', 'Category', 'Verbatim', 'Agent', 'Created At'
                    )
                );
            });
        })->export($type);
    }

    public function allReportFormExcel()
    {
        $divisionList = Division::pluck('name', 'id');
        $districtList = District::pluck('name', 'id');
        $brandList = Brand::pluck('name', 'id');
        return view('crm_profile.report.all_report_form_excel', compact('divisionList', 'districtList', 'brandList'));
    }
}
