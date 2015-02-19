<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<table style="width: 100%" border="1">
		<tbody>
			<tr>
				<td style="width: 100%" colspan="2">
					<table style="width: 100%" border="0">
						<tbody>
							<tr>
								<td style="width: 30%" align="right">
									<img src={{asset('assets/img/CEU_logo.jpg')}} width="75">
								</td>
								<td style="width: 70%" align="left">
									<p>
										Centro Escolar University <br>
										Manila*Makati*Malolos <br>
										Human Resources Department
									</p>
								</td>
							</tr>
							<tr>
								<td style="width: 100%" align="center" colspan="2">
									<b>Training Effectiveness Evaluation</b><br>
										(To Be Prepared by Human Resource Department)
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%" colspan="2">
					<table style="width: 100%" border="1">
						<tbody>
							<tr>
								<td>
									School/College/Department: <b>{{ $schoolcollege . " | " . $department }}</b>
								</td>
								<td>
									Date: <b>{{ $date_start . " - " . $date_end }}</b>
								</td>
								<td>
									Venue: <b>{{ $internaltrainings->venue }} </b>
								</td>
								<td>
									Time: <b>{{ $time_start_s . "-" . $time_end_s . " | " . $time_start_e . "-" . $time_end_e }} </b>
								</td>
							</tr>
							<tr>
								<td style="width: 50%" colspan="2">
									Topic/Theme: <b>{{ $internaltrainings->title . " | " . $internaltrainings->theme_topic }}</b>
								</td>
								<td style="width: 50%" colspan="2">
									Speakers: <b>{{ $speakerstring }}</b>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%" colspan="2">
					<table style="width: 100%" border="1">
						<thead>
							<tr>
								<th align="left" style="background-color:#CFCFCF;">Objectives/Competencies Targeted:</th>
							</tr>
						</thead>
						<tbody>
							@foreach($scnames as $value)
							<tr>
									<td align="left">{{ $value["count"] . ". " . $value["name"] }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%" colspan="2">
					<table style="width: 100%" border="1">
						<thead>
							<tr>
								<th style="background-color:#CFCFCF; width: 50%" align="center">Evaluation Instrument</th>
								<th style="background-color:#CFCFCF; width: 20%" align="center">Rating</th>
								<th style="background-color:#CFCFCF; width: 30%" align="center">Verbal Interpretation</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="left">HR Development Activity Evaluation</td>
								<td align="center">{{ number_format($aae_average, 2) }}</td>
								<td align="center">{{ $aae_verbal }}</td>
							</tr>
							<tr>
								<td align="left">Pre-Training Assessment</td>
								<td align="center">{{ number_format($pta_average, 2) }}</td>
								<td align="center">{{ $pta_verbal }}</td>
							</tr>
							<tr>
								<td align="left">Post-Training Assessment</td>
								<td align="center">{{ number_format($pte_average, 2) }}</td>
								<td align="center">{{ $pte_verbal }}</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%" align="left" colspan="2">
					Observations/ Analysis/ Evaluation on knowledge/ skills/ attitude/ competency acquired/ developed and potential/ actual impact in the workplace/ expected outcome/ return on investment <br><br>
					{{ $eval_narrative }}
				</td>
			</tr>
			<tr>
				<td style="width: 100%" align="left" colspan="2">
					Recommendation/s on training planning, content design and development, administration/ management, facilitation and delivery, evaluation <br><br>
					{{ $recommendations }}
				</td>
			</tr>
			<tr>
				<td style="width: 50%">
					Prepared by: <br><br>
					<center>_____________________________________<br>
					<center>Signature Over Printed Name<br>
					<br>
					<center>_____________________________________<br>
					<center>Date
				</td>
				<td style="width: 50%">
					Noted by: <br><br>
					<center>_____________________________________<br>
					<center>Signature Over Printed Name<br>
					<br>
					<center>_____________________________________<br>
					<center>Date
				</td>
			</tr>
			<tr>
				<td style="width: 100%" colspan="2">
					<table align="center" border="1" style="width:100%">
						<thead>
							<tr>
								<th rowspan="2" style="background-color:#CFCFCF" align="center">Employee Name</th>
								<th colspan="4" style="background-color:#CFCFCF" align="center">Rating</th>
							</tr>
							<tr>
								<th style="background-color:#CFCFCF" align="center">Pre-Training</th>
								<th style="background-color:#CFCFCF" align="center">Verbal Interpretation</th>
								<th style="background-color:#CFCFCF" align="center">Post-Training</th>
								<th style="background-color:#CFCFCF" align="center">Verbal Interpretation</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($participants as $value)
								<tr>
									<td align="left">{{ $value["last"] . ", " . $value["given"] . " " . $value["mi"] }}</td>
									<td align="center">{{ number_format($value["pta"], 2) }}</td>
									<td align="center">{{ $value["ptaverbal"] }}</td>
									<td align="center">{{ number_format($value["pte"], 2) }}</td>
									<td align="center">{{ $value["pteverbal"] }}</td>
								</tr>
							@endforeach
							<tr>
								<td align="right"><b><i>Overall</b></i></td>
								<td align="center"><b><i>{{ number_format($overallaveratings[0]["overallpta"], 2) }}</b></i></td>
								<td align="center"><b><i>{{ $overallaveratings[0]["overallptaverbal"] }}</b></i></td>
								<td align="center"><b><i>{{ number_format($overallaveratings[0]["overallpte"], 2) }}</b></i></td>
								<td align="center"><b><i>{{ $overallaveratings[0]["overallpteverbal"] }}</b></i></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%" align="left" colspan="2">
					<font size="2"><b>Copy to Human Resouces Department, {{ $schoolcollege . " | " . $department }}</b></font>
				</td>
			</tr>
			<tr>
				<td style="width: 100%" align="left" colspan="2">
					<font size="2"><b>HRF118</b></font> <br>
					<font size="2"><b>11/18/2011</b></font>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>