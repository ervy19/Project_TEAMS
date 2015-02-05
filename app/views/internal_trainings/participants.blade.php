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

				<button type="button" id="btn-add-participant" class="btn btn-primary" data-toggle="modal" data-target="#addParticipant">
					Add Participant<i class="fa fa-plus fa-lg add-plus"></i>
				</button>

				<br><br>

				<table id="tb-it_participant" class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Department</th>
							<th>Assessor</th>
							<th>Participation Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Ana Marie O. Afortunado</td>
							<td>Head</td>
							<td>Human Resources</td>
							<td>VP Espino</td>
							<td>
								<span class="label label-danger">No PTA</span>
								<span class="label label-danger">Not Attended</span>
								<span class="label label-danger">No PTE</span>
							</td>
							<td></td>
						</tr>
						@foreach($participants as $key => $value)
							<tr>
							<td>
							@if($value->has_pta)
							{{ $value->employee_name }}
							<span class="label label-success">Has PTA</span>
							@else
							<span class="label label-danger">No PTA</span>
							@endif
							</td>
							<td>{{ $value->employee_name }}</td>
							<td>Human Resources</td>
							<td>VP Espino</td>
							<td></td>
							<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<table id="tb-it_participants" class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Department</th>
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
	      						{{ Form::open(array('url' => 'internal_trainings', 'class' => 'form-horizontal')) }}
									<div class="form-group row">
										<div class="col-sm-12 col-md-12">
										{{ Form::label('employee_name','Employee Name: ') }}
										</div>
										{{ Form::select('employee', $employees, 'Select an Employee', array('id' => 'dd-employees', 'class' => 'col-sm-5 col-md-5')) }}
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
	        		<button type="button" id="btn-add-participant" class="btn btn-primary ">Add</button>
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
	        		<button type="button" id="btn-archive-campus" class="btn btn-danger ">Delete</button>
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
		            { "data": "department_id" },
		            { "data": "supervisor_id" },
		            { "data": "has_pta",
		              "render": function ( data, type, full, meta ) {
		              	if(data)
		              	{
		              		return '<span class="label label-success">Has PTA</span>';
		              	}
		              	else
		              	{
		              		return '<span class="label label-danger">No PTA Yet</span>';
		              	}
		              } 
		        	},
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
		            	 return '<button type="button" class="btn btn-info btn-edit-campus" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-campus" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
						}
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "30%", "aTargets": [ 0 ] },
			      { "sWidth": '20%', "aTargets": [ 1 ] },
			      { "sWidth": '10%', "aTargets": [ 2 ] },
			      { "sWidth": '10%', "aTargets": [ 3 ] },
			      { "sWidth": '15%', "bSortable": false, "aTargets": [ 4 ] },
			      { "sWidth": '15%', "aTargets": [ 5 ] }
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
		            $.each(data, function(element, index){
		                $('"#dd-employee_designation').append('<option value="'+element.id+'">'+element.title+'</option>')
		            });
		        }, 'json');
		    });

		});
	</script>
@stop