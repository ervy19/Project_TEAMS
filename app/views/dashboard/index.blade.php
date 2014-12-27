@extends('layouts.index')

@section('title')
	Dashboard
@stop

@section('content')

<div class="col-sm-8 col-md-8">
	<div class="panel">
		<div class="row">
			<h1>Dashboard</h1>
			<h4>Welcome, User</h4>
			<br>
		</div>
		<div class="tiles">
			<a href="{{ URL::to('employees') }}">
				<div class="tile">
					<div class="tile-body">
						<i class="fa fa-inbox fa-lg"></i>
					</div>
					<div class="tile-object">
						<h4>Employees</h4>
					</div>
				</div>
			</a>
<a href="{{ URL::to('employees') }}">
				<div class="tile">
					<div class="tile-body">
						<i class="fa fa-inbox fa-lg"></i>
					</div>
					<div class="tile-object">
						<h4>Employees</h4>
					</div>
				</div>
			</a>
			<a href="{{ URL::to('employees') }}">
				<div class="tile">
					<div class="tile-body">
						<i class="fa fa-inbox fa-lg"></i>
					</div>
					<div class="tile-object">
						<h4>Employees</h4>
					</div>
				</div>
			</a>
			<a href="{{ URL::to('employees') }}">
				<div class="tile">
					<div class="tile-body">
						<i class="fa fa-inbox fa-lg"></i>
					</div>
					<div class="tile-object">
						<h4>Employees</h4>
					</div>
				</div>
			</a>
			<a href="{{ URL::to('employees') }}">
				<div class="tile">
					<div class="tile-body">
						<i class="fa fa-inbox fa-lg"></i>
					</div>
					<div class="tile-object">
						<h4>Employees</h4>
					</div>
				</div>
			</a>
			<a href="{{ URL::to('employees') }}">
				<div class="tile">
					<div class="tile-body">
						<i class="fa fa-inbox fa-lg"></i>
					</div>
					<div class="tile-object">
						<h4>Employees</h4>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>

@stop

@section('page_js')
@stop