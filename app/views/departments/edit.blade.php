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

				<div>
			      	<select multiple id="skills_competencies" style="width: 300px">
			      		@foreach($scs as $key => $value)
			        		<option> {{ $value->name }} </option>
			      		@endforeach
			      	</select>
			    </div>
			    <div>
					    <input type="hidden" name="selected" id="selected"><br>
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
    	$('#skills_competencies').select2('val',pausecontent);

    	var sc = $('#skills_competencies');
		$(sc).change(function() {
			var elem = document.getElementById("selected");
			elem.value = $(sc).val();
		});	

    </script>

@stop