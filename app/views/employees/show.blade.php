@extends('layouts.index')

@section('title')
	Employees - {{ $employees->last_name . ', ' . $employees->given_name . " " . $employees->middle_initial }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('employees') }}">Employees</a></li>
	<li>{{ $employees->last_name . ', ' . $employees->given_name . " " . $employees->middle_initial }}</li>
@stop

@section('content')

	<div class="col-sm-9 col-md-9 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2 class="panel-header">{{ $employees->last_name . ', ' . $employees->given_name . " " . $employees->middle_initial }}</h2>
				<div class="col-sm-2 col-md-2">
					<h6>Employee Number:</h6>
					<h6>Name:</h6>
					<h6>Email Address:</h6>
				</div>
				<div class="col-sm-10 col-md-10">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->employee_number }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->last_name . ', ' . $employees->given_name . " " . $employees->middle_initial }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->email }}</h5>
				</div>

				<div class="col-sm-2 col-md-2">
					<h6>Age:</h6>
					<h6>Tenure:</h6>
				</div>
				<div class="col-sm-10 col-md-10">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->age }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $employees->tenure }}</h5>
				</div>

				<div>
					<br>
					<h3>Employee Designations</h3>
					<table id="tb-employee-show" class="table table-bordered">
						<thead>
							<tr>
								<th>Employee Type</th>
								<th>Campus</th>
								<th>School/College</th>
								<th>Department</th>
								<th>Supervisor</th>
								<th>Position</th>
								<th>Rank</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($selected_data as $key => $value)
								<tr>
									<td>{{$value[0]}}</td>
									<td>{{$value[1]}}</td>
									<td>{{$value[2]}}</td>
									<td>{{$value[3]}}</td>
									<td>{{$value[4]}}</td>
									<td>{{$value[5]}}</td>
									<td>{{$value[6]}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div>
					<h3>Internal Trainings Attended</h3>
					<table id="tb-internal-trainings" class="table table-bordered">
						<thead>
							<tr>
								<td>Title</td>
								<td>Theme/Topic</td>
								<td>Venue</td>
								<td>Schedule</td>
							</tr>
						</thead>
						<tbody>
							@foreach($it_attended as $key => $value)
								<tr>
									<td>{{$value->title}}</td>
									<td>{{$value->theme_topic}}</td>
									<td>{{$value->venue}}</td>
									<td>{{$value->schedule}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div>
					<h3>External Trainings Attended</h3>
					<table id="tb-external-trainings" class="table table-bordered">
						<thead>
							<tr>
								<td>Title</td>
								<td>Theme/Topic</td>
								<td>Venue</td>
								<td>Schedule</td>
							</tr>
						</thead>
						<tbody>
							@foreach($et_attended as $key => $value)
								<tr>
									<td>{{$value->title}}</td>
									<td>{{$value->theme_topic}}</td>
									<td>{{$value->venue}}</td>
									<td>{{$value->schedule}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
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