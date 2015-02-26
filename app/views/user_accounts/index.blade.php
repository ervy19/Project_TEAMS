@extends('layouts.index')

@section('title')
	User Accounts
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">User Accounts</h1>
			<button type="button" id="btn-add-user-account" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addUserAccount">
				Add User Account<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

		<table id="tb-skills_competencies" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
				</tr>		
			</tbody>
		</table>
		</div>
	</div>
</div>

<!-- CREATE USER ACCOUNT MODAL-->
<div class="modal fade" id="addUserAccount" tabindex="-1" role="dialog" aria-labelledby="addUserAccountLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addUserAccountLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add User Account</h4>
			</div>
			<div class="modal-body">
				<div class="col-sm-12 col-md-12">
					<div class="row">
						<!-- INSERT FORM -->
						{{ Form::open(['data-add','id' => 'add-UserAccount', 'class' => 'form-horizontal']) }}
						<div class="form-group row">
							{{ Form::label('name', 'Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::text('name', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-name" class="error-message"></div>
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('type','Type: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::select('type', array( null =>  'Select Department Type', '0' => 'Non-Academic' , '1' => 'Academic'), null, array('id' => 'dd-departments-type', 'class' => 'form-control')) }}
							<div id="error-adddepartment-type" class="error-message"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
					{{ Form::submit('Add User Account', array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">	
		$(document).ready( function () {

			var table = $('#tb-skills_competencies').dataTable({
		        "ajax": "{{ URL::to('users') }}",
		        "columns": [
		            { "data": "username" },
		            { "data": "full_name"},
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
					      return '<button type="button" class="btn btn-primary btn-viewc" data-id="'+data+'"><i class="fa fa-file-text-o"></i>&nbsp;View</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-sc" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
					    }
		        	}
		        ]
			});
		});
	</script>
@stop