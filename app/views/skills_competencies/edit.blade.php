@extends('layouts.index')

@section('title')
	Edit Skills and Competencies
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Skill or Competency</h1>

			<a href="{{ URL::to('skills_competencies') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($scs, array('route' => array('skills_competencies.update', $scs->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('name','Skill/Competency: ') }}
					{{ Form::text('name') }}
				</div>

				{{ Form::submit('Edit Skill/Competency') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop