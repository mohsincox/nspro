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

class FnmCrmProfileController extends Controller
{
    public function create(Request $request)
    {

        $phoneNumber = substr($request->phone_number, -10);

        if (strlen($phoneNumber) == 10) {
            $phoneNumber = '0'.$phoneNumber;
        }
        
        $profile = Profile::where('phone_number', $phoneNumber)->first();
        $fnmCrmLast = FnmCrm::where('phone_number', $phoneNumber)->orderBy('id', 'desc')->first();
        $agent = $request->agent;
    	$divisionList = Division::pluck('name', 'id');
    	$districtList = District::orderBy('name', 'asc')->pluck('name', 'id');
    	$policeStationList = PoliceStation::pluck('name', 'id');
        $brandList = Brand::pluck('name', 'id');
        $brandNameList = Brand::pluck('name', 'name');
        $productList = Product::pluck('name', 'id');
        $productNameList = Product::pluck('name', 'name');
        $consumerAgeList  = Option::where('select_id', 1)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
        $genderList  = Option::where('select_id', 2)->where('status', 'Active')->pluck('name', 'name');
        $professionList  = Option::where('select_id', 3)->where('status', 'Active')->pluck('name', 'name');
        $numberList  = Option::where('select_id', 5)->where('status', 'Active')->pluck('name', 'name');
        $interestedInCrmList  = Option::where('select_id', 9)->where('status', 'Active')->pluck('name', 'name');
        
        $callRemarksList  = Option::where('select_id', 20)->where('status', 'Active')->pluck('name', 'name');
        $productUsedList  = Option::where('select_id', 18)->where('status', 'Active')->pluck('name', 'name');
        $interestedInFnmList  = Option::where('select_id', 19)->where('status', 'Active')->pluck('name', 'name');
        
        $fnmCrms = FnmCrm::with(['brand'])->where('phone_number', $phoneNumber)->orderBy('id', 'desc')->limit(5)->get();
        
    	return view('fnm_crm_profile.create', compact('phoneNumber', 'agent', 'divisionList', 'districtList', 'policeStationList', 'brandList', 'brandNameList', 'productList', 'consumerAgeList', 'genderList', 'professionList', 'numberList', 'interestedInCrmList', 'callRemarksList', 'profile', 'fnmCrmLast', 'fnmCrms', 'productUsedList', 'interestedInFnmList', 'productNameList'));
    }

    public function getProduct(Request $request)
    {
        // $products = Product::where('brand_id', $request->brand_id)->pluck('name', 'id');
        // return response()->json($products);
        $products = Product::where('brand_id', $request->brand_id)->get();
        foreach ($products as $product) {
            $brandWiseProductList['Product: '.$product->name.', SKU: '.$product->sku] = $product->name.', '.$product->sku;
        }

        return response()->json($brandWiseProductList);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $phoneNumber = substr($request->phone_number, -10);

        if (strlen($phoneNumber) == 10) {
            $phoneNumber = '0'.$phoneNumber;
        }

        $district = District::find($request->district_id);
        // $brand = Brand::find($request->brand_id);
        $brand = Brand::find($request->brand_id_blank);
       
        $profile = Profile::firstOrNew(array('phone_number' => $phoneNumber));
        $profile->phone_number = $phoneNumber;
        $profile->agent = $request->agent;
        $profile->consumer_name = $request->consumer_name;
        $profile->consumer_age = $request->consumer_age;
        $profile->consumer_gender = $request->consumer_gender;

        // if ($request->division_id == null) {
        //     $profile->division_id = null;
        // } else {
        //     $profile->division_id = $request->division_id;
        // }
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
        
        $profile->profession = $request->profession;
        
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

        if ($request->brand_id == null) {
            $profile->brand_id = null;
        } else {
            $profile->brand_id = $request->brand_id_blank;
        }

        $profile->product = $request->product;
        $profile->child_name = $request->child_name;
        $profile->interested_in_fnm = $request->interested_in_fnm;
        $profile->interested_in_crm = $request->interested_in_crm;
        $profile->save();


        $crm = new FnmCrm;
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
        $crm->product_used = $request->product_used;
        
        $crm->edu_qualification = $request->edu_qualification;
        $crm->interested_in_fnm = $request->interested_in_fnm;
        $crm->interested_in_crm = $request->interested_in_crm;
        $crm->call_remarks = $request->call_remarks;
        $crm->verbatim = $request->verbatim;
        $crm->lead_id = $request->lead_id;
        $crm->save();

        flash()->success($profile->phone_number.' Profile & FNM CRM created successfully');
        return redirect()->back();
    }
}
