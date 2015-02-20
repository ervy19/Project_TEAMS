@extends('layouts.index')

@section('title')
	Internal Training Participants - {{ $internal_training->title or '---' }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}">{{$internal_training->title or '---'}}</a></li>
	<li>Participants</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internal_training->title or 'NO TITLE' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/speakers">Speakers</a></li>
				<li role="presentation" class="active"><a href="#">Participants</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			@if($isAdminHR)
				<button type="button" id="btn-add-participant" class="btn btn-primary" data-toggle="modal" data-target="#addParticipant">
					Add Participant<i class="fa fa-plus fa-lg add-plus"></i>
				</button>
				<button type="button" id="btn-add-participant" class="btn btn-primary">
					Upload List of Participants
				</button>
				<button type="button" id="btn-add-participant" class="btn btn-primary">
					Upload Attendees
				</button>
				<br><br>
			@endif
				<div class="message-log"></div>
				<table id="tb-it_participants" class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Assessor</th>
							<th>Participation Status</th>
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

	<!-- Add Participant Modal -->
	<div class="modal fade" id="addParticipant" tabindex="-1" role="dialog" aria-labelledby="addParticipantLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="addParticipantLabel"><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;Add Participant</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="container">
	      				<div class="col-sm-12 col-md-12">
	      					<div class="row">
	      						{{ Form::open(['data-add','id' => 'add-participant', 'url' => 'internal_trainings', 'class' => 'form-horizontal']) }}
									<div class="form-group row">
										<div class="col-sm-12 col-md-12">
										{{ Form::label('employee_name','Employee Name: ') }}
										</div>
										{{ Form::select('employee', $employees, 'Select an Employee', array('id' => 'dd-employees', 'class' => 'col-sm-5 col-md-5')) }}
										<div id="error-addparticipant-name" class="error-message"></div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 col-md-12">
										{{ Form::label('employee_designation','Designation: ') }}
										</div>
										{{ Form::select('employee_designation', [], 'Assign Employee Designation', array('id' => 'dd-employee_designation', 'class' => 'col-sm-5 col-md-5')) }}
									</div>
							</div>
						</div>
					</div>	
	      		</div>
	    		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        		<button type="submit" id="btn-participant" class="btn btn-primary ">Add</button>
	        					{{ Form::close() }}
	      		</div>
	    	</div>
		</div>
	</div>

	<!-- Delete Participant Modal -->
	<div class="modal fade" id="deleteParticipant" tabindex="-1" role="dialog" aria-labelledby="deleteParticipantLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="deleteParticipantLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Delete Participant</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="container">
	      				<div class="col-sm-12 col-md-12">
	      					<div class="row">
	      						<h5 class="confirm-delete">Are you sure you want to delete this participant?</h5>
							</div>
						</div>
					</div>	
	      		</div>
	    		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        		<button type="button" id="btn-archive-participant" class="btn btn-danger ">Delete</button>
	      		</div>
	    	</div>
		</div>
	</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {

		    var table = $('#tb-it_participants').dataTable({
			    "ajax": "{{ URL::to('internal_trainings') }}/{{ $internal_training->id }}/participants",
			    "columns": [
			        { "data": "employee_name" },
			        { "data": "position_title" },
			        { "data": "supervisor_name" },
			        { "data": "requirement_statuses",
				        "render": function ( data, type, full, meta ) {
							              	if(data)
							              	{
							              		var status = '';
							              		if(data[0])
							              		{
							              			status += '<span class="label label-success">Has PTA</span>&nbsp;';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">No PTA Yet</span>&nbsp;';
							              		}

							              		if(data[1])
							              		{
							              			status += '<span class="label label-success">Has Attended</span>&nbsp;';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">Has Not Attended</span>&nbsp;';
							              		}

							              		if(data[2])
							              		{
							              			status += '<span class="label label-success">Has PTE</span>';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">No PTE Yet</span>';
							              		}

							              		return status;
							              	}
							              	else
							              	{
							              		return '';
							              	}
							              } 
							        	},
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-participant" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-participant" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "25%", "aTargets": [ 0 ] },
								      { "sWidth": '18%', "aTargets": [ 1 ] },
								      { "sWidth": '20%', "aTargets": [ 2 ] },
								      { "sWidth": '22%', "bSortable": false, "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] }
								    ]
								});

		    $("#dd-employees").select2({
			    allowClear: true
			});

			$("#dd-employee_designation").select2({
			    allowClear: true
			});

			$('#dd-employees').change(function(){
		        var employee_id = $(this).val();
		        $.get('{{ URL::to('') }}/internal_trainings/participants/'+employee_id, function(data){
		            if(data.hasDesignation)
		            {
		            	$.each(data.data, function(element, index){
		                	$('#dd-employee_designation').append('<option value="'+index.id+'">'+index.title+'</option>');
		            	});
		            }
		            else
		            {
		            	$('#dd-employee_designation').append('<option value="0">Employee has no current designation</option>')
		            }		            
		        }, 'json');
		    });

			$('form[data-add]').on('submit', function (e) {
					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');	

					var training_id = {{ $internal_training->id }};

					$('.message-log').empty();

					$.ajax({
						type: method,
						url: url + '/' + training_id + '/participants',
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								$('#addParticipant').modal('hide');
								$('.message-log').append('<div class="note note-success">Participant successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-it_participants').dataTable({
								    "ajax": "{{ URL::to('internal_trainings') }}/{{ $internal_training->id }}/participants",
								    "columns": [
								        { "data": "employee_name" },
								        { "data": "position_title" },
								        { "data": "supervisor_name" },
								        { "data": "requirement_statuses",
									        "render": function ( data, type, full, meta ) {
							              	if(data)
							              	{
							              		var status = '';
							              		if(data[0])
							              		{
							              			status += '<span class="label label-success">Has PTA</span>&nbsp;';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">No PTA Yet</span>&nbsp;';
							              		}

							              		if(data[1])
							              		{
							              			status += '<span class="label label-success">Has Attended</span>&nbsp;';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">Has Not Attended</span>&nbsp;';
							              		}

							              		if(data[2])
							              		{
							              			status += '<span class="label label-success">Has PTE</span>';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">No PTE Yet</span>';
							              		}

							              		return status;
							              	}
							              	else
							              	{
							              		return '';
							              	}
							              } 
							        	},
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-participant" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-participant" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "25%", "aTargets": [ 0 ] },
								      { "sWidth": '18%', "aTargets": [ 1 ] },
								      { "sWidth": '20%', "aTargets": [ 2 ] },
								      { "sWidth": '22%', "bSortable": false, "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] }
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-addparticipant-name').append(data.errors.employee_name);
							}
						}
					});
				});

				$('#tb-it_participants').on('click', '.btn-delete-participant', function (e) {
				
					var id = $(this).attr('data-id');
					var url = "{{ URL::to('internal_trainings') }}/{{ $internal_training->id }}/participants";
					
				    $('#deleteParticipant').on('hidden.bs.modal', function (e) {
						id = '';
					});
					
					$('.message-log').empty();


				    $('#deleteParticipant').modal({ backdrop: 'static', keyboard: false })
				        .one('click', '#btn-archive-participant', function() {
				            deleteParticipant(id,url);
				    });
				});

				clearAllFields('#addParticipant','#add-participant');
				//clearAllFields('#editParticipant','#update-participant');

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

				function deleteParticipant(id,url) {

				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteParticipant').modal('hide');

							$('.message-log').append('<div class="note note-success">Participant successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-it_participants').dataTable({
								    "ajax": "{{ URL::to('internal_trainings') }}/{{ $internal_training->id }}/participants",
								    "columns": [
								        { "data": "employee_name" },
								        { "data": "position_title" },
								        { "data": "supervisor_name" },
								        { "data": "requirement_statuses",
									        "render": function ( data, type, full, meta ) {
							              	if(data)
							              	{
							              		var status = '';
							              		if(data[0])
							              		{
							              			status += '<span class="label label-success">Has PTA</span>&nbsp;';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">No PTA Yet</span>&nbsp;';
							              		}

							              		if(data[1])
							              		{
							              			status += '<span class="label label-success">Has Attended</span>&nbsp;';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">Has Not Attended</span>&nbsp;';
							              		}

							              		if(data[2])
							              		{
							              			status += '<span class="label label-success">Has PTE</span>';
							              		}
							              		else
							              		{
							              			status += '<span class="label label-danger">No PTE Yet</span>';
							              		}

							              		return status;
							              	}
							              	else
							              	{
							              		return '';
							              	}
							              } 
							        	},
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-participant" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-participant" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "25%", "aTargets": [ 0 ] },
								      { "sWidth": '18%', "aTargets": [ 1 ] },
								      { "sWidth": '20%', "aTargets": [ 2 ] },
								      { "sWidth": '22%', "bSortable": false, "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] }
								    ]
								});
						}
					}

				});
			}

		});
	</script>
@stop