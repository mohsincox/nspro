<div class="form-group required {{ $errors->has('district_id') ? 'has-error' : '' }}">
    <div class="row"> 
        {!! Form::label('district_id', 'Select District Name', ['class' => 'control-label col-sm-3 col-3']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::select('district_id', $divWiseDistrictList, null, ['class' => 'form-control', 'placeholder' => 'Select District Name', 'id' => 'div_wise_district']) !!}
                <span class="text-danger">
                    {{ $errors->first('district_id') }}
                </span>
            </div>
        </div>
    </div>
</div>