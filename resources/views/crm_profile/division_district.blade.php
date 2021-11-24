{!! Form::select('district_id', $divWiseDistrictList, null, ['class' => 'form-control','placeholder' => 'Select District Name', 'id' => 'district_id']) !!}

<script type="text/javascript">
	$(document).ready(function(){
		    $("#district_id").change(function(){
		        var districtId = $("#district_id").val();
		        //alert("aaaaa");
		        var url = '{{ url("/crm-profile/district-ps-show")}}';
		        $.get(url+'?district_id='+districtId, function (data) {
		        	$("#hide_ps").hide();
	            	$('#district_ps_show').html(data);
	        	});
		    });
		});
</script>