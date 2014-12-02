@extends('layouts.index')

@section('title')
	Campuses
@stop

@section('content')

	<h1>Campuses</h1>

	<a href="{{ URL::to('campuses/create') }}" class="btn btn-primary">Add Campus</a>

	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Campus Name</th>
				<th>Campus Address</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($campuses as $key => $value)
			<tr>
				<td>{{ $value->title }}</td>
				<td>{{ $value->address }}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('campuses/' . $value->id . '/edit') }}">Edit</a>
					&nbsp;&nbsp;
				   {{ Form::open(array('route' => array('campuses.destroy', $value->id), 'method' => 'delete')) }}
				    <button type="submit" class="btn btn-small btn-danger">Archive</button>
				   {{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@stop