@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Internal Trainings</h1>

			<a href="{{ URL::to('internal_trainings/create') }}" class="btn btn-primary">Add Internal Training<i class="fa fa-plus fa-lg add-plus"></i></a>
			</div>
			<br><br>

			<table id="tb-internal_trainings" class="table table-bordered">
				<thead>
					<tr>
						<th><input type="checkbox" id="someCheckbox" name="someCheckbox" /></th>
						<th>Title</th>
						<th>Theme/Topic</th>
						<th>Venue</th>
						<th>Schedule</th>
						<th>Organizer</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($internaltrainings as $key => $value)
					<tr>
						<td><input type="checkbox" id="someCheckbox" name="someCheckbox" /></td>
						<td>{{ $value->title }}</td>
						<td>{{ $value->theme_topic }}</td>
						<td>{{ $value->venue }}</td>
						<td>{{ $value->date_start . "-" . $value->date_end }}</td>
						<td>{{ $value->organizer_schools_colleges_id }}&nbsp;/&nbsp;{{ $value->organizer_department_id }}</td>
						<td>
							<a class="btn btn-small btn-info" href="{{ URL::to('internal_trainings/' . $value->id) }}">View</a>
							&nbsp;&nbsp;
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
		<br><br>

		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-internal_trainings').DataTable( {

				"aoColumnDefs": [
      				{ "bSortable": false, "aTargets": [ 0 ] }
    			]

		    });
		});
	</script>
@stop