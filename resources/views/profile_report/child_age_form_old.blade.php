@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	    <div class="row">
	        <div class="col-sm-6 offset-sm-3">
	            <div class="card">
	                <div class="card-header">Child Age Report</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'profile-report/child-age-show-old', 'method' => 'post', 'class' => 'form-horizontal']) !!}
	                        <div class="required form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('start_date', 'Start Date', ['class' => 'col-4 col-sm-4 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('start_date') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

	                        <div class="required form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('end_date', 'End Date', ['class' => 'col-4 col-sm-4 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'id' => 'end_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('end_date') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

							<div class="required form-group {{ $errors->has('child_start_date') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('child_start_date', 'Child Start Date', ['class' => 'col-4 col-sm-4 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::text('child_start_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'child_start_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('child_start_date') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

							<div class="required form-group {{ $errors->has('child_start_age') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('child_start_age', 'Child Start Age', ['class' => 'col-4 col-sm-4 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        <mark style="width: 290px; height: 32px; display: block;"><span id="child_start_age_show"></span></mark>
							    	        <span class="text-danger">
							    			    {{ $errors->first('child_start_age') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

	                        <div class="required form-group {{ $errors->has('child_end_date') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('child_end_date', 'Child End Date', ['class' => 'col-4 col-sm-4 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::text('child_end_date', null, ['class' => 'form-control', 'placeholder' => 'Select End Date', 'autocomplete' => 'off', 'id' => 'child_end_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('child_end_date') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

							<div class="required form-group {{ $errors->has('child_end_age') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('child_end_age', 'Child End Age', ['class' => 'col-4 col-sm-4 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        <mark style="width: 290px; height: 32px; display: block;"><span id="child_end_age_show"></span></mark>
							    	        <span class="text-danger">
							    			    {{ $errors->first('child_end_age') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

	                        <div class="form-group">
	                        	<div class="row">
	                            <div class="col-sm-8 offset-sm-4">
	                                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block']) !!}
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
@endsection

@section('script')
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
		$( function() {
			$( "#start_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date" ).datepicker( "setDate", "0" );
        	$( "#end_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date" ).datepicker( "setDate", "0" );
        	$( "#child_start_date" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child_start_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $( "#child_end_date" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child_end_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		} );

		$(document).ready(function(){
            $("#child_start_date").change(function(){
                var dateOfBirth = $("#child_start_date").val();
                var url = '{{ url("/profile-report/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child_start_age_show').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#child_end_date").change(function(){
                var dateOfBirth = $("#child_end_date").val();
                var url = '{{ url("/profile-report/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child_end_age_show').html(data);
                });
            });
        });
	</script>
@endsection