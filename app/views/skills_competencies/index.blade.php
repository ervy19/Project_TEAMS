@extends('layouts.index')

@section('title')
	Skills and Competencies
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">Skills and Competencies</h1>
			<button type="button" id="btn-add-sc" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addSC">
				Add Skill/Competency<i class="fa fa-plus fa-lg add-plus"></i>
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

<!-- Add Skill/Competency Modal -->
<div class="modal fade" id="addSC" tabindex="-1" role="dialog" aria-labelledby="addSCLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addSCLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add Skill/Competency</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(['data-add','id' => 'add-sc', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addsc-name" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Add Skill/Competency', array('class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Edit Skill/Competency Modal -->
<div class="modal fade" id="editSC" tabindex="-1" role="dialog" aria-labelledby="editSCLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editSCLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit Skill/Competency</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-sc', 'class' => 'form-horizontal form-update-sc']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-updatesc-name" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save Skill/Competency', array('id' => 'btn-update-sc', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Delete Skill/Competency Modal -->
<div class="modal fade" id="deleteSC" tabindex="-1" role="dialog" aria-labelledby="deleteSCLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteSCLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive Skill/Competency</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to archive this skill/competency?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-sc" class="btn btn-danger ">Archive</button>
      		</div>
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

			$('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');

					$('#addSC').on('hidden.bs.modal', function (e) {
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
								$('#addSC').modal('hide');
								$('.message-log').append('<div class="note note-success">Skill/Competency successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-skills_competencies').dataTable({
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
										      return '<button type="button" class="btn btn-info btn-edit-sc" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;{{ Form::open(array("route" => array("skills_competencies.destroy", '+data+'), "method" => "delete", "class" => "form-archive form-delete")) }}<button type="submit" class="btn btn-small btn-danger btn-delete-sc"><i class="fa fa-trash"></i>&nbsp;Archive</button>{{ Form::close() }}';
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
							}
							else
							{
								$('.error-message').empty();
								$('#error-addsc-name').append(data.errors.name);
							}
						}
					});
				});

			$('#tb-skills_competencies').on('click', '.btn-edit-sc', function (e) {
				var id = $(this).attr('data-id');

				var form = $('form[data-update]');
				var method = form.find('input[name="_method"]').val() || 'POST';
				var url = form.prop('action');

				$('#editSC').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

				editSkillCompetency(id,url);

				$('form[data-update]').on('submit', function (e) {

					e.preventDefault();

					$.ajax({
						type: method,
						url: url + '/' + id,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								$('#editSC').modal('hide');
								$('.message-log').append('<div class="note note-success">Skill/Competency successfully updated.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-skills_competencies').dataTable({
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
										      return '<button type="button" class="btn btn-info btn-edit-sc" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;{{ Form::open(array("route" => array("skills_competencies.destroy", '+data+'), "method" => "delete", "class" => "form-archive form-delete")) }}<button type="submit" class="btn btn-small btn-danger btn-delete-sc"><i class="fa fa-trash"></i>&nbsp;Archive</button>{{ Form::close() }}';
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
							}
							else
							{
								$('.error-message').empty();
								$('#error-updatesc-name').append(data.errors.name);
							}
						}
					});
				});
			});

			$('#tb-skills_competencies').on('click', '.btn-delete-sc', function (e) {
				
				var id = $(this).attr('data-id');
				var url = "{{ URL::to('skills_competencies') }}";
				
			    $('#deleteSC').on('hidden.bs.modal', function (e) {
					id = '';
				});
				
				$('.message-log').empty();


			    $('#deleteSC').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-sc', function() {
			            deleteSkillCompetency(id,url);
			    });
			});

			clearAllFields('#addSC','#add-sc');
			clearAllFields('#editSC','#update-sc');

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

			function editSkillCompetency(id,url) {
				$.ajax({
					type: 'GET',
					url: url + '/' + id + '/edit',
					data: id,
					success: function(data) {
						if(data.success)
						{					
							$('#editSC').find('input[name=name]').val(data.result.name);
							$('#editSC').modal({ backdrop: 'static', keyboard: false });
						}
					}
				});
			}

			function deleteSkillCompetency(id,url) {

				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteSC').modal('hide');

							$('.message-log').append('<div class="note note-success">Skill/Competency successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-skills_competencies').dataTable({
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
										      return '<button type="button" class="btn btn-info btn-edit-sc" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;{{ Form::open(array("route" => array("skills_competencies.destroy", '+data+'), "method" => "delete", "class" => "form-archive form-delete")) }}<button type="submit" class="btn btn-small btn-danger btn-delete-sc"><i class="fa fa-trash"></i>&nbsp;Archive</button>{{ Form::close() }}';
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
						}
					}

				});
			}

			

		});

	</script>
@stop