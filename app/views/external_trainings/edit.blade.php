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
			{{ Form::label('title','External Training: ') }}
			{{ Form::text('title') }}
		</div>
		<div class="form-group">
			{{ Form::label('theme_topic','Theme/Topic: ') }}
			{{ Form::text('theme_topic') }}
		</div>
		<div class="form-group">
			{{ Form::label('participation','Participation: ') }}
			{{ Form::text('participation') }}
		</div>
		<div class="form-group">
			{{ Form::label('organizer','Organizer: ') }}
			{{ Form::text('organizer') }}
		</div>
		<div class="form-group">
			{{ Form::label('venue','Venue: ') }}
			{{ Form::text('venue') }}
		</div>
		<div class="form-group">
			{{ Form::label('date_start','Date Start: ') }}
			{{ Form::text('date_start') }}
		</div>
		<div class="form-group">
			{{ Form::label('date_end','Date End: ') }}
			{{ Form::text('date_end') }}
		</div>
		<div class="form-group">
			{{ Form::label('designation_id','Designation ID: ') }}
			{{ Form::text('designation_id') }}
		</div>


		{{ Form::submit('Edit External Training') }}

	{{ Form::close() }}

@stop