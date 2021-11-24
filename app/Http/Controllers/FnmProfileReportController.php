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
use App\Models\FnmCrm;
use Excel;

class FnmProfileReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fnmReportFormExcel()
    {

        return view('fnm_crm_profile.report.form_excel');
    }

    public function fnmReportShowExcel(Request $request)
    {
        //return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $type = $request->type;
        $startDateShow = $request->start_date;
        $endDateShow = $request->end_date;

        // return FnmCrm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'category', 'createdBy'])->whereBetween('created_at', [$startDate, $endDate])->get();

       
        Excel::create('FnmProfile'.$startDateShow.$endDateShow, function($excel) use ($startDate,  $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($startDate,  $endDate, $type) {

                $fnms = FnmCrm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand', 'category', 'createdBy'])->whereBetween('created_at', [$startDate, $endDate])->get();

                $arr =array();
                foreach($fnms as $crm) {
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
                        $consumer_dob = $crm->profile->consumer_dob;
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
                        $consumer_dob = null;
                        $consumer_gender = null;
                        $address = null;
                        $alternative_phone_number = null;
                        $profession = null;
                        $sec = null;
                        $number_of_child = null;
                        $total_family_member = null;
                        $ccid = null;
                    }


                    $data =  array($crm->id, $crm->created_at, $crm->agent, $crm->phone_number, $consumer_name, $consumer_gender, $child1Age, $address, $division, $child2Age, $consumer_age, $crm->product_used, $crm->product, $crm->multi_product, $crm->verbatim, $district, $crm->interested_in_fnm, $crm->interested_in_crm, $policeStation, $profession, $crm->profile_id, $number_of_child, $total_family_member, $child3Age, $categoryName, $brandName);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'SL No', 'Date', 'Agent Name', 'Consumer Phone Number', 'Consumer Name', 'Consumer Gender', 'Child1 Age', 'Address', 'Division', 'Child2 Age', 'Consumer Age', 'Product Used', 'Product', 'Multi Product', 'Verbatim', 'District', 'Interested FNM', 'Interested CRM', 'Police Station', 'Profession', 'Consumer ID', 'Child No.', 'Family Member', 'Child3 Age', 'Category', 'Brand'
                    )

                );

            });

        })->export($type);



    }
}
