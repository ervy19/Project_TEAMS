@extends('layouts.index')

@section('title')
	Schools/Colleges
@stop

@section('content')

	<h1>Schools/Colleges</h1>

	<a href="{{ URL::to('schools_colleges/create') }}" class="btn btn-primary">Add School/College</a>

	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>School/College Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($schools_colleges as $key => $value)
			<tr>
				<td>{{ $value->name }}</td>
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

@stop