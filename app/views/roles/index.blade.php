@extends('layouts.index')

@section('title')
	Roles
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">Roles</h1>
			<button type="button" id="btn-add-role" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addRole">
				Add Role<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

		<table id="tb-roles" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Role Title</th>
					<th>Permissions</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
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

			var table = $('#tb-roles').dataTable({
		        "ajax": "{{ URL::to('roles') }}",
		        "columns": [
		            { "data": "name",
		            	"render": function ( data, type, full, meta ) {
		            		return '<b>'+data+'</b>';
		            	}
		        	},
		            { "data": "all_permissions",
		            	"render": function ( data, type, full, meta ) {
                            var permissions = '';
                            if(data)
                            {
                                $.each(data, function(element, index){
                                	if(element != 0 && element%4 == 0)
                                	{
                                		permissions += '<span class="tags label label-primary permission-tags">'+index.permission_name+'</span><br><br>';
                                	}
                                	else
                                	{
                                		permissions += '<span class="tags label label-primary permission-tags">'+index.permission_name+'</span>&nbsp;';
                                	}
                                });
                            }
                            else
                            {
                                permissions += 'No permissions tagged'
                            }

                            return permissions;
                        }
		        	},
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
					      return '<button type="button" class="btn btn-info btn-edit-sc" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-sc" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
					    }
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "20%", "aTargets": [ 0 ] },
			      { "sWidth": '65%', "aTargets": [ 1 ] },
			      { "sWidth": '15%', "aTargets": [ 2 ] }
			    ]
			});
		});

	</script>
@stop