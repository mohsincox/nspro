<!DOCTYPE html>
<html>
<head>
	<title>Nestle</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div class="container-fluid mt-1">
		<div class="row">
		    <div class="col-sm-12">
		        <div class="card">
		            <div class="card-header">
		                <h3 class="text-center"><i class="fa fa-list-ul"></i> CRM Information of <code><b><i>{{ $agent }}</i></b></code>, (Sales Force: Yes)</h3>
		            </div>
		            <div class="card-body">
		            	<div class="table-responsive" style="font-size: 12px;">
		                <table id="myTable" class="table table-bordered table-striped table-hover table-condensed">
		                    <thead>
		                        <tr class="">
		                            <th>ID</th>
		                            <th>Agent</th>
		                            <th>Date</th>
		                            <th>Phone</th>
		                            <th>Name</th>
		                            <th>Age</th>
		                            <th>Gender</th>
		                            <!-- <th>Division</th> -->
		                            <th>District</th>
		                            <!-- <th>Police Station</th> -->
		                            <th>Address</th>
		                            <!-- <th>Alt. Ph No</th> -->
		                            <th>Profession</th>
		                            <!-- <th>SEC</th> -->
		                            <!-- <th>Child No.</th>
		                            <th>Family Mem.</th> -->
		                            <th>Child1 Age</th>
		                           <!--  <th>Child2 Age</th>
		                            <th>Child3 Age</th> -->
		                            <!-- <th>Prefered Brand</th> -->
		                            <!-- <th>Brand</th> -->
		                            <th>Product</th>
		                            <!-- <th>Com. Brand Usage</th>
		                            <th>Act or Camp. Name</th>
		                            <th>Source of Knowing</th> -->
		                            <th>CCID</th>
		                            <!-- <th>Sales Force</th> -->
		                            <th>Service Level</th>
		                            <!-- <th>Interested CRM</th> -->
		                            <th>Call Type</th>
		                            <th>Call Quality</th>
		                            <!-- <th>Con. Qua.</th> -->
		                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Verbatim&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
		                            
		                            <th>Edit</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($crms as $crm)
		                        <tr>
		                            <td>{{ $crm->id }}</td>
		                            <td>{{ $crm->agent }}</td>
		                            <td>{{ $crm->created_at }}</td>
		                            <td>{{ $crm->phone_number }}</td>
		                            <td>{{ $crm->profile->consumer_name }}</td>
		                            <td>{{ $crm->profile->consumer_age }}</td>
		                            <td>{{ $crm->profile->consumer_gender }}</td>
		                            <!-- @if(isset($crm->profile->division->name))
		                            	<td>{{ $crm->profile->division->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif -->
		                            @if(isset($crm->profile->district->name))
		                            	<td>{{ $crm->profile->district->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif
		                            <!-- @if(isset($crm->profile->policeStation->name))
		                            	<td>{{ $crm->profile->policeStation->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif -->
		                            
		                            <td>{{ $crm->profile->address }}</td>
		                            <!-- <td>{{ $crm->profile->alternative_phone_number }}</td> -->
		                            <td>{{ $crm->profile->profession }}</td>
		                            <!-- <td>{{ $crm->profile->sec }}</td> -->
		                           <!--  <td>{{ $crm->profile->number_of_child }}</td>
		                            <td>{{ $crm->profile->total_family_member }}</td> -->
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
		                            <!-- <td>{{ $child2Age }}</td>
		                            <td>{{ $child3Age }}</td> -->
		                            <!-- <td>{{ $crm->profile->prefered_brand }}</td> -->
		                            <!-- @if(isset($crm->brand->name))
		                            	<td>{{ $crm->brand->name }}</td>
		                            @else
		                            	<td></td>
		                            @endif -->
		                            <td>{{ $crm->product }}</td>
		                            <!-- <td>{{ $crm->competition_brand_usage }}</td>
		                            <td>{{ $crm->activity_campaign_name }}</td>
		                            <td>{{ $crm->source_of_knowing }}</td> -->
		                            <td>{{ $crm->ccid }}</td>
		                            <!-- <td>{{ $crm->sales_force }}</td> -->
		                            <td>{{ $crm->service_level }}</td>
		                            <!-- <td>{{ $crm->interested_in_crm }}</td> -->
		                            <td>{{ $crm->call_type }}</td>
		                            <td>{{ $crm->call_quality }}</td>
		                            <!-- <td>{{ $crm->contact_qualification }}</td> -->
		                            <td>{{ $crm->verbatim }}</td>
		                            
		                            <td>{!! Html::link("ccid-agent/$crm->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success btn-sm']) !!}</td>
		                        </tr>
		                    @endforeach
		                    </tbody>
		                </table>
		                {{-- {!! $crms->render() !!} --}}
		            </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

<script>
    $('.pagination li').addClass('page-item');
    $('.pagination li a').addClass('page-link');
    $('.pagination span').addClass('page-link');
</script>

</body>
</html>