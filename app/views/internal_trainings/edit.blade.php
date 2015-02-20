-@extends('layouts.index')

@section('title')
	Update Internal Training Information - {{ $internaltrainings->title or '' }}
@stop

@section('page_css')
	{{ HTML::style('assets/css/datepicker.css'); }}
	{{ HTML::style('assets/css/datepicker.css'); }}
	{{ HTML::style('assets/css/jquery.timepicker.css'); }}
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h2>Update Internal Training Information</h2>
			<h4>{{ $internaltrainings->title or '---' }}</h4>
		</div>
	</div>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				{{ Form::model($internaltrainings, array('route' => array('internal_trainings.update', $internaltrainings->id), 'method' => 'PUT')) }}

					<div class="form-group row">
						{{ Form::label('title','Title: ') }}
						{{ Form::text('title', $internaltrainings->title, array( 'class' => 'form-control')) }}
						{{ $errors->first('title') }}
					</div>

					<div class="form-group row">
						{{ Form::label('theme_topic','Theme/Topic: ') }}
						{{ Form::text('theme_topic', $internaltrainings->theme_topic, array( 'class' => 'form-control')) }}
						{{ $errors->first('theme_topic') }}
					</div>

					<div class="form-group row">
						{{ Form::label('venue','Venue: ') }}
						{{ Form::text('venue', $internaltrainings->venue, array( 'class' => 'form-control')) }}
						{{ $errors->first('venue') }}
					</div>
					@foreach ($schedules as $value)
					<div class="form-group row">
							<div class="col-sm-4 col-md-4">
								{{ Form::label('date_startlabel','Date: ') }}
								<input class="form-control" type="text" id="{{"date" . $value["count"]}}" name="{{"date" . $value["count"]}}" value="{{ $value["date"] }}">
								{{ $errors->first('date_start','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time Start: ') }}
								<input class="form-control" type="text" id="{{"timestart" . $value["count"]}}" name="{{"timestart" . $value["count"]}}" value="{{ $value["timestart"] }}">
								{{ $errors->first('time_start_s','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time End: ') }}
								<input class="form-control" type="text" id="{{"timeend" . $value["count"]}}" name="{{"timeend" . $value["count"]}}" value="{{ $value["timeend"] }}">
								{{ $errors->first('time_end_s','<div class="error-message">:message</div>') }}
							</div>
					@endforeach
							<br>
							<input type="button" value="Add Date" onClick="addInput('dynamicInput');" class="btn btn-primary">
							<input type="button" value="Remove Date" onclick="removeInput('dynamicInput');" class="btn btn-primary">
					</div>
					<div class="form-group row" id="dynamicInput">
					     <br>
					</div>
					
					<div class="form-group row">
						{{ Form::label('format','Format: ') }}
						{{ Form::text('format', $internaltraining->format, array( 'class' => 'form-control')) }}
						{{ $errors->first('format') }}
					</div>
					<div class="form-group row">
						{{ Form::label('objectiveslabel','Objectives: ') }}
						{{ Form::textarea('objectives', $internaltraining->objectives, array( 'class' => 'form-control', 'rows' => '3')) }}
						{{ $errors->first('objectives') }}
					</div>

					<div class="form-group row">
						{{ Form::label('expected_outcomelabel','Expected Outcome: ') }}
						{{ Form::textarea('expected_outcome', $internaltraining->expected_outcome, array( 'class' => 'form-control', 'rows' => '3')) }}
						{{ $errors->first('expected_outcome') }}
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_schools_colleges_id','Organizing School/College: ') }}
						</div>
						{{ Form::select('schoolcollege', withEmpty($schoolcollege), 'Select a School or College Organizer', array('id' => 'schoolcollege', 'class' => 'col-sm-6 col-md-6')) }}
						
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_department_id','Organizing Department: ') }}
						</div>
						{{ Form::select('department', withEmpty($department), 'Select a Department Organizer', array('id' => 'department', 'class' => 'col-sm-6 col-md-6')) }}
					
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('sc','Tagged Skills and Competencies: ') }}
						<div>
						<select multiple id="skills_competencies_itraining_edit" style="width: 300px">
				      		@foreach($sc as $key => $value)
				        		<option> {{ $value }} </option>
				      		@endforeach
			      		</select>
			    	</div>
			    	<input type="hidden" name="it_sc_edit" id="it_sc_edit">
			    	<input type="hidden" name="countbox" id="countbox">
			    	<br>

					<div class="form-group row">
						{{ Form::label('isTrainingPlan','Training Plan: ') }}
						{{ Form::radio('isTrainingPlan', 1); }}YES
						{{ Form::radio('isTrainingPlan', 0); }}NO
						{{ $errors->first('isTrainingPlan') }}
					</div>


					{{ Form::submit('Save Information', array('class' => 'btn btn-primary pull-right')) }}
					<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary pull-right">Back</a>
					<br><br><br>

				{{ Form::close() }}

			</div>
		</div>
	</div>

</div>

@stop

@section('page_js')

    {{ HTML::script('assets/js/bootstrap-datepicker.js'); }}
    {{ HTML::script('assets/js/jquery.timepicker.js'); }}

<script>
	//Set values of form elements
	var pausecontent = new Array();
	    <?php foreach($currentscs as $key => $val){ ?>
	        pausecontent.push('<?php echo $val; ?>');
	    <?php } ?>
    	$('#skills_competencies_itraining_edit').select2('val',pausecontent);

    var initial = $('#skills_competencies_itraining_edit');
		var hiddensc = document.getElementById("it_sc_edit");
		hiddensc.value = $(initial).val();	

    var itscedit = $('#skills_competencies_itraining_edit');
	$(itscedit).change(function() {
		var iteditsc = document.getElementById("it_sc_edit");
		iteditsc.value = $(itscedit).val();
	});	

	var schcol = {{$sschoolcollege}};
	var schbox = document.getElementById("schoolcollege");
	schbox.value = schcol;

	var sdept = {{$sdepartment}};
	var deptbox = document.getElementById("department");
	deptbox.value = sdept;

	//layouts
	$("#schoolcollege").select2({
	    allowClear: true
	});

	$("#department").select2({
	    allowClear: true
	});

	//Initial div
	$('#date1').datepicker({
		    format: 'MM d, yyyy'
		});
	$('#timestart1').timepicker();
	$('#timeend1').timepicker();

	//Current dates
	var totalcount = {{ $totalcount }};
	var count = parseInt(totalcount);

	for (i = 0; i < count; i++) 
	{ 
    	$("#date"+i).datepicker({
	 	    	format: 'MM d, yyyy'
	 		});
		$("#timestart"+i).timepicker();
		$("#timeend"+i).timepicker();
	}

	//Functions
		function addInput(divName){
			
			count++;
		    var newdiv = document.createElement('div');
		    newdiv.setAttribute('id', count);
		    newdiv.innerHTML = "<div class='form-group row'><div class='col-sm-4 col-md-4'><b>Date: </b><input class='form-control' type='text' id='date" + count + "' " + "name='date" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time Start: </b><input class='form-control' type='text' id='timestart" + count + "' " + "name='timestart" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time End: </b><input class='form-control' type='text' id='timeend" + count + "' " + "name='timeend" + count + "'></div></div>";

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

@stop
