<!-- <div class="required form-group {{ $errors->has('police_station_id') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('police_station_id', 'Select Police Station', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-8 col-sm-8">
        	<div class="col-12 col-sm-12"> -->
    	        {!! Form::select('police_station_id', $disWisePsList, null, ['class' => 'form-control', 'placeholder' => 'Select Police Station', 'id' => 'police_station_id', 'required' => 'required']) !!}
    	        <!-- <span class="text-danger">
    			    {{ $errors->first('police_station_id') }}
    		    </span>
    		</div>
        </div>
    </div>
</div> -->