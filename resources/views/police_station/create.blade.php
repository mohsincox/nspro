@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2">
			<div class="card">
				<div class="card-header">
					<h3 class="text-center"><i class="fa fa-pencil"></i> Create Form of <code><b>Police Station Name</b></code> </h3>
				</div>
				<div class="card-body">
			  		<!-- @include('police_station._form') -->

@if(isset($policeStation))
    {!! Form::model($policeStation, ['url' => "police-station/$policeStation->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'police-station', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="form-group required {{ $errors->has('division_id') ? 'has-error' : '' }}">
    <div class="row"> 
        {!! Form::label('division_id', 'Select Division Name', ['class' => 'control-label col-sm-3 col-3']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control', 'placeholder' => 'Select Division Name', 'id' => 'division_id']) !!}
    	        <span class="text-danger">
    	            {{ $errors->first('division_id') }}
    	        </span>
            </div>
        </div>
    </div>
</div>

<div id="hide_district" class="form-group required {{ $errors->has('district_id') ? 'has-error' : '' }}">
    <div class="row"> 
        {!! Form::label('district_id', 'Select District Name', ['class' => 'control-label col-sm-3 col-3']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::select('district_id', $districtList, null, ['class' => 'form-control bg-danger text-white', 'placeholder' => 'Select District Name (at first select Division)', 'disabled' => 'disabled']) !!}
                <span class="text-danger">
                    {{ $errors->first('district_id') }}
                </span>
            </div>
        </div>
    </div>
</div>

<span id="division_district_show"></span>

<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('name', 'Police Station Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Police Station Name', 'autocomplete' => 'off']) !!}
    	        <span class="text-danger">
    			    {{ $errors->first('name') }}
    		    </span>
    		</div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
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

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
		    $("#division_id").change(function(){
		        var divisionId = $("#division_id").val();
		        var url = '{{ url("/division-district-show")}}';
		        $.get(url+'?division_id='+divisionId, function (data) {
		        	$("#hide_district").hide();
	            	$('#division_district_show').html(data);
	        	});
		    });
		});
	</script>
@endsection