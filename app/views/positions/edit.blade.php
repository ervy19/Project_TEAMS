@extends('layouts.index')

@section('title')
	Edit Position Information
@stop

@section('content')

	<h1>Edit Position Information</h1>

	<a href="{{ URL::to('positions') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($positions, array('route' => array('positions.update', $positions->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('positions','Position Name: ') }}
			{{ Form::text('positions', $positions->title, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit Position') }}

	{{ Form::close() }}

@stop