@extends('layouts.index')

@section('title')
	Edit Department Information
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('departments') }}">Department</a></li>
	<li>Edit Department</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Department Information</h1>

			<a href="{{ URL::to('departments') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($departments, array('route' => array('departments.update', $departments->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('name','Department Name: ') }}
					{{ Form::text('name') }}
				</div>
				<div class="form-group">
					{{ Form::label('schoolcollege', 'School/College: ') }}
						<select id="school_college_dept_edit" style="width: 300px">
							<option selected disabled>Select School/College</option>
				      		@foreach($schoolcollege as $key => $value)
				        		<option> {{ $value->name }} </option>
				      		@endforeach
			      		</select>
				</div>
				<div class="form-group">
					{{ Form::label('taggedsc', 'Tagged Skills and Competencies: ') }}
			      	<select multiple id="skills_competencies_dept_edit" style="width: 300px">
			      		@foreach($scs as $key => $value)
			        		<option> {{ $value->name }} </option>
			      		@endforeach
			      	</select>
			    </div>
			    <div>
					    <input type="hidden" name="selected_dept_edit" id="selected_dept_edit"><br>
					    <input type="hidden" name="selected_sch_edit" id="selected_sch_edit"><br>
				</div>
				<div>
					{{ "DEPARTMENT NAME"}}
					{{ $departments->name }}
					<br></br><br></br>
					{{ "SCHOOLS/COLLEGES" }}
					@foreach($schoolcollege as $key => $value)
					<br></br>
						{{ $value->name }}
					@endforeach
					<br></br><br></br>
					{{ "CURRENT SCHOOLS/COLLEGES" }}
					{{ $schselected }}
					<br></br><br></br>
					{{ "ALL SKILLS COMPETENCIES" }}
					@foreach($scs as $key => $value)
					<br></br>
						{{ $value->name }}
					@endforeach
					<br></br><br></br>
					{{ "CURRENT SELECTED SCs" }}
					@foreach($currentscs as $key => $value)
					<br></br>
						{{ $value }}
					@endforeach
				</div>

				{{ Form::submit('Edit Department') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')

	<script type="text/javascript">
		
		var pausecontent = new Array();
	    <?php foreach($currentscs as $key => $val){ ?>
	        pausecontent.push('<?php echo $val; ?>');
	    <?php } ?>
    	$('#skills_competencies_dept_edit').select2('val',pausecontent);

    	var scde = $('#skills_competencies_dept_edit');
		$(scde).change(function() {
			var elemde = document.getElementById("selected_dept_edit");
			elemde.value = $(scde).val();
		});		

		var scArray = new Array();
	        scArray.push('<?php echo $schselected; ?>');
    	$('#school_college').select2('val',scArray);

    	var schde = $('#school_college_dept_edit');
		$(schde).change(function() {
		var elemsde = document.getElementById("selected_sch_edit");
		elemsde.value = $(schde).val();
		});

    </script>

@stop