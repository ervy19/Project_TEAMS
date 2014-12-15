@extends('layouts.index')

@section('title')
	Employees
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('employees') }}">Employees</a></li>
	<li>Employee Name</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1>Employees</h1>
		</div>
	</div>
</div>

@stop