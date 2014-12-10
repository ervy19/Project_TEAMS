@extends('layouts.index')

@section('title')
	Schools/Colleges
@stop

@section('content')

<div class="row panel">

	<h1>Schools/Colleges</h1>

	<a href="{{ URL::to('schools_colleges/create') }}" class="btn btn-primary">Add School/College</a>

	<br><br>

	<table id="tb-schools_colleges" class="table table-bordered">
		<thead>
			<tr>
				<th>School/College Name</th>
				<th>Number of Employees</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($schools_colleges as $key => $value)
			<tr>
				<td>{{ $value->name }}</td>
				<td>DUMMY</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('schools_colleges/' . $value->id . '/edit') }}">Edit</a>
					&nbsp;&nbsp;
				   {{ Form::open(array('route' => array('schools_colleges.destroy', $value->id), 'method' => 'delete')) }}
				    <button type="submit" class="btn btn-small btn-danger">Archive</button>
				   {{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-schools_colleges').DataTable();
		} );
	</script>
@stop