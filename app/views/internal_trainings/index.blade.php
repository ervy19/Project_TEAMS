@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
@stop

@section('content')

<div class="container panel">

	<h1>Internal Trainings</h1>

	<a href="{{ URL::to('internal_trainings/create') }}" class="btn btn-primary">Add Internal Training</a>

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
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($internaltrainings as $key => $value)
				<td>{{ $value->title }}</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
				<td>Sample</td>
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