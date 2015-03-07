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

		<table id="tb-user-accounts" class="table table-striped table-bordered">
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
						<br><br><div class="form-group row">
							{{ Form::label('username', 'Username: ', array('class' => 'col-sm-4 col-md-4 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::text('username', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-username" class="error-message"></div>
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('email', 'Email Address: ', array('class' => 'col-sm-4 col-md-4 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::email('email', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-email" class="error-message"></div>
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('password', 'Password: ', array('class' => 'col-sm-4 col-md-4 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::password('password', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-password" class="error-message"></div>
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('confirmation_code', 'Confirmation Code: ', array('class' => 'col-sm-4 col-md-4 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::text('confirmation_code', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-confirmation_code" class="error-message"></div>
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('remember_token', 'Remember Token: ', array('class' => 'col-sm-4 col-md-4 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::text('remember_token', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-remember_token" class="error-message"></div>
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('confirmed', 'Confirmed: ', array('class' => 'col-sm-4 col-md-4 control-label')) }}
							<div class="col-sm-4 col-md-4">
								{{ Form::text('confirmed', '',array('class' => 'form-control')) }}
								<div id="error-addUserAccount-confirmed" class="error-message"></div>
							</div>
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

<!-- ARCHIVE USER ACCOUNT MODAL-->
<div class="modal fade" id="deleteUserAccount" tabindex="-1" role="dialog" aria-labelledby="deleteUserAccountLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteSchoolCollegeLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive User Account</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to archive this user account?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-user-account" class="btn btn-danger ">Archive</button>
      		</div>
    	</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">	
		$(document).ready( function () {

			var table = $('#tb-user-accounts').dataTable({
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

		$('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');	

					$('.message-log').empty();

					$.ajax({
						type: method,
						url: url + '/users',
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-campuses',url);
								$('#addUserAccount').modal('hide');
								$('.message-log').append('<div class="note note-success">User Account successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-user-accounts').dataTable({
							        "ajax": "{{ URL::to('users') }}",
							        "columns": [
							            { "data": "username" },
							            { "data": "full_name" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
										      return '<button type="button" class="btn btn-info btn-edit-campus" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-campus" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
						}
							        	}
							        ],
							        "aoColumnDefs": [
								      { "sWidth": "20%", "aTargets": [ 0 ] },
								      { "sWidth": '65%', "aTargets": [ 1 ] },
								      { "sWidth": '15%', "aTargets": [ 2 ] }
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-addUserAccount-username').append(data.errors.username);
								$('#error-addUserAccount-email').append(data.errors.email);
								$('#error-addUserAccount-password').append(data.errors.password);
								$('#error-addUserAccount-confirmation_code').append(data.errors.confirmation_code);
								$('#error-addUserAccount-remember_token').append(data.errors.remember_token);	
								$('#error-addUserAccount-confirmed').append(data.errors.confirmed);							}
						}
					});
				});
	
			clearAllFields('#addUserAccount','#add-UserAccount');
			/*clearAllFields('#editSpeaker','#update-speaker');*/

			function clearAllFields(modal,form) {
				$(modal).on('hide.bs.modal', function (e) {
					$('.error-message').empty();
					$(':input',form)
					  .not(':button, :submit, :reset, :hidden')
					  .val('')
					  .removeAttr('checked')
					  .removeAttr('selected');
				});
			}		

			 $('#tb-user-accounts').on('click', '.btn-delete-user-acccount', function (e) {

				var id = $(this).attr('data-id');
				var url = "{{ URL::to('users') }}";

				$('#deleteUserAccount').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

			    $('#deleteUserAccount').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-user-account', function() {

			            deleteUserAccount(id,url);
			            //$form.trigger('submit');
			            //$('.message-log').append('<div class="note note-success">Campus successfully deleted.</div>').fadeIn(300).delay(3000).fadeOut(300);
			    });

			});

			function deleteUserAccount(id,url) {
				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteUserAccount').modal('hide');

							$('.message-log').append('<div class="note note-success">User Account successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-user-accounts').dataTable({
							        "ajax": "{{ URL::to('users') }}",
							        "columns": [
							            { "data": "username" },
							            { "data": "full_name"},
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
										      return '<button type="button" class="btn btn-primary btn-view" data-id="'+data+'"><i class="fa fa-file-text-o"></i>&nbsp;View</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-user-acccount" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
										    }
							        	}
							        ]
								});
						}
					}

				});
			}
	</script>
@stop