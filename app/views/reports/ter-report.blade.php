<!DOCTYPE html>
<html style="font-family:Arial; font-size:12;">
<<<<<<< HEAD
<head>
</head>
<body>
				<table id="tb-ter-report" style="border:2px solid black;border-collapse:collapse; width:100%;">
					<thead>
						<br>
						<tr>
							<td colspan="4" style="border:1px solid black;">
								<center><b><br>CENTRO ESCOLAR UNIVERSITY<br>
=======
	<head>
	</head>
	<body>
			<table id="tb-ter-report" style="border:2px solid black;border-collapse:collapse; width:100%;">
					<thead>
						<br>
						<tr>
							
							<td colspan="4" style="border:1px solid black;">
								<div align="center">
								<div style="display:inline-block;vertical-align:top;">
									<img src={{asset('assets/img/CEU_logo.jpg')}} alt="logo" class="img-responsive" width="100">
								</div>
								<div style="display:inline-block;" align="center" id="header">
									<b>CENTRO ESCOLAR UNIVERSITY<br>
>>>>>>> origin/master
									Manila*Makati*Malolos<br></b>
									<i>Human Resource Department</i><br><br>
									<b>Training Effectiveness Evaluation</b><br>
									(To be prepared by Human Resource Department)<br><br>
<<<<<<< HEAD
								</center>
=======
								</div>
							</div>
>>>>>>> origin/master
							</td>
						</tr>
						<tr>
							<td style="border:1px solid black; padding:8px;">
								School/College/Department: <b>{{ $schoolcollege . " | " . $department }}</b>
							</td>
							<td style="border:1px solid black; padding:8px;">
								Date: <b>{{ $date_start . " - " . $date_end }}</b>
							</td>
							<td style="border:1px solid black; padding:8px;">
								Venue: <b>{{ $internaltrainings->venue }} </b>
							</td>
							<td style="border:1px solid black; padding:8px;">
								Time: <b>{{ $time_start_s . "-" . $time_end_s . " | " . $time_start_e . "-" . $time_end_e }} </b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:8px;">Topic/Theme: <b>{{ $internaltrainings->title . " | " . $internaltrainings->theme_topic }}</b></td>
							<td colspan="2" style="border:1px solid black; padding:8px;">Speaker/s: <b>{{ $speakerstring }}</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="4" style="border:1px solid black; background-color:#CFCFCF; vertical-align:middle; padding:8px;"><b>Objectives/Compentencies Targeted: </b></td>
						</tr>
							@foreach($scnames as $value)
							<tr>
									<td colspan="4" style="border:1px solid black; padding:3px;">{{ $value["count"] . ". " . $value["name"] }}</td>
							</tr>
							@endforeach
					<br>
<<<<<<< HEAD
						<tr>
							<th colspan="2" style="border:1px solid black; background-color:#CFCFCF; padding:8px;"><center>Evaluation Instrument</center></th>
							<th style="border:1px solid black; background-color:#CFCFCF; padding:8px;"><center>Rating</center></th>
							<th style="border:1px solid black; background-color:#CFCFCF; padding:8px;"><center>Verbal Interpretation</center></th>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:3px;">HR Development Activity Evaluation</td>
							<td style="border:1px solid black;"><center>{{ number_format($aae_average, 2) }}</center></td>
							<td style="border:1px solid black;"><center>{{ $aae_verbal }}</center></td>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:3px;">Pre-Training Assessment</td>
							<td style="border:1px solid black;"><center>{{ number_format($pta_average, 2) }}</center></td>
							<td style="border:1px solid black;"><center>{{$pta_verbal}}</center></td>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:3px;">Post-Training Assessment</td>
							<td style="border:1px solid black;"><center>{{ number_format($pte_average, 2) }}</center></td>
							<td style="border:1px solid black;"><center>{{ $pte_verbal }}</center></td>
						</tr>
						<tr>
=======
						<tr>
							<th colspan="2" style="border:1px solid black; background-color:#CFCFCF; padding:8px;"><center>Evaluation Instrument</center></th>
							<th style="border:1px solid black; background-color:#CFCFCF; padding:8px;"><center>Rating</center></th>
							<th style="border:1px solid black; background-color:#CFCFCF; padding:8px;"><center>Verbal Interpretation</center></th>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:3px;">HR Development Activity Evaluation</td>
							<td style="border:1px solid black;"><center>{{ number_format($aae_average, 2) }}</center></td>
							<td style="border:1px solid black;"><center>{{ $aae_verbal }}</center></td>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:3px;">Pre-Training Assessment</td>
							<td style="border:1px solid black;"><center>{{ number_format($pta_average, 2) }}</center></td>
							<td style="border:1px solid black;"><center>{{$pta_verbal}}</center></td>
						</tr>
						<tr>
							<td colspan="2" style="border:1px solid black; padding:3px;">Post-Training Assessment</td>
							<td style="border:1px solid black;"><center>{{ number_format($pte_average, 2) }}</center></td>
							<td style="border:1px solid black;"><center>{{ $pte_verbal }}</center></td>
						</tr>
						<tr>
