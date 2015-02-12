@extends('layouts.index')

@section('title')
	Pre-Training Assessment Report
@stop

@section('content')
<div class="col-sm-12 col-md-12">
	<div class="panel">
	</div>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<table id="tb-pta-report" class="table table-striped table-bordered">
					<thead>
						<br>
						<tr>
							<td colspan="2">
								<center><b>CENTRO ESCOLAR UNIVERSITY<br>
									Manila*Makati*Malolos<br></b>
									<i>Human Resource Department</i><br><br>
									<b>HUMAN RESOURCE PRE-TRAINING ASSESSMENT</b></center>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<b>Title: {{ $internaltraining->title }} </b>
							</td>
						</tr>
						<tr>
							<td class="col-sm-7 col-md-7"><b>Office/School/Department: {{ $department . " | " . $schoolcollege}} </b></td>
							<td class="col-sm-5 col-md-5"><b>Date: {{ $internaltraining->schedule }} </b></td>
						</tr>
						<tr>
							<td class="col-sm-7 col-md-7"><b>Participants: </b></td>
							<td class="col-sm-5 col-md-5"><b>Venue: {{ $internaltraining->venue }} </b></td>
						</tr>
						</table>
					</thead>
					<tbody>
						<tr>
							<table id="tb-aae-report" class="table table-striped table-bordered" border="2">
								<tr>
									<td colspan="5"><b><i><center>Human Resource Development Activity Evaluation Report</b></i></center></td>
								</tr>
								<tr>
									<th class="col-sm-6 col-md-6" rowspan="2" halign="center"><center>Criterion</center></th>
									<th colspan="4"><center>N = 14</center></th>
								</tr>
								<tr>
									<th><center>Mean</center></th>
									<th><center>S.D.</center></th>
									<th><center>Verbal Interpretation</center></th>
									<th><center>Rank</center></th>
								</tr>
								<!--SAMPLE CRITERIA-->
								@foreach ($assessment_items as $item)
								<tr>
									<td>{{$item->name}}</td>
									<td><center>3.64</td></center>
									<td><center>0.63</td></center>
									<td><center>Extensive Knowledge</td></center>
									<td><center>1</td></center>
								</tr>
								@endforeach

								<tr>
									<td align="right"><b><i>Overall</td>
									<td><center><b><i>3.64</b></i></td></center>
									<td><center><b><i>0.63</b></i></td></center>
									<td><center><b><i>Extensive Knowledge</b></i></td></center>
									<td></td>
								</tr>
							</table>
					</tr>
						<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.5 - 5   Very Extensive Knowledge/ Very Skillful/ Highly Positive Attitude<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.5 - 4 Extensive Knowledge/ Skillful/ Positive Attitude<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.5 - 3 Adequate Knowledge/ Adequately Skillful/ Neutral Attitude<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.5 - 2 Inadequate Knowledge/ Lacks Skillful/ Ambivalent<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0.5 - 1 No Knowledge/ No Skillful/ Unfavorable Attitude<br>
						<br>
						<br>
					<table class="table table-striped table-bordered">
						<tr>
							<th colspan="5"><u>Summary of Comments/Suggestions:</u></th>
						</tr>
						<tr>
							<td colspan="5"> <br><br><br><br><br></td>
						</tr>
						<tr>
								<td class="col-sm-6 col-md-6">
									<b>Processed by:</b><br><br><br>
									Ludwella Z. Tambiloc<br>
									HRD Assistant<br>
									Date:
								</td>
								<td class="col-sm-6 col-md-6">
									<b>Noted by:</b><br><br><br>
									Miss Ana Marie T. Afortunado<br>
									Head, Human Resource Department<br>
									Date:
								</td>
						</tr>
					</table>
					</tbody>
				
			</div>
		</div>
	</div>
</div>
@stop
@section('page_js')
@stop