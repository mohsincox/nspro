@extends('layouts.app')

@section('content')
<div class="container-fluid mt-1" style="height: 600px;">
	<div class="row">
	    <div class="col-sm-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> CRM information of <code><b><i>{{ Auth::user()->name }}</i></b></code> as a <code><b><i>{{ "Field User" }}</i></b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
	                <table id="myTable" class="table table-bordered table-striped table-hover">
	                    <thead>
	                        <tr class="">
	                            <th>SL</th>
	                            <th>Consu. No.</th>
	                            <th>Con Name</th>
	                            <th>Con Age</th>
	                            <th>Con Gender</th>
	                            <th>Division</th>
	                            <th>District</th>
	                            <th>Police Station</th>
	                            <th>Address</th>
	                            <th>Alt. Ph No</th>
	                            <th>Profession</th>
	                            <th>SEC</th>
	                            <th>Child No.</th>
	                            <th>Family Mem.</th>
	                            <th>Child1 Age</th>
	                            <th>Child2 Age</th>
	                            <th>Child3 Age</th>
	                            <th>Prefered Brand</th>
	                           
	                            <th>Com. Brand Usage</th>
	                            <th>Act or Camp. Name</th>
	                            
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        $i = 0;
	                    ?>
	                    @foreach($crms as $crm)
	                        <tr>
	                            <td>{{ ++$i }}</td>
	                            <td>{{ $crm->phone_number }}</td>
	                            <td>{{ $crm->profile->consumer_name }}</td>
	                            <td>{{ $crm->profile->consumer_age }}</td>
	                            <td>{{ $crm->profile->consumer_gender }}</td>
	                            @if(isset($crm->profile->division->name))
	                            	<td>{{ $crm->profile->division->name }}</td>
	                            @else
	                            	<td></td>
	                            @endif
	                            @if(isset($crm->profile->district->name))
	                            	<td>{{ $crm->profile->district->name }}</td>
	                            @else
	                            	<td></td>
	                            @endif
	                            @if(isset($crm->profile->policeStation->name))
	                            	<td>{{ $crm->profile->policeStation->name }}</td>
	                            @else
	                            	<td></td>
	                            @endif
	                            
	                            <td>{{ $crm->profile->address }}</td>
	                            <td>{{ $crm->profile->alternative_phone_number }}</td>
	                            <td>{{ $crm->profile->profession }}</td>
	                            <td>{{ $crm->profile->sec }}</td>
	                            <td>{{ $crm->profile->number_of_child }}</td>
	                            <td>{{ $crm->profile->total_family_member }}</td>
	                            <?php
	                            	if ($crm->profile->child1_DOB == null) {
	                            		$child1Age = null;
	                            	} else {
	                            		$child1_DOB = $crm->profile->child1_DOB;
		        						$interval1 = date_diff(date_create(), date_create($child1_DOB));
		        						$child1Age = $interval1->format("%yy, %mm, %dd");
	                            	}
			                        
	                            	if ($crm->profile->child2_DOB == null) {
	                            		$child2Age = null;
	                            	} else {
	                            		$child2_DOB = $crm->profile->child2_DOB;
		        						$interval2 = date_diff(date_create(), date_create($child2_DOB));
		        						$child2Age = $interval2->format("%yy, %mm, %dd");
	                            	}

	                            	if ($crm->profile->child3_DOB == null) {
	                            		$child3Age = null;
	                            	} else {
	                            		$child3_DOB = $crm->profile->child3_DOB;
		        						$interval3 = date_diff(date_create(), date_create($child3_DOB));
		        						$child3Age = $interval3->format("%yy, %mm, %dd");
	                            	}
			                    ?>
	                            <td>{{ $child1Age }}</td>
	                            <td>{{ $child2Age }}</td>
	                            <td>{{ $child3Age }}</td>
	                            <td>{{ $crm->profile->prefered_brand }}</td>
	                            
	                            <td>{{ $crm->competition_brand_usage }}</td>
	                            <td>{{ $crm->activity_campaign_name }}</td>
	                            
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