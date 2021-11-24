@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	    <div class="row">
	        <div class="col-sm-6 offset-sm-3">
	            <div class="card">
	                <div class="card-header">Police Station Wise Report Form</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'profile-report/ps-wise-show', 'method' => 'post', 'class' => 'form-horizontal']) !!}
	                        <div class="required form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('district_id', 'Select District', ['class' => 'col-3 col-sm-3 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::select('district_id', $districtList, null, ['class' => 'form-control js-example-basic-single', 'placeholder' => 'Select District', 'id' => 'district_id', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('district_id') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>
							<span id="district_ps_show">
								<div class="required form-group {{ $errors->has('police_station_id') ? 'has-error' : ''}}">
								    <div class="row"> 
								        {!! Form::label('police_station_id', 'Select Police Station', ['class' => 'col-3 col-sm-3 control-label']) !!}
								        <div class="col-8 col-sm-8">
								        	<div class="col-12 col-sm-12">
								    	        {!! Form::select('police_station_id', [], null, ['class' => 'form-control', 'placeholder' => 'Select Police Station', 'id' => 'police_station_id', 'required' => 'required']) !!}
								    	        <span class="text-danger">
								    			    {{ $errors->first('police_station_id') }}
								    		    </span>
								    		</div>
								        </div>
								    </div>
								</div>
	                       	</span>
	                        <div class="form-group">
	                            <div class="col-sm-8 offset-sm-3">
	                                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block']) !!}
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
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