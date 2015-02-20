@extends('layouts.index')

@section('title')
	Edit External Training
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit External Training</h1>

			<a href="{{ URL::to('external_trainings') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($externaltraining, array('route' => array('external_trainings.update', $externaltraining->training_id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('title','External Training: ') }} &nbsp;&nbsp;{{ $externaltraining->title }} 
				</div>
				<div class="form-group">
					{{ Form::label('theme_topic','Theme/Topic: ') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $externaltraining->theme_topic }}
				</div>
				<div class="form-group">
					{{ Form::label('participation','Participation: ') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $externaltraining->participation }}
				</div>
				<div class="form-group">
					{{ Form::label('organizer','Organizer: ') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $externaltraining->organizer }}
				</div>
				<div class="form-group">
					{{ Form::label('venue','Venue: ') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $externaltraining->venue }}
				</div>

				<input type="hidden" id="title" name="title" value="{{$externaltraining->title}}">
				<input type="hidden" id="theme_topic" name="theme_topic" value="{{$externaltraining->theme_topic}}">
				<input type="hidden" id="participation" name="participation" value="{{$externaltraining->participation}}">
				<input type="hidden" id="organizer" name="organizer" value="{{ $externaltraining->organizer }}">
				<input type="hidden" id="venue" name="venue" value="{{$externaltraining->venue}}">

				<div class="form-group">
					<div class="col-sm-6 col-md-6">
					{{ Form::label('designation','Employee Designation: ') }}
					</div>
					{{ Form::select('designation', withEmpty($designations), 'Select an Employee Designation', array('id' => 'designation', 'class' => 'form-control')) }}
				</div>

				<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('sc','Tagged Skills and Competencies: ') }}
						<div>
						<select multiple id="skills_competencies_et_edit" style="width: 300px">
				      		@foreach($sc as $key => $value)
				        		<option> {{ $value }} </option>
				      		@endforeach
			      		</select>
			    </div>
				</div>
			</div>
			    <input type="hidden" name="scet_credit" id="scet_credit">


				{{ Form::submit('Edit External Training') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')
<script>
	var pausecontent = new Array();
	    <?php foreach($currentscs as $key => $val){ ?>
	        pausecontent.push('<?php echo $val; ?>');
	    <?php } ?>
    	$('#skills_competencies_et_edit').select2('val',pausecontent);

    var initial = $('#skills_competencies_et_edit');
		var hiddensc = document.getElementById("scet_credit");
		hiddensc.value = $(initial).val();	

	var scetedit = $('#skills_competencies_et_edit');
		$(scetedit).change(function() {
			var etedit = document.getElementById("scet_credit");
			etedit.value = $(scetedit).val();
		});	

	var desig = {{$currentdesig}};
	var desigbox = document.getElementById("designation");
	desigbox.value = desig;
</script>
@stop