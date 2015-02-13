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
							<td colspan="2">Topic/Theme: <b>{{ $internaltrainings->title . " | " . $internaltrainings->theme_topic }}</b></td>
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
							<td><center>{{ number_format($aae_average, 2) }}</center></td>
							<td><center>{{ $aae_verbal }}</center></td>
						</tr>
						<tr>
							<td colspan="2">Pre-Training Assessment</td>
							<td><center>{{ number_format($pta_average, 2) }}</center></td>
							<td><center>{{$ptaverbal}}</center></td>
						</tr>
						<tr>
							<td colspan="2">Post-Training Assessment</td>
							<td><center>{{ number_format($pte_average, 2) }}</center></td>
							<td><center>{{ $pte_verbal }}</center></td>
						</tr>
					</table>
					<table id="tb-observations/analysis" class="table table-striped table-bordered">
						<tr>
							<td colspan="4"><b>Observations/ Analysis/ Evaluation on knowledge/ skills/ attitude/ competency acquired/ developed and potential/ actual impact in the workplace/ expected outcome/ return on investment</b></td>
						</tr>
						<tr> 
							<td colspan="4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
						</tr>
					</table>
					<table id="tb-reco/evals" class="table table-striped table-bordered">
						<tr>
							<td colspan="4"><b>Recommendation/s on training planning, content design and development, administration/ management, facilitation and delivery, evaluation</b></td>
						</tr>
						<tr>
							<td colspan="4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
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