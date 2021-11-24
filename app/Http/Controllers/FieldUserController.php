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
use App\Models\FieldCrm;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;

class FieldUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $crms = FieldCrm::with(['profile', 'profile.division', 'profile.district', 'profile.policeStation', 'brand'])->where('created_by', Auth::id())->orderBy('id', 'desc')->get();
        return view('field_user.index', compact('crms'));
    }

    public function create(Request $request)
    {
        // $phoneNumber=preg_replace('/\D/', '',  $request->phone_number);
        // if(substr($phoneNumber, 0, 1) == "+" ) $phoneNumber=substr($phoneNumber, 1);
        // if(substr($phoneNumber, 0, 2) == "88") $phoneNumber=substr($phoneNumber, 2);
        
        
        //$profile = Profile::where('phone_number', $phoneNumber)->first();
        //$crmLast = Crm::where('phone_number', $phoneNumber)->orderBy('id', 'desc')->first();
        $agent = $request->agent;
        $divisionList = Division::pluck('name', 'id');
        $districtList = District::pluck('name', 'id');
        $policeStationList = PoliceStation::pluck('name', 'id');
        //$brandList = Brand::pluck('name', 'id');
        $brandNameList = Brand::pluck('name', 'name');
        //$productList = Product::pluck('name', 'id');
        $consumerAgeList  = Option::where('select_id', 1)->where('status', 'Active')->pluck('name', 'name');
        $genderList  = Option::where('select_id', 2)->where('status', 'Active')->pluck('name', 'name');
        $professionList  = Option::where('select_id', 3)->where('status', 'Active')->pluck('name', 'name');
        $secList  = Option::where('select_id', 4)->where('status', 'Active')->pluck('name', 'name');
        $numberList  = Option::where('select_id', 5)->where('status', 'Active')->pluck('name', 'name');
        $actOrCampList  = Option::where('select_id', 12)->where('status', 'Active')->pluck('name', 'name');
        $productSoldList  = Option::where('select_id', 14)->where('status', 'Active')->pluck('name', 'name');
        $supVisitedList  = Option::where('select_id', 15)->where('status', 'Active')->pluck('name', 'name');
        $perContactList  = Option::where('select_id', 16)->where('status', 'Active')->pluck('name', 'name');
        
        return view('field_user.create', compact('phoneNumber', 'agent', 'divisionList', 'districtList', 'policeStationList', 'brandNameList', 'consumerAgeList', 'genderList', 'professionList', 'secList', 'numberList', 'actOrCampList', 'productSoldList', 'supVisitedList', 'perContactList'));
    }

    public function getYMD(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth;
        $interval = date_diff(date_create(), date_create($dateOfBirth));
        return $interval->format("%yy, %mm, %dd");
        //return view('crm_profile.get_ymd', compact('dateOfBirth'));
    }

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
            $brandWiseProductList['Product: '.$product->name.', SKU:'.$product->sku] = $product->name.', '.$product->sku;
        }
        return view('crm_profile.brand_product', compact('brandWiseProductList'));
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $rules = [
            'phone_number' => 'required|numeric|digits_between:11,11'
        ];
        $messages = [];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //return $request->all();
        $phoneNumber=preg_replace('/\D/', '',  $request->phone_number);          
        if(substr($phoneNumber, 0, 1) == "+" ) $phoneNumber=substr($phoneNumber, 1);       
        if(substr($phoneNumber, 0, 2) == "88") $phoneNumber=substr($phoneNumber, 2);
       
        $profile = Profile::firstOrNew(array('phone_number' => $phoneNumber));
        $profile->phone_number = $phoneNumber;
        $profile->agent = $request->agent;
        $profile->consumer_name = $request->consumer_name;
        $profile->consumer_age = $request->consumer_age;
        $profile->consumer_gender = $request->consumer_gender;
        $profile->division_id = $request->division_id;
        $profile->district_id = $request->district_id;
        $profile->police_station_id = $request->police_station_id;
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
        if ($request->prefered_brand == null) {
            $profile->prefered_brand = $request->prefered_brand;
        } else {
            $strPreferedBrand = implode(", ",$request->prefered_brand);
            //print_r (explode(", ",$strPreferedBrand));
            $profile->prefered_brand = $strPreferedBrand;
        }
        $profile->activity_campaign_name = $request->activity_campaign_name;
        $profile->created_by = Auth::id();
        $profile->save();

        $crm = new FieldCrm;
        $crm->profile_id = $profile->id;
        $crm->phone_number = $profile->phone_number;
        //$crm->brand_id = $request->brand_id;
        //$crm->product = $request->product;
        $crm->competition_brand_usage = $request->competition_brand_usage;
        $crm->activity_campaign_name = $request->activity_campaign_name;
        $crm->supervisor_name = $request->supervisor_name;
        $crm->husband_name = $request->husband_name;
        $crm->product_sold = $request->product_sold;
        $crm->supervisor_visited = $request->supervisor_visited;
        $crm->permission_contact = $request->permission_contact;
        // $crm->source_of_knowing = $request->source_of_knowing;
        // $crm->ccid = $request->ccid;
        // $crm->sales_force = $request->sales_force;
        // $crm->consumer_satisfaction_index = $request->consumer_satisfaction_index;
        // $crm->interested_in_crm = $request->interested_in_crm;
        // $crm->reasons_of_call = $request->reasons_of_call;
        // $crm->call_category = $request->call_category;
        // $crm->verbatim = $request->verbatim;
        $crm->created_by = Auth::id();
        $crm->save();

        flash()->success($profile->phone_number.' Profile & CRM created successfully');
        return redirect()->back();
    }
}
