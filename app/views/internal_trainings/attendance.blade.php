
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>CEU HR TEAMS | Attendance - </title>

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
			<div class="panel">
				<div class="row">
					<h2 class="panel-header attendance-title">{{ $title or '---' }}</h2>
					<p>{{ $id or '---' }}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="col-sm-4 col-md-4 training-info">
			<div class="panel">
				<div class="row training-details">
						<!-- if there are creation errors, they will show here -->
						<!--{{ HTML::ul($errors->all()) }}-->

						{{ Form::open(array('url' => 'internal-training/attendance')) }}

							<div class="form-group row">
								<div class="col-sm-12 col-md-12">
								{{ Form::label('employee_number','Employee Number: ') }}
								{{ Form::text('employee_number', '', array('class' => 'form-control', 'placeholder' => 'Employee Number')) }}
								{{ $errors->first('employee_number') }}
								</div>
							</div>

							{{ Form::submit('Register', array('class' => 'btn btn-primary')) }}

						{{ Form::close() }}
				</div>
			</div>
		</div>
		<div class="col-sm-8 col-md-8 training-sidebar">
			<div class="row panel training-status">
				<h3>Employee Number:</h3>
				<h3>Name:</h3>
				
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

    <script type="text/javascript">

    	$(document).ready( function () {

    		var id = $(this).attr('data-id');

			var form = $('form[data-update]');
			var method = form.find('input[name="_method"]').val() || 'POST';
			var url = form.prop('action');

    		$.ajax({
				type: method,
				url: url,
				data: form.serialize(),
				success: function(data) {
					if(data.success)
					{
					
					}
					else
					{
						$('.error-message').empty();
						$('#error-addcampus-name').append(data.errors.name);
						$('#error-addcampus-address').append(data.errors.address);
					}
				}
			});
    	});

    </script>

  </body>
</html>