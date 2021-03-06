@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="row">
		    	<div class="col-sm-7">
		        		<h3><i class="fa fa-list-ul"></i> List of Category Names</h3>
		        </div>
	        	<div class="col-sm-5">
	        		@can('admin-access')
		        		<a href="{{ url('category/create') }}" class="btn btn-outline-primary float-right">
			                <i class="fa fa-plus"></i> Create <b>Category Name</b>
			            </a>
		            @endcan
		    	</div>
	        </div>
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Category Names</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
	                <table id="myTable" class="table table-bordered table-striped table-hover">
	                    <thead>
	                        <tr class="">
	                            <th>SL</th>
	                            <th>Category Names</th>
	                            @can('admin-access')
									<th>Edit</th>
                    			@endcan
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        $i = 0;
	                    ?>
	                    @foreach($categories as $category)
	                        <tr>
	                            <td>{{ $category->id }}</td>
	                            <td>{{ $category->name }}</td>
	                            @can('admin-access')
	                            	<td>{!! Html::link("category/$category->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs']) !!}</td>
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