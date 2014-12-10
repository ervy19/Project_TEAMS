@extends('layouts.index')

@section('title')
	External Trainings
@stop

@section('content')

<div class="row panel">

	<h1>External Trainings</h1>

	<a href="{{ URL::to('external_trainings/create') }}" class="btn btn-primary">Add External Training</a>

	<br><br>

	<table id="tb-external_trainings" class="table table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Theme/Topic</th>
				<th>Participation</th>
				<th>Organizer</th>
				<th>Venue</th>
				<th>Date</th>
				<th>Designation ID</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($externaltrainings as $key => $value)
			<tr>				
				<td>{{ $value->title }}</td>
				<td>{{ $value->theme_topic }}</td>
				<td>{{ $value->participation }}</td>
				<td>{{ $value->organizer }}</td>
				<td>{{ $value->venue }}</td>
				<td>{{ $value->date_start . " - " . $value->date_end }}</td>
				<td>{{ $value->designation_id }}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('external_trainings/' . $value->id . '/edit') }}">Edit</a>
					&nbsp;&nbsp;
				   {{ Form::open(array('route' => array('external_trainings.destroy', $value->id), 'method' => 'delete')) }}
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
		    $('#tb-external_trainings').DataTable();
		} );
	</script>
@stop