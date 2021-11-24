@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="row">
		    	<div class="col-sm-7">
		        		<h3><i class="fa fa-list-ul"></i> List of Quiz Names</h3>
		        </div>
	        	<div class="col-sm-5">
	        		@can('admin-access')
		        		<a href="{{ url('quiz/create') }}" class="btn btn-outline-primary float-right">
			                <i class="fa fa-plus"></i> Create <b>Quiz Name</b>
			            </a>
		            @endcan
		    	</div>
	        </div>
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Quiz Names</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
	                <table id="myTable" class="table table-bordered table-striped table-hover">
	                    <thead>
	                        <tr class="">
	                            <th>SL</th>
	                            <th>Quiz Names</th>
	                            <th>Status</th>
	                            @can('admin-access')
									<th>Edit</th>
                    			@endcan
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        $i = 0;
	                    ?>
	                    @foreach($quizzes as $quiz)
	                        <tr>
	                            <td>{{ ++$i }}</td>
	                            <td>{{ $quiz->name }}</td>
	                            <td>{{ $quiz->status }}</td>
	                            @can('admin-access')
	                            	<td>{!! Html::link("quiz/$quiz->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs']) !!}</td>
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