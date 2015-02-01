@extends('layouts.index')

@section('title')
	Employee - {{ $employees->given_name . ' ' . $employees->middle_initial . '. ' . $employees->last_name }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('employees') }}">Employees</a></li>
	<li>{{  $employees->given_name . ' ' . $employees->middle_initial . '. ' . $employees->last_name }}</li>
@stop

@section('content')

	<div class="col-sm-9 col-md-9 employee-info">
		<div class="panel">
			<div class="row employee-details">
				<h4>&nbsp;&nbsp;{{  $employees->employee_number or 'NN-0011-111' }}</h4>
				<h2 class="panel-header">{{  $employees->given_name . ' ' . $employees->middle_initial . '. ' . $employees->last_name }}</h2>
				
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="col-sm-1 col-md-1">
							<h6>Email:</h6>
						</div>
						<div class="col-sm-11 col-md-11">
							<h5>&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->email or '---' }}</h5>
						</div>
						<div class="col-sm-1 col-md-1">
							<h6>Age:</h6>
						</div>
						<div class="col-sm-3 col-md-3">
							<h5>&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->age or '---' }}</h5>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="col-sm-2 col-md-2">
								<h6>Status:</h6>
								<h6>Tenure:</h6>
							</div>
							<div class="col-sm-10 col-md-10">
								<h5>&nbsp;&nbsp;&nbsp;{{ $employees->status or 'NON-PERMANENT' }}</h5>
								<h5>&nbsp;&nbsp;&nbsp;{{ $employees->tenure or '---' }}</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-3 col-md-3 training-sidebar">
		<div class="row panel training-status">
			<h3 class="panel-header">Employee Training History</h3>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="#" class="btn btn-primary">View Employee's Trainings</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="#" class="btn btn-primary">View Employee's Training Report</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="#" class="btn btn-primary">Download Employee's Training Log</a>
			</div>
		</div>
	</div>

	@if(!(null !== $designations))
		@foreach( $designations as $key => $value)
		<div class="col-sm-12 col-md-12 employee-info">
		<div class="panel">
			<div class="row employee-details">
				<h3>&nbsp;&nbsp;{{ $designations->title or 'Designation Title' }}</h3>
				<h4>&nbsp;&nbsp;Supervisor: {{ $designations->title or 'Supervisor Name' }}</h4>
				<div class="col-sm-5 col-md-5">
					<div class="row designation">
						<h6 class="employee-designation">Classification:</h6>
						<h5 class="employee-designation">&nbsp;&nbsp;{{ $designation->classification or 'Classification' }}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">Position:</h6>
						<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designation->position or 'Position Title' }}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">Rank:</h6>
						<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designation->rank or 'Rank Title' }}</h5>
					</div>
				</div>
				<div class="col-sm-5 col-md-5">
					<div class="row designation">
						<h6 class="employee-designation">Campus: </h6>
						<h5 class="employee-designation">{{ $designation->campus_name or 'Campus Name'}}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">School/College: </h6>
						<h5 class="employee-designation">{{ $designation->campus_name or 'Campus Name'}}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">Department: </h6>
						<h5 class="employee-designation">{{ $designation->campus_name or 'Campus Name'}}</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
		@endforeach
	@else
		<div class="col-sm-12 col-md-12 employee-info">
			<div class="panel">
				<div class="row employee-details">
					<h5 class="no-designation">Employee has no designations.</h5>
				</div>
			</div>
		</div>
	@endif
	<div class="col-sm-12 col-md-12 employee-info">
		<div class="panel">
			<div class="row employee-details">
				<h3>&nbsp;&nbsp;{{ $designations->title or 'Designation Title' }}</h3>
				<h4>&nbsp;&nbsp;Supervisor: {{ $designations->title or 'Supervisor Name' }}</h4>
				<div class="col-sm-5 col-md-5">
					<div class="row designation">
						<h6 class="employee-designation">Classification:</h6>
						<h5 class="employee-designation">&nbsp;&nbsp;{{ $designation->classification or 'Classification' }}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">Position:</h6>
						<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designation->position or 'Position Title' }}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">Rank:</h6>
						<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designation->rank or 'Rank Title' }}</h5>
					</div>
				</div>
				<div class="col-sm-5 col-md-5">
					<div class="row designation">
						<h6 class="employee-designation">Campus: </h6>
						<h5 class="employee-designation">{{ $designation->campus_name or 'Campus Name'}}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">School/College: </h6>
						<h5 class="employee-designation">{{ $designation->campus_name or 'Campus Name'}}</h5>
					</div>
					<div class="row designation">
						<h6 class="employee-designation">Department: </h6>
						<h5 class="employee-designation">{{ $designation->campus_name or 'Campus Name'}}</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-employee-show').DataTable( {

				"aoColumnDefs": [
      				{ "bSortable": false, "aTargets": [ 0 ] }
    			]

		    });

		    $('#tb-internal-trainings').DataTable( {

				"aoColumnDefs": [
      				{ "bSortable": false, "aTargets": [ 0 ] }
    			]

		    });

		    $('#tb-external-trainings').DataTable( {

				"aoColumnDefs": [
      				{ "bSortable": false, "aTargets": [ 0 ] }
    			]

		    });
		});
	</script>
@stop