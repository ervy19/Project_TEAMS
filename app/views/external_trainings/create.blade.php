@extends('layouts.index')

@section('title')
	Add External Training
@stop

@section('content')

	<h1>Add an External Training</h1>

	<a href="{{ URL::to('external_trainings') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->

	{{ Form::open(array('url' => 'external_trainings')) }}

		<div class="form-group">
			{{ Form::label('title','External Training: ') }}
			{{ Form::text('title') }}
			{{ $errors->first('title') }}
		</div>
		<div class="form-group">
			{{ Form::label('theme_topic','Theme/Topic: ') }}
			{{ Form::text('theme_topic') }}
			{{ $errors->first('theme_topic') }}
		</div>
		<div class="form-group">
			{{ Form::label('participation','Participation: ') }}
			{{ Form::text('participation') }}
			{{ $errors->first('participation') }}
		</div>
		<div class="form-group">
			{{ Form::label('organizer','Organizer: ') }}
			{{ Form::text('organizer') }}
			{{ $errors->first('organizer') }}
		</div>
		<div class="form-group">
			{{ Form::label('venue','Venue: ') }}
			{{ Form::text('venue') }}
			{{ $errors->first('venue') }}
		</div>
		<div class="form-group">
			{{ Form::label('date_start','Date Start: ') }}
			{{ Form::text('date_start') }}
			{{ $errors->first('date_start') }}
		</div>
		<div class="form-group">
			{{ Form::label('date_end','Date End: ') }}
			{{ Form::text('date_end') }}
			{{ $errors->first('date_end') }}
		</div>
		<div class="form-group">
			{{ Form::label('designation_id','Designation ID: ') }}
			{{ Form::text('designation_id') }}
			{{ $errors->first('designation_id') }}
		</div>

		{{ Form::submit('Add External Training') }}

	{{ Form::close() }}

@stop