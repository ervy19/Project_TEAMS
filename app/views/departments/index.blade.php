@extends('layouts.index')

@section('title')
	Departments
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="row panel">

		<h1>Departments</h1>

		<a href="{{ URL::to('departments/create') }}" class="btn btn-primary">Add Department</a>

		<br><br>

		<table id="tb-departments" class="table table-bordered">
			<thead>
				<tr>
					<th>Department Name</th>
					<th>Department Supervisor</th>
					<th>School/College</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($departments as $key => $value)
				<tr>
					<td>{{ $value->name }}</td>
					<td>Sample</td>
					<td>Sample</td>
					<td>Sample</td>
					<td>
						<a class="btn btn-small btn-info" href="{{ URL::to('departments/' . $value->id . '/edit') }}">Edit</a>
						&nbsp;&nbsp;
					   {{ Form::open(array('route' => array('departments.destroy', $value->id), 'method' => 'delete')) }}
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
		    $('#tb-departments').DataTable();
		} );
	</script>
@stop