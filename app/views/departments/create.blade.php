@extends('layouts.index')

@section('title')
	Add Department
@stop

@section('content')

	<h1>Add Department Information</h1>

	<a href="{{ URL::to('departments') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

		{{ Form::open(array('url' => 'departments')) }}

			<div class="form-group">
				{{ Form::label('name','Department Name: ') }}
				{{ Form::text('name') }}

			</div>

		{{ Form::submit('Add Department') }}

	{{ Form::close() }}

@stop