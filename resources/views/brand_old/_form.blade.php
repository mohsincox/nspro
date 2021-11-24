@if(isset($brand))
    {!! Form::model($brand, ['url' => "brand/$brand->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'brand', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

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