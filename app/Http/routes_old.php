<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/test', 'HomeController@test');
Route::get('/test2', 'HomeController@test2');

Route::get('/user', 'UserController@index');

Route::get('/division', 'DivisionController@index');

Route::get('/district', 'DistrictController@index');

Route::get('/testing', 'PoliceStationController@testing');
Route::get('/division-district-show', 'PoliceStationController@divisionDistrictShow');

Route::get('/police-station', 'PoliceStationController@index');

Route::get('/brand', 'BrandController@index');

Route::get('/product', 'ProductController@index');

Route::get('/select', 'SelectController@index');

Route::get('/option', 'OptionController@index');

Route::get('/crm-profile/division-district-show', 'CrmProfileController@divisionDistrictShow');
Route::get('/crm-profile/district-ps-show', 'CrmProfileController@districtPsShow');
Route::get('/crm-profile/get-ymd', 'CrmProfileController@getYMD');
Route::get('/crm-profile/brand-product-show', 'CrmProfileController@brandProductShow');
Route::get('/crm-profile/create', 'CrmProfileController@create');
Route::post('/crm-profile', 'CrmProfileController@store');

Route::get('/field-user/division-district-show', 'FieldUserController@divisionDistrictShow');
Route::get('/field-user/district-ps-show', 'FieldUserController@districtPsShow');
Route::get('/field-user/get-ymd', 'FieldUserController@getYMD');
Route::get('/field-user/brand-product-show', 'FieldUserController@brandProductShow');
Route::get('/field-user', 'FieldUserController@index');
Route::get('/field-user/create', 'FieldUserController@create');
Route::post('/field-user', 'FieldUserController@store');

