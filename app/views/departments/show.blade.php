@extends('layouts.index')

@section('title')
	Department 
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('departments') }}">Departments</a></li>
	<li>Department Name</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Departments</h1>

		</div>
	</div>
</div>

@stop