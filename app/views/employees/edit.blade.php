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
			    <input type="hidden" id='count' value='' />
			    <input type="hidden" id='currentCount' value={{$currentCount}} />
			    <!--@foreach($selected_data as $key => $value)
			    	@foreach($value as $key => $value2)
			    @endforeach-->
				{{ Form::submit('Save') }}

			{{ Form::close() }}
			
		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		var count = 1;
		var currentCount = document.getElementById('currentCount').value;
		(function autofill() {
			for (var i = 0; i < currentCount; i++) {
				addInput('dynamicInput');
				//currentChoice = 
				//$("select option:contains('" + currentChoice + "')").prop('selected',true);
			};
		})()

		function addInput(divName) {
		    //http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
		    var newdiv = document.createElement('div');
		    newdiv.setAttribute('id', count);
		    newdiv.innerHTML = 	"<h2>Employee Designation " + count + "</h2>" +
		    					"<br><label>Designation Type:&nbsp</label><select name='myInputs" + count + "[]'><option>Teaching</option><option>Non-Teaching</option> </select><br>" +
		    					"<br><label>Campus:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($campuses as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
		    					"<br><label>School/College:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($schools_colleges as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
		    					"<br><label>Department:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($departments as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
								"<br><label>Supervisor:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($supervisors as $key => $value): ?> <option><?php echo $value->id ?></option><?php endforeach; ?></select><br>" +
		    					"<br><label>Position:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($positions as $key => $value): ?> <option><?php echo $value->title ?></option> <?php endforeach; ?> </select><br>" +
								"<br><label>Rank:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($ranks as $key => $value): ?> <option><?php echo $value->title ?></option><?php endforeach; ?></select><br>" + 
								"<input type='button' value='Remove Employee Designation' onclick=removeInput(&quot;dynamicInput&quot;,&quot;" + count + "&quot;); class='btn btn-primary'>"
								;
		    document.getElementById(divName).appendChild(newdiv);
		    document.getElementById('count').value = count;
		    count++;    
		}

		function removeInput(parentDiv, childDiv) {
			//http://www.randomsnippets.com/2008/03/26/how-to-dynamically-remove-delete-elements-via-javascript/
			if (document.getElementById(childDiv)) {     
		          var child = document.getElementById(childDiv);
		          var parent = document.getElementById(parentDiv);
		          parent.removeChild(child);
		          count--;
		     }
		     else {
		          alert("Child div has already been removed or does not exist.");
		          return false;
		     }
		}
	</script>
@stop