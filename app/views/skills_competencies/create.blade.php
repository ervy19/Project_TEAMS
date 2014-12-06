@extends('layouts.index')

@section('title')
	Add Skills and Competencies
@stop

@section('content')

	<h1>Add Skill or Competency</h1>

	<a href="{{ URL::to('skills_competencies') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'skills_competencies')) }}

		<div class="form-group">
			{{ Form::label('name','Skill/Competency: ') }}
			{{ Form::text('name') }}
		</div>

		{{ Form::submit('Add Skill/Competency') }}

	{{ Form::close() }}

@stop