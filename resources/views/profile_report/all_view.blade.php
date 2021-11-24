@extends('layouts.app')

@section('content')
<div class="container-fluid mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="text-center"><i class="fa fa-list-ul"></i> <b><i>All Profile</i></b> Information </h4>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
		                <table id="table2excel" class="table table-bordered table-striped table-hover">
		                    <thead>
		                        <tr class="">
		                            <!-- <th>SL</th> -->
		                            <th>Unique ID</th>
		                            <th>Consu. No.</th>
		                            <th>Con Name</th>
		                            <th>Con Age</th>
		                            <th>Con Gender</th>
		                            <th>Division</th>
		                            <th>District</th>
		                            <th>Thana</th>
		                            <th>Address</th>
		                            <!-- <th>Alt. Ph No</th> -->
		                            <th>Profession</th>
		                            <th>Brand</th>
		                            <th>SEC</th>
		                            <th>Interested in CRM</th>
		                            <th>Camp. Activity</th>
		                            <th>Kids Age</th>
		                            <!-- <th>Child No.</th>
		                            <th>Family Mem.</th> -->
		                            <!-- <th>Child1 Age</th>
		                            <th>Child2 Age</th>
		                            <th>Child3 Age</th>
		                            <th>Prefered Brand</th> -->
		                            
		                            <!-- <th>Agent</th> -->
		                            <th>Created or Updated</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($profiles as $profile)
		                        <tr>
		                            <!-- <td>{{ ++$i }}</td> -->
		                            <td>{{ $profile->id }}</td>
		                            <td>{{ $profile->phone_number }}</td>
		                            <td>{{ $profile->consumer_name }}</td>
		                            <td>{{ $profile->consumer_age }}</td>
		                            <td>{{ $profile->consumer_gender }}</td>
		                            @if(isset($profile->division->name))
		                            	<td>{{ $profile->division->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif
		                            @if(isset($profile->district->name))
		                            	<td>{{ $profile->district->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif
		                            @if(isset($profile->policeStation->name))
		                            	<td>{{ $profile->policeStation->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif
		                            
		                            <td>{{ $profile->address }}</td>
		                            <!-- <td>{{ $profile->alternative_phone_number }}</td> -->
		                            <td>{{ $profile->profession }}</td>
		                            @if(isset($profile->brand))
		                            	<td>{{ $profile->brand->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif
		                            <td>{{ $profile->sec }}</td>
		                            <td>{{ $profile->interested_in_crm }}</td>
		                            <td>{{ $profile->activity_campaign_name }}</td>
		                            <td>{{ $profile->kids_age }}</td>
		                            <!-- <td>{{ $profile->number_of_child }}</td>
		                            <td>{{ $profile->total_family_member }}</td> -->
		                            <?php
		                            	if ($profile->child1_DOB == null) {
		                            		$child1Age = null;
		                            	} else {
		                            		$child1_DOB = $profile->child1_DOB;
			        						$interval1 = date_diff(date_create(), date_create($child1_DOB));
			        						$child1Age = $interval1->format("%yy, %mm, %dd");
		                            	}
				                        
		                            	if ($profile->child2_DOB == null) {
		                            		$child2Age = null;
		                            	} else {
		                            		$child2_DOB = $profile->child2_DOB;
			        						$interval2 = date_diff(date_create(), date_create($child2_DOB));
			        						$child2Age = $interval2->format("%yy, %mm, %dd");
		                            	}

		                            	if ($profile->child3_DOB == null) {
		                            		$child3Age = null;
		                            	} else {
		                            		$child3_DOB = $profile->child3_DOB;
			        						$interval3 = date_diff(date_create(), date_create($child3_DOB));
			        						$child3Age = $interval3->format("%yy, %mm, %dd");
		                            	}
				                    ?>
		                            <!-- <td>{{ $child1Age }}</td>
		                            <td>{{ $child2Age }}</td>
		                            <td>{{ $child3Age }}</td>
		                            <td>{{ $profile->prefered_brand }}</td> -->
		                            
		                            <!-- <td>{{ $profile->agent }}</td> -->
		                            <td>{{ $profile->updated_at }}</td>
		                        </tr>
		                    @endforeach
		                    </tbody>
		                </table>
	                	{!! $profiles->render() !!}
	            	</div>
	            	<!-- <button class="btn btn-success">Export</button> -->
	        	</div>
	        </div>
	    </div>
	</div>
</div>

@endsection

@section('style')
	<style type="text/css">
		ul.pagination li {
    display: inline;
    font-size: 12px;
    font-weight: bold;
}

ul.pagination li a {

    color: black;
    padding: 8px 8px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 4px;
}

ul.pagination li a.active {
    background-color: #4CAF50;
    padding: 8px 8px;
    margin: 4px;
    color: white;
    border: 1px solid #4CAF50;
}

ul.pagination li.active {
    /*background-color: #4CAF50;*/
    background-color: #687282;
    padding: 8px 8px;
    margin: 4px;
    color: white;
    border: 1px solid #4CAF50;
}

/*ul.pagination li a:hover:not(.active) {background-color: #ddd;}*/
ul.pagination li a:hover {background-color: #999999;}

ul.pagination li.disabled {
    /*background-color: #cccccc;*/
    color: #ddd;
    padding: 8px 8px;
    border: 1px solid #ddd;
    margin: 4px;
}
	</style>
@endsection

@section('script')
<!-- <script src="{{ asset('assets/js/jquery.table2excel.js') }}"></script> -->
<script type="text/javascript">
    // $(document).ready(function(){
    //     $('#myTable').DataTable();
    // });

   //  $(function() {
			// 	$("button").click(function(){
			// 	$("#table2excel").table2excel({
			// 		exclude: ".noExl",
   //  				name: "Excel Document Name"
			// 	}); 
			// 	 });
			// });
</script>
@endsection