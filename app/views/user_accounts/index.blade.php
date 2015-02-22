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
					<th>Username</th>
					<th>Name</th>
					<th>Role</th>
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

@stop

@section('page_js')
	<script type="text/javascript">
		
		$(document).ready( function () {

			var table = $('#tb-skills_competencies').dataTable({
		        "ajax": "{{ URL::to('users') }}",
		        "columns": [
		            { "data": "username" },
		            { "data": "name"},
		            { "data": "all_roles",
		            	"render": function ( data, type, full, meta ) {
		            		var roles = '';
                            if(data)
                            {
                                $.each(data, function(element, index){
                                	roles += '<span class="tags label label-primary">'+index.role_name+'</span>&nbsp;';
                                });
                            }
                            else
                            {
                                roles += 'No roles tagged'
                            }

                            return roles;
		            	}
		        	},
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
					      return '<button type="submit" class="btn btn-small btn-danger btn-delete-sc" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
					    }
		        	}
		        ],
		       	"aoColumnDefs": [
			      { "sWidth": "30%", "aTargets": [ 0 ] },
			      { "sWidth": '32%', "aTargets": [ 1 ] },
			      { "sWidth": '30%', "aTargets": [ 2 ] },
			      { "sWidth": '8%', "aTargets": [ 3 ] }
			    ]
			});
		});
	</script>
@stop