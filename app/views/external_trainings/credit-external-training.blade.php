@extends('layouts.index')

@section('title')
	Credit External Training
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">
			<h1>Credit External Training</h1>

			<a href="{{ URL::to('external_trainings/pending-approval') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($externaltraining, array('route' => array('external_trainings.credit', $externaltraining->et_id), 'method' => 'POST')) }}

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
					{{ Form::select('designation', withEmpty($designations), 'Select an Employee Designation', array('class' => 'form-control')) }}
				</div>

				<div class="form-group row">
						<div class="col-sm-12 col-md-12">
						{{ Form::label('sc','Tagged Skills and Competencies: ') }}
						<div>
						<select multiple id="skills_competencies_credit" style="width: 300px">
				      		@foreach($sc as $key => $value)
				        		<option> {{ $value }} </option>
				      		@endforeach
			      		</select>
			    </div>
				</div>
			</div>
			    <input type="hidden" name="scet_credit" id="scet_credit">


				{{ Form::submit('Credit External Training') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')
<script>
	var sccredit = $('#skills_competencies_credit');
		$(sccredit).change(function() {
			var cred = document.getElementById("scet_credit");
			cred.value = $(sccredit).val();
		});	
</script>
@stop