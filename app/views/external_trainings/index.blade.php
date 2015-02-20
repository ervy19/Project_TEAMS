@extends('layouts.index')

@section('title')
	External Trainings
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>Trainings</h1>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
		<ul class="nav nav-tabs nav-justified">
			<li role="presentation"><a  href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
			<li role="presentation" class="active"><a>External Trainings</a></li>
			@if($isAdminHR)
			<li role="presentation"><a href="{{ URL::to('external_trainings/queue') }}">External Trainings in Queue</a></li>
			@endif
		</ul>
					<div class="training-contents">
					<div class="col-sm-12 col-md-12">
					<div class="panel">
						<div class="row">
						<table id="tb-external_trainings" class="table table-bordered">
							<thead>
								<tr>
									<th>Title</th>
									<th>Theme/Topic</th>
									<th>Participation</th>
									<th>Organizer</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($externaltrainings as $key => $value)
								<tr>				
									<td>{{ $value->title }}</td>
									<td>{{ $value->theme_topic }}</td>
									<td>{{ $value->participation }}</td>
									<td>{{ $value->organizer }}</td>
									<td>{{ $value->date_scheduled . " (" . $value->timeslot . ")" }}</td>
									<td>
										<a class="btn btn-small btn-primary btn-view" href="{{ URL::to('external_trainings/' . $value->training_id) }}"><i class="fa fa-file-text-o"></i>&nbsp;View</a>
										@if($isAdminHR)
										<a class="btn btn-small btn-info btn-edit" href="{{ URL::to('external_trainings/' . $value->training_id . '/edit') }}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
									   	{{ Form::model($externaltrainings, array('route' => array('external_trainings.destroy', $value->training_id), 'method' => 'delete')) }}
									    <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-trash"></i>&nbsp;Archive</button>
									   {{ Form::close() }}
									   @endif
									</td>
								</tr>
								@endforeach
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
		    $('#tb-external_trainings').DataTable();
		} );
	</script>
@stop