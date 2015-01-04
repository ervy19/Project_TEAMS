@extends('layouts.index')

@section('title')
	Add Post Training Evaluation
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	
@stop

@section('content')

<?php

 $id = "3";
		 $internaltrainings = Internal_Training::where('id', '=', $id)->get();
		 $title = Internal_Training::where('isActive', '=', true)->where('id', '=', $id)->pluck('title');
		 $theme_topic = Internal_Training::where('id', '=', $id)->pluck('theme_topic');
		 $organizerschid = Internal_Training::where('id', '=', $id)->pluck('organizer_schools_colleges_id');
		 $school_college = School_College::where('id', '=', $id)->where('id', '=', $organizerschid)->pluck('name');


?>

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Create Post Training Evaluation</h1>
				
				<div class="col-sm-9 col-md-9 training-info">
				<div class="panel">
					<div class="row training-details">
						<h2 class="panel-header">{{ $title }}</h2>
						<div class="col-sm-1 col-md-1">
							<h6>&nbsp;&nbsp;Theme/Topic: </h6>
							<h6>&nbsp;&nbsp;Organizer: </h6>
						</div>
						<div class="col-sm-11 col-md-11">
							<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $theme_topic }}</h5>
							<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $school_college }} </h5>
						</div>

						{{ Form::open(array('url' => 'assessment_items')) }}

						<div>
							<h6>&nbsp;&nbsp;&nbsp;Add assessment items: </h6>
						</div>

						<div class="input_fields_wrap">
						    <button class="add_field_button">Add More Items</button>
						    <div><input type="text" name="mytext[]"></div>
						    <input type="hidden" name="assessment_items" id="assessment_items"><br>
						</div>

						{{ Form::submit('Add Assessment Items') }}

						{{ Form::close() }}

		</div>
	</div>
</div>


@stop

@section('page_js')
<script>
	$(document).ready(function() {
	    var max_fields      = 10; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	    var add_button      = $(".add_field_button"); //Add button ID
	    
	    var x = 1; //initlal text box count
	    $(add_button).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
	        }
	    });
	    
	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	});

		var assessmentitems = document.getElementById("assessment_items");
		assessmentitems.value = $(wrapper).val();

</script>
@stop