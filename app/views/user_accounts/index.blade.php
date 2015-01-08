@extends('layouts.index')

@section('title')
	User Accounts
@stop

@section('breadcrumb')
	<li>User Accounts</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">User Accounts</h1>
			<button type="button" id="btn-add-rank" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addRank">
				Add User Account<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

		<table id="tb-ranks" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Level</th>
					<th>Supervisor Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>		
			</tbody>
		</table>
		</div>
	</div>
</div>

@stop