<!DOCTYPE html>
<html>
<head>
	<title>FNM CRM Profile</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	
	<style type="text/css">
        .btn-group-xs > .btn, .btn-xs {
            padding  : .25rem .4rem;
            font-size  : .875rem;
            line-height  : .5;
            border-radius : .2rem;
        }

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

		.table-sm td, .table-sm th {
		    padding: 0px;
		}
    </style>
</head>
<body>
	<div class="container-fluid">
		<div class="col-sm-8 offset-sm-2">
            @include('flash::message')
        </div>
	    <div class="row">
	        <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
	            <!-- <div class="card bg-dark"> -->
	            <div class="card bg-secondary text-white">
	            	<!-- <img src="{{URL::asset('/assets/image/nestle.png')}}" alt="profile Pic" height="87" width="300"> -->
	            	<!-- style="background-color: #0555af!important;" -->
	                <div class="card-header" style="padding: 0px;">
	                	<img src="{{URL::asset('/assets/image/nestle.png')}}" alt="profile Pic" height="87" width="300" >
	                    <span class="float-right" style="padding: 22px; font-size: 22px;"><!-- <a href="http://192.168.100.16/nestle_all_crm/fnm_upsell/index.php" target="_blank" class="btn btn-danger">Upsel Link</a> --> Nestle FNM CRM <small><?php echo 'Phone No: </small><code><b>'.$phoneNumber; ?></b></code> & <small><?php echo 'Agent:</small> <code><b>'.$agent; ?></b></code></span>
	                </div>

	                <div class="card-body" style="padding: 5px;">
	                    {!! Form::model($profile, ['url' => 'fnm-crm-profile', 'method' => 'post']) !!}
	                    {!! Form::hidden('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'autocomplete' => 'off']) !!}
	                    {!! Form::hidden('agent', null, ['class' => 'form-control', 'placeholder' => 'Enter Agent', 'autocomplete' => 'off']) !!}
	                        <div class="row">
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Consumer's Name <!-- <span style="color: red;"> &nbsp;*</span> --></span>
	                                    </div>
	                                    {!! Form::text('consumer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Consumer Name', 'autocomplete' => 'off', 'required' => 'required']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Consumer's Age</span>
	                                    </div>
	                                    {!! Form::select('consumer_age', $consumerAgeList, null, ['class' => 'form-control','placeholder' => 'Select Consumer Age', 'id' => 'consumer_age', 'required' => 'required']) !!}
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                        	
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">District</span>
	                                    </div>
	                                    {!! Form::select('district_id', $districtList, null, ['class' => 'form-control', 'placeholder' => 'Select District', 'id' => 'district', 'required' => 'required']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Thana</span>
	                                    </div>
	                                    {!! Form::select('police_station_id', [], null, ['class' => 'form-control','placeholder' => 'Select Police Station', 'id' => 'police_station']) !!}
	                                    <span id="district_ps_show"></span>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Address</span>
	                                    </div>
	                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Profession</span>
	                                    </div>
	                                    {!! Form::select('profession', $professionList, null, ['class' => 'form-control','placeholder' => 'Select Profession']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Consumer's Gender</span>
	                                    </div>
	                                    {!! Form::select('consumer_gender', $genderList, null, ['class' => 'form-control','placeholder' => 'Select Consumer Gender', 'required' => 'required']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Number of Child</span>
	                                    </div>
	                                    {!! Form::select('number_of_child', $numberList, null, ['class' => 'form-control','placeholder' => 'Select Child No.', 'required' => 'required']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Family Members</span>
	                                    </div>
	                                    {!! Form::select('total_family_member', $numberList, null, ['class' => 'form-control','placeholder' => 'Total Members']) !!}
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
	                                        <span class="input-group-text bg-success text-white">Child1 DOB</span>
	                                    </div>
	                                    {!! Form::text('child1_DOB', null, ['class' => 'form-control',  'placeholder' => 'Select Child1 Date of Birth', 'autocomplete' => 'off', 'id' => 'child1_DOB', 'readonly' => 'readonly']) !!}
	                                    <span id="child1_DOB_show"></span>
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child2 DOB</span>
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
	                                        <span class="input-group-text bg-success text-white">Child3 DOB</span>
	                                    </div>
	                                    {!! Form::text('child3_DOB', null, ['class' => 'form-control', 'placeholder' => 'Select Child3 Date of Birth', 'autocomplete' => 'off', 'id' => 'child3_DOB', 'readonly' => 'readonly']) !!}
	                                    <span id="child3_DOB_show"></span>
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Baby Name</span>
	                                    </div>
	                                    {!! Form::text('child_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Baby Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Educational Qu.</span>
	                                    </div>
	                                    @if(isset($fnmCrmLast))
	                                    	{!! Form::text('edu_qualification', $fnmCrmLast->edu_qualification, ['class' => 'form-control', 'placeholder' => 'Enter edu. Qalification', 'autocomplete' => 'off']) !!}
	                                    @else
	                                    	{!! Form::text('edu_qualification', null, ['class' => 'form-control', 'placeholder' => 'Enter edu. Qalification', 'autocomplete' => 'off']) !!}
	                                    @endif
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Product Used</span>
	                                    </div>
	                                    @if(isset($fnmCrmLast))
	                                    	{!! Form::select('product_used', $productUsedList, $fnmCrmLast->product_used, ['class' => 'form-control', 'placeholder' => 'Select Product Used']) !!}
	                                    @else
	                                    	{!! Form::select('product_used', $productUsedList, null, ['class' => 'form-control', 'placeholder' => 'Select Product Used']) !!}
	                                    @endif
	                                    
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Brand</span>
	                                    </div>
	                                    {!! Form::select('brand_id_blank', $brandList, null, ['class' => 'form-control', 'placeholder' => 'Select Brand', 'id' => 'brand_id', 'required' => 'required']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Product Cat. & SKU</span>
	                                    </div>
	                                     {!! Form::select('product', [], '', ['class' => 'form-control', 'placeholder' => 'Select Category & SKU', 'id' => 'product_idZ', 'required' => 'required']) !!}
	                                     <!-- <span id="brand_product_show"></span> -->
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-12" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend" style="flex: 0 0 12%;">
	                                        <span class="input-group-text bg-primary text-white">Multi Product</span>
	                                    </div>
	                                    @if(isset($profile))
		                                    <?php
		                            			$arrMultiProduct = (explode(", ",$profile->multi_product));
		                            		?>
		                                    {!! Form::select('multi_product[]', $productNameList, $arrMultiProduct, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) !!}
	                                    @else
		                                    {!! Form::select('multi_product[]', $productNameList, null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) !!}
		                                @endif
	                                </div>
	                            </div>
	                            
	                        </div>
	                        
	                        <div class="row">
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-danger text-white">Interested in CRM</span>
	                                    </div>
	                                    {!! Form::select('interested_in_crm', $interestedInCrmList, null, ['class' => 'form-control', 'placeholder' => 'Select Interested in CRM', 'required' => 'required']) !!}
	                                </div>
	                            </div>

	                            <!-- <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">CP Shared</span>
	                                    </div>
	                                    {!! Form::select('cp_shared', $interestedInCrmList, null, ['class' => 'form-control', 'placeholder' => 'Select CP Shared']) !!}
	                                </div>
	                            </div> -->
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Interested in FNM</span>
	                                    </div>
	                                    {!! Form::select('interested_in_fnm', $interestedInFnmList, null, ['class' => 'form-control', 'placeholder' => 'Select Interested in FNM']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Call Remaks</span>
	                                    </div>
	                                    {!! Form::select('call_remarks', $callRemarksList, null, ['class' => 'form-control', 'placeholder' => 'Select Call Remarks']) !!}
	                                </div>
	                            </div>
	                        </div>
	                  
	                        <div class="row">
	                            <div class="col-sm-12" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend" style="flex: 0 0 13%;">
	                                        <span class="input-group-text bg-primary text-white">Consumer Suggestion</span>
	                                    </div>
	                                    {!! Form::text('verbatim', null, ['class' => 'form-control', 'placeholder' => 'Enter Consumer Suggestion']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group" style="margin-bottom: 2px">
							    <div class="row">
							    	<div class="col-sm-12">
							        {!! Form::button('Submit', ['class' => 'btn btn-danger btn-block text-white', 'data-toggle' => 'modal', 'data-target' => '#myModal']) !!}
							        </div>
							    </div>
							</div>

  							<div class="modal fade" id="myModal">
    							<div class="modal-dialog">
      								<div class="modal-content">
								        <div class="modal-header bg-success">
								          	<h4 class="modal-title" style="color: #FFF;">Confirmation Message</h4>
								          	<button type="button" class="close" data-dismiss="modal">&times;</button>
								        </div>
								        <div class="modal-body bg-secondary">
								         	<h3 class="text-center" style="color: #FFF;">Want to <b>save CRM</b>?</h3>
								        </div>        
								        <div class="modal-footer bg-dark">
								          	{!! Form::submit('YES', ['class' => 'btn btn-primary btn-block']) !!}
								        </div>
      								</div>
    							</div>
  							</div>
						{!! Form::close() !!}
	                </div>

	                <div class="table-responsive">
		                <table class="table table-sm table-striped table-bordered table-hover">
		                    <thead>
		                        <tr class="">
		                            <th>SL</th>
		                            <th>Date</th>
		                            <th>Brand</th>
		                            <th>Product</th>
		                            <th>Consumer Suggestion</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($fnmCrms as $fnmCrm)
		                        <tr>
		                            <td>{{ ++$i }}</td>
		                            <td>{{ $fnmCrm->created_at }}</td>
		                            @if(isset($fnmCrm->brand->name))
		                            	<td>{{ $fnmCrm->brand->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif
		                            <td>{{ substr($fnmCrm->product, strpos($fnmCrm->product, " ") + 1) }}</td>
		                            <td>{{ $fnmCrm->verbatim }}</td>
		                        </tr>
		                    @endforeach
		                    </tbody>
		                </table>
		            </div>

	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
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

            $( "#consumer_dob" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#consumer_dob" ).datepicker( "option", "dateFormat", "dd MM" );
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

        // $(document).ready(function(){
		//     $("#division_id").change(function(){
		//         var divisionId = $("#division_id").val();
		//         var url = '{{ url("/crm-profile/division-district-show")}}';
		//         $.get(url+'?division_id='+divisionId, function (data) {
		//         	$("#hide_district").hide();
		//         	$("#district_id_disable").hide();
		//         	$("#ps_id_disable").hide();
		//         	$("#hide_ps").hide();
	    //         	$('#division_district_show').html(data);
	    //         	$('#district_ps_show').html('<select class="form-control" name="police_station_id"><option value="">Select Police Station</option></select>');
	    //     	});
		//     });
		// });

		$(document).ready(function() {
			$('.select2').select2();
    		$('.js-example-basic-multiple').select2();
		});

		// $(document).ready(function(){
		//     $("#brand_id").change(function(){
		//         $("#hide_product").hide();
		//         var brandId = $("#brand_id").val();
		//         var url = '{{ url("/crm-profile/brand-product-show")}}';
		//         $.get(url+'?brand_id='+brandId, function (data) {
	 //            	$('#brand_product_show').html(data);
	 //        	});
		//     });
		// });

		

		// $('#district_id_disable option:not(:selected)').prop('disabled', true);
		// $('#ps_id_disable option:not(:selected)').prop('disabled', true);


		// address manage

		@if(isset($profile))

			// var profileDivisionId = '{{ $profile->division_id }}';
			var profileDistrictId = '{{ $profile->district_id }}';
			var profilePoliceStationId = '{{ $profile->police_station_id }}';
			var profileBrandId = '{{ $profile->brand_id }}';
			
			jQuery.ajaxSetup({async:false});
			// to select district
			// getDistrict(profileDivisionId);

			$('#district').val(profileDistrictId);
			
			// to select police station
			
			getPoliceStation(profileDistrictId);
			$('#police_station').val(profilePoliceStationId);

			if(profileBrandId != '') {
				getProduct(profileBrandId);
				$('#product_idZ').val(profileBrandId);
			}

			jQuery.ajaxSetup({async:true});

		@endif
		
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

		$(function() {
			$('#brand_id').change(function() {
				var brandId = $(this).val();
				getProduct(brandId);
			});
		});

		function getDistrict(divisionId) {
			
			resetField('district', 'Select District');

			resetField('police_station', 'Select Police Station');

			$.get(baseUrl+'/crm-profile/get-district?division_id='+divisionId, function (response) {
				//console.log(response);
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


		function getProduct(brandId) {

			// $('#product_idZ').empty();
			// $('#product_idZ').append('<option value="">Select Product</option>');
			resetField('product_idZ', 'Select Product');
			
			$.get(baseUrl+'/fnm-crm-profile/get-product?brand_id='+brandId, function (response) {
				//console.log(response);
				$.map( response, function( name, id ) {
					$('#product_idZ').append('<option value="'+ id +'">' + name + '</option>');
				});

			});
		}

    </script>
</body>
</html>