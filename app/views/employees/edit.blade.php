@extends('layouts.index')

@section('title')
	Edit Employee
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

				{{ Form::submit('Save') }}

			{{ Form::close() }}
			
		</div>
	</div>
</div>

@stop