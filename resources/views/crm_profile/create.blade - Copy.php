<!DOCTYPE html>
<html>
<head>
	<title>CRM Profile</title>
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
            padding: 2px; 
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
</head>
<body>
	<div class="container-fluid mt-1">
	    <div class="row">
	        <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
	            <div class="card bg-dark text-white">
	            	<!-- <img src="{{URL::asset('/assets/image/nestle.png')}}" alt="profile Pic" height="87" width="300"> -->
	                <div class="card-header" style="padding: 0px;">
	                	<img src="{{URL::asset('/assets/image/nestle.png')}}" alt="profile Pic" height="87" width="300" >
	                    <span class="float-right" style="padding: 22px; font-size: 22px;">Nestle Inbound CRM <small><?php echo 'Phone No: <mark>'.'$phone_number'; ?></mark></small> & <small><?php echo 'Agent: <mark>'.'$agent'; ?></mark></small></span>
	                </div>

	                <div class="card-body" style="padding: 5px;">
	                    {!! Form::open(['url' => 'crm-profile', 'method' => 'post']) !!}
	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Consumer's Name</span>
	                                    </div>
	                                    {!! Form::text('consumer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Consumer Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Consumer's Age</span>
	                                    </div>
	                                    {!! Form::select('consumer_age', $consumerAgeList, null, ['class' => 'form-control','placeholder' => 'Select Consumer Age', 'id' => 'consumer_age']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Consumer's Gender</span>
	                                    </div>
	                                    {!! Form::select('consumer_gender', $genderList, null, ['class' => 'form-control','placeholder' => 'Select Consumer Gender']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Division</span>
	                                    </div>
	                                    {!! Form::select('division', $divisionList, null, ['class' => 'form-control','placeholder' => 'Select Division', 'id' => 'division_id']) !!}
	                                </div>
	                            </div>

	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">District</span>
	                                    </div>
	                                    {!! Form::select('district', [], null, ['class' => 'form-control', 'placeholder' => 'Select District Name', 'id' => 'hide_district']) !!}
	                                    
	                                    <span id="division_district_show"></span>
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Police Station</span>
	                                    </div>
	                                    {!! Form::select('police_station', [], null, ['class' => 'form-control','placeholder' => 'Select Police Station', 'id' => 'hide_ps']) !!}

	                                    <span id="district_ps_show"></span>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Address</span>
	                                    </div>
	                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Alternative Phone</span>
	                                    </div>
	                                    {!! Form::text('alternative_phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Alternative Phone', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Profession</span>
	                                    </div>
	                                    {!! Form::select('profession', $professionList, null, ['class' => 'form-control','placeholder' => 'Select Profession']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">SEC</span>
	                                    </div>
	                                    {!! Form::select('sec', $secList, null, ['class' => 'form-control','placeholder' => 'Select SEC']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Number of Child</span>
	                                    </div>
	                                    {!! Form::select('no_of_child', $numberList, null, ['class' => 'form-control','placeholder' => 'Select Child No.']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Total family Members</span>
	                                    </div>
	                                    {!! Form::select('no_of_member', $numberList, null, ['class' => 'form-control','placeholder' => 'Select Member No.']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child1 Name</span>
	                                    </div>
	                                    {!! Form::text('child1_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Child1 Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child1 Gender</span>
	                                    </div>
	                                    {!! Form::select('child1_gender', $genderList, null, ['class' => 'form-control','placeholder' => 'Select Child1 Gender']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child2 DOB</span>
	                                    </div>
	                                    {!! Form::text('child1_DOB', null, ['class' => 'form-control', 'placeholder' => 'Enter Child1 Date of Birth', 'autocomplete' => 'off', 'id' => 'child1_DOB', 'readonly' => 'readonly']) !!}
	                                    <span id="child1_DOB_show"></span>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child2 Name</span>
	                                    </div>
	                                    {!! Form::text('child2_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Child2 Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child2 Gender</span>
	                                    </div>
	                                    {!! Form::select('child2_gender', $genderList, null, ['class' => 'form-control','placeholder' => 'Select Child1 Gender']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child2 DOB</span>
	                                    </div>
	                                    {!! Form::text('child2_DOB', null, ['class' => 'form-control', 'placeholder' => 'Enter Child2 Date of Birth', 'autocomplete' => 'off', 'id' => 'child2_DOB', 'readonly' => 'readonly']) !!}
	                                    <span id="child2_DOB_show"></span>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child3 Name</span>
	                                    </div>
	                                    {!! Form::text('child3_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Child3 Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child2 Gender</span>
	                                    </div>
	                                    {!! Form::select('child3_gender', $genderList, null, ['class' => 'form-control','placeholder' => 'Select Child3 Gender']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Child3 DOB</span>
	                                    </div>
	                                    {!! Form::text('child3_DOB', null, ['class' => 'form-control', 'placeholder' => 'Enter Child3 Date of Birth', 'autocomplete' => 'off', 'id' => 'child3_DOB', 'readonly' => 'readonly']) !!}
	                                    <span id="child3_DOB_show"></span>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Brand</span>
	                                    </div>
	                                    {!! Form::select('brand', $brandList, null, ['class' => 'form-control', 'placeholder' => 'Select Brand']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Product Category & SKU</span>
	                                    </div>
	                                     {!! Form::select('product', $productList, null, ['class' => 'form-control', 'placeholder' => 'Select Product']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Prefered Brand</span>
	                                    </div>
	                                    {!! Form::select('prefered_brand[]', $brandList, null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Competition's Brand Usage</span>
	                                    </div>
	                                    {!! Form::text('competition_brand_usage', null, ['class' => 'form-control', 'placeholder' => 'Enter Competition Brand Usage', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="offset-sm-4 col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Activity/Campaign Name</span>
	                                    </div>
	                                     {!! Form::text('activity_campaign_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Activity/Campaign Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Call Category</span>
	                                    </div>
	                                    {!! Form::select('call_category', $callCategoryList, null, ['class' => 'form-control', 'placeholder' => 'Select Call Category']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Call Sub Category</span>
	                                    </div>
	                                    {!! Form::select('call_sub_category', $callSubCategoryList, null, ['class' => 'form-control', 'placeholder' => 'Select Call Sub Category']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Consumer Involvement</span>
	                                    </div>
	                                    {!! Form::select('consumer_involvement', $consumerInvolvementList, null, ['class' => 'form-control', 'placeholder' => 'Select Consumer Involvement']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Contact Qualification</span>
	                                    </div>
	                                    {!! Form::select('contact_qualification', $contactQualificationList, null, ['class' => 'form-control', 'placeholder' => 'Select Contact Qualification']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Source of Knowing</span>
	                                    </div>
	                                    <!-- {!! Form::select('source_of_knowing', $sourceOfKnowingList, null, ['class' => 'form-control', 'placeholder' => 'Select Source of Knowing']) !!} -->
	                                    {!! Form::text('source_of_knowing', null, ['class' => 'form-control', 'placeholder' => 'Select or Enter Knowing', 'autocomplete' => 'off', 'list' => 'source_of_knowing']) !!}
	                                    <datalist id="source_of_knowing">
	                                    	@foreach($sourceOfKnowingList as $sourceOfKnowing)
										    	<option value="{{ $sourceOfKnowing->name }}">
										    @endforeach
  										</datalist>
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">CCID</span>
	                                    </div>
	                                    {!! Form::text('ccid', null, ['class' => 'form-control', 'placeholder' => 'Enter CCID', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Sales Force</span>
	                                    </div>
	                                    {!! Form::text('sales_force', null, ['class' => 'form-control', 'placeholder' => 'Enter Sales Force', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Consumer Satisfaction Index (CSI)</span>
	                                    </div>
	                                    {!! Form::select('csi', $CSIList, null, ['class' => 'form-control', 'placeholder' => 'Select CSI']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Interested in CRM</span>
	                                    </div>
	                                    {!! Form::select('interested_in_crm', $interestedInCrmList, null, ['class' => 'form-control', 'placeholder' => 'Select Interested in CRM']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-sm-8" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Verbatim</span>
	                                    </div>
	                                    {!! Form::text('verbatim', null, ['class' => 'form-control', 'placeholder' => 'Enter Verbatim', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-primary text-white">Remarks</span>
	                                    </div>
	                                    {!! Form::select('remarks', $remarksList, null, ['class' => 'form-control', 'placeholder' => 'Select Remarks']) !!}
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
							    <div class="row">
							    	<div class="col-sm-12">
							        {!! Form::submit('Submit', ['class' => 'btn btn-outline-danger btn-xs btn-block text-white']) !!}
							        </div>
							    </div>
							</div>
						{!! Form::close() !!}
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
        $( function() {
            // $( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            // $( "#datepicker" ).datepicker( "setDate", "0" );
            $( "#child1_DOB" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child1_DOB" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $( "#child2_DOB" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child2_DOB" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $( "#child3_DOB" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child3_DOB" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
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

        $(document).ready(function(){
		    $("#division_id").change(function(){
		        var divisionId = $("#division_id").val();
		        var url = '{{ url("/crm-profile/division-district-show")}}';
		        $.get(url+'?division_id='+divisionId, function (data) {
		        	$("#hide_district").hide();
		        	$("#hide_ps").hide();
	            	$('#division_district_show').html(data);
	            	$('#district_ps_show').html('<select class="form-control" name="police_station_id"><option value="">Select Police Station</option></select>');
	        	});
		    });
		});

		$(document).ready(function() {
    		$('.js-example-basic-multiple').select2();
		});
    </script>
</body>
</html>