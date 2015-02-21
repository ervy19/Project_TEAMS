@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internal_training->id }}">{{ $internal_training->title }}</a></li>
	<li>Training Effectiveness Report</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internal_training->title or '---' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/speakers">Speakers</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/participants">Participants Information</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation" class="active"><a href="#">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			@if($hasAE)
				@if(!$existsTER)	
					@if($isAdminHR)
					{{ Form::model($internal_training, array('route' => array('internal_trainings.store-report', $internal_training->id), 'method' => 'POST')) }}
						<div class="form-group row">
								{{ Form::label('narrative','Evaluation Narrative: ') }}
								{{ Form::textarea('evaluation_narrative', '', array( 'class' => 'form-control', 'rows' => '3')) }}
								{{ $errors->first('evaluation_narrative') }}
						</div>
						<div class="form-group row">
								{{ Form::label('recommendation','Recommendations: ') }}
								{{ Form::textarea('recommendations', '', array( 'class' => 'form-control', 'rows' => '3')) }}
								{{ $errors->first('recommendations') }}
						</div>
						<br>
						{{ Form::submit('Submit', array('class' => 'btn btn-primary pull-right')) }}
		      		{{ Form::close() }}
	      			@else
      					<h3>Training Effectiveness Report Not Yet Available</h3>
      				@endif
	      		</div>
		      	@else
		      		<a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/training-effectiveness-report/download" class="btn btn-primary">Download Training Effectiveness Report</a>
					<h4><b>Evaluation Narrative</b></h4>
					<p>{{ $internal_training->evaluation_narrative}}</p>
					<br>
					<h4><b>Recommendations</b></h4>
					<p>{{ $internal_training->recommendations }}</p>
		      	@endif
		    @else
				@if($isAdminHR)
					<h3>After Activity Evaluation Report has not yet been accomplished. You cannot accomplish the Training Effectivess Report.</h3>
				@else
					<h3>Training Effectivess Report Not Yet Available</h3>
				@endif
			@endif
			</div>
		</div>
	</div>

@stop