Route::group([ 'middleware' => 'can:admin-access'], function () {
	Route::get('/user/{id}/edit', 'UserController@edit');
	Route::put('/user/{id}', 'UserController@update');

	Route::get('/division/create', 'DivisionController@create');
	Route::post('/division', 'DivisionController@store');
	Route::get('/division/{id}/edit', 'DivisionController@edit');
	Route::put('/division/{id}', 'DivisionController@update');

	Route::get('/district/create', 'DistrictController@create');
	Route::post('/district', 'DistrictController@store');
	Route::get('/district/{id}/edit', 'DistrictController@edit');
	Route::put('/district/{id}', 'DistrictController@update');

	Route::get('/police-station/create', 'PoliceStationController@create');
	Route::post('/police-station', 'PoliceStationController@store');
	Route::get('/police-station/{id}/edit', 'PoliceStationController@edit');
	Route::put('/police-station/{id}', 'PoliceStationController@update');

	Route::get('/brand/create', 'BrandController@create');
	Route::post('/brand', 'BrandController@store');
	Route::get('/brand/{id}/edit', 'BrandController@edit');
	Route::put('/brand/{id}', 'BrandController@update');

	Route::get('/product/create', 'ProductController@create');
	Route::post('/product', 'ProductController@store');
	Route::get('/product/{id}/edit', 'ProductController@edit');
	Route::put('/product/{id}', 'ProductController@update');

	Route::get('/select/create', 'SelectController@create');
	Route::post('/select', 'SelectController@store');
	Route::get('/select/{id}/edit', 'SelectController@edit');
	Route::put('/select/{id}', 'SelectController@update');

	Route::get('/option/create', 'OptionController@create');
	Route::post('/option', 'OptionController@store');
	Route::get('/option/{id}/edit', 'OptionController@edit');
	Route::put('/option/{id}', 'OptionController@update');


	Route::get('/all-report-form-excel', 'CrmProfileReportController@allReportFormExcel');

	Route::get('/report-single-form-excel', 'ReportSingleController@reportSingleFormExcel');
	Route::post('/report-single-show-excel', 'ReportSingleController@reportSingleShowExcel');

	Route::get('/crm-profile/crm-report-form', 'CrmProfileReportController@crmReportForm');
	Route::post('/crm-profile/crm-report-show', 'CrmProfileReportController@crmReportShow');
	Route::get('/crm-profile/crm-report-form-excel', 'CrmProfileReportController@crmReportFormExcel');
	Route::post('/crm-profile/crm-report-show-excel', 'CrmProfileReportController@crmReportShowExcel');

	Route::get('/crm-profile/brand-wise-form', 'CrmProfileReportController@brandWiseForm');
	Route::post('/crm-profile/brand-wise-show', 'CrmProfileReportController@brandWiseShow');
	Route::get('/crm-profile/brand-wise-form-excel', 'CrmProfileReportController@brandWiseFormExcel');
	Route::post('/crm-profile/brand-wise-show-excel', 'CrmProfileReportController@brandWiseShowExcel');

	Route::get('/crm-profile/brand-and-div-wise-form', 'CrmProfileReportController@brandAndDivWiseForm');
	Route::post('/crm-profile/brand-and-div-wise-show', 'CrmProfileReportController@brandAndDivWiseShow');
	Route::get('/crm-profile/brand-and-div-wise-form-excel', 'CrmProfileReportController@brandAndDivWiseFormExcel');
	Route::post('/crm-profile/brand-and-div-wise-show-excel', 'CrmProfileReportController@brandAndDivWiseShowExcel');
	Route::post('/crm-profile/brand-and-date-wise-show-excel', 'CrmProfileReportController@brandAndDateWiseShowExcel');

	Route::get('/profile-report/child-age-form-old', 'ProfileReportController@childAgeFormOld');
	Route::post('/profile-report/child-age-show-old', 'ProfileReportController@childAgeShowOld');
	Route::get('/profile-report/get-ymd', 'ProfileReportController@getYMD');

	Route::get('/profile-report/child-age-form', 'ProfileReportController@childAgeForm');
	Route::post('/profile-report/child-age-show', 'ProfileReportController@childAgeShow');
	Route::get('/profile-report/child-age-form-excel', 'ProfileReportController@childAgeFormExcel');
	Route::post('/profile-report/child-age-show-excel', 'ProfileReportController@childAgeShowExcel');
	Route::post('/profile-report/child-age-and-date-wise-show-excel', 'ProfileReportController@childAgeAndDateWiseShowExcel');

	Route::get('/profile-report/division-all-show', 'ProfileReportController@divisionAllShow');
	Route::get('/profile-report/division-all-download-excel', 'ProfileReportController@divisionAllDownloadExcel');
	Route::get('/profile-report/division-wise-form', 'ProfileReportController@divisionWiseForm');
	Route::post('/profile-report/division-wise-show', 'ProfileReportController@divisionWiseShow');
	Route::get('/profile-report/division-wise-form-excel', 'ProfileReportController@divisionWiseFormExcel');
	Route::post('/profile-report/division-wise-show-excel', 'ProfileReportController@divisionWiseShowExcel');
	Route::post('/profile-report/division-and-date-wise-show-excel', 'ProfileReportController@divisionAndDateWiseShowExcel');

	Route::get('/profile-report/district-wise-form', 'ProfileReportController@districtWiseForm');
	Route::get('/profile-report/division-district-show', 'ProfileReportController@divisionDistrictShow');
	Route::post('/profile-report/district-wise-show', 'ProfileReportController@districtWiseShow');
	Route::get('/profile-report/district-wise-form-excel', 'ProfileReportController@districtWiseFormExcel');
	Route::post('/profile-report/district-wise-show-excel', 'ProfileReportController@districtWiseShowExcel');

	Route::get('/profile-report/ps-wise-form', 'ProfileReportController@psWiseForm');
	Route::get('/profile-report/district-ps-show', 'ProfileReportController@districtPsShow');
	Route::post('/profile-report/ps-wise-show', 'ProfileReportController@psWiseShow');
	Route::get('/profile-report/ps-wise-form-excel', 'ProfileReportController@psWiseFormExcel');
	Route::post('/profile-report/ps-wise-show-excel', 'ProfileReportController@psWiseShowExcel');

});