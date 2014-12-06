@extends('layouts.index')

@section('title')
	Edit Employee
@stop

@section('content')

	<h1>Edit Employee</h1>

	<a href="{{ URL::to('employees') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($employees, array('route' => array('employees.update', $employees->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('employees','Employee: ') }}
			{{ Form::text('employees', $employees->name, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit Employee') }}

	{{ Form::close() }}

@stop