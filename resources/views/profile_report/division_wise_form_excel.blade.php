@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	    <div class="row">
	        <div class="col-sm-6 offset-sm-3">
	            <div class="card">
	                <div class="card-header">Division Wise Report Download Form</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'profile-report/division-wise-show-excel', 'method' => 'post', 'class' => 'form-horizontal']) !!}
	                        <div class="required form-group {{ $errors->has('division_id') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('division_id', 'Select Division', ['class' => 'col-3 col-sm-3 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control', 'placeholder' => 'Select Division', 'id' => 'division_id', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('division_id') }}
							    		    </span>
							    		</div>
							        </div>
							    </div>
							</div>
							<div class="required form-group {{ $errors->has('file') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('file', 'Select File Type', ['class' => 'col-3 col-sm-3 control-label']) !!}
							        <div class="col-8 col-sm-8">
							        	<div class="col-12 col-sm-12">
							    	        {!! Form::select('type', ['xlsx' => 'XLSX', 'csv' => 'CSV', 'xls' => 'XLS'], 'xlsx', ['class' => 'form-control', 'placeholder' => 'Select File Type', 'id' => 'type', 'required' => 'required']) !!}
							    	        <span class="text-danger">
							    			    {{ $errors->first('file') }}
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