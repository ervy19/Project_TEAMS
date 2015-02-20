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

    <div class="container-fluid">
		<div class="col-sm-12 col-md-12">
			<div class="row submit-et-nav">
					<div class="col-sm-6 col-md-6 submit-guide active">
						<i class="fa fa-edit fa-lg"></i>&nbsp;Submit
					</div>
					<div class="col-sm-6 col-md-6 submit-guide ">
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

					{{ Form::open(array('url' => 'submit-external-training')) }}
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
							<div class="col-sm-5 col-md-5">
								{{ Form::label('datelabel','Date: ') }}
								<input class="form-control" type="text" id="date1" name="date1">
								{{ $errors->first('date1','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('timestartlabel','Time Start: ') }}
								<input class="form-control" type="text" id="timestart1" name="timestart1">
								{{ $errors->first('timestart1','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('timeendlabel','Time End: ') }}
								<input class="form-control" type="text" id="timeend1" name="timeend1">
								{{ $errors->first('timeend1','<div class="error-message">:message</div>') }}
							</div>
						</div>
						<div class="form-group row" id="dynamicInput">
					     
						</div>
						<br>
							<input type="button" value="Add Date" onClick="addInput('dynamicInput');" class="btn btn-primary">
							<input type="button" value="Remove Date" onclick="removeInput('dynamicInput');" class="btn btn-primary">
							<input type="hidden" name="countbox" id="countbox">
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
    {{ HTML::script('assets/js/bootstrap-datepicker.js'); }}
    {{ HTML::script('assets/js/jquery.timepicker.js'); }}


	<script type="text/javascript">
		var employee_number = document.getElementById("employee_number");
		employee_number.value = {{$employee_number}};

		var title = document.getElementById("title");
		title.value = {{$title}};

		var theme_topic = document.getElementById("theme_topic");
		theme_topic.value = {{$theme_topic}};

		var participation = document.getElementById("participation");
		participation.value = {{$participation}};

		var organizer = document.getElementById("organizer");
		organizer.value = {{$organizer}};

		var venue = document.getElementById("venue");
		venue.value = {{$venue}};

		var sc = $('#external-training-on-queue');
		$(sc).change(function() {
			var elem = document.getElementById("selected");
			elem.value = $(sc).val();
		});	

	</script>
	<script>

		$('#date1').datepicker({
		    format: 'MM d, yyyy'
		});

	$('#timestart1').timepicker();
	$('#timeend1').timepicker();

	var count = 1;

		function addInput(divName){
			
			count++;
		    var newdiv = document.createElement('div');
		    newdiv.setAttribute('id', count);
		    newdiv.innerHTML = "<div class='form-group row'><div class='col-sm-5 col-md-5'><b>Date: </b><input class='form-control' type='text' id='date" + count + "' " + "name='date" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time Start: </b><input class='form-control' type='text' id='timestart" + count + "' " + "name='timestart" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time End: </b><input class='form-control' type='text' id='timeend" + count + "' " + "name='timeend" + count + "'></div></div>";

			document.getElementById(divName).appendChild(newdiv);
			
		    $("#date"+count).datepicker({
	 	    	format: 'MM d, yyyy'
	 		});
		    $("#timestart"+count).timepicker();
			$("#timeend"+count).timepicker();

			var box = count;
			document.getElementById('countbox').value = box;
		}

		var cb = count;
		document.getElementById('countbox').value = cb;

		function removeInput(parentDiv, childDiv) {
			childDiv = document.getElementById('countbox').value;
			//http://www.randomsnippets.com/2008/03/26/how-to-dynamically-remove-delete-elements-via-javascript/
			if (document.getElementById(childDiv)) {     
		          var child = document.getElementById(childDiv);
		          var parent = document.getElementById(parentDiv);
		          parent.removeChild(child);
		          count--;
		          document.getElementById('countbox').value = count;
		          	          
		     }
		     else {
		          alert("Child div has already been removed or does not exist.");
		          return false;
		     }
		}

	</script>

  </body>
</html>