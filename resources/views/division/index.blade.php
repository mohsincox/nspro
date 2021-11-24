@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <div class="row">
		    	<div class="col-sm-7">
		        		<h3><i class="fa fa-list-ul"></i> List of Division Names</h3>
		        </div>
	        	<div class="col-sm-5">
	        		@can('admin-access')
		        		<a href="{{ url('division/create') }}" class="btn btn-outline-primary pull-right">
			                <i class="fa fa-plus"></i> Create <b>Division Name</b>
			            </a>
		            @endcan
		    	</div>
	        </div>
	        <div class="card">
	            <div class="card-header">
	                <h4 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Division Names</b></code></h4>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
	                <table id="myTable" class="table table-bordered table-striped table-hover">
	                    <thead>
	                        <tr class="">
	                            <th>SL</th>
	                            <th>Division Names</th>
	                            <!-- <th>View</th> -->
	                            @can('admin-access')
	                            	<th>Edit</th>
	                            @endcan
	                            <!-- <th>Delete</th> -->
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        $i = 0;
	                    ?>
	                    @foreach($divisions as $division)
	                        <tr>
	                            <td>{{ ++$i }}</td>
	                            <td>{{ $division->name }}</td>
	                            <!-- <td>{!! Html::link("result/$division->id",' View', ['class' => 'fa fa-eye btn btn-success btn-xs']) !!}</td> -->
	                            @can('admin-access')
	                            	<td>{!! Html::link("division/$division->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs']) !!}</td>
	                            @endcan
	                            <!-- <td><a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal-{{ $division->id }}">
	                                    <i class="fa fa-trash"></i> Delete
	                                </a>
	                            </td> -->

	                            <!-- Modal -->
	                            <div class="modal fade" id="myModal-{{ $division->id }}" role="dialog">
	                                <div class="modal-dialog">

	                                    <!-- Modal content-->
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                            <h4 class="modal-title">DELETE</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                            <p>Do you want to delete this Result?</p>
	                                        </div>
	                                        <div class="modal-footer">
	                                            {{--<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>--}}

	                                            {{ Form::open(['method' => 'DELETE', 'url' => "result/$division->id"]) }}
	                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
	                                            {{ Form::close() }}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
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