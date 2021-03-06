@extends('layouts.index')

@section('title')
	Positions
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Positions</h1>

			<a href="{{ URL::to('positions/create') }}" class="btn btn-primary">Add Position<i class="fa fa-plus fa-lg add-plus"></i></a>

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
					@foreach($positions_array as $value)
					<tr>
						<td>{{ $value["title"] }}</td>
						<td>{{ $value["count"] }}</td>
						<td>
							<a class="btn btn-small btn-info" href="{{ URL::to('positions/' . $value['id'] . '/edit') }}">Edit</a>
							&nbsp;&nbsp;
						   {{ Form::open(array('route' => array('positions.destroy', $value['id']), 'method' => 'delete')) }}
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

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-positions').DataTable();
		} );
	</script>
@stop