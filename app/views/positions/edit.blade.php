@extends('layouts.index')

@section('title')
	Edit Position Information
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Position Information</h1>

			<a href="{{ URL::to('positions') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($positions, array('route' => array('positions.update', $positions->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('title','Position Name: ') }}
					{{ Form::text('title') }}
				</div>

				<div>
			      	<select multiple id="skills_competencies" style="width: 300px">
			      		@foreach(SkillsCompetencies::all() as $key => $value)
			        		<option> {{ $value->name }} </option>
			      		@endforeach
			      	</select>
			    </div>
			    <div>
					    <input type="hidden" name="selected" id="selected"><br>
				</div>

				{{ Form::submit('Edit Position') }}

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

		// var scclick = $('#skills_competencies');
		// $(scclick).click(function () { 
		// 	var data = $("#skills_competencies").select2("selected"); 
		// 	delete data.element; 
		// 	var elem = document.getElementById("deleted");
		// 	elem.value = $(scclick).val();
		// 	//alert("Selected data is: "+JSON.stringify(data));
		// });

    </script>


	
@stop