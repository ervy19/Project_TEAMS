<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/php">
        if ( isset($pdf) ) {
            $font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(255,0,0));
        }
    </script>
</head>
<body>
	<table style="width: 100%" border="1">
		<tbody>
			<tr>
				<!--MAIN CELL-->
				<td>
				<table style="width: 100%" border="0">
					<tbody>
						<tr>
							<td style="width: 45%" align="right">
								<img src={{asset('assets/img/CEU_logo.jpg')}} width="75">
							</td>
							<td style="width: 55%" align="left">
								<p>
									Centro Escolar University <br>
									Manila*Makati*Malolos <br>
									Human Resources Department
								</p>
							</td>
						</tr>
						<tr>
							<td align="center" colspan="2">
								<b>Training Log</b> <br>
								Period Covered: April 1, ____ to March 31, ____
							</td>
						</tr>
						<tr>
							<td align="center" style="margin:50px;" colspan="2">
								&#x25A2 Top/Middle Manager &nbsp;&nbsp;&nbsp;
								&#x25A2 Senior Staff ____Academic ____Non-Academic &nbsp;&nbsp;&nbsp;
								&#x25A2 Faculty Member &nbsp;&nbsp;&nbsp;
								&#x25A2 Non-Teaching Employee
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table style="width: 100%" frame="box">
									<tr>
										<td><font size="2">Employee No.</font></td>
										<td><font size="2">Name (Last name, First name, Middle Initial):</font></td>
										<td><font size="2">Campus:</font></td>
										<td><font size="2">School/College:</font></td>
										<td><font size="2">Department:</font></td>
										<td><font size="2">Signature:</font></td>
									</tr>
									<tr>
										<td>{{$emp_details[0]->employee_number}}</td>
										<td>{{$emp_details[0]->last_name . ', ' . $emp_details[0]->given_name . ' ' . $emp_details[0]->middle_initial}}</td>
										<td>{{$emp_desig_details[1]}}</td>
										<td>{{$emp_desig_details[2]}}</td>
										<td>{{$emp_desig_details[3]}}</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table style="width: 100%" border="1">
					<thead>
						<tr>
							<th>Date</th>
							<th>Topic/Theme</th>
							<th>Training Seminar Classification</th>
							<th>Sponsoring Organization</th>
							<th>Venue</th>
							<th>If training is outside CEU, check if subsidized</th>
						</tr>
					</thead>
					<tbody>
						@foreach($it_attended as $key => $value)
							<tr>
								<td>{{$value->date_scheduled}}</td>
								<td>{{$value->theme_topic}}</td>
								<td></td>
								<td>{{$value->name}}</td>
								<td>{{$value->venue}}</td>
								<td></td>
							</tr>
						@endforeach

						@foreach($et_attended as $key => $value)
							<tr>
								<td>{{$value->date_scheduled}}</td>
								<td>{{$value->theme_topic}}</td>
								<td></td>
								<td>{{$value->organizer}}</td>
								<td>{{$value->venue}}</td>
								<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				</td>
			</tr>
			<tr>
				<!--"Copy to HRD" Cell-->
				<td>
					<font size="2">Copy to HRD</font>
				</td>
			</tr>
			<tr>
				<!--Footer Cell-->
				<td>
					<font size="2">HRF 061</font> <br>
					<font size="2">Rev. 2 6/16/2014</font>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>