<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Models\Profile;
use App\Models\Crm;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;

use Illuminate\Support\Facades\Auth;
//use Redirect;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $role = Auth::user()->role;
        if ($role == 'user') {
            //return Redirect::to('field-user/create');
            return redirect('field-user/create');
        }

        $todayStart = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');
        $userCount = User::count();
        $profileTotalCount = Profile::count();
        $profileTodayCount = Profile::whereBetween('updated_at', [$todayStart, $todayEnd])->count();
        $crmTotalCount = Crm::count();
        $crmTodayCount = Crm::whereBetween('updated_at', [$todayStart, $todayEnd])->count();
        $brandCount = Brand::count();
        $productCount = Product::count();
        $divisionCount = Division::count();
        $districtCount = District::count();
        $policeStationCount = PoliceStation::count();
        $categoryCount = Category::count();

        return view('home', compact('userCount', 'profileTotalCount', 'profileTodayCount', 'crmTotalCount', 'crmTodayCount', 'brandCount', 'productCount', 'divisionCount', 'districtCount', 'policeStationCount', 'categoryCount'));
    }

    public function test()
    {
        return view('test');
    }

    public function test2(Request $request)
    {
        $dateOfBirth = $request->dateOfBirth2;
        return view('test2', compact('dateOfBirth'));
    }

    public function divisionDistrictShow(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->get();
        foreach ($districts as $district) {
            $divWiseDistrictList[$district->id] = $district->name;
        }

        //print_r($divWiseDistrictList);
        return view('police_station.division_district', compact('divWiseDistrictList'));
    }

    public function dashboard()
    {
        $todayStart = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');
        // $userCount = User::count();
        $profileTotalCount = Profile::count();
        // $profileTodayCount = Profile::whereBetween('updated_at', [$todayStart, $todayEnd])->count();
        $maleCount = Profile::where('consumer_gender', 'Male')->count();
        $femaleCount = Profile::where('consumer_gender', 'Female')->count();
        
        $division1BarCount = Profile::where('division_id', 1)->count();
        $division2ChiCount = Profile::where('division_id', 2)->count();
        $division3DhaCount = Profile::where('division_id', 3)->count();
        $division4KhuCount = Profile::where('division_id', 4)->count();
        $division5MymCount = Profile::where('division_id', 5)->count();
        $division6RajCount = Profile::where('division_id', 6)->count();
        $division7RanCount = Profile::where('division_id', 7)->count();
        $division8SylCount = Profile::where('division_id', 8)->count();

        $crmIntCount = Profile::where('interested_in_crm', 'Yes')->count();
        $crmNotIntCount = Profile::where('interested_in_crm', 'No')->count();
        $fnmIntCount = Profile::where('interested_in_fnm', 'Yes')->count();
        $fnmNotIntCount = Profile::where('interested_in_fnm', 'No')->count();

        $childCount = Profile::where('kids_age', '<>', null)->count();

        return view('dashboard', compact('userCount', 'profileTotalCount', 'maleCount', 'femaleCount', 'division1BarCount', 'division2ChiCount', 'division3DhaCount', 'division4KhuCount', 'division5MymCount', 'division6RajCount', 'division7RanCount', 'division8SylCount', 'crmIntCount', 'crmNotIntCount', 'fnmIntCount', 'fnmNotIntCount', 'childCount'));
    }

    public function brandDashboard()
    {
        $brand1Count = Profile::where('brand_id', 1)->count();
        $brand2Count = Profile::where('brand_id', 2)->count();
        $brand3Count = Profile::where('brand_id', 3)->count();
        $brand4Count = Profile::where('brand_id', 4)->count();
        $brand5Count = Profile::where('brand_id', 5)->count();
        $brand6Count = Profile::where('brand_id', 6)->count();
        $brand7Count = Profile::where('brand_id', 7)->count();
        $brand8Count = Profile::where('brand_id', 8)->count();
        $brand9Count = Profile::where('brand_id', 9)->count();
        $brand10Count = Profile::where('brand_id', 10)->count();
        $brand11Count = Profile::where('brand_id', 11)->count();
        $brand12Count = Profile::where('brand_id', 12)->count();
        $brand13Count = Profile::where('brand_id', 13)->count();
        $brand14Count = Profile::where('brand_id', 14)->count();
        $brand15Count = Profile::where('brand_id', 15)->count();
        $brand16Count = Profile::where('brand_id', 16)->count();
        $brand17Count = Profile::where('brand_id', 17)->count();
        $brand18Count = Profile::where('brand_id', 18)->count();
        $brand19Count = Profile::where('brand_id', 19)->count();
        $brand20Count = Profile::where('brand_id', 20)->count();
        $brand21Count = Profile::where('brand_id', 21)->count();
        $brand22Count = Profile::where('brand_id', 22)->count();
        $brand23Count = Profile::where('brand_id', 23)->count();
        $brand24Count = Profile::where('brand_id', 24)->count();
        $brand25Count = Profile::where('brand_id', 25)->count();

        return view('brand_dashboard', compact('brand1Count', 'brand2Count', 'brand3Count', 'brand4Count', 'brand5Count', 'brand6Count', 'brand7Count', 'brand8Count', 'brand9Count', 'brand10Count', 'brand11Count', 'brand12Count', 'brand13Count', 'brand14Count', 'brand15Count', 'brand16Count', 'brand17Count', 'brand18Count', 'brand19Count', 'brand20Count', 'brand21Count', 'brand22Count', 'brand23Count', 'brand24Count', 'brand25Count'));
    }
}
