<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>CEU HR TEAMS | Login </title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{ HTML::style('assets/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/css/font-awesome.min.css'); }}

    <!-- BEGIN THEME STYLES -->
    {{ HTML::style('assets/css/general-style.css'); }}
    {{ HTML::style('assets/css/login-style.css'); }}

  </head>

  <body>

    @if(isset($error))
    <div>{{ $error }}</div>
    @endif

	<div class="login">
		<div class="row panel">
            {{ Form::open(array('url'=>'/', 'class' => 'form-signin')) }}
	  			<div class="form-group">
	  				<img src={{asset('assets/img/CEU_logo.jpg')}} alt="logo" class="img-responsive ceu-logo">
		  			<h2>Human Resources</h2>
		  			<h4>Training Evaluation and Monitoring System</h4>
	  			</div>
	  			<div class="input-group margin-bottom-sm">
				  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
				  <input id="inputEmail" name="email" class="form-control" type="text" placeholder="Email Address">
				</div>
				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
				  <input type="password" id="inputPassword" name="password" class="form-control" type="password" placeholder="Password">
				</div>
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		        <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Forgot your password?</a><span class="clearfix"></span>
            {{ Form::close() }}
	  </div>
	</div>
  
    <!-- BEGIN CORE JS -->

    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); }}

    {{ HTML::script('assets/js/bootstrap.min.js'); }}

  </body>
</html>