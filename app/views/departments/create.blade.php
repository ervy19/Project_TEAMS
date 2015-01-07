@extends('layouts.index')

@section('title')
	Add Department
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('departments') }}">Departments</a></li>
	<li>Create Department</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Add Department Information</h1>

			<a href="{{ URL::to('departments') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

				{{ Form::open(array('url' => 'departments')) }}

					<div class="form-group">
						{{ Form::label('name','Department Name: ') }}
						{{ Form::text('name') }}
					</div>
					<div class="form-group">
						{{ Form::label('schoolcollege', 'School/College: ') }}
						<select id="school_college_dept" style="width: 300px">
							<option selected disabled>Select School/College</option>
				      		@foreach($schoolcollege as $key => $value)
				        		<option> {{ $value }} </option>
				      		@endforeach
			      		</select>
					</div>
					<div class="form-group">
						{{ Form::label('sc','Tagged Skills and Competencies: ') }}
						<select multiple id="skills_competencies_dept" style="width: 300px">
				      		@foreach($sc as $key => $value)
				        		<option> {{ $value }} </option>
				      		@endforeach
			      		</select>
			    	</div>
			    	<div>
					    <input type="hidden" name="selected_dept" id="selected_dept"><br>
					</div>
					<div>
					    <input type="hidden" name="selected_sch_dept" id="selected_sch_dept"><br>
					</div>

				{{ Form::submit('Add Department') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')

	<script type="text/javascript">
		var scd = $('#skills_competencies_dept');
		$(scd).change(function() {
			var elemd = document.getElementById("selected_dept");
			elemd.value = $(scd).val();
		});	

        $(document).ready(function() { $("#school_college_dept").select2() });

        var sch = $('#school_college_dept');
		$(sch).change(function() {
			var elem = document.getElementById("selected_sch_dept");
			elem.value = $(sch).val();
		});	

	</script>
@stop