@extends('layouts.index')

@section('title')
	Campuses
@stop

@section('breadcrumb')
	<li>Campuses</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

		<h1>Campuses</h1>

		<a href="{{ URL::to('campuses/create') }}" class="btn btn-primary">Add Campus<i class="fa fa-plus fa-lg add-plus"></i></a>

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
		</div>
	</div>
</div>

@stop