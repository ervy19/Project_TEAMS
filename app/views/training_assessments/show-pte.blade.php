@extends('layouts.index')

@section('title')
	Post Training Evaluation - 
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h2 class="panel-header">Post Training Evaluation</h2>	
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
							<h5>{{ $internaltrainings->theme_topic or '---' }}</h5>
							<h5>{{ $internaltrainings->organizer or '---' }}</h5>
						</div>

						<div class="col-sm-1 col-md-1">
							<h6>Venue:</h6>
							<h6>Schedule:</h6>
						</div>
						<div class="col-sm-3 col-md-3">
							<h5>{{ $internaltrainings->venue or '---' }}</h5>
							<h5>
							@if(isset($internaltrainings))
								{{ $internaltrainings->date_start . ' (' . $internaltrainings->time_start . "-" . $internaltrainings->time_end . ") " . " | " . $internaltrainings->date_end . ' (' . $internaltrainings->time_start . "-" . $internaltrainings->time_end . ')' }}</h5>
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
			<div class="col-sm-12 col-md-12 pte-form">
				<div class="panel">
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
							<tr>
								<td>ITEM</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>ITEM2</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>

					<h5 class="label-remarks">Remarks</h5>
					<p>
					</p>

				</div>
			</div>
		</div>
	</div>
</div>

@stop