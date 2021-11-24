@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> Form of <code><b>All Reports</b></code> at a glance</h3>
	            </div>
	            <div class="card-body">
	            	<!-- CRM and Profile Report Download Form -->
	            	<div class="row">
		            	<div class="col-sm-12 border border-primary mb-1">
			            	<h5 class="text-center"><span class="bg-primary">Date Wise CRM Report With Profile Information</span></h5>
			            	{!! Form::open(['url' => 'crm-profile/crm-report-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		    					{!! Form::label('start_date', 'Start Date:', ['class' => 'mb-2 mr-sm-2']) !!}
		    					{!! Form::text('start_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'id' => 'start_date', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'readonly' => 'readonly', 'required' => 'required']) !!}

		    					{!! Form::label('end_date', 'End Date:', ['class' => 'mb-2 mr-sm-2 control-label']) !!}
		    					{!! Form::text('end_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'id' => 'end_date', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'readonly' => 'readonly', 'required' => 'required']) !!}

		    					{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}
		    					    
		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-primary mb-2']) !!}

		  					{!! Form::close() !!}
	  					</div>
  					</div>

  					<!-- Child Age Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-secondary mb-1">
		  					<h5 class="text-center"><span class="bg-secondary">Child Age Wise</span></h5>
		  					{!! Form::open(['url' => 'profile-report/child-age-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('from_year', 'From', ['class' => 'control-label mb-2 mr-sm-2']) !!}
		  						{!! Form::select('from_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Year', 'required' => 'required']) !!}

		  						{!! Form::select('from_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Month', 'required' => 'required']) !!}

		  						{!! Form::label('to_year', 'To', ['class' => 'control-label mb-2 mr-sm-2']) !!}
		  						{!! Form::select('to_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Year', 'required' => 'required']) !!}

		  						{!! Form::select('to_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Month', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}

		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-secondary mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- Child Age Date Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-info mb-1">
		  					<h5 class="text-center"><span class="bg-info">Child Age and Date Wise</span></h5>
		  					{!! Form::open(['url' => 'profile-report/child-age-and-date-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('start_date', 'Start Date:', ['class' => 'mb-2 mr-sm-2']) !!}
		    					{!! Form::text('start_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'id' => 'start_date_age', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'readonly' => 'readonly', 'required' => 'required']) !!}

		    					{!! Form::label('end_date', 'End Date:', ['class' => 'mb-2 mr-sm-2 control-label']) !!}
		    					{!! Form::text('end_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'id' => 'end_date_age', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'readonly' => 'readonly', 'required' => 'required']) !!}

		  						{!! Form::label('from_year', 'From', ['class' => 'control-label mb-2 mr-sm-2']) !!}
		  						{!! Form::select('from_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Year', 'required' => 'required']) !!}

		  						{!! Form::select('from_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Month', 'required' => 'required']) !!}

		  						{!! Form::label('to_year', 'To', ['class' => 'control-label mb-2 mr-sm-2']) !!}
		  						{!! Form::select('to_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Year', 'required' => 'required']) !!}

		  						{!! Form::select('to_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control mb-2 mr-sm-2','placeholder' => 'Select Month', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}

		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-info mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- Division Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-success mb-1">
		  					<h5 class="text-center"><span class="bg-success">Division Wise</span></h5>
		  					{!! Form::open(['url' => 'profile-report/division-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('division_id', 'Select Division', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('division_id', $divisionList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Division', 'id' => 'division_id_no_need', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}

		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-success mb-2']) !!}

		  						<a href="{{ url('/profile-report/division-all-download-excel') }}" class="btn btn-outline-success mb-2 ml-sm-2" role="button">All Division Download</a>

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- Division and Date Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-success mb-1">
		  					<h5 class="text-center"><span class="bg-success">Division and Date Wise</span></h5>
		  					{!! Form::open(['url' => 'profile-report/division-and-date-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('start_date', 'Start Date:', ['class' => 'mb-2 mr-sm-2']) !!}
		    					{!! Form::text('start_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'id' => 'start_date_division', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'readonly' => 'readonly', 'required' => 'required']) !!}

		    					{!! Form::label('end_date', 'End Date:', ['class' => 'mb-2 mr-sm-2 control-label']) !!}
		    					{!! Form::text('end_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'id' => 'end_date_division', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'readonly' => 'readonly', 'required' => 'required']) !!}

		  						{!! Form::label('division_id', 'Select Division', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('division_id', $divisionList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Division', 'id' => 'division_id_no_need', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}

		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-success mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- District Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-danger mb-1">
		  					<h5 class="text-center"><span class="bg-danger">District Wise</span></h5>
		  					{!! Form::open(['url' => 'profile-report/district-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('division_id', 'Select Division', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('division_id', $divisionList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Division', 'id' => 'division_id', 'required' => 'required']) !!}

		  						{!! Form::label('district_id', 'Select District', ['class' => 'control-label mb-2 mr-sm-2']) !!}
		  						<span id="division_district_show">
		  						{!! Form::select('district_id', [], null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select District', 'id' => 'district_id_no_need', 'required' => 'required']) !!}
		  						</span>
		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}

		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-danger mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- PS Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-warning mb-1">
		  					<h5 class="text-center"><span class="bg-warning">Police Station Wise</span></h5>
		  					{!! Form::open(['url' => 'profile-report/ps-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('district_id', 'Select District', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('district_id', $districtList, null, ['class' => 'form-control mb-2 mr-sm-2 js-example-basic-single', 'placeholder' => 'Select District', 'id' => 'district_id', 'required' => 'required']) !!}

		  						{!! Form::label('police_station_id', 'Select Police Station', ['class' => 'control-label mb-2 mr-sm-2']) !!}
		  						<span id="district_ps_show">
		  						{!! Form::select('police_station_id', [], null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Police Station', 'id' => 'police_station_id', 'required' => 'required']) !!}
		  						</span>
		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}
		    					    
		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-warning mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- Brand Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-info mb-1">
		  					<h5 class="text-center"><span class="bg-info">Brand Wise</span></h5>
		  					{!! Form::open(['url' => 'crm-profile/brand-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('brand_id', 'Select Brand', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('brand_id', $brandList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Brand', 'id' => 'brand_id', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}
		    					    
		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-info mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- Brand Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-success mb-1">
		  					<h5 class="text-center"><span class="bg-success">Brand Wise with Date Range</span></h5>
		  					{!! Form::open(['url' => 'crm-profile/brand-and-date-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('start_date', 'Start Date:', ['class' => 'mb-2 mr-sm-2']) !!}
		    					{!! Form::text('start_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date_brand', 'readonly' => 'readonly', 'required' => 'required']) !!}

		    					{!! Form::label('end_date', 'End Date:', ['class' => 'mb-2 mr-sm-2 control-label']) !!}
		    					{!! Form::text('end_date', null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'id' => 'end_date_brand', 'readonly' => 'readonly', 'required' => 'required']) !!}

		  						{!! Form::label('brand_id', 'Select Brand', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('brand_id', $brandList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Brand', 'id' => 'brand_id', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}
		    					    
		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-success mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>

  					<!-- Brand and Division Wise Report Download Form -->
  					<div class="row">
  						<div class="col-sm-12 border border-dark mb-1">
		  					<h5 class="text-center text-white"><span class="bg-dark">Brand and Division Wise</span></h5>
		  					{!! Form::open(['url' => 'crm-profile/brand-and-div-wise-show-excel', 'method' => 'post', 'class' => 'form-inline justify-content-center']) !!}

		  						{!! Form::label('brand_id', 'Select Brand', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('brand_id', $brandList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Brand', 'id' => 'brand_id', 'required' => 'required']) !!}

		  						{!! Form::label('division_id', 'Select Division', ['class' => 'control-label mb-2 mr-sm-2']) !!}

		  						{!! Form::select('division_id', $divisionList, null, ['class' => 'form-control mb-2 mr-sm-2', 'placeholder' => 'Select Division', 'id' => 'division_id', 'required' => 'required']) !!}

		  						{!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required', 'hidden' => 'hidden']) !!}
		    					    
		  						{!! Form::submit('Download', ['class' => 'btn btn-outline-dark mb-2']) !!}

		  					{!! Form::close() !!}
  						</div>
  					</div>
  					<!-- <form class="form-inline" role="form">
    					<label for="email2" class="mb-2 mr-sm-2">Email:</label>
    					<input type="text" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter email">
    					<label for="pwd2" class="mb-2 mr-sm-2">Password:</label>
    					<input type="text" class="form-control mb-2 mr-sm-2" id="pwd2" placeholder="Enter password">  
  						<button type="button" class="btn btn-primary mb-2">Submit</button>
  					</form> -->
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection

@section('style')
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
		$( function() {
        	$( "#start_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date" ).datepicker( "setDate", "0" );
        	$( "#end_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date" ).datepicker( "setDate", "0" );

        	$( "#start_date_age" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date_age" ).datepicker( "setDate", "0" );
        	$( "#end_date_age" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date_age" ).datepicker( "setDate", "0" );

        	$( "#start_date_division" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date_division" ).datepicker( "setDate", "0" );
        	$( "#end_date_division" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date_division" ).datepicker( "setDate", "0" );

        	$( "#start_date_brand" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date_brand" ).datepicker( "setDate", "0" );
        	$( "#end_date_brand" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date_brand" ).datepicker( "setDate", "0" );
		} );
	 </script>
	 <script type="text/javascript">
		$(document).ready(function(){
		    $("#division_id").change(function(){
		        var divisionId = $("#division_id").val();
		        var url = '{{ url("/profile-report/division-district-show")}}';
		        $.get(url+'?division_id='+divisionId, function (data) {
	            	$('#division_district_show').html(data);
	        	});
		    });
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $("#district_id").change(function(){
		        var districtId = $("#district_id").val();
		        var url = '{{ url("/profile-report/district-ps-show")}}';
		        $.get(url+'?district_id='+districtId, function (data) {
	            	$('#district_ps_show').html(data);
	        	});
		    });
		});

		$(document).ready(function() {
		    $('.js-example-basic-single').select2();
		});
	</script>
@endsection