@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internaltrainings[0]->id }}">{{ $internaltrainings[0]->title }}</a></li>
	<li>Training Effectiveness Report</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internaltrainings[0]->title or '---' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings[0]->id}}/speakers">Speakers</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings[0]->id}}/participants">Participants Information</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings[0]->id}}/after-activity-evaluation/{{$intent}}">After Activity Evaluation</a></li>
				<li role="presentation" class="active"><a href="#">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
				@if ($tereport === "") 
					{{ Form::model($internaltrainings, array('route' => array('internal_trainings.store-report', $internaltrainings[0]->id), 'method' => 'POST')) }}
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
						{{ Form::submit('Submit', array('class' => 'btn btn-primary pull-right')) }}
		      		{{ Form::close() }}
	      			<br>
	      		</div>
	      		@else
	      		<div class="training-contents">
	      			<div class="label-remarks">
						<h4>Evaluation Narrative</h4>
						<p>{{ $trainingdetails[0]->evaluation_narrative or '---'}}</p>
					</div>
					<div class="label-remarks">
						<h4>Recommendations</h4>
						<p>{{ $trainingdetails[0]->recommendations or '---'}}</p>
					</div>
	      		@endif
			</div>
		</div>
	</div>

@stop