@extends('layouts.app')

@section('content')
<div class="container mt-1">
	    <div class="row">
	        <div class="col-sm-12 offset-sm-0">
	            <div class="card text-white bg-info">
	                <div class="card-header">
	                	<div class="float-left">
	                		Profile Report Download Form
	                	</div>
	                	<div class="float-right">
	                		{!! Form::open(['url' => 'search-phone-number', 'method' => 'post', 'class' => 'form-horizontal']) !!}
	                		<div class="{{ $errors->has('phone_number') ? 'has-error' : ''}}">
			                	<div class="input-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
								  	{!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'autocomplete' => 'off']) !!}
								  	<div class="input-group-append">
								    	{!! Form::submit('Search', ['class' => 'btn btn-danger']) !!}
								  	</div>
								</div>
								<div class="text-danger">
							  		<!-- dghfhgfjhwww -->
    			    				{{ $errors->first('phone_number') }}
    		    				</div>
							</div>
							{!! Form::close() !!}
						</div>
	            	</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'all-report-tab-xls-show', 'method' => 'get', 'class' => 'form-horizontal' , 'onsubmit' => 'return validateForm()', 'name' => 'myForm']) !!}
	                    	<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('start_date', 'Start Date', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::text('start_date', null, ['class' => 'form-control readonly', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('start_date') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('end_date', 'End Date', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::text('end_date', null, ['class' => 'form-control readonly', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'id' => 'end_date']) !!}
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
									        {!! Form::label('division_id', 'Division', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('division_id[]', $divisionList, null, ['class' => 'form-control js-example-basic-multiple', 'id' => 'division_id', 'multiple' => 'multiple']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('division_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<!-- <div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('district_id', 'District', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('district_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select District', 'id' => 'district_id']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('district_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div> -->
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('consumer_gender') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('consumer_gender', 'Consumer Gender', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
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
							</div>

							<!-- <div class="row"> -->

	                    		<!-- <div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('police_station_id') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('police_station_id', 'Thana', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('police_station_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select Thana', 'id' => 'police_station_id']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('police_station_id') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div> -->
								
							<!-- </div> -->

							<div class="row">
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('consumer_age') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('consumer_age', 'Consumer Age', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
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
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('marital_status') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('marital_status', 'Marital Status', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('marital_status', $maritalStatusList, null, ['class' => 'form-control', 'placeholder' => 'Select Profession', 'id' => 'marital_status']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('marital_status') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('profession') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('profession', 'Profession', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('profession', $professionList, null, ['class' => 'form-control', 'placeholder' => 'Select Profession', 'id' => 'profession']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('profession') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('activity_campaign_name') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('activity_campaign_name', 'Act or Cmp Name', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
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
									        {!! Form::label('brand_id', 'Brand', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
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
									        {!! Form::label('sec', 'SEC', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
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
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('interested_in_crm') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('interested_in_crm', 'Interested In CRM', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('interested_in_crm', $interestedInCrm, null, ['class' => 'form-control', 'placeholder' => 'Select Interested In CRM', 'id' => 'interested_in_crm']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('interested_in_crm') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('interested_in_fnm') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('interested_in_fnm', 'Interested In Fnm', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('interested_in_fnm', $interestedInFnm, null, ['class' => 'form-control', 'placeholder' => 'Select Interested In Fnm', 'id' => 'interested_in_fnm']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('interested_in_fnm') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>
<!-- <hr style="margin-top: 0px;"> -->
							<!-- <div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('from_year') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('from_year', 'Child Year Start', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('from_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control','placeholder' => 'Select Start Year']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('from_year') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('from_month') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('from_month', 'Child Month Start', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
									        	<div class="col-12 col-sm-12">
									    	        {!! Form::select('from_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control','placeholder' => 'Select Start Month']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('from_month') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div>

							<div class="row">
	                    		<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('to_year') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('to_year', 'Child Year End', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">
								        		<div class="col-12 col-sm-12">
									    	        {!! Form::select('to_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control','placeholder' => 'Select End Year']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('to_year') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="col-sm-6">
			                        <div class="form-group {{ $errors->has('to_month') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('to_month', 'Child Month End', ['class' => 'col-5 col-sm-5 control-label font-weight-bold']) !!}
									        <div class="col-7 col-sm-7">	
									    		<div class="col-12 col-sm-12">
									    	        {!! Form::select('to_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control','placeholder' => 'Select End Month']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('to_month') }}
									    		    </span>
									    		</div>
									        </div>
									    </div>
									</div>
								</div>
							</div> -->

							{{--<div class="row">
	                    		
								<div class="col-sm-7 offset-sm-3">
			                        <div class="required form-group {{ $errors->has('type') ? 'has-error' : ''}}">
									    <div class="row"> 
									        {!! Form::label('type', 'File Type (xlsx, csv, xls)', ['class' => 'col-4 col-sm-4 control-label font-weight-bold']) !!}
									        <div class="col-6 col-sm-6">
									        	<!-- <div class="col-12 col-sm-12"> -->
									    	        {!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required']) !!}
									    	        <span class="text-danger">
									    			    {{ $errors->first('type') }}
									    		    </span>
									    		<!-- </div> -->
									        </div>
									    </div>
									</div>
								</div>
							</div>--}}

	                        <div class="form-group">
	                            <div class="col-sm-10 offset-sm-1">
	                                {!! Form::submit('Submit', ['class' => 'btn btn-dark btn-block']) !!}
	                            </div>
	                        </div>
	                    {!! Form::close() !!}
	                    
	                    <!-- <p class="text-center" style="font-size: 18px;"><b>Do Not Download More Then 30,000 Data At A Time</b></p>
	                    <p class="text-center" style="font-size: 18px; color: yellow;"><b>Do Not Select More then 4 Combination including Date Range, File type & Division</b></p>
	                    <p class="text-center" style="font-size: 18px;"><b>Please Select 4 Fields of Child Age Range (if need child age range data)</b></p> -->
	                </div>
	            </div>
	        </div>
	    </div>
	</div>	
@endsection

@section('style')
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<style type="text/css">
		.select2-selection__choice {
			color: #101010;
		}

		.blink_me {
		  animation: blinker 1s linear infinite;
		}

		@keyframes blinker {
		  50% {
		    opacity: 0;
		  }
		}

		/*hr {
		    margin-top: 0px;
		    margin-bottom: 0px;
		}*/
	</style>
@endsection

@section('script')
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script>
		$( function() {
			$( "#start_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date" ).datepicker( );
        	$( "#end_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date" ).datepicker(  );
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

        $(document).ready(function() {
    		// $('.js-example-basic-multiple').select2();
    		$(".js-example-basic-multiple").select2({
			    placeholder: "All Divisions"
			});
		});
	</script>
@endsection