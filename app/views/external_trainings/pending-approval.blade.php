@extends('layouts.index')

@section('title')
	External Trainings | Pending Approval
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>External Trainings in Queue</h1>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
					<ul class="nav nav-tabs nav-justified">
						<li role="presentation"><a  href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
						<li role="presentation"><a  href="{{ URL::to('external_trainings') }}">External Trainings</a></li>
						<li role="presentation" class="active"><a>External Trainings in Queue</a></li>
					</ul>
					<div class="training-contents">
					<div class="col-sm-12 col-md-12">
					<div class="panel">
						<div class="row">
						<table id="tb-external_trainings" class="table table-bordered">
							<thead>
								<tr>
									<th>Employee Name</th>
									<th>Title</th>
									<th>Theme/Topic</th>
									<th>Participation</th>
									<th>Organizer</th>
									<th>Venue</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@if(isset($externaltrainingsqueue))
								@foreach($externaltrainingsqueue as $key => $value)
								<tr>				
									<td>{{ $value->given_name . ' ' . $value->middle_initial . ' ' . $value->last_name }}</td>
									<td>{{ $value->title }}</td>
									<td>{{ $value->theme_topic }}</td>
									<td>{{ $value->participation }}</td>
									<td>{{ $value->organizer }}</td>
									<td>{{ $value->venue }}</td>
									<td>{{ $value->date_scheduled . " (" . $value->timeslot . ")" }}</td>
									<td>
										<a class="btn btn-small btn-info" href="{{ URL::to('external_trainings/' . $value->id . '/credit-external-training') }}">Credit</a>
										<br><br>
										<a class="btn btn-small btn-danger" href="">Reject</a>
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
		    $('#tb-external_trainings').DataTable();
		} );
	</script>
@stop