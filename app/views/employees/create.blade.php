@extends('layouts.index')

@section('title')
	Add Employee
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('employees') }}">Employees</a></li>
	<li>Create Employee</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Add an Employee</h1>

			<a href="{{ URL::to('employees') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			<!-- {{ HTML::ul($errors->all()) }} -->

			{{ Form::open(array('url' => 'employees', 'files' => 'true')) }}
			<br>
				<div class="form-group">
					{{ Form::label('employee_number','Employee Number: ') }}
					{{ Form::text('employee_number', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('employee_number') }}
				</div>

				<div class="form-group">
					{{ Form::label('last_name','Last Name: ') }}
					{{ Form::text('last_name', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('last_name') }}
				</div>

				<div class="form-group">
					{{ Form::label('given_name','Given Name: ') }}
					{{ Form::text('given_name', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('given_name') }}
				</div>

				<div class="form-group">
					{{ Form::label('middle_initial','Middle Initial: ') }}
					{{ Form::text('middle_initial', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('middle_initial') }}
				</div>

				<div class="form-group">
					{{ Form::label('email','Email Address: ') }}
					{{ Form::text('email', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('email') }}
				</div>

				<div class="form-group">
					{{ Form::label('age','Age: ') }}
					{{ Form::text('age', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('age') }}
				</div>

				<div class="form-group">
					{{ Form::label('tenure','Tenure: ') }}
					{{ Form::text('tenure', '', array( 'class' => 'form-control')) }}
					{{ $errors->first('tenure') }}
				</div>

				<div class="form-group" id="dynamicInput">
			    </div>
			    <input type="button" value="Add an Employee Designation" onClick="addInput('dynamicInput');" class="btn btn-primary">
			    <input type="button" value="Remove Employee Designation" onclick="removeInput('dynamicInput');" class="btn btn-primary">
			    <input type="hidden" id="count" name="count" />
				{{ Form::submit('Add Employee') }}

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
				addInput('dynamicInput');
		})()

		function addInput(divName) {	
			//http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
		    var newdiv = document.createElement('div');
		    count++;
		    newdiv.setAttribute('id', count);
		    newdiv.innerHTML = 	"<table id='employee_designation_" + count + " class='table'>" +
		    					"<thead> <tr> <td colspan='2'><h3>Employee Designation " + count + "</h3></td> </tr> </thead>" +
		    					"<tbody>" +
		    					"<tr><td><label>Classification:&nbsp</label></td><td><select id=" + (univID) + " class='form-control' name='myInputs" + count + "[]'><option value='Faculty'>Faculty</option><option value='Non-Teaching'>Non-Teaching</option> </select><br></td></tr>" +
		    					"<tr><td><label>Title:&nbsp</label></td><td><input type='text' id=" + (univID+1) + " class='form-control' name='myInputs" + count + "[]'><br></td></tr>" +
		    					"<tr><td><label>Campus:&nbsp</label></td><td><select id=" + (univID+2) + " class='form-control' name='myInputs" + count + "[]'><?php foreach($campuses as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br></td></tr>" +
		    					"<tr><td><label>School/College:&nbsp</label></td><td><select id=" + (univID+3) + " class='form-control' name='myInputs" + count + "[]'><?php foreach($schools_colleges as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br></td></tr>" +
		    					"<tr><td><label>Department:&nbsp</label></td><td><select id=" + (univID+4) + " class='form-control' name='myInputs" + count + "[]'><?php foreach($departments as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br></td></tr>" +
								"<tr><td><label>Supervisor:&nbsp</label></td><td><select id=" + (univID+5) + " class='form-control' name='myInputs" + count + "[]'><?php foreach($supervisors as $key => $value): ?> <option value='<?php echo $value->name ?>'><?php echo $value->name ?></option><?php endforeach; ?></select><br></td></tr>" +
		    					"<tr><td><label>Position:&nbsp</label></td><td><select id=" + (univID+6) + " class='form-control' name='myInputs" + count + "[]'><?php foreach($positions as $key => $value): ?> <option value='<?php echo $value->title ?>'><?php echo $value->title ?></option> <?php endforeach; ?> </select><br></td></tr>" +
								"<tr><td><label>Rank:&nbsp</label></td><td><select id=" + (univID+7) + " class='form-control' name='myInputs" + count + "[]'><?php foreach($ranks as $key => $value): ?> <option value='<?php echo $value->title ?>'><?php echo $value->title ?></option><?php endforeach; ?></select><br></td></tr>" +
								"</tbody></table>"
								;
			univID = univID + 8;
		    document.getElementById(divName).appendChild(newdiv);
		    document.getElementById('count').value = count;

		    for (var i = univID-1; i >= univID-6; i--) {
		    	$("#" + i).select2();
		    };
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
		          univID = univID -	8;	          
		     }
		     else {
		          alert("Designation has already been removed or does not exist.");
		          return false;
		     }
		}
	</script>
@stop