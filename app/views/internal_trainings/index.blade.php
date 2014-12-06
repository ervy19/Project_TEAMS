@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('content')

	<h1>Internal Trainings</h1>

	<a href="{{ URL::to('internal_trainings/create') }}" class="btn btn-primary">Add Internal Training</a>

	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Theme/Topic</th>
				<th>Venue</th>
				<th>Date Start</th>
				<th>Date End</th>
				<th>Time Start</th>
				<th>Time End</th>
				<th>Objectvies</th>
				<th>Expected Outcome</th>
				<th>Evaluation Narrative</th>
				<th>Recommendations</th>
				<th>Organizing School/College</th>
				<th>Organizing Department</th>
				<th>Training Plan</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($internaltrainings as $key => $value)
				<td>{{ $value->title }}</td>
				<td>{{ $value->theme_topic }}</td>
				<td>{{ $value->venue }}</td>
				<td>{{ $value->date_start }}</td>
				<td>{{ $value->date_end }}</td>
				<td>{{ $value->time_start }}</td>
				<td>{{ $value->time_end }}</td>
				<td>{{ $value->objectives }}</td>
				<td>{{ $value->expected_outcome }}</td>
				<td>{{ $value->evaluation_narrative }}</td>
				<td>{{ $value->recommendations }}</td>
				<td>{{ $value->organizer_schools_colleges_id }}</td>
				<td>{{ $value->organizer_department_id }}</td>
				<td>{{ $value->isTrainingPlan }}</td>
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

@stop