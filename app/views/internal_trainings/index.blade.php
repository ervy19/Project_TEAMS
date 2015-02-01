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
			<br><br>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
			<ul class="nav nav-tabs nav-justified">
						<li role="presentation" class="active"><a>Internal Trainings</a></li>
						<li role="presentation"><a href="{{ URL::to('external_trainings') }}">External Trainings</a></li>
						<li role="presentation"><a href="{{ URL::to('pending_approval') }}">External Trainings in Queue</a></li>
					</ul>
					<div class="training-contents">
					<div class="col-sm-12 col-md-12">
					<div class="panel">
						<div class="row">
							<table id="tb-internal_trainings" class="table table-bordered">
								<thead>
									<tr>
										<th>Title</th>
										<th>Theme/Topic</th>
										<th>Venue</th>
										<th>Schedule</th>
										<th>Organizer</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(isset($internaltrainings))
										@foreach($internaltrainings as $key => $value)
										<tr>
											<th>{{ $value->title }}</th>
											<th>{{ $value->theme_topic }}</th>
											<th>{{ $value->venue }}</th>
											<th>{{ $value->schedule }}</th>
											<th>Organizer</th>
											<td>
												<a class="btn btn-small btn-primary btn-view" href="{{ URL::to('internal_trainings/' . $value->id) }}">View</a>
												<a class="btn btn-small btn-info btn-edit" href="{{ URL::to('internal_trainings/' . $value->id . '/edit') }}">Edit</a>
											   {{ Form::open(array('route' => array('internal_trainings.destroy', $value->id), 'class' => 'form-archive', 'method' => 'delete')) }}
											   	<button type="submit" class="btn btn-small btn-danger">Archive</button>
											   {{ Form::close() }}
											</td>
										</tr>
										@endforeach
									@endif
								</tbody>
							</table>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-internal_trainings').DataTable( {

				"aoColumnDefs": [
			      { "sWidth": "23%", "aTargets": [ 0 ] },
			      { "sWidth": '15%', "aTargets": [ 1 ] },
			      { "sWidth": '15%', "aTargets": [ 2 ] },
			      { "sWidth": '15%', "aTargets": [ 3 ] },
			      { "sWidth": '15%', "aTargets": [ 4 ] },
			      { "sWidth": '17%', "aTargets": [ 5 ] },
			    ]

		    });
		});
	</script>
@stop