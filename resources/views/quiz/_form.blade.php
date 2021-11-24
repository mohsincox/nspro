@if(isset($quiz))
    {!! Form::model($quiz, ['url' => "quiz/$quiz->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'quiz', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="row"> 
        {!! Form::label('name', 'Quiz Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
        <div class="col-9 col-sm-9">
        	<div class="col-12 col-sm-12">
    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Quiz Name', 'autocomplete' => 'off']) !!}
    	        <span class="text-danger">
    			    {{ $errors->first('name') }}
    		    </span>
    		</div>
        </div>
    </div>
</div>

@if(isset($quiz))
    <div class="form-group required {{ $errors->has('status') ? 'has-error' : '' }}">
        <div class="row"> 
            {!! Form::label('status', 'Select Status', ['class' => 'control-label col-sm-3 col-3']) !!}
            <div class="col-9 col-sm-9">
                <div class="col-12 col-sm-12">
                    {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control', 'placeholder' => 'Select Status']) !!}
                    <span class="text-danger">
                        {{ $errors->first('status') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="form-group">
    <div class="row">
        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block']) !!}
    </div>
</div>
{!! Form::close() !!}