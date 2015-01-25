@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internaltrainings[0]->id }}">{{ $internaltrainings[0]->title }}</a></li>
	<li>After Activity Evaluation</li>
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
				<li role="presentation" class="active"><a href="#">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings[0]->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			@if ($intent === "accomplish")
				<table id="tb-evaluation" class="table table-striped table-bordered">
					{{ Form::model($internaltrainings, array('route' => array('after_activity_eval.store', $internaltrainings[0]->id), 'method' => 'POST')) }}
					
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
							<td>{{ Form::number('planning_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>1.2 Coordination of Committees</td>
							<td>{{ Form::number('planning_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td rowspan="3">2. Objectives</td>
							<td>2.1 Clarity</td>
							<td>{{ Form::number('objectives_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>2.2 Timeliness</td>
							<td>{{ Form::number('objectives_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>2.3 Relevance</td>
							<td>{{ Form::number('objectives_criterion3', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td rowspan="2">3. Content/Activities</td>
							<td>3.1 Relevance</td>
							<td>{{ Form::number('content_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>3.2 Organization/Logic</td>
							<td>{{ Form::number('content_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td rowspan="2">4. Materials</td>
							<td>4.1 Handouts</td>
							<td>{{ Form::number('materials_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>4.2 Audio-Visual/Devices</td>
							<td>{{ Form::number('materials_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td rowspan="3">5. Schedule of Activities</td>
							<td>5.1 Time allotment</td>
							<td>{{ Form::number('schedule_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>5.2 Flexibility</td>
							<td>{{ Form::number('schedule_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>5.3 Appropriateness of date</td>
							<td>{{ Form::number('schedule_criterion3', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td colspan="3">6. Speaker/s</td>
						</tr>
						<tr>
							<td rowspan="3">6.1 Speaker 1</td>
							<td>6.1.1 Subject matter mastery</td>
							<td>{{ Form::number('evaluation_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>6.1.2 Contribution to the attainment of the objectives</td>
							<td>{{ Form::number('evaluation_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>6.1.3 Interaction/Rapport with participants</td>
							<td>{{ Form::number('evaluation_criterion3', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td rowspan="3">7. Open Forum</td>
							<td>7.1 Time allotment</td>
							<td>{{ Form::number('openForum_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>7.2 Extent of audience participation</td>
							<td>{{ Form::number('openForum_criterion2', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>7.3 Moderator's effectiveness</td>
							<td>{{ Form::number('openForum_criterion3', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td rowspan="2">8. Venue/Facilities</td>
							<td>8.1 Acoustics</td>
							<td>{{ Form::number('venue_criterion1', '',array('class' => 'form-control')) }}</td>
						</tr>
						<tr>
							<td>8.2 Appropriateness</td>
							<td>{{ Form::number('venue_criterion2', '',array('class' => 'form-control')) }}</td>
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

      			@elseif ($intent === "show")

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
							<td>{{ $activityevaluation[0]->planning_criterion1 }}</td>
						</tr>
						<tr>
							<td>1.2 Coordination of Committees</td>
							<td>{{ $activityevaluation[0]->planning_criterion2 }}</td>
						</tr>
						<tr>
							<td rowspan="3">2. Objectives</td>
							<td>2.1 Clarity</td>
							<td>{{ $activityevaluation[0]->objectives_criterion1 }}</td>
						</tr>
						<tr>
							<td>2.2 Timeliness</td>
							<td>{{ $activityevaluation[0]->objectives_criterion2 }}</td>
						</tr>
						<tr>
							<td>2.3 Relevance</td>
							<td>{{ $activityevaluation[0]->objectives_criterion3 }}</td>
						</tr>
						<tr>
							<td rowspan="2">3. Content/Activities</td>
							<td>3.1 Relevance</td>
							<td>{{ $activityevaluation[0]->content_criterion1 }}</td>
						</tr>
						<tr>
							<td>3.2 Organization/Logic</td>
							<td>{{ $activityevaluation[0]->content_criterion2 }}</td>
						</tr>
						<tr>
							<td rowspan="2">4. Materials</td>
							<td>4.1 Handouts</td>
							<td>{{ $activityevaluation[0]->materials_criterion1 }}</td>
						</tr>
						<tr>
							<td>4.2 Audio-Visual/Devices</td>
							<td>{{ $activityevaluation[0]->materials_criterion2 }}</td>
						</tr>
						<tr>
							<td rowspan="3">5. Schedule of Activities</td>
							<td>5.1 Time allotment</td>
							<td>{{ $activityevaluation[0]->schedule_criterion1 }}</td>
						</tr>
						<tr>
							<td>5.2 Flexibility</td>
							<td>{{ $activityevaluation[0]->schedule_criterion2 }}</td>
						</tr>
						<tr>
							<td>5.3 Appropriateness of date</td>
							<td>{{ $activityevaluation[0]->schedule_criterion3 }}</td>
						</tr>
						<tr>
							<td colspan="3">6. Speaker/s</td>
						</tr>
						<tr>
							<td rowspan="3">6.1 Speaker 1</td>
							<td>6.1.1 Subject matter mastery</td>
							<td>{{ $speakerevaluation[0]->evaluation_criterion1 }}</td>
						</tr>
						<tr>
							<td>6.1.2 Contribution to the attainment of the objectives</td>
							<td>{{ $speakerevaluation[0]->evaluation_criterion2 }}</td>
						</tr>
						<tr>
							<td>6.1.3 Interaction/Rapport with participants</td>
							<td>{{ $speakerevaluation[0]->evaluation_criterion3 }}</td>
						</tr>
						<tr>
							<td rowspan="3">7. Open Forum</td>
							<td>7.1 Time allotment</td>
							<td>{{ $activityevaluation[0]->openForum_criterion1 }}</td>
						</tr>
						<tr>
							<td>7.2 Extent of audience participation</td>
							<td>{{ $activityevaluation[0]->openForum_criterion2 }}</td>
						</tr>
						<tr>
							<td>7.3 Moderator's effectiveness</td>
							<td>{{ $activityevaluation[0]->openForum_criterion3 }}</td>
						</tr>
						<tr>
							<td rowspan="2">8. Venue/Facilities</td>
							<td>8.1 Acoustics</td>
							<td>{{ $activityevaluation[0]->venue_criterion1 }}</td>
						</tr>
						<tr>
							<td>8.2 Appropriateness</td>
							<td>{{ $activityevaluation[0]->venue_criterion2 }}</td>
						</tr>
						<tr>
							<td>Comments/Recommendations:</td>
							<td colspan="2">{{ $activityevaluation[0]->comments }}</td>
						</tr>
					</tbody>
				</table>

      			@endif
			</div>
		</div>
	</div>

@stop