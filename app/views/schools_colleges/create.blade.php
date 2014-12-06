@extends('layouts.index')

@section('title')
	Add School/College
@stop

@section('content')

	<h1>Add School/College Information</h1>

	<a href="{{ URL::to('schools_colleges') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'schools_colleges')) }}

		<div class="form-group">
				{{ Form::label('schools_colleges','School/College Name: ') }}
				{{ Form::text('schools_colleges', Input::old('schools_colleges')) }}
		</div>

		{{ Form::submit('Add School/Colleges') }}

	{{ Form::close() }}

@stop