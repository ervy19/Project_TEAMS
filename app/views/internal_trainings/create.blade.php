@extends('layouts.index')

@section('title')
	Add Internal Training
@stop

@section('content')

	<h1>Add an Internal Training</h1>

	<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	<!--{{ HTML::ul($errors->all()) }}-->

	{{ Form::open(array('url' => 'internal_trainings')) }}

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
			{{ Form::text('date_start') }}
			{{ $errors->first('date_start') }}
		</div>

		<div class="form-group">
			{{ Form::label('date_end','Date End: ') }}
			{{ Form::text('date_end') }}
			{{ $errors->first('date_end') }}
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
			{{ Form::label('organizer_schools_colleges_id','Organizing School/College ID: ') }}
			{{ Form::text('organizer_schools_colleges_id') }}
			{{ $errors->first('organizer_schools_colleges_id') }}
		</div>

		<div class="form-group">
			{{ Form::label('organizer_department_id','Organizing Department ID: ') }}
			{{ Form::text('organizer_department_id') }}
			{{ $errors->first('organizer_department_id') }}
		</div>

		<div class="form-group">
			{{ Form::label('isTrainingPlan','Training Plan: ') }}
			{{ Form::text('isTrainingPlan') }}
			{{ $errors->first('isTrainingPlan') }}
		</div>

		{{ Form::submit('Add Internal Training') }}

	{{ Form::close() }}

@stop