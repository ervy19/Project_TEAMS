@extends('layouts.index')

@section('title')
	Edit Skills and Competencies
@stop

@section('content')

	<h1>Edit Skill or Competency</h1>

	<a href="{{ URL::to('skills_competencies') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($scs, array('route' => array('skills_competencies.update', $scs->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('skill_competency','Skill or Competency: ') }}
			{{ Form::text('skill_competency', $scs->name, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit Skill/Competency') }}

	{{ Form::close() }}

@stop