@extends('layouts.index')

@section('title')
	Add Participant
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}">{{$internaltrainings->title or '---'}}</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/participants">Participant</a></li>
	<li>Add Participant</li>
@stop

@section('content')
<div class="col-sm-12 col-md-12">
	<div class="panel">
		<br>
		<a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
		{{ Form::model($internaltraining, array('route' => array('internal_trainings.store-upload-participant', $internaltraining[0]->id), 'method' => 'POST', 'files' => 'true')) }}
			<div class="batch">
			<br><br>
			{{ Form::label('Please choose the Excel file') }}
			{{ Form::file('file') }}
			</div>
			<br><br>
			{{ Form::submit('Upload/Add Participant') }}
		{{ Form::close() }}
	</div>
</div>
@stop