>>>>>>> origin/master
							<td colspan="4" style="padding:8px; border:2px solid black;">
								<br>
									<b>Observations/ Analysis/ Evaluation on knowledge/ skills/ attitude/ competency acquired/ developed and potential/ actual impact in the workplace/ expected outcome/ return on investment</b><br><br>
										{{ $eval_narrative }}
								<br><br>
							</td>
						</tr>
						<tr>
							<td colspan="4" style="padding:8px;">
								<br>
								<b>Observations/ Analysis/ Evaluation on knowledge/ skills/ attitude/ competency acquired/ developed and potential/ actual impact in the workplace/ expected outcome/ return on investment</b><br><br>
							{{ $eval_narrative }}
								<br><br>
							</td>
						</tr>
						<tr>
							<td style="vertical-align:middle; padding:8px; width:50%; border:1px solid black;" colspan="2">
								&nbsp;&nbsp;&nbsp;&nbsp;Prepared by: <br><br><br>
								<center>_____________________________________<br>
								Signature Over Printed Name<br>
								<br>
								<center>_____________________________________<br>
								Date</center>

							</td>
							<td style="vertical-align: middle; padding:8px; width:50%; border:1px solid black;" colspan="2">
								&nbsp;&nbsp;&nbsp;&nbsp;Noted by: <br><br><br>
								<center>_____________________________________<br>
								Signature Over Printed Name<br>
								<br>
								<center>_____________________________________<br>
								Date</center>
							</td>
						</tr>
						<tr>
							<td colspan="4" style="vertical-align:middle; padding:2px">
								<b>Copy to: Human Resource Department, {{ $schoolcollege . " | " . $department }}</b>
							</td>
						</tr>	
<<<<<<< HEAD

					</table>
					

					<br>
					<table id="tb-ter-participants" align="center" border="1" style="width:100%; border:2px solid black;border-collapse:collapse;">
=======
				</table>
				<br>
				<table id="tb-ter-participants" align="center" border="1" style="width:100%; border:2px solid black;border-collapse:collapse;">
>>>>>>> origin/master
						<tr>
							<th rowspan="2" style="vertical-align: middle; padding:6px; background-color:#CFCFCF;"><center>Employee Name</center></th>
							<th colspan="4" style="padding:6px; background-color:#CFCFCF; "><center>Rating</center></th>
						</tr>
						<tr>
							<th style="padding:6px; background-color:#CFCFCF;"><center>Pre-Training</center></th>
							<th style="padding:6px; background-color:#CFCFCF;"><center>Verbal Interpretation</center></th>
							<th style="padding:6px; background-color:#CFCFCF;"><center>Post-Training</center></th>
							<th style="padding:6px; background-color:#CFCFCF;"><center>Verbal Interpretation</center></th>
						</tr>

						@foreach ($participants as $value)
						<tr>
							<td style="padding:3px;">{{ $value["last"] . ", " . $value["given"] . " " . $value["mi"] }}</td>
							<td style="padding:3px;"><center>{{ number_format($value["pta"], 2) }}</center></td>
							<td style="padding:3px;"><center>{{ $value["ptaverbal"] }}</center></td>
							<td style="padding:3px;"><center>{{ number_format($value["pte"], 2) }}</center></td>
							<td style="padding:3px;"><center>{{ $value["pteverbal"] }}</center></td>
						</tr>
						@endforeach
						<tr>
							<td align="right" style="padding:3px;"><b><i>Overall</b></i></td>
							<td style="padding:3px;"><center><b><i>{{ number_format($overallaveratings[0]["overallpta"], 2) }}</b></i></center></td>
							<td style="padding:3px;"><center><b><i>{{ $overallaveratings[0]["overallptaverbal"] }}</b></i></center></td>
							<td style="padding:3px;"><center><b><i>{{ number_format($overallaveratings[0]["overallpte"], 2) }}</b></i></center></td>
							<td style="padding:3px;"><center><b><i>{{ $overallaveratings[0]["overallpteverbal"] }}</b></i></center></td>
						</tr>
<<<<<<< HEAD

					</table>
				</tbody>
			</table>
		</table>
			</div>
</body>
=======
				</table>
			</div>
	</body>
>>>>>>> origin/master
</html>