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
use App\Models\Quiz;
use App\Models\Tertiary;
use App\Models\Secondary;
use App\Models\PrimaryN;

class CrmProfileController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function create(Request $request)
    {

        $phoneNumber = substr($request->phone_number, -10);

        if (strlen($phoneNumber) == 10) {
            $phoneNumber = '0'.$phoneNumber;
        }
        
        $profile = Profile::where('phone_number', $phoneNumber)->first();
        $crmLast = Crm::where('phone_number', $phoneNumber)->orderBy('id', 'desc')->first();
        $agent = $request->agent;
        $divisionList = Division::pluck('name', 'id');
        $districtList = District::orderBy('name', 'asc')->pluck('name', 'id');
        $policeStationList = PoliceStation::pluck('name', 'id');
        $brandList = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $brandNameList = Brand::orderBy('name', 'asc')->pluck('name', 'name');
        $productNameList = Product::orderBy('name', 'asc')->pluck('name', 'name');
        $productList = Product::pluck('name', 'id');
        $quizList  = Quiz::where('status', 'Active')->pluck('name', 'name');
        $consumerAgeList  = Option::where('select_id', 1)->where('status', 'Active')->pluck('name', 'name');
        $genderList  = Option::where('select_id', 2)->where('status', 'Active')->pluck('name', 'name');
        $professionList  = Option::where('select_id', 3)->where('status', 'Active')->pluck('name', 'name');
        $secList  = Option::where('select_id', 4)->where('status', 'Active')->pluck('name', 'name');
        $numberList  = Option::where('select_id', 5)->where('status', 'Active')->pluck('name', 'name');
        //$sourceOfKnowingList  = Option::where('select_id', 6)->where('status', 'Active')->pluck('name', 'name');
        $sourceOfKnowingList  = Option::where('select_id', 6)->where('status', 'Active')->get();
        $salesForceList  = Option::where('select_id', 7)->where('status', 'Active')->pluck('name', 'name');
        $serviceLevelList  = Option::where('select_id', 8)->where('status', 'Active')->pluck('name', 'name');
        $interestedInCrmList  = Option::where('select_id', 9)->where('status', 'Active')->pluck('name', 'name');
        $callTypeList  = Option::where('select_id', 10)->where('status', 'Active')->pluck('name', 'name');
        $callQualityList  = Option::where('select_id', 11)->where('status', 'Active')->pluck('name', 'name');
        $actOrCampList  = Option::where('select_id', 12)->where('status', 'Active')->pluck('name', 'name');
        $quizAnsList  = Option::where('select_id', 13)->where('status', 'Active')->pluck('name', 'name');
        $maritalStatusList  = Option::where('select_id', 17)->where('status', 'Active')->pluck('name', 'name');
        $consumerInvolvementList  = Option::where('select_id', 21)->where('status', 'Active')->pluck('name', 'name');
        $contactQualificationList  = Option::where('select_id', 22)->where('status', 'Active')->pluck('name', 'name');
        $primaryList  = PrimaryN::pluck('name', 'id');
        // $secondaryList  = Option::where('select_id', 24)->where('status', 'Active')->pluck('name', 'name');
        // $tertiaryList  = Option::where('select_id', 25)->where('status', 'Active')->pluck('name', 'name');
        $crms = Crm::with(['brand'])->where('phone_number', $phoneNumber)->orderBy('id', 'desc')->limit(5)->get();
        
        return view('crm_profile.create', compact('phoneNumber', 'agent', 'divisionList', 'districtList', 'policeStationList', 'brandList', 'brandNameList', 'productNameList', 'productList', 'actOrCampList', 'quizList', 'consumerAgeList', 'genderList', 'professionList', 'secList', 'numberList', 'sourceOfKnowingList', 'salesForceList', 'serviceLevelList', 'interestedInCrmList', 'callTypeList', 'callQualityList', 'contactQualificationList', 'quizAnsList', 'maritalStatusList', 'consumerInvolvementList', 'profile', 'crmLast', 'crms', 'primaryList'));
    }

    public function getYMD(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth;
        $interval = date_diff(date_create(), date_create($dateOfBirth));
        return $interval->format("%yy, %mm, %dd");
        //return view('crm_profile.get_ymd', compact('dateOfBirth'));
    }

    // For address
    public function getDistrict(Request $request)
    {
        
        $districts = District::where('division_id', $request->division_id)->pluck('name', 'id');

        return response()->json($districts);

    }

    public function getPoliceStation(Request $request)
    {   
        $policeStations = PoliceStation::where('district_id', $request->district_id)->pluck('name', 'id');

        return response()->json($policeStations);
    }
    // end address


    // For pri sec ter
    public function getSecondary(Request $request)
    {
        
        $secondaries = Secondary::where('primary_n_id', $request->primary_n_id)->pluck('name', 'id');

        return response()->json($secondaries);

    }

    public function getTertiary(Request $request)
    {   
        $tertiaries = Tertiary::where('secondary_id', $request->secondary_id)->pluck('name', 'id');

        return response()->json($tertiaries);
    }
    // end pri sec ter


    public function divisionDistrictShow(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->get();
        foreach ($districts as $district) {
            $divWiseDistrictList[$district->id] = $district->name;
        }
        return view('crm_profile.division_district', compact('divWiseDistrictList'));
    }
    
    public function districtPsShow(Request $request)
    {   
        $policeStations = PoliceStation::where('district_id', $request->district_id)->get();
        foreach ($policeStations as $policeStation) {
            $disWisePsList[$policeStation->id] = $policeStation->name;
        }
        return view('crm_profile.district_ps', compact('disWisePsList'));
    }

    public function brandProductShow(Request $request)
    {   
        $products = Product::where('brand_id', $request->brand_id)->get();
        foreach ($products as $product) {
            $brandWiseProductList['Product: '.$product->name.', SKU: '.$product->sku] = $product->name.', '.$product->sku;
        }
        return view('crm_profile.brand_product', compact('brandWiseProductList'));
    }

    public function store(Request $request)
    {
        //return $request->all();
        $phoneNumber = substr($request->phone_number, -10);

        if (strlen($phoneNumber) == 10) {
            $phoneNumber = '0'.$phoneNumber;
        }

        $district = District::find($request->district_id);
        $brand = Brand::find($request->brand_id_blank);

        // return $brand->category_id;

        // if ($brand == null) {
        //     echo "Nai";
        // } else {
        //    echo "ache";
        // }
        // exit();
       
        $profile = Profile::firstOrNew(array('phone_number' => $phoneNumber));
        $profile->phone_number = $phoneNumber;
        $profile->agent = $request->agent;
        $profile->consumer_name = $request->consumer_name;
        $profile->consumer_age = $request->consumer_age;
        $profile->consumer_gender = $request->consumer_gender;

        if ($district == null) {
            $profile->division_id = null;
        } else {
            $profile->division_id = $district->division_id;
        }

        if ($request->district_id == null) {
            $profile->district_id = null;
        } else {
            $profile->district_id = $request->district_id;
        }

        if ($request->police_station_id == null) {
            $profile->police_station_id = null;
        } else {
            $profile->police_station_id = $request->police_station_id;
        }
        
        $profile->address = $request->address;
        $profile->alternative_phone_number = $request->alternative_phone_number;
        $profile->profession = $request->profession;
        $profile->sec = $request->sec;
        $profile->number_of_child = $request->number_of_child;
        $profile->total_family_member = $request->total_family_member;

        if ($request->child1_DOB == null) {
            $profile->child1_DOB = null;
        } else {
            $profile->child1_DOB = $request->child1_DOB;
        }

        if ($request->child2_DOB == null) {
            $profile->child2_DOB = null;
        } else {
            $profile->child2_DOB = $request->child2_DOB;
        }

        if ($request->child3_DOB == null) {
            $profile->child3_DOB = null;
        } else {
            $profile->child3_DOB = $request->child3_DOB;
        }

        // if ($request->prefered_brand == null) {
        //     $profile->prefered_brand = $request->prefered_brand;
        // } else {
        //     $strPreferedBrand = implode(", ",$request->prefered_brand);
        //     //print_r (explode(", ",$strPreferedBrand));
        //     $profile->prefered_brand = $strPreferedBrand;
        // }

        if ($request->multi_product == null) {
            $profile->multi_product = $request->multi_product;
        } else {
            $strMultiProduct = implode(", ",$request->multi_product);
            $profile->multi_product = $strMultiProduct;
        }

        if ($brand == null) {
            $profile->category_id = null;
        } else {
            $profile->category_id = $brand->category_id;
        }

        if ($request->brand_id_blank == null) {
            $profile->brand_id = null;
        } else {
            $profile->brand_id = $request->brand_id_blank;
        }

        $profile->product = $request->product;
        $profile->activity_campaign_name = 'Inbound';
        $profile->marital_status = $request->marital_status;
        $profile->consumer_dob = $request->consumer_dob;
        $profile->child_name = $request->child_name;
        $profile->save();

        $crm = new Crm;
        $crm->profile_id = $profile->id;
        $crm->phone_number = $profile->phone_number;
        $crm->agent = $profile->agent;

        if ($brand == null) {
            $crm->category_id = null;
        } else {
            $crm->category_id = $brand->category_id;
        }

        if ($request->brand_id_blank == null) {
            $crm->brand_id = null;
        } else {
            $crm->brand_id = $request->brand_id_blank;
        }

        if ($request->multi_product == null) {
            $crm->multi_product = $request->multi_product;
        } else {
            $strMultiProduct = implode(", ",$request->multi_product);
            $crm->multi_product = $strMultiProduct;
        }
        
        $crm->product = $request->product;
        $crm->competition_brand_usage = $request->competition_brand_usage;
        $crm->activity_campaign_name = 'Inbound';
        $crm->source_of_knowing = $request->source_of_knowing;
        $crm->sales_force = $request->sales_force;
        $crm->service_level = $request->service_level;
        $crm->consumer_involvement = $request->consumer_involvement;
        $crm->interested_in_crm = $request->interested_in_crm;
        $crm->call_type = $request->call_type;
        $crm->call_quality = $request->call_quality;
        $crm->contact_qualification = $request->contact_qualification;
        $crm->verbatim = $request->verbatim;
        $crm->quiz_question = $request->quiz_question;
        $crm->quiz_ans_given = $request->quiz_ans_given;
        $crm->quiz_ans_status = $request->quiz_ans_status;
        $crm->lead_id = $request->lead_id;
        $crm->primary_n_id = $request->primary_n_id;
        $crm->secondary_id = $request->secondary_id;
        $crm->tertiary_id = $request->tertiary_id;
        $crm->save();

        flash()->success($profile->phone_number.' Profile & CRM created successfully');
        return redirect()->back();
    }    
}
