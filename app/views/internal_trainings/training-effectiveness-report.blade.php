@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internaltrainings->id }}">{{ $internaltrainings->title }}</a></li>
	<li>Training Effectiveness Report</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internaltrainings->title or '---' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}">Speakers</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/participants">Participants Information</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation" class="active"><a href="#">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			</div>
		</div>
	</div>

@stop