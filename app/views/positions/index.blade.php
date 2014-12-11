@extends('layouts.index')

@section('title')
	Positions
@stop

@section('content')

<div class="row panel">

	<h1>Positions</h1>

	<a href="{{ URL::to('positions/create') }}" class="btn btn-primary">Add Position</a>

	<br><br>

	<table id="tb-positions" class="table table-bordered">
		<thead>
			<tr>
				<th>Position Title</th>
				<th>Number of Employees Holding the Position</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($positions as $key => $value)
			<tr>
				<td>{{ $value->title }}</td>
				<td>DUMMY</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('positions/' . $value->id . '/edit') }}">Edit</a>
					&nbsp;&nbsp;
				   {{ Form::open(array('route' => array('positions.destroy', $value->id), 'method' => 'delete')) }}
				    <button type="submit" class="btn btn-small btn-danger">Archive</button>
				   {{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@stop