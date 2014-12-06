@extends('layouts.index')

@section('title')
	Edit Internal Training
@stop

@section('content')

	<h1>Edit Internal Training</h1>

	<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($internaltrainings, array('route' => array('internal_trainings.update', $internaltrainings->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('internaltrainings','Internal Training: ') }}
			{{ Form::text('internaltrainings', $internaltrainings->title, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit Internal Training') }}

	{{ Form::close() }}

@stop