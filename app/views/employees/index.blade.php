@extends('layouts.index')

@section('title')
	Employees
@stop

@section('content')

	<h1>Employees</h1>

	<a href="{{ URL::to('employees/create') }}" class="btn btn-primary">Add Employee</a>

	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Employees</th>
				<th>Employee Number</th>
				<th>Name</th>
				<th>Age</th>
				<th>Email</th>
				<th>Tenure</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($employees as $key => $value)
			<tr>
				<td>{{ $value->name }}</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
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

@stop