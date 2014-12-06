@extends('layouts.index')

@section('title')
	Edit School/College Information
@stop

@section('content')

	<h1>Edit School/College Information</h1>

	<a href="{{ URL::to('schools_colleges') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($schools_colleges, array('route' => array('schools_colleges.update', $schools_colleges->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('schools_colleges','School/College Name: ') }}
			{{ Form::text('schools_colleges', $schools_colleges->name, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit School/College') }}

	{{ Form::close() }}

@stop