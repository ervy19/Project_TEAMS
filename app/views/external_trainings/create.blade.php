@extends('layouts.index')

@section('title')
	Add External Training
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Add an External Training</h1>

			<a href="{{ URL::to('external_trainings') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->

			{{ Form::open(array('url' => 'external_trainings', 'class' => 'form-horizontal')) }}

				<div class="form-group row">
					<div class="col-sm-12 col-md-12">
					{{ Form::label('title','External Training: ') }}
					{{ Form::text('title') }}
					{{ $errors->first('title') }}
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 col-md-12">
					{{ Form::label('theme_topic','Theme/Topic: ') }}
					{{ Form::text('theme_topic') }}
					{{ $errors->first('theme_topic') }}
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 col-md-12">
					{{ Form::label('participation','Participation: ') }}
					{{ Form::text('participation') }}
					{{ $errors->first('participation') }}
					</div>
				</div>
				<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_id','Organizer: ') }}
						</div>
						{{ Form::select('organizer', $schoolcollege, 'Select a School or College Organizer', array('id' => 'dd-schoolcollege', 'class' => 'col-sm-6 col-md-6')) }}
				</div>
				<div class="form-group row">
					<div class="col-sm-12 col-md-12">
					{{ Form::label('venue','Venue: ') }}
					{{ Form::text('venue') }}
					{{ $errors->first('venue') }}
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 col-md-12">
					{{ Form::label('schedule','Schedule: ') }}
					{{ Form::text('schedule') }}
					{{ $errors->first('schedule') }}
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 col-md-12">
					{{ Form::label('designation','Designation ID: ') }}
					</div>
					{{ Form::select('designation_id', $designation, 'Select a Designation ID', array('id' => 'dd-designations', 'class' => 'col-sm-6 col-md-6')) }}
				</div>
				<div class="form-group row">
						{{ Form::label('isTrainingPlan','Training Plan: ') }}
						{{ Form::radio('isTrainingPlan', 1); }}YES
						{{ Form::radio('isTrainingPlan', 0); }}NO
						{{ $errors->first('isTrainingPlan') }}
				</div>

				{{ Form::submit('Credit External Training') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop