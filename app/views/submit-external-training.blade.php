<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>CEU HR TEAMS | Submit External Training </title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{ HTML::style('assets/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/css/font-awesome.min.css'); }}

    <!-- BEGIN THEME STYLES -->
    {{ HTML::style('assets/css/general-style.css'); }}
    {{ HTML::style('assets/css/pages-style.css'); }}

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

    <div class="container-fluid">
		<div class="col-sm-12 col-md-12">
			<div class="row submit-et-nav">
					<div class="col-sm-4 col-md-4 submit-guide active">
						<i class="fa fa-edit fa-lg"></i>&nbsp;Submit
					</div>
					<div class="col-sm-4 col-md-4 submit-guide ">
						<i class="fa fa-exclamation-circle fa-lg"></i>&nbsp;Confirmation
					</div>
					<div class="col-sm-4 col-md-4 submit-guide ">
						<i class="fa fa-check-circle fa-lg"></i>&nbsp;Successful
					</div>
			</div>

			<div class="panel submit-et">
				<div class="row">
					<div class="col-sm-12 col-md-12 pta-form">
						<div class="panel">

						<h2 class="panel-header">Submit External Training Details</h2>
							
					<!-- if there are creation errors, they will show here -->
					{{ HTML::ul($errors->all()) }}

					@if ($employee_number === "")
					{{ Form::open(array('url' => 'confirm-external-training')) }}
						<div class="form-group row">
							<div class="col-sm-4 col-md-4">
							{{ Form::label('employee_numberlabel','Employee Number: ') }}
							{{ Form::text('employee_number', '', array('class' => 'form-control')) }}
							</div>
							<div class="col-sm-12 col-md-12">
								{{ $errors->first('employee_number','<div class="error-message">:message</div>') }}
							</div>
						</div>

						<div class="form-group row">
							{{ Form::label('titlelabel','Title: ') }}
							{{ Form::text('title', '', array('class' => 'form-control')) }}
							{{ $errors->first('title','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('theme_topiclabel','Theme/Topic: ') }}
							{{ Form::text('theme_topic', '', array('class' => 'form-control')) }}
							{{ $errors->first('theme_topic','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('participationlabel','Participation: ') }}
							{{ Form::text('participation', '', array('class' => 'form-control')) }}
							{{ $errors->first('participation','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('organizerlabel','Organizer: ') }}
							{{ Form::text('organizer', '', array('class' => 'form-control')) }}
							{{ $errors->first('organizer','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('venuelabel','Venue: ') }}
							{{ Form::text('venue', '', array('class' => 'form-control')) }}
							{{ $errors->first('venue','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							<div class="col-sm-6 col-md-6">
								{{ Form::label('date_startlabel','Start Date: ') }}
								{{ Form::text('date_start', '', array('class' => 'form-control')) }}
								{{ $errors->first('date_start','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-6 col-md-6">
								{{ Form::label('date_endlabel','End Date: ') }}
								{{ Form::text('date_end', '', array('class' => 'form-control')) }}
								{{ $errors->first('date_end','<div class="error-message">:message</div>') }}
							</div>
						</div>
						{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

					@else
						{{ Form::open(array('url' => 'confirm-external-training')) }}
						<div class="form-group row">
							<div class="col-sm-4 col-md-4">
							{{ Form::label('employee_numberlabel','Employee Number: ') }}
							{{ Form::text('employee_number', $employee_number, array('class' => 'form-control')) }}
							</div>
							<div class="col-sm-12 col-md-12">
								{{ $errors->first('employee_number','<div class="error-message">:message</div>') }}
							</div>
						</div>

						<div class="form-group row">
							{{ Form::label('titlelabel','Title: ') }}
							{{ Form::text('title', $title, array('class' => 'form-control')) }}
							{{ $errors->first('title','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('theme_topiclabel','Theme/Topic: ') }}
							{{ Form::text('theme_topic', $theme_topic, array('class' => 'form-control')) }}
							{{ $errors->first('theme_topic','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('participationlabel','Participation: ') }}
							{{ Form::text('participation', $participation, array('class' => 'form-control')) }}
							{{ $errors->first('participation','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('organizerlabel','Organizer: ') }}
							{{ Form::text('organizer', $organizer, array('class' => 'form-control')) }}
							{{ $errors->first('organizer','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							{{ Form::label('venuelabel','Venue: ') }}
							{{ Form::text('venue', $venue, array('class' => 'form-control')) }}
							{{ $errors->first('venue','<div class="error-message">:message</div>') }}
						</div>

						<div class="form-group row">
							<div class="col-sm-6 col-md-6">
								{{ Form::label('date_startlabel','Start Date: ') }}
								{{ Form::text('date_start', $date_start, array('class' => 'form-control')) }}
								{{ $errors->first('date_start','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-6 col-md-6">
								{{ Form::label('date_endlabel','End Date: ') }}
								{{ Form::text('date_end', $date_end, array('class' => 'form-control')) }}
								{{ $errors->first('date_end','<div class="error-message">:message</div>') }}
							</div>
						</div>

						{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

					@endif
					{{ Form::close() }}

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

    <footer class="footer">
      <div class="container-fluid">
        <p class="text-muted">© 2015 Centro Escolar University Human Resources | Training Evaluation and Monitoring System</p>
      </div>
    </footer>

    <!-- BEGIN CORE JS -->

    {{ HTML::script('assets/js/jquery.min.js'); }}

    {{ HTML::script('assets/js/bootstrap.min.js'); }}

  </body>
</html>