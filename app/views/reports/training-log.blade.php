
<div class="col-sm-12 col-md-12">
	<div id="training-log-content" class="panel">
		<div class="row">
		<div class="panel-heading">
			<div align="center">
				<div style="display:inline-block;vertical-align:top;">
					<img src={{asset('assets/img/CEU_logo.jpg')}} alt="logo" class="img-responsive" width="100">
				</div>
				<div style="display:inline-block;" align="center">
					<h4>Centro Escolar University</h4>
					<h4>Manila*Makati*Malolos</h4>
					<h4>Human Resources Department</h4>
				</div>
			</div>

			<div align="center">
				<h4>Training Log</h4>
				<h4>Period Covered: April 1, _____ to March 31, _____</h4>
			</div>

			<div align="center">
				<input type="checkbox" name="role" value="Top/middleManager" disabled>Top/Middle Manager
				<input type="checkbox" name="role" value="SeniorStaff" disabled>Senior Staff    _____Academic    _____Non-Academic

				<input type="checkbox" name="role" value="Faculty" disabled>Faculty Member
				<input type="checkbox" name="role" value="NonTeaching" disabled>Non-Teaching Employee
			</div>
<br>
			<div align="center">
				<table class="table">
					<thead>
						<tr>
							<th>Employee No.</th>
							<th>Name (Last Name, First Name, Middle Initial):</th>
							<th>Campus:</th>
							<th>School/College:</th>
							<th>Department:</th>
							<th>Signature:</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$emp_details[0]->employee_number}}</td>
							<td>{{$emp_details[0]->last_name . ', ' . $emp_details[0]->given_name . ' ' . $emp_details[0]->middle_initial}}</td>
							<td>{{$emp_desig_details[1]}}</td>
							<td>{{$emp_desig_details[2]}}</td>
							<td>{{$emp_desig_details[3]}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="message-log"></div>

			<table class="table table-bordered">
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

		</div>
	</div>
</div>

@stop
