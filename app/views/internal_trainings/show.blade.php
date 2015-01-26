@extends('layouts.index')

@section('title')
	Internal Training - {{ $internaltrainings->title or '---' }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li>{{$internaltrainings->title or '---'}}</li>
@stop

@section('content')

	<div class="col-sm-9 col-md-9 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2 class="panel-header">{{  $internaltrainings->title or '---' }}</h2>
				<div class="col-sm-1 col-md-1">
					<h6>Theme: </h6>
					<h6>Organizer:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->theme_topic or '---' }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $department or '---' }}</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Venue:</h6>
					<h6>Schedule:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->venue or '---' }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->schedule or '---' }}</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Format:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lecture-workshop</h5>
				</div>

				<div class="col-sm-12 col-md-12">
					<h6>Objectives:</h6>
					<p>{{ $internaltrainings->internal_training->objectives or '---'}}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Expected Outcome:</h6>
					<p>{{ $internaltrainings->internal_training->expected_outcome or '---'}}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Focus Areas:</h6>
					<div class="tags">
							<a href="#"><h3><span class="label label-default">Instructional Strategy</span></h3></a>
					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Skills and Competencies Addressed:</h6>
					<div class="tags">
						<a href="#"><h3><span class="label label-default">IT Literacy</span></h3></a>
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
				<span class="label label-danger status">Not Yet Available</span>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<h4>Training Effectiveness Report</h4>
				<span class="label label-danger status">Not Yet Available</span>
			</div>
		</div>
		<div class="row panel training-status">
			<h3 class="panel-header">Training Information</h3>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/speakers" class="btn btn-primary">View Speakers</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/participants" class="btn btn-primary">View Participants</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/after-activity-evaluation/accomplish" class="btn btn-primary">View After Activity Evaluation</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/training-effectiveness-report" class="btn btn-primary">View After Activity Evaluation</a>
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

	
@stop