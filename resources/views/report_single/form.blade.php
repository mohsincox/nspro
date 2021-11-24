@extends('layouts.app')

@section('content')
<div class="container mt-1">
	    <div class="row">
	        <div class="col-sm-10 offset-sm-1">
	            <div class="card">
	                <div class="card-header">Report Download Form</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'report-single-show-excel', 'method' => 'post', 'class' => 'form-horizontal' , 'onsubmit' => 'return validateForm()', 'name' => 'myForm']) !!}
	                    	<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="required form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('start_date', 'Start Date', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::text('start_date', null, ['class' => 'form-control readonly', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date', 'required' => 'required']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('start_date') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="required form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('end_date', 'End Date', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::text('end_date', null, ['class' => 'form-control readonly', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'id' => 'end_date', 'required' => 'required']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('end_date') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('division_id') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('division_id', 'Division', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control', 'placeholder' => 'Select Division', 'id' => 'division_id']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('division_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('district_id', 'District', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									        		
									    	        {!! Form::select('district_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select District', 'id' => 'district_id']) !!}
									    	       
									    	        <span class="text-danger">
									    			    {{ $errors->first('district_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('police_station_id') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('police_station_id', 'Thana', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('police_station_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select Thana', 'id' => 'police_station_id']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('police_station_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('consumer_age') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('consumer_age', 'Consumer Age', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('consumer_age', $consumerAge, null, ['class' => 'form-control', 'placeholder' => 'Select Consumer Age', 'id' => 'consumer_age']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('consumer_age') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('from_year') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('from_year', 'Child From', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="row">
										        	<div class="col-6 col-sm-6">
										    	        {!! Form::select('from_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control','placeholder' => 'Select Year']) !!}
										    	        <span class="text-danger">
										    			    {{ $errors->first('from_year') }}
										    		    </span>
										    		</div>
										    		<div class="col-6 col-sm-6">
										    	        {!! Form::select('from_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control','placeholder' => 'Select Month']) !!}
										    	        <span class="text-danger">
										    			    {{ $errors->first('from_month') }}
										    		    </span>
										    		</div>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('to_year') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('to_year', 'Child To', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="row">
										        	<div class="col-6 col-sm-6">
										    	        {!! Form::select('to_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control','placeholder' => 'Select Year']) !!}
										    	        <span class="text-danger">
										    			    {{ $errors->first('to_year') }}
										    		    </span>
										    		</div>
										    		<div class="col-6 col-sm-6">
										    	        {!! Form::select('to_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control','placeholder' => 'Select Month']) !!}
										    	        <span class="text-danger">
										    			    {{ $errors->first('to_month') }}
										    		    </span>
										    		</div>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('consumer_gender') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('consumer_gender', 'Consumer Gender', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('consumer_gender', $gender, null, ['class' => 'form-control', 'placeholder' => 'Select Consumer Gender', 'id' => 'consumer_gender']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('consumer_gender') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('activity_campaign_name') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('activity_campaign_name', 'Act or Cmp Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('activity_campaign_name', $actOrCmpName, null, ['class' => 'form-control', 'placeholder' => 'Select Activity or Campaign Name', 'id' => 'activity_campaign_name']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('activity_campaign_name') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('brand_id', 'Brand', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('brand_id', $brandList, null, ['class' => 'form-control', 'placeholder' => 'Select Brand', 'id' => 'brand_id']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('brand_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('sec') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('sec', 'SEC', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('sec', $sec, null, ['class' => 'form-control', 'placeholder' => 'Select SEC', 'id' => 'sec']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('sec') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								
							</div>

							<div class="row">
	                    		
								<div class="col-sm-6 offset-sm-3">
			                        <div class="required form-group {{ $errors->has('type') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('type', 'File Type', ['class' => 'col-3 col-sm-3 control-label']) !!}
									        <div class="col-9 col-sm-9">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('type') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

	                        <div class="form-group">
	                            <div class="col-sm-9 offset-sm-2">
	                                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block', 'onclick' => 'return confirm("Do you want to download?");']) !!}
	                            </div>
	                        </div>
	                    {!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>	
@endsection

@section('style')
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
@endsection

@section('script')
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
		$( function() {
			$( "#start_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date" ).datepicker( "setDate", "0" );
        	$( "#end_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date" ).datepicker( "setDate", "0" );
		} );

		$(".readonly").keydown(function(e){
	        e.preventDefault();
	    });
	</script>

	<script>
		function validateForm() {
		    var fromYear = document.forms["myForm"]["from_year"].value;
		    var fromMonth = document.forms["myForm"]["from_month"].value;
		    var toYear = document.forms["myForm"]["to_year"].value;
		    var toMonth = document.forms["myForm"]["to_month"].value;
		    if ( ((fromYear != "") && ((fromMonth == "") || (toYear == "") || (toMonth == "")))   ||   ((fromMonth != "") && ((fromYear == "") || (toYear == "") || (toMonth == "")))  ||   ((toYear != "") && ((fromYear == "") || (fromMonth == "") || (toMonth == "")))  ||   ((toMonth != "") && ((fromYear == "") || (fromMonth == "") || (toYear == ""))) ) {
		        alert("4 field of child age must be filled out");
			    return false;   
		    }
		}
	</script>

	<script>
		var baseUrl = "{{ url('/') }}";

		$(function() {
            $('#division_id').change(function() {
                var divisionId = $(this).val();
                getDistrict(divisionId);
            });

            $('#district_id').change(function() {
                var districtId = $(this).val();
                getPoliceStation(districtId);
            });
        });

        function getDistrict(divisionId) {
            
            resetField('district_id', 'Select District');

            resetField('police_station_id', 'Select Police Station');

            $.get(baseUrl+'/crm-profile/get-district?division_id='+divisionId, function (response) {

                $.map( response, function( name, id ) {
                    $('#district_id').append('<option value="'+ id +'">' + name + '</option>');
                });
                
            });
        }

        function getPoliceStation(districtId) {
            
            resetField('police_station_id', 'Select Police Station');

            $.get(baseUrl+'/crm-profile/get-police-station?district_id='+districtId, function (response) {
                
                $.map( response, function( name, id ) {
                    $('#police_station_id').append('<option value="'+ id +'">' + name + '</option>');
                });

            });
        }

        function resetField(id, placeholder) {
            $('#' + id).empty();
            $('#' + id).append('<option value="">'+ placeholder +'</option>');
        }
	</script>
@endsection