@extends('layouts.index')

@section('title')
	Add External Training
@stop

@section('content')

	<h1>Add an External Training</h1>

	<a href="{{ URL::to('external_trainings') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'external_trainings')) }}

		<div class="form-group">
			{{ Form::label('externaltraining','External Trining: ') }}
			{{ Form::text('externaltraining', Input::old('externaltraining')) }}
		</div>

		{{ Form::submit('Add External Training') }}

	{{ Form::close() }}

@stop