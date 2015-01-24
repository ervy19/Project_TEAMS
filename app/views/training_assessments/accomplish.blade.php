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
			<div class="col-sm-12 col-md-12 training-info">
				<div class="panel">
					<div class="row training-details">
						<div class="col-sm-2 col-md-2">
							<h6>Participant Name:</h6>
							<h6>Position:</h6>
						</div>
						<div class="col-sm-6 col-md-6">
							<h5>{{ "Sophia Hernandez" }}</h5>
							<h5>{{ "faculty" }}</h5>
						</div>
						@foreach($internaltraining as $training)
						<div class="col-sm-4 col-md-4">
							<h6>School/College/Department:</h6>
							<p>{{ $training->name }}</p>
						</div>
					</div>
					<div class="row training-details">
						<div class="col-sm-2 col-md-2">
							<h6>Training Theme: </h6>
							<h6>Training Organizer:</h6>
						</div>
						<div class="col-sm-6 col-md-6">
							<h5>{{ $training->theme_topic }}</h5>
							<h5>{{ $training->name }}</h5>
						</div>

						<div class="col-sm-1 col-md-1">
							<h6>Venue:</h6>
							<h6>Schedule:</h6>
						</div>
						<div class="col-sm-3 col-md-3">
							<h5>{{ $training->venue }}</h5>
							<h5>{{ $training->schedule }}</h5>
						</div>

						<div class="col-sm-12 col-md-12">
							<h6>Objectives:</h6>
							<p>{{ $training->objectives }}</p>
						</div>
						@endforeach
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

					@if ($type === 'pta')
						@if (is_null($assessmentresponse)) 
							{{ Form::open(array('url' => 'internal_trainings/1/pta/1')) }}

							<table class="table">
								<thead>
									<tr class="assessment-form">
										<th>Items for Assessment</th>
										<th>5</th>
										<th>4</th>
										<th>3</th>
										<th>2</th>
										<th>1</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($assessmentitems as $key => $value)
									<tr>
										<td>{{ $value }}</td>
										<td>{{ Form::radio($value, '5'); }}</td>
										<td>{{ Form::radio($value, '4'); }}</td>
										<td>{{ Form::radio($value, '3'); }}</td>
										<td>{{ Form::radio($value, '2'); }}</td>
										<td>{{ Form::radio($value, '1'); }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>

							<h5 class="label-remarks">Verbal Interpretation</h5>
							<textarea class="remarks" name="verbalinterpretation"></textarea>

							<h5 class="label-remarks">Remarks</h5>
							<textarea class="remarks" name="remarks"></textarea>

							{{ Form::submit('Submit PTA Report', array('class' => 'pta-form-btn pull-right')) }}

						{{ Form::close() }}

						@else 							    
							
							<table class="table">
										<thead>
											<tr class="assessment-form">
												<th>Items for Assessment</th>
												<th>Rating</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < $itemcount; $i++)
												<tr>
													<td>{{ $assessmentresponse[$i]->name }}</td>
													<td>{{ $assessmentresponse[$i]->rating }}</td>
												</tr>
											@endfor
										</tbody>
									</table>

									<div class="label-remarks">
										<h6>Verbal Interpretation</h6>
										<p>{{ $participantassessment[0]->verbal_interpretation or '---'}}</p>
									</div>
									<div class="label-remarks">
										<h6>Remarks</h6>
										<p>{{ $participantassessment[0]->remarks or '---'}}</p>
									</div>
									<br>
							@endif
							
					@elseif ($type === 'pte')
						@if (is_null($assessmentresponse)) 
							     {{ Form::open(array('url' => 'internal_trainings/1/pte/1')) }}

									<table class="table">
										<thead>
											<tr class="assessment-form">
												<th>Items for Assessment</th>
												<th>5</th>
												<th>4</th>
												<th>3</th>
												<th>2</th>
												<th>1</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($assessmentitems as $key => $value)
											<tr>
												<td>{{ $value }}</td>
												<td>{{ Form::radio($value, '5'); }}</td>
												<td>{{ Form::radio($value, '4'); }}</td>
												<td>{{ Form::radio($value, '3'); }}</td>
												<td>{{ Form::radio($value, '2'); }}</td>
												<td>{{ Form::radio($value, '1'); }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>

									<h5 class="label-remarks">Verbal Interpretation</h5>
									<textarea class="remarks" name="verbalinterpretation"></textarea>

									<h5 class="label-remarks">Remarks</h5>
									<textarea class="remarks" name="remarks"></textarea>

									{{ Form::submit('Submit PTE Report', array('class' => 'pta-form-btn pull-right')) }}

								{{ Form::close() }}

							@else 							    
							
							<table class="table">
										<thead>
											<tr class="assessment-form">
												<th>Items for Assessment</th>
												<th>Rating</th>
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < $itemcount; $i++)
												<tr>
													<td>{{ $assessmentresponse[$i]->name }}</td>
													<td>{{ $assessmentresponse[$i]->rating }}</td>
												</tr>
											@endfor
										</tbody>
									</table>

									<div class="label-remarks">
										<h6>Verbal Interpretation</h6>
										<p>{{ $participantassessment[0]->verbal_interpretation or '---'}}</p>
									</div>
									<div class="label-remarks">
										<h6>Remarks</h6>
										<p>{{ $participantassessment[0]->remarks or '---'}}</p>
									</div>
									<br>
							@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@stop