@extends('layouts.index')

@section('title')
	Schools/Colleges
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<div class="panel-heading">
				<h1 class="panel-header">Schools and Colleges</h1>
				<button type="button" id="btn-add-schoolcollege" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addSchoolCollege">
					Add School/College<i class="fa fa-plus fa-lg add-plus"></i>
				</button>
			</div>

			<div class="message-log"></div>

			<table id="tb-schools_colleges" class="table table-bordered">
				<thead>
					<tr>
						<th>School/College Name</th>
						<th>Number of Employees</th>
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

<!-- Add School/College Modal -->
<div class="modal fade" id="addSchoolCollege" tabindex="-1" role="dialog" aria-labelledby="addSchoolCollegeLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addSchoolCollegeLabel"><i class="fa fa-university-o fa-lg"></i>&nbsp;&nbsp;Add School/College</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(['data-add','id' => 'add-schoolcollege', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addschoolcollege-name" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Add School/College', array('class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Edit School/College Modal -->
<div class="modal fade" id="editSchoolCollege" tabindex="-1" role="dialog" aria-labelledby="editSchoolCollegeLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editSchoolCollegeLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit School/College</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-schoolcollege', 'class' => 'form-horizontal form-update-schoolcollege']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-updateschoolcollege-name" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save School/College', array('id' => 'btn-update-schoolcollege', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Delete School/College Modal -->
<div class="modal fade" id="deleteSchoolCollege" tabindex="-1" role="dialog" aria-labelledby="deleteSchoolCollegeLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteSchoolCollegeLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive School/College</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to archive this school/college?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-schoolcollege" class="btn btn-danger ">Archive</button>
      		</div>
    	</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {

			var table = $('#tb-schools_colleges').dataTable({
				"processing": true,
		        "ajax": "{{ URL::to('schools_colleges') }}",
		        "columns": [
		            { "data": "name" },
		            { "data": "employeeCount" },
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
		            	 return '<button type="button" class="btn btn-info btn-edit-schoolcollege" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-schoolcollege" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
						}
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "65%", "aTargets": [ 0 ] },
			      { "sWidth": '20%', "aTargets": [ 1 ] },
			      { "sWidth": '15%', "aTargets": [ 2 ] }
			    ]
			});

			$('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');

					$('#addSchoolCollege').on('hidden.bs.modal', function (e) {
						id = '';
					});			

					$('.message-log').empty();

					$.ajax({
						type: method,
						url: url,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-campuses',url);
								$('#addSchoolCollege').modal('hide');
								$('.message-log').append('<div class="note note-success">School/College successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-schools_colleges').dataTable({
							        "ajax": "{{ URL::to('schools_colleges') }}",
							        "columns": [
							            { "data": "name" },
							            { "data": "employeeCount" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-schoolcollege" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-schoolcollege" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "65%", "aTargets": [ 0 ] },
								      { "sWidth": '20%', "aTargets": [ 1 ] },
								      { "sWidth": '15%', "aTargets": [ 2 ] }
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-addschoolcollege-name-name').append(data.errors.name);
								$('#error-addschoolcollege-address').append(data.errors.address);
							}
						}
					});
			});

			$('#tb-schools_colleges').on('click', '.btn-edit-schoolcollege', function (e) {
				var id = $(this).attr('data-id');

				var form = $('form[data-update]');
				var method = form.find('input[name="_method"]').val() || 'POST';
				var url = form.prop('action');

				$('#editSchoolCollege').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

				editSchoolCollegeInformation(id,url);

				$('form[data-update]').on('submit', function (e) {

					e.preventDefault();

					$.ajax({
						type: method,
						url: url + '/' + id,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-campuses',url);
								$('#editSchoolCollege').modal('hide');
								$('.message-log').append('<div class="note note-success">School/College information successfully updated.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-schools_colleges').dataTable({
							        "ajax": "{{ URL::to('schools_colleges') }}",
							        "columns": [
							            { "data": "name" },
							            { "data": "employeeCount" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-schoolcollege" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-schoolcollege" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "60%", "aTargets": [ 0 ] },
								      { "sWidth": '25%', "aTargets": [ 1 ] },
								      { "sWidth": '15%', "aTargets": [ 2 ] }
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-updateschoolcollege-name').append(data.errors.name);
							}
						}
					});
				});
			});

			$('#tb-schools_colleges').on('click', '.btn-delete-schoolcollege', function (e) {

				var id = $(this).attr('data-id');
				var url = "{{ URL::to('schools_colleges') }}";

				$('#deleteSchoolCollege').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

			    $('#deleteSchoolCollege').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-schoolcollege', function() {

			            deleteSchoolCollege(id,url);
			            //$form.trigger('submit');
			            //$('.message-log').append('<div class="note note-success">Campus successfully deleted.</div>').fadeIn(300).delay(3000).fadeOut(300);
			    });

			});

			clearAllFields('#addSchoolCollege','#add-schoolcollege');
			clearAllFields('#editSchoolCollege','#update-schoolcollege');

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

			function editSchoolCollegeInformation(id,url) {
				$.ajax({
					type: 'GET',
					url: url + '/' + id + '/edit',
					data: id,
					success: function(data) {
						if(data.success)
						{					
							$('#editSchoolCollege').find('input[name=name]').val(data.result.name);
							$('#editSchoolCollege').modal({ backdrop: 'static', keyboard: false });
						}
					}
				});
			}

			function deleteSchoolCollege(id,url) {
				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteSchoolCollege').modal('hide');

							$('.message-log').append('<div class="note note-success">School/College successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-schools_colleges').dataTable({
							        "ajax": "{{ URL::to('schools_colleges') }}",
							        "columns": [
							            { "data": "name" },
							            { "data": "employeeCount" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-schoolcollege" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-schoolcollege" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "60%", "aTargets": [ 0 ] },
								      { "sWidth": '25%', "aTargets": [ 1 ] },
								      { "sWidth": '15%', "aTargets": [ 2 ] }
								    ]
								});
						}
					}

				});
			}

		});
	</script>
@stop