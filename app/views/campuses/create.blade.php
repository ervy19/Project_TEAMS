@extends('layouts.index')

@section('title')
	Add Campus
@stop

@section('content')

	<h1>Add Department Information</h1>

	{{ Form::open() }}

		<div class="form-group">
			{{ Form::label('department','Department Name: ') }}
			{{ Form::text('department') }}
		</div>

		<div class="form-group">
			{{ Form::label('department','Department Supervisor: ') }}
			{{ Form::text('department') }}
		</div>

		{{ Form::submit('Add Department') }}

	{{ Form::close() }}

@stop