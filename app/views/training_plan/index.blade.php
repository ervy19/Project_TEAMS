@extends('layouts.index')

@section('title')
	Training Plan
@stop

@section('page_css')
	{{ HTML::style('assets/css/fullcalendar.min.css'); }}
@stop

@section('breadcrumb')
	<li>Training Plan</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>Training Plan</h1>
		</div>
	</div>
</div>

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<div id="calendar" class="calendar-tp"></div>
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
		    	events: [
		    		@foreach($consecutive_trainings as $key => $value)
		    			{
		    				id: '{{ $value->id }}',
		    				title: "{{ $value->title }}",
		    				start: '{{ $value->start_date }}',
		    				end: '{{ $value->end_date }}'
		    			},
		    		@endforeach
		    		@foreach($separated_trainings as $k => $v)
		    			{
		    				id: "{{ $v['id'] }}",
		    				title: "{{ $v['title'] }}",
		    				start: "{{ $v['start'] }}"
		    			},
		    		@endforeach
		    	],
    			eventClick: function(event) {
			        if (event.id) {
			            window.location = "./internal_trainings/" + event.id;
			        }
			    }

    		});
		});
	</script>
@stop