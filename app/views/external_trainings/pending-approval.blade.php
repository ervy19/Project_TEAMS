@extends('layouts.index')

@section('title')
	External Trainings | Pending Approval
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>External Trainings</h1>
			<br>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
					<ul class="nav nav-tabs nav-justified">
						<li role="presentation"><a  href="{{ URL::to('external_trainings') }}">Credited</a></li>
						<li role="presentation" class="active"><a>Pending Approval</a></li>
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
								@foreach($externaltrainingsqueue as $key => $value)
								<tr>				
									<td>{{ $value->title }}</td>
									<td>{{ $value->theme_topic }}</td>
									<td>{{ $value->participation }}</td>
									<td>{{ $value->organizer }}</td>
									<td>{{ $value->venue }}</td>
									<td>{{ $value->date_start . " - " . $value->date_end }}</td>
									<td>{{ $value->designation_id }}</td>
									<td>
										<a class="btn btn-small btn-info" href="">Credit</a>
										&nbsp;&nbsp;
										<a class="btn btn-small btn-info" href="">Reject</a>
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