@extends('layouts.index')

@section('title')
	Edit External Training
@stop

@section('content')

	<h1>Edit External Training</h1>

	<a href="{{ URL::to('external_trainings') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($externaltrainings, array('route' => array('external_trainings.update', $externaltrainings->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('externaltrainings','External Training: ') }}
			{{ Form::text('externaltrainings', $externaltrainings->title, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit External Training') }}

	{{ Form::close() }}

@stop