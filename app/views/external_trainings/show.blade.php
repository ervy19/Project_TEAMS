@extends('layouts.index')

@section('title')
	External Trainings - {{  $externaltraining->training_info->title or '---' }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('external_trainings') }}">External Trainings</a></li>
	<li>{{  $externaltraining->training_info->title or '---' }}</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h3>&nbsp;&nbsp;Attended by: </h3>
				<h2 class="panel-header">{{  $externaltraining->training_info->title or '---' }}</h2>
				<div class="col-sm-1 col-md-1">
					<h6>Theme: </h6>
					<h6>Organizer:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->training_info->theme_topic or '---' }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->organizer or '---' }}</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Venue:</h6>
					<h6>Schedule:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->training_info->venue or '---' }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->date_scheduled or '---' }}</h5>
				</div>
				<div class="col-sm-1 col-md-1">
					<h6>Attendee:</h6>
					<h6>Participation:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->attended_by or '---'}}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->participation or '---' }}</h5>
				</div>
			</div>
		</div>
</div>
@stop