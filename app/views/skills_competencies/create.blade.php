@extends('layouts.index')

@section('title')
	Add Skills and Competencies
@stop

@section('content')

	<h1>Add Skill or Competency</h1>

	{{ Form::open(['route' =>  'skills_competencies.store']) }}

		<div class="form-group">
			{{ Form::label('skill_competency','Skill or Competency: ') }}
			{{ Form::text('skill_competency') }}
		</div>

		{{ Form::submit('Add Skill/Competency') }}

	{{ Form::close() }}

@stop