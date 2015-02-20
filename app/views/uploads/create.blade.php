@extends('layouts.index')

@section('title')
	Add Participant
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}">{{$internaltrainings->title or '---'}}</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/participants">Participants</a></li>
	<li>Add Participants</li>
@stop

@section('content')
<div class="col-sm-12 col-md-12">
	<div class="panel">
	{{ Form::model($internaltraining, array('route' => array('internal_trainings.store-participants', $internaltraining[0]->id), 'method' => 'POST', 'files' => 'true')) }}
		<div>
			<input type="radio" id="1" name="isIndividual" value="individual" onClick="onChoice()" checked>Individual
			<input type="radio" id="2" name="isIndividual" value="batch" onClick="onChoice()">Batch
		</div>
		<br><br>
		<div class="individual">
			{{ Form::label('individual_id','Enter ID Number: ') }}
			{{ Form::text('individual_id') }}
		</div>
		<br><br>
		<div class="batch">
			{{ Form::label('Please choose the Excel file') }}
			{{ Form::file('file') }}
		</div>
		<br><br>
		{{ Form::submit('Upload/Add Participant') }}
	{{ Form::close() }}
	</div>
</div>
@stop
