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
    	        {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control', 'placeholder' => 'Select Division Name']) !!}
    	        <span class="text-danger">
    	            {{ $errors->first('division_id') }}
    	        </span>
            </div>
        </div>
    </div>
</div>

<div class="form-group required {{ $errors->has('district_id') ? 'has-error' : '' }}">
    <div class="row"> 
        {!! Form::label('district_id', 'Select District Name', ['class' => 'control-label col-sm-3 col-3']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::select('district_id', $districtList, null, ['class' => 'form-control', 'placeholder' => 'Select District Name']) !!}
                <span class="text-danger">
                    {{ $errors->first('district_id') }}
                </span>
            </div>
        </div>
    </div>
</div>

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