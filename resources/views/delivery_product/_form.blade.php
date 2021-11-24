@if(isset($deliveryProduct))
    {!! Form::model($deliveryProduct, ['url' => "home-delivery-product/$deliveryProduct->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'home-delivery-product', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('name', 'Product', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Home Delivery Product', 'autocomplete' => 'off']) !!}
    	        <span class="text-danger">
    			    {{ $errors->first('name') }}
    		    </span>
    		</div>
        </div>
    </div>
</div>

<div class="required form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('price', 'Special Price', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Enter Special Price', 'autocomplete' => 'off']) !!}
                <span class="text-danger">
                    {{ $errors->first('price') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="required form-group {{ $errors->has('mrp') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('mrp', 'MRP', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::text('mrp', null, ['class' => 'form-control', 'placeholder' => 'Enter MRP', 'autocomplete' => 'off']) !!}
                <span class="text-danger">
                    {{ $errors->first('mrp') }}
                </span>
            </div>
        </div>
    </div>
</div>

@if(isset($deliveryProduct))
<div class="required form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('status', 'Status', ['class' => 'required col-3 col-sm-3 control-label']) !!}
        <div class="col-xs-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control', 'placeholder' => 'Select Status']) !!}
                <span class="text-danger">
                    {{ $errors->first('status') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="required form-group {{ $errors->has('offer') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('offer', 'Offer', ['class' => 'required col-3 col-sm-3 control-label']) !!}
        <div class="col-xs-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::select('offer', ['Yes' => 'Yes', 'No' => 'No'], null, ['class' => 'form-control', 'placeholder' => 'Select Status']) !!}
                <span class="text-danger">
                    {{ $errors->first('offer') }}
                </span>
            </div>
        </div>
    </div>
</div>
@endif

<div class="form-group {{ $errors->has('remarks') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('remarks', 'Remarks', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
            <div class="col-12 col-sm-12">
                {!! Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => 'Enter Remarks', 'autocomplete' => 'off']) !!}
                <span class="text-danger">
                    {{ $errors->first('remarks') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        @if(isset($deliveryProduct))
            {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '#pro_update']) !!}
        @else
            {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '#pro_create']) !!}
        @endif
    </div>
</div>

<div class="modal fade" id="pro_create">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Want to Create Product?</h3>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <div class="float-left">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pro_update">
    <div class="modal-dialog">
        <div class="modal-content bg-success text-white">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Want to Update Product?</h3>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <div class="float-left">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}