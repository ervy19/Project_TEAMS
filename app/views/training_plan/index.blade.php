@extends('layouts.index')

@section('title')
	External Trainings
@stop

@section('page_css')
	{{ HTML::style('assets/css/fullcalendar.min.css'); }}
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>Training Plan</h1>
			<br>
		</div>
	</div>
</div>


<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<div id='calendar'></div>
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
    		});
		});
	</script>
@stop