<!-- <div class="required form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('district_id', 'Select District', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-8 col-sm-8">
        	<div class="col-12 col-sm-12"> -->
    	        {!! Form::select('district_id', $divWiseDistrictList, null, ['class' => 'form-control', 'placeholder' => 'Select District', 'id' => 'district_id_no_need', 'required' => 'required']) !!}
    	        <!-- <span class="text-danger">
    			    {{ $errors->first('district_id') }}
    		    </span>
    		</div>
        </div>
    </div>
</div> -->