@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">User and Role</div>

				<div class="card-body">
					<table id="myTable" class="table table-striped table-bordered table-hover">
						<thead>
							<tr class="success">
								<th>SL</th>
								<th>Name</th>
								<th>Email</th>
								<th>Active</th>
								<th>Role</th>
								<th>Phone Number</th>
								<th>Address</th>
								@can('admin-access')
									<th>Edit</th>
                    			@endcan
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<?php
								if ($user->role == 'super_admin') {
									$role = "Super Admin";
								} else if ($user->role == 'admin') {
									$role = "Admin";
								} else if ($user->role == 'supervisor') {
									$role = "Supervisor";
								} else {
									$role = "User";
								}

								if ($user->active == 1) {
									$active = 'Yes';
								} else {
									$active = 'No';
								}
							?>	
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $active }}</td>
								<td>{{ $role }}</td>
								<td>{{ $user->phone_number }}</td>
								<td>{{ $user->address }}</td>
								@can('admin-access')
									<td><a href='{{"user/$user->id/edit"}}' class="btn btn-success btn-sm">Change Role</a></td>
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
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
@endsection