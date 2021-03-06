@extends('layouts.index')

@section('title')
	{{ $sectiontitle }} 
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h2 class="panel-header">{{ $header }}</h2>	

		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 training-info training-assessment">
				<div class="panel">
					<div class="row training-details">
						<div class="col-sm-2 col-md-2">
							<h6>Participant Name:</h6>
							<h6>Position:</h6>
						</div>
						<div class="col-sm-6 col-md-6">
							<h5>{{ $participant->employee_name or "--Participant Name--" }}</h5>
							<h5>{{ $participant->position_title or "--Position Title--" }}</h5>
						</div>
						<div class="col-sm-4 col-md-4">
							<h6>School/College/Department:</h6>
							<p>{{ $internaltraining->title }}</p>
						</div>
					</div>
					<div class="row training-details">
						<div class="col-sm-2 col-md-2">
							<h6>Training Theme: </h6>
							<h6>Training Organizer:</h6>
						</div>
						<div class="col-sm-10 col-md-10">
							<h5>{{ $internaltraining->theme_topic }}</h5>
							<h5>{{ $internaltraining->name }}</h5>
						</div>
					</div>
					<div class="row training-details">
						<div class="col-sm-2 col-md-2">
							<h6>Schedule and Venue:</h6>
						</div>
						<div class="col-sm-10 col-md-10 inline-block">
							<h5>{{ $internaltraining->schedule or 'No schedule yet'}}&nbsp;&nbsp;|&nbsp;</h5>
							<h5>{{ $internaltraining->venue or 'No venue yet'}}</h5>
						</div>
					</div>
					<div class="row training-details">
						<div class="col-sm-12 col-md-12">
							<h6>Objectives:</h6>
							<p>{{ $internaltraining->objectives }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12 pta-form">
				<div class="panel">
					<h5>Instructions</h5> 
					<p>
						Read each of the items carefully and rate the participant by selecting the appropriate column based on the following rating scale:
					</p>
					<p class="assessment-scale">
						<b>5</b>&nbsp;&nbsp;&nbsp;&nbsp; Very Extensive Knowledge | Very Skillful | Highly Positive Attitude
						<br>
						<b>4</b>&nbsp;&nbsp;&nbsp;&nbsp; Extensive Knowledge | Skillful | Positive Attitude
						<br>
						<b>3</b>&nbsp;&nbsp;&nbsp;&nbsp; Adequate Knowledge | Adequate Skillful | Neutral Attitude
						<br>
						<b>2</b>&nbsp;&nbsp;&nbsp;&nbsp; Inadequate Knowledge | Lacks Skillful | Ambivalent
						<br>
						<b>1</b>&nbsp;&nbsp;&nbsp;&nbsp; No Knowledge | No Skill | Unfavorable Attitude
					</p>

					@if ($type === "pta")
						<table class="table">
										<thead>
											<tr class="assessment-form">
												<th>Items for Assessment</th>
												<th>Rating</th>
											</tr>
										</thead>
										<tbody>
											@foreach($assessmentresponse as $key => $value)
												<tr>
													<td><p>{{ $value->name }}</p></td>
													<td><p>{{ $value->rating }}</p></td>
												</tr>
											@endforeach
										</tbody>
									</table>

									<div class="label-remarks">
										<h6>Verbal Interpretation</h6>
										<p>{{ $participantassessment->verbal_interpretation or '---'}}</p>
									</div>
									<div class="label-remarks">
										<h6>Remarks</h6>
										<p>{{ $participantassessment->remarks or '---'}}</p>
									</div>
									<br>
									
					@elseif ($type === "pte")

							<table class="table">
										<thead>
											<tr class="assessment-form">
												<th>Items for Assessment</th>
												<th>Rating</th>
											</tr>
										</thead>
										<tbody>
											@foreach($assessmentresponse as $key => $value)
												<tr>
													<td><p>{{ $value->name }}</p></td>
													<td><p>{{ $value->rating }}</p></td>
												</tr>
											@endforeach
										</tbody>
									</table>

									<div class="label-remarks">
										<h6>Verbal Interpretation</h6>
										<p>{{ $participantassessment->verbal_interpretation or '---'}}</p>
									</div>
									<div class="label-remarks">
										<h6>Remarks</h6>
										<p>{{ $participantassessment->remarks or '---'}}</p>
									</div>
									<br>
					@endif
					</div>
			</div>
		</div>
	</div>
</div>

@stop