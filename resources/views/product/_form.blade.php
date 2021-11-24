@if(isset($product))
    {!! Form::model($product, ['url' => "product/$product->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'product', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="form-group required {{ $errors->has('brand_id') ? 'has-error' : '' }}">
    <div class="row"> 
        {!! Form::label('brand_id', 'Select Brand Name', ['class' => 'control-label col-sm-3 col-3']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::select('brand_id', $brandList, null, ['class' => 'form-control', 'placeholder' => 'Select Brand Name']) !!}
    	        <span class="text-danger">
    	            {{ $errors->first('brand_id') }}
    	        </span>
            </div>
        </div>
    </div>
</div>

<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('name', 'Product Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Name', 'autocomplete' => 'off']) !!}
    	        <span class="text-danger">
    			    {{ $errors->first('name') }}
    		    </span>
    		</div>
        </div>
    </div>
</div>

<div class="required form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('sku', 'SKU', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'Enter SKU', 'autocomplete' => 'off']) !!}
                <span class="text-danger">
                    {{ $errors->first('sku') }}
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