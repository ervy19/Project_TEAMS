@extends('layouts.index')

@section('title')
	Credit External Training
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit External Training</h1>

			<a href="{{ URL::to('external_trainings/pending-approval') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($externaltraining, array('route' => array('external_trainings.credit', $externaltraining->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('title','External Training: ') }}
					{{ Form::text('title', $externaltraining->title, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('theme_topic','Theme/Topic: ') }}
					{{ Form::text('theme_topic', $externaltraining->theme_topic, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('participation','Participation: ') }}
					{{ Form::text('participation', $externaltraining->participation, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('organizer','Organizer: ') }}
					{{ Form::text('organizer', $externaltraining->organizer, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('venue','Venue: ') }}
					{{ Form::text('venue', $externaltraining->venue, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-md-6">
						{{ Form::label('date_start','Date Start: ') }}
						{{ Form::text('date_start', $externaltraining->date_start, array('class' => 'form-control')) }}
					</div>
					<div class="col-sm-6 col-md-6">
						{{ Form::label('date_end','Date End: ') }}
						{{ Form::text('date_end', $externaltraining->date_end, array('class' => 'form-control')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('designation_id','Designation ID: ') }}
					{{ Form::text('designation_id', '', array('class' => 'form-control')) }}
				</div>


				<div class="form-group">
					{{ Form::label('schoolcollege', 'School/College: ') }}
					<select id="school_college_dept" style="width: 300px">
				    	@foreach($schoolcollege as $key => $value)
				      		<option> {{ $value }} </option>
				    	@endforeach
			      	</select>
				</div>

				{{ Form::submit('Credit External Training') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop