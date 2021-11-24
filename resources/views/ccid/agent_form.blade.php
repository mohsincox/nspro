<!DOCTYPE html>
<html>
<head>
	<title>Nestle</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
</head>
<body>
	<div class="container mt-1">
        <div class="col-sm-8 offset-sm-2">
            @include('flash::message')
        </div> 
    </div>
	<div class="container mt-1" style="height: 500px;">
		<div class="row">
			<div class="col-12 col-sm-8 offset-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="text-center"><i class="fa fa-pencil"></i> Agent Panel For Updateing <code><b>CCID</b></code> </h3>
					</div>
					<div class="card-body">
				  		
						{!! Form::open(['url' => 'ccid-agent-wise-show', 'method' => 'get', 'class' => 'form-horizontal']) !!}

						<div class="form-group required {{ $errors->has('agent') ? 'has-error' : '' }}">
						    <div class="row"> 
						        {!! Form::label('agent', 'Select Name', ['class' => 'control-label col-sm-3 col-3']) !!}
						        <div class="col-9 col-sm-9">
						                {!! Form::select('agent', $agentList, null, ['class' => 'form-control select2', 'placeholder' => 'Select Name', 'required' => 'required']) !!}
						                <span class="text-danger">
						                    {{ $errors->first('agent') }}
						                </span>
						        </div>
						    </div>
						</div>

						<div class="form-group">
						    <div class="row">
						        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block']) !!}
						    </div>
						</div>
						{!! Form::close() !!}



					</div>
				</div>
			</div>
		</div>	
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.select2').select2();
    		// $('.js-example-basic-multiple').select2();
		});
	</script>
</body>
</html>