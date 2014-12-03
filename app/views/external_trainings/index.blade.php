@extends('layouts.index')

@section('title')
	External Trainings
@stop

@section('content')

	<h1>External Trainings</h1>

	<a href="{{ URL::to('external_trainings/create') }}" class="btn btn-primary">Add External Training</a>

	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Theme/Topic</th>
				<th>Participation</th>
				<th>Organizer</th>
				<th>Venue</th>
				<th>Date Start</th>
				<th>Date End</th>
			</tr>
		</thead>
		<tbody>
			@foreach($externaltrainings as $key => $value)
			<tr>
				<td>{{ $value->name }}</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
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

@stop