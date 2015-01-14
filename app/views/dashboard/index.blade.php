@extends('layouts.index')

@section('title')
	Dashboard
@stop

@section('page_css')
	{{ HTML::style('assets/css/fullcalendar.min.css'); }}
@stop

@section('content')

<div class="row">
	<div class="col-sm-8 col-md-8">
		<div class="panel">
			<div class="row dashboard">
				<h3>Dashboard</h3>
				<h5>Welcome, User</h5>
			</div>
			<div class="tiles">
				@if($permission)
				<a href="{{ URL::to('users') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-user fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>User Accounts</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('campuses') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-building-o fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Campuses</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('schools_colleges') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-university fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>School & Colleges</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('departments') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-graduation-cap fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Departments</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('positions') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-graduation-cap fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Positions</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('ranks') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-graduation-cap fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Ranks</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('skills_competencies') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-users fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Skills & Competencies</h4>
						</div>
					</div>
				</a>
				@endif
				<a href="{{ URL::to('employees') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-users fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Employees</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('internal_trainings') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-inbox fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Internal Trainings</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('trainings') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-inbox fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>External Trainings</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('training_plan') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-calendar fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Training Plan</h4>
						</div>
					</div>
				</a>
				<a href="{{ URL::to('reports') }}">
					<div class="tile">
						<div class="tile-body">
							<i class="fa fa-area-chart fa-lg"></i>
						</div>
						<div class="tile-object">
							<h4>Summary Reports</h4>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-md-4">
		<div class="panel cal-dashboard">
			<div class="row">
				<h3 class="panel-header"><i class="fa fa-calendar"></i>&nbsp;Calendar</h3>
			</div>
			<div id="calendar" class="calendar-dashboard"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 col-md-8">
		<div class="panel">
			<div class="row">
				<h3 class="panel-header">Latest Activity</h3>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-md-4">
		<div class="panel">
			<div class="row">
				<h3 class="panel-header"><i class="fa fa-pencil-square-o"></i>&nbsp;To Be Accomplished</h3>
			</div>
		</div>
	</div>	
</div>

@stop

@section('page_js')
	{{ HTML::script('assets/js/moment.min.js'); }}
	{{ HTML::script('assets/js/fullcalendar.min.js'); }}

	<script type="text/javascript">
		$(document).ready( function () {
		    $('#calendar').fullCalendar({
		    	header: false,
		    	height: "auto",
		    	contentHeight: "auto"
		    });
		});
	</script>
@stop