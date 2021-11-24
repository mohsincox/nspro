<!DOCTYPE html>
<html>
<head>
	<title>Nestle</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container mt-1" style="height: 500px;">
		<div class="row">
			<div class="col-12 col-sm-8 offset-sm-2">
				<div class="card">
					<div class="card-header">
						<h3 class="text-center"><i class="fa fa-pencil"></i> Agent Panel For Updateing <code><b>CCID</b></code> </h3>
					</div>
					<div class="card-body">
				  		
						{!! Form::model($crm, ['url' => "ccid-agent/$crm->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}

						<div class="required form-group {{ $errors->has('ccid') ? 'has-error' : ''}}">
						    <div class="row"> 
						        {!! Form::label('ccid', 'CCID', ['class' => 'col-3 col-sm-3 control-label']) !!}
						        <div class="col-9 col-sm-9">
						        	<div class="col-12 col-sm-12">
						    	        {!! Form::text('ccid', null, ['class' => 'form-control', 'placeholder' => 'Enter CCID', 'autocomplete' => 'off']) !!}
						    	        <span class="text-danger">
						    			    {{ $errors->first('ccid') }}
						    		    </span>
						    		</div>
						        </div>
						    </div>
						</div>

						<div class="form-group">
						    <div class="row">
						        {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '#ccid_update']) !!}
						    </div>
						</div>

						<div class="modal fade" id="ccid_update">
						    <div class="modal-dialog">
						        <div class="modal-content bg-success text-white">
						            <div class="modal-header">
						                <h4 class="modal-title">Confirmation Message</h4>
						                <button type="button" class="close" data-dismiss="modal">&times;</button>
						            </div>
						            <div class="modal-body">
						                <h3>Want to Update CCID?</h3>
						            </div>
						            <div class="modal-footer">
						                <div class="col-sm-12">
						                    <div class="float-left">
						                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                    </div>
						                    <div class="float-right">
						                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>


						{!! Form::close() !!}



					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>