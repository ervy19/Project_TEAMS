@extends('layouts.index')

@section('title')
	Edit Campus Information
@stop

@section('content')

	<h1>Edit Campus Information</h1>

	<a href="{{ URL::to('campuses') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($campuses, array('route' => array('campuses.update', $campuses->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('campuses','Campus Name: ') }}
			{{ Form::text('campuses', $campuses->title, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('address','Campus Address: ') }}
			{{ Form::text('address', $campuses->address, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit Campus') }}

	{{ Form::close() }}

@stop