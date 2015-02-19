@extends('layouts.index')

@section('title')
	Employee - {{ $employees->full_name }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('employees') }}">Employees</a></li>
	<li>{{  $employees->full_name }}</li>
@stop

@section('content')

	<div class="col-sm-9 col-md-9 employee-info">
		<div class="panel">
			<div class="row employee-details">
				<h4 class="information-header">{{  $employees->employee_number or 'NN-0011-111' }}</h4>
				<h2 class="panel-header information-header">{{  $employees->full_name }}</h2>
				<div class="line-division"></div>
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="col-sm-1 col-md-1">
							<h6 class="email">Email:</h6>
						</div>
						<div class="col-sm-11 col-md-11">
							<h5 class="email">{{ $employees->email or '---' }}</h5>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="col-sm-1 col-md-1">
							<h6>Age:</h6>
						</div>
						<div class="col-sm-3 col-md-3">
							<h5>{{ $employees->age or '---' }}</h5>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="col-sm-2 col-md-2">
								<h6>Status:</h6>
								<h6>Tenure:</h6>
							</div>
							<div class="col-sm-10 col-md-10">
								<h5>{{ $employees->status or 'NON-PERMANENT' }}</h5>
								<h5>{{ $employees->tenure or '---' }}</h5>
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
				<a href="{{ URL::to('employees') }}/{{$employees->id}}/individual-training-report" class="btn btn-primary">View Employee's Trainings</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="{{ URL::to('employees') }}/{{$employees->id}}/training-log" class="btn btn-primary">View Employee's Training Report</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="{{ URL::to('employees') }}/{{$employees->id}}/training-log-download" class="btn btn-primary">Download Employee's Training Log</a>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 employee-info">
			<div class="panel">
				<div class="row employee-details">
					<h5 class="has-designation">Employee Designations</h5>
				</div>
			</div>
		</div>

	@if($designations)
		@if(count($designations) > 1)
			@foreach( $designations as $key => $value)
			<div class="col-sm-12 col-md-12 employee-info">
				<div class="panel">
					<div class="row employee-details">
						<h3>&nbsp;&nbsp;{{ $value->title or 'Designation Title' }}</h3>
						<h4>&nbsp;&nbsp;Supervisor: &nbsp;{{ $value->supervisor_name or 'Supervisor Name' }}</h4>
						<div class="col-sm-5 col-md-5">
							<div class="row designation">
								<h6 class="employee-designation">Classification:</h6>
								<h5 class="employee-designation">&nbsp;&nbsp;{{ $value->classification or 'Classification' }}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">Position:</h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value->position_title or 'Position Title' }}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">Rank:</h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value->rank_title or 'Rank Title' }}</h5>
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							<div class="row designation">
								<h6 class="employee-designation">Campus: </h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value->campus_name or 'Campus Name'}}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">School/College: </h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;{{ $value->schoolcollege_name or 'Campus Name'}}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">Department: </h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value->department_name or 'Campus Name'}}</h5>
							</div>
						</div>
						<h6 class="employee-designation">Needed Skills and Competencies:</h6>
						<div class="tags">
								@if(count($designations->department_scs) > 1)
									@foreach($designations->department_scs as $k => $v)
										<h3><span class="label label-default">{{ $v->name }}</span></h3>
									@endforeach
								@else
									<h3><span class="label label-default">{{ $designations->department_scs->name }}</span></h3>
								@endif

								@if(count($designations->position_scs) > 1)
									@foreach($designations->position_scs as $k => $v)
										<h3><span class="label label-default">{{ $v->name }}</span></h3>
									@endforeach
								@else
									<h3><span class="label label-default">{{ $designations->position_scs->name }}</span></h3>
								@endif
						</div>
					</div>
				</div>
			</div>	
			@endforeach
		@else
			<div class="col-sm-12 col-md-12 employee-info">
				<div class="panel">
					<div class="row employee-details">
						<h3>&nbsp;&nbsp;{{ $designations->title or 'Designation Title' }}</h3>
						<h4>&nbsp;&nbsp;Supervisor: &nbsp;{{ $designations->supervisor_name or 'Supervisor Name' }}</h4>
						<div class="col-sm-5 col-md-5">
							<div class="row designation">
								<h6 class="employee-designation">Classification:</h6>
								<h5 class="employee-designation">&nbsp;&nbsp;{{ $designations->classification or 'Classification' }}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">Position:</h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designations->position_title or 'Position Title' }}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">Rank:</h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designations->rank_title or 'Rank Title' }}</h5>
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							<div class="row designation">
								<h6 class="employee-designation">Campus: </h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designations->campus_name or 'Campus Name'}}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">School/College: </h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;{{ $designations->schoolcollege_name or 'Campus Name'}}</h5>
							</div>
							<div class="row designation">
								<h6 class="employee-designation">Department: </h6>
								<h5 class="employee-designation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $designations->department_name or 'Campus Name'}}</h5>
							</div>
						</div>
						<h6 class="employee-designation">Needed Skills and Competencies:</h6>
						<div class="tags">
								@if(count($designations->department_scs) > 1)
									@foreach($designations->department_scs as $k => $v)
										<h3><span class="label label-default">{{ $v->name }}</span></h3>
									@endforeach
								@else
									<h3><span class="label label-default">{{ $designations->department_scs->name }}</span></h3>
								@endif

								@if(count($designations->position_scs) > 1)
									@foreach($designations->position_scs as $k => $v)
										<h3><span class="label label-default">{{ $v->name }}</span></h3>
									@endforeach
								@else
									<h3><span class="label label-default">{{ $designations->position_scs->name }}</span></h3>
								@endif
						</div>
					</div>
				</div>
			</div>
		@endif
	@else
		<div class="col-sm-12 col-md-12 employee-info">
			<div class="panel">
				<div class="row employee-details">
					<h5 class="no-designation">Employee has no designations.</h5>
				</div>
			</div>
		</div>
	@endif
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