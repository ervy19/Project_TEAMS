-@extends('layouts.index')

@section('title')
	Update Internal Training Information - {{ $internaltrainings->title or '' }}
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h2>Update Internal Training Information</h2>
			<h4>{{ $internaltrainings->title or '---' }}</h4>
		</div>
	</div>
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				{{ Form::model($internaltrainings, array('route' => array('internal_trainings.update', $internaltrainings->id), 'method' => 'PUT')) }}

					<div class="form-group row">
						{{ Form::label('title','Title: ') }}
						{{ Form::text('title', $internaltrainings->title, array( 'class' => 'form-control')) }}
						{{ $errors->first('title') }}
					</div>

					<div class="form-group row">
						{{ Form::label('theme_topic','Theme/Topic: ') }}
						{{ Form::text('theme_topic', $internaltrainings->theme_topic, array( 'class' => 'form-control')) }}
						{{ $errors->first('theme_topic') }}
					</div>

					<div class="form-group row">
						{{ Form::label('venue','Venue: ') }}
						{{ Form::text('venue', $internaltrainings->venue, array( 'class' => 'form-control')) }}
						{{ $errors->first('venue') }}
					</div>
					<div class="form-group row">
						{{ Form::label('schedule','Schedule: ') }}
						{{ Form::text('schedule', $internaltrainings->schedule, array( 'class' => 'form-control')) }}
						{{ $errors->first('schedule') }}
					</div>
					<div class="form-group row">
						{{ Form::label('objectives','Objectives: ') }}
						{{ Form::textarea('internal_training[objectives]', $internaltrainings->objectives, array( 'class' => 'form-control', 'rows' => '3')) }}
						{{ $errors->first('objectives') }}
					</div>

					<div class="form-group row">
						{{ Form::label('expected_outcome','Expected Outcome: ') }}
						{{ Form::textarea('internal_training[expected_outcome]', $internaltrainings->expected_outcome, array( 'class' => 'form-control', 'rows' => '3')) }}
						{{ $errors->first('expected_outcome') }}
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_schools_colleges_id','Organizing School/College: ') }}
						</div>
						{{ Form::select('internal_training[organizer_schools_colleges_id]', $schoolcollege, 'Select a School or College Organizer', array('id' => 'dd-schoolscolleges', 'class' => 'col-sm-6 col-md-6')) }}
						
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('organizer_department_id','Organizing Department: ') }}
						</div>
						{{ Form::select('internal_training[organizer_department_id]', $department, 'Select a Department Organizer', array('id' => 'dd-departments', 'class' => 'col-sm-6 col-md-6')) }}
					
					</div>

					<div class="form-group row">
						{{ Form::label('isTrainingPlan','Training Plan: ') }}
						&nbsp;&nbsp;
						{{ Form::radio('internal_training[isTrainingPlan]', 1); }}&nbsp;YES
						&nbsp;&nbsp;
						{{ Form::radio('internal_training[isTrainingPlan]', 0); }}&nbsp;NO
						{{ $errors->first('isTrainingPlan') }}
					</div>


					{{ Form::submit('Save Information', array('class' => 'btn btn-primary pull-right')) }}
					<a href="{{ URL::to('internal_trainings') }}" class="btn btn-primary pull-right">Back</a>
				{{ Form::close() }}

			</div>
		</div>
	</div>

</div>

@stop

@section('page_js')

    {{ HTML::script('assets/js/bootstrap-datepicker.js'); }}

<script>
	$("#dd-schoolscolleges").select2({
		placeholder: 'HEHEHE',
	    allowClear: true
	});

	$("#dd-departments").select2({
	    allowClear: true
	});

	/*$('#date_start').datepicker({
    format: 'yyyy-mm-dd'
});
	$('#date_end').datepicker({
    format: 'yyyy-mm-dd'
});
	
	var schtr = $('#school_college_training');
	$(schtr).change(function() {
		var elemtr = document.getElementById("selected_sch_training");
		elemtr.value = $(schtr).val();
	});

	var depttr = $('#dept_training');
	$(depttr).change(function() {
		var elemdepttr = document.getElementById("selected_dept_training");
		elemdepttr.value = $(depttr).val();
	});*/
</script>

@stop
