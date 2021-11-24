@extends('layouts.app')

@section('content')
<div class="container mt-1" ng-app="myApp" ng-controller="districtSelectCtrl">
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2">
			<div class="card bg-dark text-white">
				<div class="card-header">
					<h3 class="text-center"><i class="fa fa-pencil"></i> Create Form of <code><b>Police Station Name</b></code> </h3>
				</div>
				<div class="card-body">
			  		<!-- @include('police_station._form') -->

			  		@if(isset($policeStation))
					    {!! Form::model($policeStation, ['url' => "police-station/$policeStation->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
					@else
					    {!! Form::open(['url' => 'police-station', 'method' => 'post', 'class' => 'form-horizontal']) !!}
					@endif
					<div class="form-group required {{ $errors->has('division_id') ? 'has-error' : '' }}">
					    <div class="row"> 
					        {!! Form::label('division_id', 'Select Division Name', ['class' => 'control-label col-sm-3 col-3']) !!}
					        <div class="col-9 col-sm-9">
					        	<div class="col-12 col-sm-12">
					    	        {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control', 'placeholder' => 'Select Division Name', 'ng-model' => 'selectedDivision', 'ng-change' => 'divisionSelect()']) !!}
					    	        <span class="text-danger">
					    	            {{ $errors->first('division_id') }}
					    	        </span>
					            </div>
					        </div>
					    </div>
					</div>

					<div class="form-group required {{ $errors->has('district_id') ? 'has-error' : '' }}">
					    <div class="row">
					        {!! Form::label('district_id', 'Select District Name', ['class' => 'control-label col-sm-3 col-3']) !!}
					        <div class="col-9 col-sm-9">
					            <div class="col-12 col-sm-12">
					                <select class="form-control" name="district_id" >
					                    <option value="">Select District Name</option>
					                    <option ng-repeat="district in districts" value="@{{ district.id }}">@{{ district.name }}</option>
					                </select>
					                <span class="text-danger">
					                    {{ $errors->first('district_id') }}
					                </span>
					            </div>
					        </div>
					    </div>
					</div>

					<div class="required form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					    <div class="row"> 
					        {!! Form::label('name', 'Police Station Name', ['class' => 'col-3 col-sm-3 control-label']) !!}
					        <div class="col-9 col-sm-9">
					        	<div class="col-12 col-sm-12">
					    	        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Police Station Name', 'autocomplete' => 'off']) !!}
					    	        <span class="text-danger">
					    			    {{ $errors->first('name') }}
					    		    </span>
					    		</div>
					        </div>
					    </div>
					</div>

					<div class="form-group">
					    <div class="row">
					        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block text-white']) !!}
					    </div>
					</div>
					{!! Form::close() !!}


				</div>
			</div>
		</div>
	</div>	
</div>	
@endsection

@section('script')
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script>
		var app = angular.module('myApp', []);
		app.controller('districtSelectCtrl', function($scope, $http) {
			$scope.divisionSelect = function() {
			   	console.log($scope.selectedDivision);
			   	$http.get("/nestle-profile/testing?division_id=" + $scope.selectedDivision)
			    	.then(function (response) {$scope.districts = response.data.district_records; });
			}
		});
	</script>
@endsection