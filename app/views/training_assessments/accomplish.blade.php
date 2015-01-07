@extends('layouts.index')

@section('title')
	Accomplish Pre-Training Assessment - 
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h2 class="panel-header">Pre-Training Assessment</h2>	

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
							<h5>{{ $participant->name or '---' }}</h5>
							<h5>{{ $participant->position or '---' }}</h5>
						</div>
						<div class="col-sm-4 col-md-4">
							<h6>School/College/Department:</h6>
							<p>{{ $participant->scd or '---' }}</p>
						</div>
					</div>
					<div class="row training-details">
						<div class="col-sm-2 col-md-2">
							<h6>Training Theme: </h6>
							<h6>Training Organizer:</h6>
						</div>
						<div class="col-sm-6 col-md-6">
							<h5>{{ "hello" }}</h5>
							<h5>{{ "hello" }}</h5>
						</div>

						<div class="col-sm-1 col-md-1">
							<h6>Venue:</h6>
							<h6>Schedule:</h6>
						</div>
						<div class="col-sm-3 col-md-3">
							<h5>{{ $trainingdetails->venue or '---' }}</h5>
							<h5>
							@if(isset($internaltrainings))
								{{ $trainingdetails->schedule }}</h5>
							@endif
						</div>

						<div class="col-sm-12 col-md-12">
							<h6>Objectives:</h6>
							<p>{{ $internaltrainings->objectives or '---' }}</p>
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

				</div>
			</div>
		</div>
	</div>
</div>

@stop