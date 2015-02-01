
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>CEU HR TEAMS | Confirm External Training </title>

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
					<div class="col-sm-4 col-md-4 submit-guide">
						<i class="fa fa-edit fa-lg"></i>&nbsp;Submit
					</div>
					<div class="col-sm-4 col-md-4 submit-guide active">
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

						<h2 class="panel-header">Confirm External Training Details</h2>
							
					<!-- if there are creation errors, they will show here -->
					<!--{{ HTML::ul($errors->all()) }}-->

					{{ Form::open(array('url' => 'submit-external-training')) }}

						<div class="form-group row">
							<div class="col-sm-4 col-md-4">
							{{ Form::label('employee_number','Employee Number: ') }}
							{{ Form::text('employee_number', '', array('class' => 'form-control')) }}
							{{ $errors->first('employee_number') }}
							</div>
						</div>

						<div class="form-group row">
							{{ Form::label('title','Title: ') }}
							{{ Form::text('title', '', array('class' => 'form-control')) }}
							{{ $errors->first('title') }}
						</div>

						<div class="form-group row">
							{{ Form::label('theme_topic','Theme/Topic: ') }}
							{{ Form::text('theme_topic', '', array('class' => 'form-control')) }}
							{{ $errors->first('theme_topic') }}
						</div>

						<div class="form-group row">
							{{ Form::label('participation','Participation: ') }}
							{{ Form::text('participation', '', array('class' => 'form-control')) }}
							{{ $errors->first('participation') }}
						</div>

						<div class="form-group row">
							{{ Form::label('organizer','Organizer: ') }}
							{{ Form::text('organizer', '', array('class' => 'form-control')) }}
							{{ $errors->first('organizer') }}
						</div>

						<div class="form-group row">
							{{ Form::label('venue','Venue: ') }}
							{{ Form::text('venue', '', array('class' => 'form-control')) }}
							{{ $errors->first('venue') }}
						</div>

						<div class="form-group row">
							<div class="col-sm-6 col-md-6">
								{{ Form::label('date_start','Date Start: ') }}
								{{ Form::text('date_start', '', array('class' => 'form-control')) }}
								{{ $errors->first('date_start') }}
							</div>
							<div class="col-sm-6 col-md-6">
								{{ Form::label('date_end','Date End: ') }}
								{{ Form::text('date_end', '', array('class' => 'form-control')) }}
								{{ $errors->first('date_end') }}
							</div>
						</div>

						{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

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