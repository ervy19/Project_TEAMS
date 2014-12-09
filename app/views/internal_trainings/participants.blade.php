@extends('layouts.index')

@section('title')
	Internal Training Participants
@stop

@section('content')

	<div class="col-sm-9 col-md-9 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2 class="panel-header">IQA Orientation</h2>
				<div class="col-sm-1 col-md-1">
					<h6>Theme: </h6>
					<h6>Organizer:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Internal Quality Audit</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department of Mathematics</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Venue:</h6>
					<h6>Schedule:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISO Meeting Room</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;01/10/2015 (1 pm - 5 pm) | 01/11/2015 (1 pm - 5 pm)</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Format:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lecture-workshop</h5>
				</div>

				<div class="col-sm-12 col-md-12">
					<h6>Objectives:</h6>
					<p>Lorem ipsum dolor sit amet, duo aperiri signiferumque ad, vim an laboramus deterruisset. Homero vitupera toribus ex per, eu nec summo liber.</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Expected Outcome:</h6>
					<p>Lorem ipsum dolor sit amet, duo aperiri signiferumque ad, vim an laboramus deterruisset. Homero vitupera toribus ex per, eu nec summo liber.</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Focus Areas:</h6>
					<div class="tags">
						<a href="#"><h3><span class="label label-default">Instructional Strategy</span></h3></a>
						<a href="#"><h3><span class="label label-default">Evaluation of Learning</span></h3></a>
						<a href="#"><h3><span class="label label-default">Curriculum Enrichment</span></h3></a>
						<a href="#"><h3><span class="label label-default">Research in Aid of Instruction</span></h3></a>
						<a href="#"><h3><span class="label label-default">Content Update</span></h3></a>
					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Skills and Competencies Addressed:</h6>
					<div class="tags">
						<a href="#"><h3><span class="label label-default">IT Literacy</span></h3></a>
						<a href="#"><h3><span class="label label-default">Default</span></h3></a>
						<a href="#"><h3><span class="label label-default">Default</span></h3></a>
						<a href="#"><h3><span class="label label-default">Default</span></h3></a>
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
				<li role="presentation"><a href="{{ URL::to('internal_trainings/show') }}">Speakers</a></li>
				<li role="presentation" class="active"><a href="#">Participants Information</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings/after-activity-evaluation') }}">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings/training-effectiveness-report') }}">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			</div>
		</div>
	</div>

@stop