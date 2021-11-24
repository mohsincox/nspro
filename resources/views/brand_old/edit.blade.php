@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2">
			<div class="card">
				<div class="card-header">
					<h3 class="text-center"><i class="fa fa-pencil"></i> Edit Form of <code><b>Brand Name</b></code></h3>
				</div>
				<div class="card-body">
			  		@include('brand._form')
				</div>
			</div>
		</div>
	</div>	
</div>	
@endsection