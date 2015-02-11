@extends('layouts.index')

@section('title')
	Departments
@stop

@section('breadcrumb')
	<li>Departments</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">Departments</h1>
			<button type="button" id="btn-add-department" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addDepartment">
				Add Department<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

			<table id="tb-departments" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Department Name</th>
						<th>Department Supervisor</th>
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

<!-- View Department Modal -->
<div class="modal fade" id="viewDepartment" tabindex="-1" role="dialog" aria-labelledby="viewDepartmentLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="viewDepartmentLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Department Name Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
							<div class="col-sm-2 col-md-2">
								<h5>Department Name: </h5>
								<h5>Department Head:</h5>
							</div>
							<div class="col-sm-4 col-md-4">
								<h4 id="view-department-name"></h4>
								<h4 id="view-department-head"></h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<h5>Needed Skills and Competencies:</h5>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="tags">
									<h3><span id="tag" class="label label-default"></span></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
	</div>
</div>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="addDepartmentLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addDepartmentLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add Department</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(['data-add','id' => 'add-department', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-adddepartment-name" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('type','Type: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::select('type', array( null =>  'Select Department Type', '0' => 'Non-Academic' , '1' => 'Academic'), null, array('id' => 'dd-departments-type', 'class' => 'form-control')) }}
										<div id="error-adddepartment-type" class="error-message"></div>
									</div>
								</div>
								<div id="department-schoolcollege">
									<div class="form-group row">
										{{ Form::label('schoolcollege', 'School or College to which the department belongs to: ', array('class' => 'col-sm-5 col-md-5 control-label')) }}
									</div>
									<div class="form-group row">
										<div class="col-sm-1 col-md-1">
										</div>
										<div class="col-sm-4 col-md-4">
											{{ Form::select('schoolcollege', array('' => 'Select a School/College') + $schoolscolleges, null, array('id' => 'dd-departments-add', 'class' => 'form-control')) }}
											<div id="error-adddepartment-schoolcollege" class="error-message"></div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('scs','Needed Skills and Competencies: ', array('class' => 'control-label department-scs-needed')) }}
								</div>
								<div class="form-group row">
									<div class="col-sm-1 col-md-1">
									</div>
									<div class="col-sm-4 col-md-4">
										{{ Form::select('scs', $scs, null, array('id' => 'dd-departments-scs', 'class' => 'form-control', 'multiple' => 'multiple')) }}
										<div id="error-adddepartment-scs" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        					{{ Form::submit('Add Department', array('class' => 'btn btn-primary')) }}
      					{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Edit Department Information Modal -->
<div class="modal fade" id="editDepartment" tabindex="-1" role="dialog" aria-labelledby="editDepartmentLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editDepartmentLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit Department Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-department', 'class' => 'form-horizontal form-update-department']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-adddepartment-name" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('type','Type: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::select('type', array( '0' => 'Non-Academic' , '1' => 'Academic'), null, array('id' => 'dd-departments-type', 'class' => 'form-control')) }}
										<div id="error-adddepartment-type" class="error-message"></div>
									</div>
								</div>
								<div id="department-schoolcollege">
									<div class="form-group row">
										{{ Form::label('schoolcollege', 'School or College to which the department belongs to: ', array('class' => 'col-sm-5 col-md-5 control-label')) }}
									</div>
									<div class="form-group row">
										<div class="col-sm-1 col-md-1">
										</div>
										<div class="col-sm-4 col-md-4">
											{{ Form::select('schoolcollege', array('' => 'Select a School/College') + $schoolscolleges, null, array('id' => 'dd-departments-add', 'class' => 'form-control')) }}
											<div id="error-adddepartment-schoolcollege" class="error-message"></div>
										</div>
									</div>
								</div>
																<div class="form-group row">
									{{ Form::label('scs','Needed Skills and Competencies: ', array('class' => 'control-label department-scs-needed')) }}
								</div>
								<div class="form-group row">
									<div class="col-sm-1 col-md-1">
									</div>
									<div class="col-sm-4 col-md-4">
										{{ Form::select('scs', $scs, null, array('id' => 'dd-departments-scs', 'class' => 'form-control', 'multiple' => 'multiple')) }}
										<div id="error-updatedepartment-scs" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save Department Information', array('id' => 'btn-update-department', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Delete Department Modal -->
<div class="modal fade" id="deleteDepartment" tabindex="-1" role="dialog" aria-labelledby="deleteDepartmentLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteDepartmentLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive Department</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to archive this department?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-department" class="btn btn-danger ">Archive</button>
      		</div>
    	</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    
		    var table = $('#tb-departments').dataTable({
		        "ajax": "{{ URL::to('departments') }}",
		        "columns": [
		            { "data": "name" },
		            { "data": "supervisor"},
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
		            	 return '&nbsp;<button type="button" class="btn btn-primary btn-view-department" data-id="'+data+'"><i class="fa fa-file-text-o"></i>&nbsp;View Information</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info btn-edit-department" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-department" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
						}
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "30%", "aTargets": [ 0 ] },
			      { "sWidth": '40%', "aTargets": [ 1 ] },
			      { "sWidth": '30%', "aTargets": [ 2 ] }
			    ]
			});

		    $('#dd-departments-scs').select2(); 

			$('#department-schoolcollege').hide(); 
		    $('#dd-departments-type').on('change', function(){
		        if($('#dd-departments-type').val() == 1) {
		            $('#department-schoolcollege').show(); 
		        } else {
		            $('#department-schoolcollege').hide(); 
		        } 
		    });

		    $('#tb-departments').on('click', '.btn-view-department', function (e) {
				var id = $(this).attr('data-id');

				$('#viewDepartment').on('hidden.bs.modal', function (e) {
					id = '';
				});

				viewCampusInformation(id);

				//$('#viewDepartment').modal({ backdrop: 'static', keyboard: false });
			});

		    $('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');		

					$('.message-log').empty();

					$.ajax({
						type: method,
						url: url,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-campuses',url);
								$('#addCampus').modal('hide');
								$('.message-log').append('<div class="note note-success">Campus successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-campuses').dataTable({
							        "ajax": "{{ URL::to('campuses') }}",
							        "columns": [
							            { "data": "name" },
							            { "data": "address" },
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
								$('#error-addcampus-name').append(data.errors.name);
								$('#error-addcampus-address').append(data.errors.address);
							}
						}
					});
				});

			$('#viewDepartment').on('hide.bs.modal', function (e) {
				$('#view-department-name').empty();
			});

			clearAllFields('#addDepartment','#add-department');
			//clearAllFields('#editCampus','#update-campus');

			function clearAllFields(modal,form) {
				$(modal).on('hide.bs.modal', function (e) {
					$('.error-message').empty();
					$(':input',form)
					  .not(':button, :submit, :reset, :hidden')
					  .val('')
					  .removeAttr('checked')
					  .removeAttr('selected');
					$('#dd-departments-type').val();
					$('#department-schoolcollege').hide(); 

				});
			}

			function viewCampusInformation(id) {
				$.ajax({
					type: 'GET',
					url: "{{ URL::to('departments') }}/" + id,
					data: id,
					dataType: "json",
					success: function(data) {
						if(data.result)
						{					
							//$('#view-department-name').append(data.result.name);
							//$('#view-department-head').append(data.result.supervisor.name);

							 $.getJSON(data.tags, function(data) {
						        $.each(data, function(index) {
						            alert(data[index].name);
						        });
						    });

							
						}
					}
				});
			}

		});
	</script>
@stop