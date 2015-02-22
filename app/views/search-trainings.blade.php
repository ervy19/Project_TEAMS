<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>CEU HR TEAMS | Search Trainings </title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{ HTML::style('assets/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/css/font-awesome.min.css'); }}

    <!-- BEGIN THEME STYLES -->
    {{ HTML::style('assets/css/general-style.css'); }}
    {{ HTML::style('assets/css/pages-style.css'); }}
    {{ HTML::style('assets/css/fullcalendar.min.css'); }}
	{{ HTML::style('assets/css/datepicker.css'); }}
	{{ HTML::style('assets/css/jquery.timepicker.css'); }}

  </head>

  <body>

      <!-- Fixed navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/') }}"><img src={{asset('assets/img/CEU_logo.jpg')}} alt="logo" class="img-responsive"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav nav-title">
            <li><a>Human Resources TEAMS</a></li>
          </ul>       
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<div class="panel-heading">
				<h1 class="panel-header">Search for Trainings</h1>			
			</div>
			<div id="calendar" class="calendar-tp"></div>
		</div>
	</div>
</div>

	{{ HTML::script('assets/js/jquery.min.js'); }}

    {{ HTML::script('assets/js/bootstrap.min.js'); }}

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