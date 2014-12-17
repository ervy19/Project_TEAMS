@extends('layouts.index')

@section('title')
	Internal Training Participants
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internaltrainings->id }}">{{ $internaltrainings->title }}</a></li>
	<li>Participants</li>
@stop

@section('content')

	<div class="col-sm-9 col-md-9 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2 class="panel-header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{  $internaltrainings->title }}</h2>
				<div class="col-sm-1 col-md-1">
					<h6>Theme: </h6>
					<h6>Organizer:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->theme_topic }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department of Mathematics</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Venue:</h6>
					<h6>Schedule:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->venue }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->date_start . ' (' . $internaltrainings->time_start . "-" . $internaltrainings->time_end . ") " . " | " . $internaltrainings->date_end . ' (' . $internaltrainings->time_start . "-" . $internaltrainings->time_end . ')' }}</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Format:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->format }}</h5>
				</div>

				<div class="col-sm-12 col-md-12">
					<h6>Objectives:</h6>
					<p>{{ $internaltrainings->objectives }}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Expected Outcome:</h6>
					<p>{{ $internaltrainings->expected_outcome }}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Focus Areas:</h6>
					<div class="tags">
						@if (isset($focusareas))
							@foreach($internaltrainings as $key => $value)
							<a href="#"><h3><span class="label label-default">Instructional Strategy</span></h3></a>
							@endforeach
						@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Skills and Competencies Addressed:</h6>
					<div class="tags">
						@if (isset($scs))
							@foreach($internaltrainings as $key => $value)
							<a href="#"><h3><span class="label label-default">IT Literacy</span></h3></a>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>		
	<div class="col-sm-3 col-md-3 training-sidebar">
		<div class="row panel training-status">
			<h3 class="panel-header">Requirement Status</h3>
			<div class="col-sm-12 col-md-12 requirement">
				<h4>Assessment Form Template</h4>
				<span class="label label-success status">Accomplished</span>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<h4>After Activity Evaluation Report</h4>
				<span class="label label-danger status">Not Yet Accomplished</span>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<h4>Training Effectiveness Report</h4>
				<span class="label label-danger status">Not Yet Accomplished</span>
			</div>
		</div>
		<div class="row panel training-summary">
			<h3 class="panel-header">Report Summary</h3>
			<div class="col-sm-4 col-md-4 summary-name">
				<div class="count">
					10
				</div>
				<div class="title">
					Attendees
				</div>
			</div>
			<div class="col-sm-4 col-md-4 summary-name">
				<div class="count">
					100
				</div>
				<div class="title">
					Attendees
				</div>
			</div>
			<div class="col-sm-4 col-md-4 summary-name">
				<div class="count">
					100
				</div>
				<div class="title">
					Attendees
				</div>
			</div>
			<div class="col-sm-4 col-md-4 summary-name">
				<div class="count">
					10
				</div>
				<div class="title">
					Attendees
				</div>
			</div>
			<div class="col-sm-4 col-md-4 summary-name">
				<div class="count">
					100
				</div>
				<div class="title">
					Attendees
				</div>
			</div>
			<div class="col-sm-4 col-md-4 summary-name">
				<div class="count">
					100
				</div>
				<div class="title">
					Attendees
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}">Speakers</a></li>
				<li role="presentation" class="active"><a href="#">Participants Information</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
				<h1>Participants</h1>

				<a href="#" class="btn btn-primary">Add Participant<i class="fa fa-plus fa-lg add-plus"></i></a>
				<br><br>

				<table id="tb-it_participants" class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Department</th>
							<th>Assessor</th>
							<th>Participation Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Ana Marie O. Afortunado</td>
							<td>Head</td>
							<td>Human Resources</td>
							<td>VP Espino</td>
							<td>
								<span class="label label-danger">No PTA</span>
								<span class="label label-danger">Not Attended</span>
								<span class="label label-danger">No PTE</span>
							</td>
						</tr>
						<tr>
							<td>Erna Yabut</td>
							<td>Vice President</td>
							<td>Research and Evaluation</td>
							<td>N/A</td>
							<td>
								<span class="label label-success">PTA</span>
								<span class="label label-danger">Not Attended</span>
								<span class="label label-danger">No PTE</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-it_participants').DataTable( {

				"aoColumnDefs": [
      				{ "bSortable": false, "aTargets": [ 4 ] }
    			]

		    });
		});
	</script>
@stop