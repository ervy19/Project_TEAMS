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

			{{ Form::open(array('url' => 'employees')) }}

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
			     	<br>
			    </div>
			    <input type="button" value="Add an Employee Designation" onClick="addInput('dynamicInput');" class="btn btn-primary">
			    <input type="text" id='count' value=2 />
				{{ Form::submit('Add Employee') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')

	<script type="text/javascript">
		var count = 1;
		function addInput(divName){
			
		    var newdiv = document.createElement('div');
		    newdiv.innerHTML = 	"<h2>Employee Designation " + count + "</h2>" +
		    					"<br><label>Position:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($positions as $key => $value): ?> <option><?php echo $value->title ?></option> <?php endforeach; ?> </select><br>" +
								"<br><label>Rank:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($ranks as $key => $value): ?> <option><?php echo $value->title ?></option><?php endforeach; ?></select><br>" +
								"<br><label>School/College:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($schools_colleges as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
								"<br><label>Department:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($departments as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
								"<br><label>Campus:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($campuses as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" +
								"<br><label>Supervisor:&nbsp</label><select name='myInputs" + count + "[]'><?php foreach($supervisors as $key => $value): ?> <option><?php echo $value->name ?></option><?php endforeach; ?></select><br>" 
								;

		    document.getElementById(divName).appendChild(newdiv);
		    //document.getElementById('count').value = count;
		    count++;    
		}
	</script>
@stop