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
		<div class="panel-heading">
			<h1>Trainings</h1>
			@if($isAdminHR)
				<a href="{{ URL::to('internal_trainings/create') }}" class="btn btn-primary pull-right">Add Internal Training<i class="fa fa-plus fa-lg add-plus"></i></a>
			@endif
		</div>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a>Internal Trainings</a></li>
				<li role="presentation"><a href="{{ URL::to('external_trainings') }}">External Trainings</a></li>
				@if($isAdminHR)
				<li role="presentation"><a href="{{ URL::to('external_trainings/queue') }}">External Trainings in Queue</a></li>
				@endif
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
										<th>Schedule</th>
										<th>Organizer</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(isset($internaltrainings))
										@foreach($internaltrainings as $key => $value)
										<tr>
											<td>{{ $value->title }}</td>
											<td>{{ $value->theme_topic }}</td>
											<td>{{ $value->date_scheduled . " (" . $value->timeslot . ")" }}</td>
											<td>{{ $value->name }}</td>
											<td>
												<a class="btn btn-small btn-primary btn-view" href="{{ URL::to('internal_trainings/' . $value->training_id) }}"><i class="fa fa-file-text-o"></i>&nbsp;View</a>
												@if($isAdminHR)
												<a class="btn btn-small btn-info btn-edit" href="{{ URL::to('internal_trainings/' . $value->training_id . '/edit') }}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
											   {{ Form::open(array('route' => array('internal_trainings.destroy', $value->training_id), 'class' => 'form-archive', 'method' => 'delete')) }}
											   	<button type="submit" class="btn btn-small btn-danger"><i class="fa fa-trash"></i>&nbsp;Archive</button>
											   {{ Form::close() }}
											   @endif
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
				@if($isAdminHR)
			      { "sWidth": "23%", "aTargets": [ 0 ] },
			      { "sWidth": '20%', "aTargets": [ 1 ] },
			      { "sWidth": '20%', "aTargets": [ 2 ] },
			      { "sWidth": '20%', "aTargets": [ 3 ] },
			      { "sWidth": '17%', "aTargets": [ 4 ] }
			    @else
			      { "sWidth": "25%", "aTargets": [ 0 ] },
			      { "sWidth": '20%', "aTargets": [ 1 ] },
			      { "sWidth": '15%', "aTargets": [ 2 ] },
			      { "sWidth": '20%', "aTargets": [ 3 ] },
			      { "sWidth": '10%', "aTargets": [ 4 ] }
			    @endif
			    ]
		    });
		});
	</script>
@stop