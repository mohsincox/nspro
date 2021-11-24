@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	    <div class="row">
	        <div class="col-sm-6 offset-sm-3">
	            <div class="card">
	                <div class="card-header">CRM and Profile Report Download Form</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'crm-profile/crm-report-show-excel', 'method' => 'post', 'class' => 'form-horizontal']) !!}
	                        <div class="required form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('start_date', 'Start Date', ['class' => 'col-3 col-sm-3 control-label']) !!}
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
							        {!! Form::label('end_date', 'End Date', ['class' => 'col-3 col-sm-3 control-label']) !!}
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

							<div class="required form-group {{ $errors->has('type') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('type', 'File Type', ['class' => 'col-3 col-sm-3 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('type') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>

	                        <div class="form-group">
	                            <div class="col-sm-8 offset-sm-3">
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
	 </script>
@endsection