@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="row">
		    	<div class="col-sm-7">
		        		<h3><i class="fa fa-list-ul"></i> List of Home Delivery Products</h3>
		        </div>
	        	<div class="col-sm-5">
	        		@can('admin-access')
		        		<a href="{{ url('home-delivery-product/create') }}" class="btn btn-outline-primary float-right">
			                <i class="fa fa-plus"></i> Create <b>Home Delivery Product</b>
			            </a>
		            @endcan
		    	</div>
	        </div>
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Home Delivery Products</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
	                <table id="myTable" class="table table-bordered table-striped table-hover">
	                    <thead>
	                        <tr class="">
	                            <th>SL</th>
	                            <th>Product</th>
	                            <th>Special Price</th>
	                            <th>MRP</th>
	                            <th>Status</th>
	                            <th>Offer</th>
	                            <th>Remarks</th>
	                            @can('admin-access')
									<th>Edit</th>
                    			@endcan
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        $i = 0;
	                    ?>
	                    @foreach($deliveryProducts as $deliveryProduct)
	                        <tr>
	                            <td>{{ $deliveryProduct->id }}</td>
	                            <td>{{ $deliveryProduct->name }}</td>
	                            <td class="text-right">{{ number_format($deliveryProduct->price, 2) }}</td>
	                            <td class="text-right">{{ number_format($deliveryProduct->mrp, 2) }}</td>
	                            <td>{{ $deliveryProduct->status }}</td>
	                            <td>{{ $deliveryProduct->offer }}</td>
	                            <td>{{ $deliveryProduct->remarks }}</td>
	                            @can('admin-access')
	                            	<td>{!! Html::link("home-delivery-product/$deliveryProduct->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs']) !!}</td>
	                            @endcan
	                        </tr>
	                    @endforeach
	                    </tbody>
	                </table>
	            </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
@endsection