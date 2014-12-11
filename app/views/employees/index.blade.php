@extends('layouts.index')

@section('title')
	Employees
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="row panel">

		<h1>Employees</h1>

		<a href="{{ URL::to('employees/create') }}" class="btn btn-primary">Add Employee</a>

		<br><br>

		<table id="tb-employees" class="table table-bordered">
			<thead>
				<tr>
					<th>Employee Number</th>
					<th>Name</th>
					<th>Email</th>
					<th>Age</th>
					<th>Tenure</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($employees as $key => $value)
				<tr>
					<td>{{ $value->employee_number }}</td>
					<td>{{ $value->last_name . ', ' . $value->given_name . " " . $value->middle_initial }}</td>
					<td>{{ $value->email }}</td>
					<td>{{ $value->age }}</td>
					<td>{{ $value->tenure }}</td>
					<td>
						<a class="btn btn-small btn-info" href="{{ URL::to('employees/' . $value->id . '/edit') }}">Edit</a>
						&nbsp;&nbsp;
					   {{ Form::open(array('route' => array('employees.destroy', $value->id), 'method' => 'delete')) }}
					    <button type="submit" class="btn btn-small btn-danger">Archive</button>
					   {{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-employees').DataTable();
		} );
	</script>
@stop