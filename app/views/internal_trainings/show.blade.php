@extends('layouts.index')

@section('title')
	Internal Training - $internaltrainings->title
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li>{{ $title }}</li>
@stop

@section('content')

	<div class="col-sm-9 col-md-9 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2 class="panel-header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $title }}</h2>
				<div class="col-sm-1 col-md-1">
					<h6>Theme: </h6>
					<h6>Organizer:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $theme_topic }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $school_college }} </h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Venue:</h6>
					<h6>Schedule:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $venue }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $date_start . ' (' . $time_start . "-" . $time_end . ") " . " | " . $date_end . ' (' . $time_start . "-" . $time_end . ')' }}</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Format:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lecture-workshop</h5>
				</div>

				<div class="col-sm-12 col-md-12">
					<h6>Objectives:</h6>
					<p>{{ $objectives }}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Expected Outcome:</h6>
					<p>{{ $expected_outcome }}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Focus Areas:</h6>
					<div class="tags">
						@foreach($internaltrainings as $key => $value)
							<a href="#"><h3><span class="label label-default">Instructional Strategy</span></h3></a>
						@endforeach
					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Skills and Competencies Addressed:</h6>
					<div class="tags">
						@foreach($internaltrainings as $key => $value)
						<a href="#"><h3><span class="label label-default">IT Literacy</span></h3></a>
						@endforeach
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
		<div class="row panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a>Speakers</a></li>
				
				
			</ul>
			<div class="training-contents">
			</div>
		</div>
	</div>

@stop