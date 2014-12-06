@extends('layouts.index')

@section('title')
	Add Campus
@stop

@section('content')

	<h1>Add Campus Information</h1>

	<a href="{{ URL::to('campuses') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'campuses')) }}

		<div class="form-group">
				{{ Form::label('title','Campus Name: ') }}
				{{ Form::text('title') }}
		</div>

		<div class="form-group">
				{{ Form::label('address','Address: ') }}
				{{ Form::text('address') }}
		</div>

		{{ Form::submit('Add Campus') }}

	{{ Form::close() }}

@stop