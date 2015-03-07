@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internal_training->id }}">{{ $internal_training->title }}</a></li>
	<li>After Activity Evaluation</li>
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
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/assessment-items">Assessment Items</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/participants">Participants</a></li>
				<li role="presentation" class="active"><a href="#">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			@if($hasAttendees)
				@if(!$existsAE)
					@if($isAdminHR)
					<table id="tb-evaluation" class="table table-striped table-bordered">
						{{ Form::model($internal_training, array('route' => array('after_activity_eval.store', $internal_training->id), 'method' => 'POST')) }}
						
						<thead>
							<tr>
								<th>Area</th>
								<th>Criterion</th>
								<th>Rating</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td rowspan="2">1. Planning</td>
								<td>1.1 Preparedness of Participants</td>
								<td>{{ Form::number('planning_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>1.2 Coordination of Committees</td>
								<td>{{ Form::number('planning_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td rowspan="3">2. Objectives</td>
								<td>2.1 Clarity</td>
								<td>{{ Form::number('objectives_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>2.2 Timeliness</td>
								<td>{{ Form::number('objectives_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>2.3 Relevance</td>
								<td>{{ Form::number('objectives_criterion3', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td rowspan="2">3. Content/Activities</td>
								<td>3.1 Relevance</td>
								<td>{{ Form::number('content_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>3.2 Organization/Logic</td>
								<td>{{ Form::number('content_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td rowspan="2">4. Materials</td>
								<td>4.1 Handouts</td>
								<td>{{ Form::number('materials_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>4.2 Audio-Visual/Devices</td>
								<td>{{ Form::number('materials_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td rowspan="3">5. Schedule of Activities</td>
								<td>5.1 Time allotment</td>
								<td>{{ Form::number('schedule_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>5.2 Flexibility</td>
								<td>{{ Form::number('schedule_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>5.3 Appropriateness of date</td>
								<td>{{ Form::number('schedule_criterion3', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td colspan="3">6. Speaker/s</td>
							</tr>
							@foreach ($speakers as $value)
							<tr>
								<td rowspan="3">6.1 {{ $value->name }}</td>
								<td>6.1.1 Subject matter mastery</td>
								<td>{{ Form::number("evaluation_criterion1_" . $value->id, '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>6.1.2 Contribution to the attainment of the objectives</td>
								<td>{{ Form::number("evaluation_criterion2_" . $value->id, '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>6.1.3 Interaction/Rapport with participants</td>
								<td>{{ Form::number("evaluation_criterion3_" . $value->id, '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							@endforeach
							<tr>
								<td rowspan="3">7. Open Forum</td>
								<td>7.1 Time allotment</td>
								<td>{{ Form::number('openForum_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>7.2 Extent of audience participation</td>
								<td>{{ Form::number('openForum_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>7.3 Moderator's effectiveness</td>
								<td>{{ Form::number('openForum_criterion3', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td rowspan="2">8. Venue/Facilities</td>
								<td>8.1 Acoustics</td>
								<td>{{ Form::number('venue_criterion1', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>8.2 Appropriateness</td>
								<td>{{ Form::number('venue_criterion2', '',array('class' => 'form-control', 'min' => 0, 'max' => 5, 'step' => 0.0001)) }}</td>
							</tr>
							<tr>
								<td>Comments/Recommendations:</td>
								<td colspan="2">{{ Form::textarea('comments', '',array('class' => 'form-control', 'rows' => '3')) }}</td>
							</tr>
						</tbody>
					</table>
					{{ Form::submit('Submit', array('class' => 'btn btn-primary pull-right')) }}
	      			{{ Form::close() }}
	      			<br>
      				@else
      					<h3>After Activity Evaluation Report Not Yet Available</h3>
      				@endif
      			@else

      			<table id="tb-evaluation" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Area</th>
							<th>Criterion</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="2">1. Planning</td>
							<td>1.1 Preparedness of Participants</td>
							<td>{{ $activityevaluation->planning_criterion1 }}</td>
						</tr>
						<tr>
							<td>1.2 Coordination of Committees</td>
							<td>{{ $activityevaluation->planning_criterion2 }}</td>
						</tr>
						<tr>
							<td rowspan="3">2. Objectives</td>
							<td>2.1 Clarity</td>
							<td>{{ $activityevaluation->objectives_criterion1 }}</td>
						</tr>
						<tr>
							<td>2.2 Timeliness</td>
							<td>{{ $activityevaluation->objectives_criterion2 }}</td>
						</tr>
						<tr>
							<td>2.3 Relevance</td>
							<td>{{ $activityevaluation->objectives_criterion3 }}</td>
						</tr>
						<tr>
							<td rowspan="2">3. Content/Activities</td>
							<td>3.1 Relevance</td>
							<td>{{ $activityevaluation->content_criterion1 }}</td>
						</tr>
						<tr>
							<td>3.2 Organization/Logic</td>
							<td>{{ $activityevaluation->content_criterion2 }}</td>
						</tr>
						<tr>
							<td rowspan="2">4. Materials</td>
							<td>4.1 Handouts</td>
							<td>{{ $activityevaluation->materials_criterion1 }}</td>
						</tr>
						<tr>
							<td>4.2 Audio-Visual/Devices</td>
							<td>{{ $activityevaluation->materials_criterion2 }}</td>
						</tr>
						<tr>
							<td rowspan="3">5. Schedule of Activities</td>
							<td>5.1 Time allotment</td>
							<td>{{ $activityevaluation->schedule_criterion1 }}</td>
						</tr>
						<tr>
							<td>5.2 Flexibility</td>
							<td>{{ $activityevaluation->schedule_criterion2 }}</td>
						</tr>
						<tr>
							<td>5.3 Appropriateness of date</td>
							<td>{{ $activityevaluation->schedule_criterion3 }}</td>
						</tr>
						@foreach ($speakerevaluation as $value )
							<tr>
								<td rowspan="3">6.1 {{ $value["name"] }}</td>
								<td>6.1.1 Subject matter mastery</td>
								<td>{{ $value["evaluation_criterion1_" . $value["id"]] }}</td>
							</tr>
							<tr>
								<td>6.1.2 Contribution to the attainment of the objectives</td>
								<td>{{ $value["evaluation_criterion2_" . $value["id"]] }}</td>						
							<tr>
								<td>6.1.3 Interaction/Rapport with participants</td>
								<td>{{ $value["evaluation_criterion3_" . $value["id"]] }}</td>						
						@endforeach
						<tr>
							<td rowspan="3">7. Open Forum</td>
							<td>7.1 Time allotment</td>
							<td>{{ $activityevaluation->openForum_criterion1 }}</td>
						</tr>
						<tr>
							<td>7.2 Extent of audience participation</td>
							<td>{{ $activityevaluation->openForum_criterion2 }}</td>
						</tr>
						<tr>
							<td>7.3 Moderator's effectiveness</td>
							<td>{{ $activityevaluation->openForum_criterion3 }}</td>
						</tr>
						<tr>
							<td rowspan="2">8. Venue/Facilities</td>
							<td>8.1 Acoustics</td>
							<td>{{ $activityevaluation->venue_criterion1 }}</td>
						</tr>
						<tr>
							<td>8.2 Appropriateness</td>
							<td>{{ $activityevaluation->venue_criterion2 }}</td>
						</tr>
						<tr>
							<td>Comments/Recommendations:</td>
							<td colspan="2">{{ $activityevaluation->comments }}</td>
						</tr>
					</tbody>
				</table>
      			@endif
			@else
				@if($isAdminHR)
					<h3>No attendees registered. You cannot accomplish the After Activity Evaluation Report.</h3>
				@else
					<h3>After Activity Evaluation Report Not Yet Available</h3>
				@endif
			@endif
			</div>
		</div>
	</div>
@stop