@if(isset($category))
    {!! Form::model($category, ['url' => "category/$category->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'category', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('name', 'Category Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name', 'autocomplete' => 'off']) !!}
    	        <span class="text-danger">
    			    {{ $errors->first('name') }}
    		    </span>
    		</div>
        </div>
    </div>
</div>

@if(isset($category))
<!-- <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
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
</div> -->
@endif

<div class="form-group">
    <div class="row">
        @if(isset($category))
            {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '#cat_update']) !!}
        @else
            {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '#cat_create']) !!}
        @endif
    </div>
</div>

<div class="modal fade" id="cat_create">
    <div class="modal-dialog">
        <div class="modal-content bg-success text-white">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Want to Create Category?</h3>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <div class="float-left">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cat_update">
    <div class="modal-dialog">
        <div class="modal-content bg-success text-white">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Want to Update Category?</h3>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <div class="float-left">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}