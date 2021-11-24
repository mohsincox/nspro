@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="row">
		    	<div class="col-sm-7">
		        		<h3><i class="fa fa-download"></i> Nestle Data Download </h3>
		        </div>
	        	<div class="col-sm-5">
	        			<a href="http://log:out@<?= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" class="btn btn-outline-danger float-right">Log out</a>
		        		<!-- <a href="{{ url('brand/create') }}" class="btn btn-outline-primary float-right">
			                <i class="fa fa-plus"></i> Create <b>Brand Name</b>
			            </a> -->
		    	</div>
	        </div>
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-download"></i><code><b> Nestle Data Download</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="row">
				  		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-one') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File1
			            		</a>1-100000 data
			        		<!-- </center> -->
			    		</div>
				  		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-two') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File2
			            		</a>100001-200000 data
			        		<!-- </center> -->
			    		</div>
				  		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-three') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File3
			            		</a>200001-300000 data
			        		<!-- </center> -->
			    		</div>
					</div>

					<div class="row mt-4">
						<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-four') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File4
			            		</a>300001-400000 data
			        		<!-- </center> -->
			    		</div>
			    		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-five') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File5
			            		</a>400001-500000 data
			        		<!-- </center> -->
			    		</div>
			    		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-six') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File6
			            		</a>500001-600000 data
			        		<!-- </center> -->
			    		</div>
					</div>

					<div class="row mt-4">
						<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-seven') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File7
			            		</a>600001-700000 data
			        		<!-- </center> -->
			    		</div>
			    		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-eight') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File8
			            		</a>700001-800000 data
			        		<!-- </center> -->
			    		</div>
			    		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-nine') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File9
			            		</a>800001-900000 data
			        		<!-- </center> -->
			    		</div>
					</div>

					<div class="row mt-4">
						<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-ten') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File10
			            		</a>900001-1000000 data
			        		<!-- </center> -->
			    		</div>
			    		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-eleven') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File11
			            		</a>1000001-1100000 data
			        		<!-- </center> -->
			    		</div>
			    		<div class="col-sm-4">
				  			<!-- <center> -->
				  				<a href="{{ url('get-download-twelve') }}" class="btn btn-primary">
			                		<i class="fa fa-download"></i> Nestle Data File12
			            		</a>1100001-1178160 data
			        		<!-- </center> -->
			    		</div>
					</div>
	            </div>
	            
	        </div>
	    </div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    // $(document).ready(function(){
    //     $('#myTable').DataTable();
    // });
</script>
@endsection