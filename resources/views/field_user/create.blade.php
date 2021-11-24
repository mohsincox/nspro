@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="col-sm-8 offset-sm-2">
        @include('flash::message')
    </div>
    <div class="row">
        <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
            <div class="card bg-dark text-white">
                <div class="card-header" style="padding: 0px;">
                	<img src="{{URL::asset('/assets/image/nestle.png')}}" alt="profile Pic" height="87" width="300" >
                    <span class="float-right" style="padding: 22px; font-size: 22px;">Nestle Field User CRM <small><mark>Create Form</mark></small></span>
                </div>

                <div class="card-body" style="padding: 5px;">
                    {!! Form::open(['url' => 'field-user', 'method' => 'post']) !!}
                
                    	<div class="row">
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Consumer's Phone No. <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Consumer Phone Number (11 digits)', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <span class="text-danger">
                                {{ $errors->first('phone_number') }}
                            </span>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Field User Name <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::text('', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Enter Consumer Name', 'autocomplete' => 'off', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Consumer's Name</span>
                                    </div>
                                    {!! Form::text('consumer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Consumer Name', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Consumer's Age <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('consumer_age', $consumerAgeList, null, ['class' => 'form-control','placeholder' => 'Select Consumer Age', 'id' => 'consumer_age', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Consumer's Gender <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('consumer_gender', $genderList, null, ['class' => 'form-control','placeholder' => 'Select Consumer Gender', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Division <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control','placeholder' => 'Select Division', 'id' => 'division', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">District <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    	{!! Form::select('district_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select District Name', 'id' => 'district', 'required' => 'required']) !!}
                                    <span id="division_district_show"></span>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Thana <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    	{!! Form::select('police_station_id', [], null, ['class' => 'form-control','placeholder' => 'Select Thana', 'id' => 'police_station', 'required' => 'required']) !!}
                                    <span id="district_ps_show"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Address</span>
                                    </div>
                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Alternative Phone</span>
                                    </div>
                                    {!! Form::text('alternative_phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Alternative Phone', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Profession</span>
                                    </div>
                                    {!! Form::select('profession', $professionList, null, ['class' => 'form-control','placeholder' => 'Select Profession']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">SEC <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('sec', $secList, null, ['class' => 'form-control','placeholder' => 'Select SEC', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Number of Child <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('number_of_child', $numberList, null, ['class' => 'form-control','placeholder' => 'Select Child No.', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Family Members <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('total_family_member', $numberList, null, ['class' => 'form-control','placeholder' => 'Total Members', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <?php
                        	if (isset($profile)) {
                        		$child1DOB = $profile->child1_DOB;
                        		$child2DOB = $profile->child2_DOB;
                        		$child3DOB = $profile->child3_DOB;
                        	} else {
                        		$child1DOB = null;
                        		$child2DOB = null;
                        		$child3DOB = null;
                        	}
                        ?>
                        <span id="child1_DOB_from_db" style="display: none;">{{ $child1DOB }}</span>
                        <span id="child2_DOB_from_db" style="display: none;">{{ $child2DOB }}</span>
                        <span id="child3_DOB_from_db" style="display: none;">{{ $child3DOB }}</span>

                        <div class="row">
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Child1 DOB</span>
                                    </div>
                                    {!! Form::text('child1_DOB', null, ['class' => 'form-control',  'placeholder' => 'Select Child2 Date of Birth', 'autocomplete' => 'off', 'id' => 'child1_DOB', 'readonly' => 'readonly']) !!}
                                    <span id="child1_DOB_show"></span>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Child2 DOB</span>
                                    </div>
                                    {!! Form::text('child2_DOB', null, ['class' => 'form-control', 'placeholder' => 'Select Child2 Date of Birth', 'autocomplete' => 'off', 'id' => 'child2_DOB', 'readonly' => 'readonly']) !!}
                                    <span id="child2_DOB_show"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Child3 DOB</span>
                                    </div>
                                    {!! Form::text('child3_DOB', null, ['class' => 'form-control', 'placeholder' => 'Select Child3 Date of Birth', 'autocomplete' => 'off', 'id' => 'child3_DOB', 'readonly' => 'readonly']) !!}
                                    <span id="child3_DOB_show"></span>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Prefered Brand <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    @if(isset($profile))
	                                    <?php
	                            			$arrPreferedBrand = (explode(", ",$profile->prefered_brand));
	                            		?>
	                                    {!! Form::select('prefered_brand[]', $brandNameList, $arrPreferedBrand, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple', 'required' => 'required']) !!}
                                    @else
	                                    {!! Form::select('prefered_brand[]', $brandNameList, null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple', 'required' => 'required']) !!}
	                                @endif
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            
                            
                        </div>
 -->
                        <div class="row">
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Comp.Brand Usage</span>
                                    </div>
	                                {!! Form::text('competition_brand_usage', null, ['class' => 'form-control', 'placeholder' => 'Competition Brand Usage', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Acti./Camp.Name <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
	                                {!! Form::select('activity_campaign_name', $actOrCampList, null, ['class' => 'form-control', 'placeholder' => 'Select Acti./Camp.Name', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Supervisor Name</span>
                                    </div>
                                    {!! Form::text('supervisor_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Supervisor Name', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Husband Name</span>
                                    </div>
                                    {!! Form::text('husband_name', null, ['class' => 'form-control', 'placeholder' => 'Husband Name', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Product Sold <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('product_sold', $productSoldList, null, ['class' => 'form-control', 'placeholder' => 'Select Product Sold', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Sup. visited <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('supervisor_visited', $supVisitedList, null, ['class' => 'form-control', 'placeholder' => 'Select Supervisor visited', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Permission Contact <span style="color: red;"> &nbsp; * </span></span>
                                    </div>
                                    {!! Form::select('permission_contact', $perContactList, null, ['class' => 'form-control', 'placeholder' => 'Select Further Contact', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
						    <div class="row">
						    	<div class="col-sm-12">
						        {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block text-white', 'data-toggle' => 'modal', 'data-target' => '#myModal']) !!}
						        </div>
						    </div>
						</div>

							<div class="modal fade" id="myModal">
							<div class="modal-dialog">
  								<div class="modal-content">
							        <div class="modal-header bg-success">
							          	<h4 class="modal-title">Confirmation Message</h4>
							          	<button type="button" class="close" data-dismiss="modal">&times;</button>
							        </div>
							        <div class="modal-body bg-secondary">
							         	<h3 class="text-center">Want to <b>save CRM</b>?</h3>
							        </div>        
							        <div class="modal-footer bg-dark">
							          	{!! Form::submit('YES', ['class' => 'btn btn-primary btn-block']) !!}
							        </div>
  								</div>
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
/*        .btn-group-xs > .btn, .btn-xs {
            padding  : .25rem .4rem;
            font-size  : .875rem;
            line-height  : .5;
            border-radius : .2rem;
        }
*/
        .alert {
            padding: 0px; 
            margin-bottom: 0px; 
        }

        .input-group>.input-group-prepend {
		    flex: 0 0 40%;
		}
		.input-group .input-group-text {
		    width: 100%;
		}
		.select2-selection__choice {
			color: #101010;
		}
    </style>
@endsection

@section('script')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> -->
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        var baseUrl = "{{ url('/') }}";

        $( function() {
        	var child1DOB = $("#child1_DOB_from_db").text();
        	var child2DOB = $("#child2_DOB_from_db").text();
        	var child3DOB = $("#child3_DOB_from_db").text();
            // $( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            // $( "#datepicker" ).datepicker( "setDate", "0" );
            $( "#child1_DOB" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child1_DOB" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $('#child1_DOB').datepicker('setDate', child1DOB);
            $( "#child2_DOB" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child2_DOB" ).datepicker( "option", "dateFormat", "yy-mm-dd");
            $('#child2_DOB').datepicker('setDate', child2DOB);

            $( "#child3_DOB" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child3_DOB" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $('#child3_DOB').datepicker('setDate', child3DOB);
        });

        $(document).ready(function(){
            $("#child1_DOB").change(function(){
                var dateOfBirth = $("#child1_DOB").val();
                var url = '{{ url("/crm-profile/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child1_DOB_show').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#child2_DOB").change(function(){
                var dateOfBirth = $("#child2_DOB").val();
                var url = '{{ url("/crm-profile/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child2_DOB_show').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#child3_DOB").change(function(){
                var dateOfBirth = $("#child3_DOB").val();
                var url = '{{ url("/crm-profile/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child3_DOB_show').html(data);
                });
            });
        });

  //       $(document).ready(function(){
		//     $("#division_id").change(function(){
		//         var divisionId = $("#division_id").val();
		//         var url = '{{ url("/crm-profile/division-district-show")}}';
		//         $.get(url+'?division_id='+divisionId, function (data) {
		//         	$("#hide_district").hide();
		//         	$("#district_id_disable").hide();
		//         	$("#ps_id_disable").hide();
		//         	$("#hide_ps").hide();
	 //            	$('#division_district_show').html(data);
	 //            	$('#district_ps_show').html('<select class="form-control" name="police_station_id"><option value="">Select Police Station</option></select>');
	 //        	});
		//     });
		// });

        $(function() {
            $('#division').change(function() {
                var divisionId = $(this).val();
                getDistrict(divisionId);
            });

            $('#district').change(function() {
                var districtId = $(this).val();
                getPoliceStation(districtId);
            });
        });

        function getDistrict(divisionId) {
            
            resetField('district', 'Select District');

            resetField('police_station', 'Select Police Station');

            $.get(baseUrl+'/crm-profile/get-district?division_id='+divisionId, function (response) {

                $.map( response, function( name, id ) {
                    $('#district').append('<option value="'+ id +'">' + name + '</option>');
                });
                
            });
        }

        function getPoliceStation(districtId) {
            
            resetField('police_station', 'Select Police Station');

            $.get(baseUrl+'/crm-profile/get-police-station?district_id='+districtId, function (response) {
                
                $.map( response, function( name, id ) {
                    $('#police_station').append('<option value="'+ id +'">' + name + '</option>');
                });

            });
        }

        function resetField(id, placeholder) {
            $('#' + id).empty();
            $('#' + id).append('<option value="">'+ placeholder +'</option>');
        }


		$(document).ready(function() {
    		$('.js-example-basic-multiple').select2();
		});

		$(document).ready(function(){
		    $("#brand_id").change(function(){
		        $("#hide_product").hide();
		        var brandId = $("#brand_id").val();
		        var url = '{{ url("/crm-profile/brand-product-show")}}';
		        $.get(url+'?brand_id='+brandId, function (data) {
	            	$('#brand_product_show').html(data);
	        	});
		    });
		});

		// $('#district_id_disable option:not(:selected)').prop('disabled', true);
		// $('#ps_id_disable option:not(:selected)').prop('disabled', true);
    </script>
@endsection