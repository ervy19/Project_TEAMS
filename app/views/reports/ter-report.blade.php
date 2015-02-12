@extends('layouts.index')

@section('title')
	Training Effectiveness Evaluation Report
@stop

@section('content')
<div class="col-sm-12 col-md-12">
	<div class="panel">
	</div>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">
			<table id="tb-ter-report" class="table table-striped table-bordered">
				<table id="tb-pta-report" class="table table-striped table-bordered">
					<thead>
						<br>
						<tr>
							<td colspan="4">
								<center><b>CENTRO ESCOLAR UNIVERSITY<br>
									Manila*Makati*Malolos<br></b>
									<i>Human Resource Department</i><br><br>
									<b>Training Effectiveness Evaluation</b><br>
									(To be prepared by Human Resource Department)
								</center>
							</td>
						</tr>
						<tr>
							<td class="col-sm-4 col-md-4">
								School/College/Department: <b>{{ $schoolcollege . " | " . $department }}</b>
							</td>
							<td class="col-sm-3 col-md-3">
								Date: <b>{{ $date_start . " - " . $date_end }}</b>
							</td>
							<td class="col-sm-2 col-md-2">
								Venue: <b>{{ $internaltrainings->venue }} </b>
							</td>
							<td class="col-sm-3 col-md-3">
								Time: <b>{{ $time_start_s . "-" . $time_end_s . " | " . $time_start_e . "-" . $time_end_e }} </b>
							</td>
						</tr>
						<tr>
							<td colspan="2">Topic/Theme: <b>{{ $internaltrainings->theme_topic }}</b></td>
							<td colspan="2">Speaker/s: <b>{{ $speakerstring }}</b></td>
						</tr>
					</table>
						</thead>
						<tbody>
					<table id="tb-objectives/competencies" class="table table-striped table-bordered">
						<tr>
							<td colspan="4"><b>Objectives/Compentencies Targeted: </b></td>
						</tr>
							@foreach($scnames as $value)
							<tr>
									<td colspan="4">{{ $value["count"] . ". " . $value["name"] }}</td>
							</tr>
							@endforeach
					</table>
					<table id="tb-evals" class="table table-striped table-bordered">
						<tr>
							<th colspan="2"><center>Evaluation Instrument</center></th>
							<th><center>Rating</center></th>
							<th><center>Verbal Interpretation</center></th>
						</tr>
						<tr>
							<td colspan="2">HR Development Activity Evaluation</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">Pre-Training Assessment</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">Post-Training Assessment</td>
							<td></td>
							<td></td>
						</tr>
					</table>
					<table id="tb-observations/analysis" class="table table-striped table-bordered">
						<tr>
							<td colspan="4"><b>Observations/ Analysis/ Evaluation on knowledge/ skills/ attitude/ competency acquired/ developed and potential/ actual impact in the workplace/ expected outcome/ return on investment</b></td>
						</tr>
						<tr> 
							<td colspan="4">{{ $eval_narrative or 'Not Accomplished Yet'}}</td>
						</tr>
					</table>
					<table id="tb-reco/evals" class="table table-striped table-bordered">
						<tr>
							<td colspan="4"><b>Recommendation/s on training planning, content design and development, administration/ management, facilitation and delivery, evaluation</b></td>
						</tr>
						<tr>
							<td colspan="4">{{ $recommendations or 'Not Accomplished Yet' }}</td>
						</tr>
					</table>
						</tbody>
					</table>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
@section('page_js')
@stop