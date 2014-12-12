@extends('layouts.index')

@section('title')
	Campus
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('campuses') }}">Campuses</a></li>
	<li>Campus Name</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>Campus</h1>
		</div>
	</div>
</div>

@stop