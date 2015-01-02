-@extends('layouts.index')

@section('title')
	Edit Internal Training
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Internal Training</h1>

			<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			<!--{{ HTML::ul($errors->all()) }}-->

			{{ Form::model($internaltrainings, array('route' => array('internal_trainings.update', $internaltrainings->training_id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('title','Title: ') }}
					{{ Form::text('title') }}
					{{ $errors->first('title') }}
				</div>

				<div class="form-group">
					{{ Form::label('theme_topic','Theme/Topic: ') }}
					{{ Form::text('theme_topic') }}
					{{ $errors->first('theme_topic') }}
				</div>

				<div class="form-group">
					{{ Form::label('venue','Venue: ') }}
					{{ Form::text('venue') }}
					{{ $errors->first('venue') }}
				</div>

				<div class="form-group">
					{{ Form::label('date_start','Date Start: ') }}
					<input type="text" id="date_start" name="date_start">
				</div>

				<div class="form-group">
					{{ Form::label('date_end','Date End: ') }}
					<input type="text" id="date_end" name="date_end">
				</div>

				<div class="form-group">
					{{ Form::label('time_start','Time Start: ') }}
					{{ Form::text('time_start') }}
					{{ $errors->first('time_start') }}
				</div>

				<div class="form-group">
					{{ Form::label('time_end','Time End: ') }}
					{{ Form::text('time_end') }}
					{{ $errors->first('time_end') }}
				</div>

				<div class="form-group">
					{{ Form::label('format','Format: ') }}
					{{ Form::text('format') }}
					{{ $errors->first('format') }}
				</div>

				<div class="form-group">
					{{ Form::label('objectives','Objectives: ') }}
					{{ Form::text('objectives') }}
					{{ $errors->first('objectives') }}
				</div>

				<div class="form-group">
					{{ Form::label('expected_outcome','Expected Outcome: ') }}
					{{ Form::text('expected_outcome') }}
					{{ $errors->first('expected_outcome') }}
				</div>

				<div class="form-group">
					{{ Form::label('evaluation_narrative','Evaluation Narrative: ') }}
					{{ Form::text('evaluation_narrative') }}
					{{ $errors->first('evaluation_narrative') }}
				</div>

				<div class="form-group">
					{{ Form::label('recommendations','Recommendations: ') }}
					{{ Form::text('recommendations') }}
					{{ $errors->first('recommendations') }}
				</div>

				<div class="form-group">
					{{ Form::label('organizer_schools_colleges_id','Organizing School/College: ') }}
					<select id="school_college_training_edit" style="width: 300px">
				      		@foreach($schoolcollege as $key => $value)
				        		<option> {{ $value->name }} </option>
				      		@endforeach
			      	</select>
			      	<input type="hidden" name="selected_sch_training_edit" id="selected_sch_training_edit"><br>
					{{ $errors->first('organizer_schools_colleges_id') }}
				</div>

				<div class="form-group">
					{{ Form::label('organizer_department_id','Organizing Department ID: ') }}
					<select id="dept_training_edit" style="width: 300px">
				      		@foreach($department as $key => $value)
				        		<option> {{ $value->name }} </option>
				      		@endforeach
			      	</select>
			      	<input type="hidden" name="selected_dept_training_edit" id="selected_dept_training_edit"><br>
					{{ $errors->first('organizer_department_id') }}
				</div>

				<div class="form-group">
					{{ Form::label('isTrainingPlan','Training Plan: ') }}
					{{ Form::radio('isTrainingPlan', 1); }}YES
					{{ Form::radio('isTrainingPlan', 0); }}NO
					{{ $errors->first('isTrainingPlan') }}
				</div>


				{{ Form::submit('Edit Internal Training') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')

    {{ HTML::script('assets/js/bootstrap-datepicker.js'); }}

<script>

	$('#date_start').datepicker({
    	format: 'yyyy-mm-dd'
	});
	$('#date_start').datepicker('update', "{{ $currentstartdate }}" );
	$('#date_start').datepicker('update');

	$('#date_end').datepicker({
    	format: 'yyyy-mm-dd'
	});
	$('#date_end').datepicker('update', "{{ $currentenddate }}" );
	$('#date_end').datepicker('update');

	jQuery(function(){
    	RadionButtonSelectedValueSet('isTrainingPlan', $isTP);
	})
	
	var schtr = $('#school_college_training_edit');
	$(schtr).change(function() {
		var elemtr = document.getElementById("selected_sch_training_edit");
		elemtr.value = $(schtr).val();
	});

	var depttr = $('#dept_training_edit');
	$(depttr).change(function() {
		var elemdepttr = document.getElementById("selected_dept_training_edit");
		elemdepttr.value = $(depttr).val();
	});
</script>

@stop
