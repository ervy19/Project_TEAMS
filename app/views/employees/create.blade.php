@extends('layouts.index')

@section('title')
	Add Employee
@stop

@section('content')

	<h1>Add an Employee</h1>

	<a href="{{ URL::to('employees') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'employees')) }}

		<div class="form-group">
			{{ Form::label('employee','Employee: ') }}
			{{ Form::text('employee', Input::old('employee')) }}
		</div>

		{{ Form::submit('Add Employee') }}

	{{ Form::close() }}

@stop