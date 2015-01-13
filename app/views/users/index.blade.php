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
			<button type="button" id="btn-add-sc" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addSC">
				Add User Account<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

		<table id="tb-skills_competencies" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Skill/Competency</th>
					<th>Departments Tagged</th>
					<th>Positions Tagged</th>
					<th>Internal Trainings Tagged</th>
					<th>External Trainings Tagged</th>
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

@section('page_js')
	<script type="text/javascript">
		
		$(document).ready( function () {

			var table = $('#tb-skills_competencies').dataTable({
		        "ajax": "{{ URL::to('skills_competencies') }}",
		        "columns": [
		            { "data": "name" },
		            { "data": "departmentsTagged" },
		            { "data": "positionsTagged" },
		            { "data": "internalTrainingsTagged" },
		            { "data": "externalTrainingsTagged" },
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
					      return '<button type="button" class="btn btn-info btn-edit-sc" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-sc" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
					    }
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "21%", "aTargets": [ 0 ] },
			      { "sWidth": '15%', "aTargets": [ 1 ] },
			      { "sWidth": '13%', "aTargets": [ 2 ] },
			      { "sWidth": '18%', "aTargets": [ 3 ] },
			      { "sWidth": '18%', "aTargets": [ 4 ] },
			      { "sWidth": '15%', "aTargets": [ 5 ] }
			    ]
			});

	</script>
@stop