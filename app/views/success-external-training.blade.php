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
					<div class="col-sm-4 col-md-4 submit-guide">
						<i class="fa fa-exclamation-circle fa-lg"></i>&nbsp;Confirmation
					</div>
					<div class="col-sm-4 col-md-4 submit-guide active">
						<i class="fa fa-check-circle fa-lg"></i>&nbsp;Successful
					</div>
			</div>

			<div class="panel submit-et">
				<div class="row">
					<div class="col-sm-12 col-md-12 pta-form">
						<div class="panel">

						<h2 class="panel-header">Submission Successful</h2>
						<br>
						<h5>Employee ID: {{ (string)Session::get('message') }}</h5>
						<br>
						<p>
							Your external training has been submitted. 
						</p>
						<p>
							You may now submit the documentation of your external training to the Human Resources Department Office to complete the process.
						</p>

            <a class="btn btn-primary" href="{{ URL::to('submit-external-training')  }}">Submit A New External Training Record</a>
					<!-- if there are creation errors, they will show here -->
					<!--{{ HTML::ul($errors->all()) }}-->

					

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

    <footer class="footer">
      <div class="container-fluid">
        <p class="text-muted">© 2014 Centro Escolar University Human Resources | Training Evaluation and Monitoring System</p>
      </div>
    </footer>

    <!-- BEGIN CORE JS -->

    {{ HTML::script('assets/js/jquery.min.js'); }}

    {{ HTML::script('assets/js/bootstrap.min.js'); }}

  </body>
</html>