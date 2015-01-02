@extends('layouts.index')

@section('title')
	Trainings
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>Trainings</h1>
			<br>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
					<ul class="nav nav-tabs nav-justified">
						<li role="presentation" class="active"><a>Internal Trainings</a></li>
						<li role="presentation"><a href="{{ URL::to('external_trainings') }}">External Trainings</a></li>
						<li role="presentation"><a href="{{ URL::to('external_trainings/pending-approval') }}">Pending Approval</a></li>
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
									<th>Venue</th>
									<th>Date</th>
									<th>Designation ID</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@if(isset($trainings))
								@foreach($trainings as $key => $value)
								<tr>				
									<td>{{ $value->title }}</td>
									<td>{{ $value->theme_topic }}</td>
									<td>{{ $value->participation }}</td>
									<td>{{ $value->organizer }}</td>
									<td>{{ $value->venue }}</td>
									<td>{{ $value->date_start . " - " . $value->date_end }}</td>
									<td>{{ $value->designation_id }}</td>
									<td>
										<a class="btn btn-small btn-info" href="{{ URL::to('external_trainings/' . $value->id . '/edit') }}">Edit</a>
										&nbsp;&nbsp;
									   {{ Form::open(array('route' => array('external_trainings.destroy', $value->id), 'method' => 'delete')) }}
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
		    $('#tb-trainings').DataTable();
		} );
	</script>
@stop