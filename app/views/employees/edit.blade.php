@extends('layouts.index')

@section('title')
	Edit Employee
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('employees') }}">Employees</a></li>
	<li>Edit Employee</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Employee</h1>

			<a href="{{ URL::to('employees') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			<!--{{ HTML::ul($errors->all()) }}-->

			{{ Form::model($employees, array('route' => array('employees.update', $employees->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('employee_number','Employee Number: ') }}
					{{ Form::text('employee_number') }}
					{{ $errors->first('employee_number') }}
				</div>

				<div class="form-group">
					{{ Form::label('last_name','Last Name: ') }}
					{{ Form::text('last_name') }}
					{{ $errors->first('last_name') }}
				</div>

				<div class="form-group">
					{{ Form::label('given_name','Given Name: ') }}
					{{ Form::text('given_name') }}
					{{ $errors->first('given_name') }}
				</div>

				<div class="form-group">
					{{ Form::label('middle_initial','Middle Initial: ') }}
					{{ Form::text('middle_initial') }}
					{{ $errors->first('middle_initial') }}
				</div>

				<div class="form-group">
					{{ Form::label('email','Email Address: ') }}
					{{ Form::text('email') }}
					{{ $errors->first('email') }}
				</div>

				<div class="form-group">
					{{ Form::label('age','Age: ') }}
					{{ Form::text('age') }}
					{{ $errors->first('age') }}
				</div>

				<div class="form-group">
					{{ Form::label('tenure','Tenure: ') }}
					{{ Form::text('tenure') }}
					{{ $errors->first('tenure') }}
				</div>

				<div class="form-group" id="dynamicInput">
			    </div>
			    <input type="button" value="Add an Employee Designation" onClick="addInput('dynamicInput');" class="btn btn-primary">
			    <input type="button" value="Remove Employee Designation" onclick="removeInput('dynamicInput');" class="btn btn-primary">
			    <input type="hidden" id="count" name="count" />
				
				{{ Form::submit('Save') }}

			{{ Form::close() }}
			
		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		var count = 0;
		var univID = 10;
		document.getElementById('count').value = count;
		(function autofill() {
			var data_array = {{json_encode($selected_data)}};
			for (var i = 0; i < data_array.length; i++) {
				addInput('dynamicInput');

					$("#" + (univID-7)).val(data_array[i][0]);
					$("#" + (univID-6)).val(data_array[i][1]);
					$("#" + (univID-5)).val(data_array[i][2]);
					$("#" + (univID-4)).val(data_array[i][3]);
					$("#" + (univID-3)).val(data_array[i][4]);
					$("#" + (univID-2)).val(data_array[i][5]);
					$("#" + (univID-1)).val(data_array[i][6]);
			};
		})()

		function addInput(divName) {	
			//http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
		    var newdiv = document.createElement('div');
		    count++;
		    document.getElementById('count').value = count;
		    newdiv.setAttribute('id', count);
		    newdiv.innerHTML = 	"<h2>Employee Designation " + count + "</h2>" +
		    					"<br><label>Designation Type:&nbsp</label><select id=" + (univID) + " name='myInputs" + count + "[]'><option value='Teaching'>Teaching</option><option value='Non-Teaching'>Non-Teaching</option> </select><br>" +
		    					"<br><label>Campus:&nbsp</label><select id=" + (univID+1) + " name='myInputs" + count + "[]'><?php foreach($campuses as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
		    					"<br><label>School/College:&nbsp</label><select id=" + (univID+2) + " name='myInputs" + count + "[]'><?php foreach($schools_colleges as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
		    					"<br><label>Department:&nbsp</label><select id=" + (univID+3) + " name='myInputs" + count + "[]'><?php foreach($departments as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
								"<br><label>Supervisor:&nbsp</label><select id=" + (univID+4) + " name='myInputs" + count + "[]'><?php foreach($supervisors as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
		    					"<br><label>Position:&nbsp</label><select id=" + (univID+5) + " name='myInputs" + count + "[]'><?php foreach($positions as $key => $value): ?> <option value='<?php echo $value->title ?>'><?php echo $value->title ?></option> <?php endforeach; ?> </select><br>" +
								"<br><label>Rank:&nbsp</label><select id=" + (univID+6) + " name='myInputs" + count + "[]'><?php foreach($ranks as $key => $value): ?> <option value='<?php echo $value->title ?>'><?php echo $value->title ?></option><?php endforeach; ?></select><br>"
								;
			univID = univID + 7;
		    document.getElementById(divName).appendChild(newdiv);
		}

		function removeInput(parentDiv, childDiv) {
			childDiv = document.getElementById('count').value;
			//http://www.randomsnippets.com/2008/03/26/how-to-dynamically-remove-delete-elements-via-javascript/
			if (document.getElementById(childDiv)) {     
		          var child = document.getElementById(childDiv);
		          var parent = document.getElementById(parentDiv);
		          parent.removeChild(child);
		          count--;
		          document.getElementById('count').value = count;
		          univID = univID -	7;	          
		     }
		     else {
		          alert("Child div has already been removed or does not exist.");
		          return false;
		     }
		}
	</script>
@stop