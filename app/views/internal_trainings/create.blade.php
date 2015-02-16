@extends('layouts.index')

@section('title')
	Add Internal Training
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
			<h2>Add Internal Training</h2>
		</div>
	</div>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">

				{{ Form::open(array('url' => 'internal_trainings', 'class' => 'form-horizontal')) }}

					<div class="form-group row">
						{{ Form::label('title','Title: ') }}
						{{ Form::text('title', '', array( 'class' => 'form-control')) }}
						{{ $errors->first('title') }}
					</div>

					<div class="form-group row">
						{{ Form::label('theme_topic','Theme/Topic: ') }}
						{{ Form::text('theme_topic', '', array( 'class' => 'form-control')) }}
						{{ $errors->first('theme_topic') }}
					</div>

					<div class="form-group row">
						{{ Form::label('venue','Venue: ') }}
						{{ Form::text('venue', '', array( 'class' => 'form-control')) }}
						{{ $errors->first('venue') }}
					</div>
					<div class="form-group row">
							<div class="col-sm-4 col-md-4">
								{{ Form::label('date_startlabel','Start Date: ') }}
								<input class="form-control" type="text" id="date_start" name="date_start">
								{{ $errors->first('date_start','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time Start: ') }}
								<input class="form-control" type="text" id="time_start_s" name="time_start_s">
								{{ $errors->first('time_start_s','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time End: ') }}
								<input class="form-control" type="text" id="time_end_s" name="time_end_s">
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
								<input class="form-control" type="text" id="date_end" name="date_end">
								{{ $errors->first('date_end','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time Start: ') }}
								<input class="form-control" type="text" id="time_start_e" name="time_start_e">
								{{ $errors->first('time_start_e','<div class="error-message">:message</div>') }}
							</div>
							<div class="col-sm-2 col-md-2">
								{{ Form::label('time','Time End: ') }}
								<input class="form-control" type="text" id="time_end_e" name="time_end_e">
								{{ $errors->first('time_end_e','<div class="error-message">:message</div>') }}
							</div>
					</div>
					<div class="form-group row">
						{{ Form::label('format','Format: ') }}
						{{ Form::text('format', '', array( 'class' => 'form-control')) }}
						{{ $errors->first('format') }}
					</div>
					<div class="form-group row">
						{{ Form::label('objectives','Objectives: ') }}
						{{ Form::textarea('objectives', '', array( 'class' => 'form-control', 'rows' => '3')) }}
						{{ $errors->first('objectives') }}
					</div>

					<div class="form-group row">
						{{ Form::label('expected_outcome','Expected Outcome: ') }}
						{{ Form::textarea('expected_outcome', '', array( 'class' => 'form-control', 'rows' => '3')) }}
						{{ $errors->first('expected_outcome') }}
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_schools_colleges_id','Organizing School/College: ') }}
						</div>
						{{ Form::select('schoolcollege', $schoolcollege, 'Select a School or College Organizer', array('id' => 'dd-schoolscolleges', 'class' => 'col-sm-6 col-md-6')) }}
						
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_department_id','Organizing Department: ') }}
						</div>
						{{ Form::select('department', $department, 'Select a Department Organizer', array('id' => 'dd-departments', 'class' => 'col-sm-6 col-md-6')) }}
					
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('sc','Tagged Skills and Competencies: ') }}
						<div>
						<select multiple id="skills_competencies_it" style="width: 300px">
				      		@foreach($sc as $key => $value)
				        		<option> {{ $value }} </option>
				      		@endforeach
			      		</select>
			    	</div>
			    	<input type="hidden" name="scit" id="scit">
			    	<br>

					<div class="form-group row">
						{{ Form::label('isTrainingPlan','Training Plan: ') }}
						{{ Form::radio('isTrainingPlan', 1); }}YES
						{{ Form::radio('isTrainingPlan', 0); }}NO
						{{ $errors->first('isTrainingPlan') }}
					</div>

					{{ Form::submit('Add Internal Training', array('class' => 'btn btn-primary pull-right')) }}
					<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary btn-back pull-right">Back</a>
					<br><br>
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

	$("#dd-schoolscolleges").select2({
	    allowClear: true
	});

	$("#dd-departments").select2({
	    allowClear: true
	});

	var sc = $('#skills_competencies_it');
	$(sc).change(function() {
		var elem = document.getElementById("scit");
		elem.value = $(sc).val();
	});	

	$('#date_start').datepicker({
	 	    format: 'MM d, yyyy'
	 	});

	$('#date_end').datepicker({
		    format: 'MM d, yyyy'
		});

	$('#time_start_s').timepicker();
	$('#time_end_s').timepicker();
	$('#time_start_e').timepicker();
	$('#time_end_e').timepicker();

</script>
<script>

	var count = 2;
		function addInput(divName){
			
		    var newdiv = document.createElement('div');
		    newdiv.innerHTML = "<div class='form-group row'><div class='col-sm-4 col-md-4'><b>Date: </b><input class='form-control' type='text' id='date" + count + "' " + "name='date" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time Start: </b><input class='form-control' type='text' id='timestart" + count + "' " + "name='timestart" + count + "'></div><div class='col-sm-2 col-md-2'><b>Time End: </b><input class='form-control' type='text' id='timeend" + count + "' " + "name='timeend" + count + "'></div></div>";

		    $('#date2').datepicker({
		    format: 'yyyy-mm-dd'
		});

		    $('#timestart2').timepicker();
			$('#timeend2').timepicker();

			document.getElementById(divName).appendChild(newdiv);
			document.getElementById('count').value = count;
			var box = "item" + count;
			document.getElementById('items').value = box;
			count++;    
		}
</script>

@stop
