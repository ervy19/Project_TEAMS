@extends('layouts.index')

@section('title')
	Add Internal Training
@stop

@section('content')

	<h1>Add an Internal Training</h1>

	<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'internal_trainings')) }}

		<div class="form-group">
			{{ Form::label('internaltrainings','Internal Training: ') }}
			{{ Form::text('internaltrainings', Input::old('internaltrainings')) }}
		</div>
		<div class="form-group">
			{{ Form::label('school_college_id','School/College ID: ') }}
			{{ Form::text('school_college_id', Input::old('school_college_id')) }}
		</div>
		<div class="form-group">
			{{ Form::label('department_id','Department ID: ') }}
			{{ Form::text('department_id', Input::old('department_id')) }}
		</div>

		{{ Form::submit('Add Internal Training') }}

	{{ Form::close() }}

@stop