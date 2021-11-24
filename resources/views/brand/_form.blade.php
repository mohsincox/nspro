@if(isset($brand))
    {!! Form::model($brand, ['url' => "brand/$brand->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'brand', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="form-group required {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <div class="row"> 
        {!! Form::label('category_id', 'Select Category Name', ['class' => 'control-label col-sm-3 col-3']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::select('category_id', $categoryList, null, ['class' => 'form-control', 'placeholder' => 'Select Category Name']) !!}
                <span class="text-danger">
                    {{ $errors->first('category_id') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('name', 'Brand Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Brand Name', 'autocomplete' => 'off']) !!}
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