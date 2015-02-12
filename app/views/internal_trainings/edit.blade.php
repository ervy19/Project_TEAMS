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
					<div class="form-group row">
							<div class="col-sm-4 col-md-4">
								{{ Form::label('date_startlabel','Start Date: ') }}
								<input class="form-control" type="text" id="date_start" name="date_start" value="{{$date_start}}">
								{{ $errors->first('date_start','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time Start: ') }}
								<input class="form-control" type="text" id="time_start_s_edit" name="time_start_s_edit" value="{{$time_start_s_edit}}">
								{{ $errors->first('time_start_s_edit','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time End: ') }}
								<input class="form-control" type="text" id="time_end_s" name="time_end_s" value="{{$time_end_s}}">
								{{ $errors->first('time_end_s','<div class="error-message">:message</div>') }}
							</div>
					</div>
					 <input type="button" value="Add Date" onClick="addInput('dynamicInput');" class="btn btn-primary">
					 	<div class="form-group row" id="dynamicInput">
				     		<br>
					    </div>
					<div class="form-group row">
							<div class="col-sm-4 col-md-4">
								{{ Form::label('date_endlabel','End Date: ') }}
								<input class="form-control" type="text" id="date_end" name="date_end" value="{{$date_end}}">
								{{ $errors->first('date_end','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time Start: ') }}
								<input class="form-control" type="text" id="time_start_e" name="time_start_e" value="{{$time_start_e}}">
								{{ $errors->first('time_start_e','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time End: ') }}
								<input class="form-control" type="text" id="time_end_e" name="time_end_e" value="{{$time_end_s}}">
								{{ $errors->first('time_end_e','<div class="error-message">:message</div>') }}
							</div>
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
						{{ Form::select('organizer_schools_colleges_id', $schoolcollege, 'Select a School or College Organizer', array('id' => 'dd-schoolscolleges', 'class' => 'col-sm-6 col-md-6')) }}
						
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_department_id','Organizing Department: ') }}
						</div>
						{{ Form::select('organizer_department_id', $department, 'Select a Department Organizer', array('id' => 'dd-departments', 'class' => 'col-sm-6 col-md-6')) }}
					
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
			    	<br>

					<div class="form-group row">
						{{ Form::label('isTrainingPlan','Training Plan: ') }}
						&nbsp;&nbsp;
						{{ Form::radio('internal_training[isTrainingPlan]', 1); }}&nbsp;YES
						&nbsp;&nbsp;
						{{ Form::radio('internal_training[isTrainingPlan]', 0); }}&nbsp;NO
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

	$("#dd-schoolscolleges").select2({
	    allowClear: true
	});

	$("#dd-departments").select2({
	    allowClear: true
	});

	$('#date_start').datepicker({
		    format: 'yyyy-mm-dd'
		});

	$('#date_end').datepicker({
		    format: 'yyyy-mm-dd'
		});

	$('#time_start_s_edit').timepicker();
	$('#time_end_s').timepicker();
	$('#time_start_e').timepicker();
	$('#time_end_e').timepicker();

	

	var count = 2;
		function addInput(divName){
			
		    var newdiv = document.createElement('div');
		    newdiv.innerHTML = "<div class='form-group row'><div class='col-sm-4 col-md-4'><b>Date: </b><input class='form-control' type='text' id='date" + count + "' " + "name='date" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time Start: </b><input class='form-control' type='text' id='timestart" + count + "' " + "name='timestart" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time End: </b><input class='form-control' type='text' id='timeend" + count + "' " + "name='timeend" + count + "'></div></div>";

			document.getElementById(divName).appendChild(newdiv);
			document.getElementById('count').value = count;
			var box = "item" + count;
			document.getElementById('items').value = box;
			count++;    
		}

</script>

@stop
