@extends('layouts.index')

@section('title')
	Add Internal Training
@stop

@section('page_css')
	{{ HTML::style('assets/css/datepicker.css'); }}
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
						{{ Form::label('schedule','Schedule: ') }}
						{{ Form::text('schedule', '', array( 'class' => 'form-control')) }}
						{{ $errors->first('schedule') }}
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
						{{ Form::label('isTrainingPlan','Training Plan: ') }}
						{{ Form::radio('isTrainingPlan', 1); }}YES
						{{ Form::radio('isTrainingPlan', 0); }}NO
						{{ $errors->first('isTrainingPlan') }}
					</div>

					{{ Form::submit('Add Internal Training', array('class' => 'btn btn-primary pull-right')) }}
					<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary pull-right">Back</a>

				{{ Form::close() }}

			</div>
		</div>
	</div>

</div>

@stop

@section('page_js')

    {{ HTML::script('assets/js/bootstrap-datepicker.js'); }}

<script>

	$("#dd-schoolscolleges").select2({
		placeholder: 'HEHEHE',
	    allowClear: true
	});

	$("#dd-departments").select2({
	    allowClear: true
	});

	/*$('#date_start').datepicker({
    format: 'yyyy-mm-dd'
});
	$('#date_end').datepicker({
    format: 'yyyy-mm-dd'
});
	
	var schtr = $('#school_college_training');
	$(schtr).change(function() {
		var elemtr = document.getElementById("selected_sch_training");
		elemtr.value = $(schtr).val();
	});

	var depttr = $('#dept_training');
	$(depttr).change(function() {
		var elemdepttr = document.getElementById("selected_dept_training");
		elemdepttr.value = $(depttr).val();
	});*/
</script>

@stop
