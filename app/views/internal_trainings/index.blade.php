@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
@stop

@section('content')

<div class="row panel">

	<h1>Internal Trainings</h1>

	<a href="{{ URL::to('internal_trainings/create') }}" class="btn btn-primary">Add Internal Training</a>

	<br><br>

	<table id="tb-internal_trainings" class="table table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Theme/Topic</th>
				<th>Venue</th>
				<th>Schedule</th>
				<th>Organizing School/College/Department</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($internaltrainings as $key => $value)
			<tr>
				<td>{{ $value->title }}</td>
				<td>{{ $value->theme_topic }}</td>
				<td>{{ $value->venue }}</td>
				<td>{{ $value->date_start . "-" . $value->date_end }}</td>
				<td>{{ $value->organizer_schools_colleges_id }}&nbsp;/&nbsp;{{ $value->organizer_department_id }}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('internal_trainings/' . $value->id . '/edit') }}">Edit</a>
					&nbsp;&nbsp;
				   {{ Form::open(array('route' => array('internal_trainings.destroy', $value->id), 'method' => 'delete')) }}
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
		    $('#tb-internal_trainings').DataTable();
		} );
	</script>
@stop