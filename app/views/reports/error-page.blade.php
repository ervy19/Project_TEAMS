@extends('layouts.index')

@section('title')
	Internal Trainings
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{ $internaltrainings->id }}">{{ $internaltrainings->title }}</a></li>
	<li>Training Effectiveness Report</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internaltrainings->title or '---' }}</h2><br>
				<br>
				<h5>&nbsp;&nbsp;&nbsp;{{ $strerror }}</h5>
			</div>
		</div>
	</div>

	
@stop