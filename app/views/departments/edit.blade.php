@extends('layouts.index')

@section('title')
	Edit Department Information
@stop

@section('content')

	<h1>Edit Department Information</h1>

	<a href="{{ URL::to('departments') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($departments, array('route' => array('departments.update', $departments->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('departments','Department Name: ') }}
			{{ Form::text('departments', $departments->name, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit Department') }}

	{{ Form::close() }}

@stop