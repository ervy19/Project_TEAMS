@extends('layouts.index')

@section('title')
	Internal Training Speakers - {{ $internal_training->title }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}">{{$internal_training->title or '---'}}</a></li>
	<li>Speakers</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internal_training->title or '---' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a href="#">Speakers</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/assessment-items">Assessment Items</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/participants">Participants</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
			@if($isAdminHR)
				<button type="button" id="btn-add-speaker" class="btn btn-primary" data-toggle="modal" data-target="#addSpeaker">
					Add Speaker<i class="fa fa-plus fa-lg add-plus"></i>
				</button>
				<br><br>
			@endif
				<table id="tb-speakers" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Topic</th>
							<th>Educational Background</th>
							<th>Work Background</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!-- Add Speaker Modal -->
<div class="modal fade" id="addSpeaker" tabindex="-1" role="dialog" aria-labelledby="addSpeakerLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addSpeakerLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add Speaker Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(['data-add','id' => 'add-speaker', 'url' => 'internal_trainings', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addspeaker-name" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('topiclabel','Topic: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('topic', '',array('class' => 'form-control')) }}
										<div id="error-addspeaker-topic" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('educational_background_label','Educational Background: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('educational_background', '',array('class' => 'form-control', 'rows' => '3')) }}
										<div id="error-addspeaker-educationalbackground" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('work_background_label','Work Background: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('work_background', '',array('class' => 'form-control', 'rows' => '3')) }}
										<div id="error-addspeaker-workbackground" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Add Speaker', array('class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Edit Speaker Information Modal -->
<div class="modal fade" id="editSpeaker" tabindex="-1" role="dialog" aria-labelledby="editSpeakerLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editSpeakerLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit Speaker Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-speaker', 'class' => 'form-horizontal form-update-speaker']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addspeaker-name" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('topiclabel','Topic: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('topic', '',array('class' => 'form-control')) }}
										<div id="error-addspeaker-topic" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('educational_background_label','Educational Background: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('educational_background', '',array('class' => 'form-control', 'rows' => '3')) }}
										<div id="error-addspeaker-educationalbackground" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('work_background_label','Work Background: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('work_background', '',array('class' => 'form-control', 'rows' => '3')) }}
										<div id="error-addspeaker-workbackground" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save Speaker Information', array('id' => 'btn-update-speaker', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Delete Speaker Modal -->
<div class="modal fade" id="deleteSpeaker" tabindex="-1" role="dialog" aria-labelledby="deleteSpeakerLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteSpeakerLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive Speaker</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to delete this speaker?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-speaker" class="btn btn-danger ">Delete</button>
      		</div>
    	</div>
	</div>
</div>
@stop

@section('page_js')
	<script type="text/javascript">

		$(document).ready( function () {

			var table = $('#tb-speakers').dataTable({
		        "ajax": "{{URL::to('internal_trainings')}}/{{$internal_training->id}}/speakers",
		        "columns": [
		            { "data": "name" },
		            { "data": "topic" },
		            { "data": "educational_background" },
		            { "data": "work_background" },
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
		            	 return '<button type="button" class="btn btn-info btn-edit-speaker" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-speaker" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
		        		}
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "30%", "aTargets": [ 0 ] },
			      { "sWidth": '15%', "aTargets": [ 1 ] },
			      { "sWidth": '20%', "aTargets": [ 2 ] },
			      { "sWidth": '20%', "aTargets": [ 3 ] },
			      { "sWidth": '15%', "aTargets": [ 4 ] },
			    ]
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
						url: url + '/' + training_id + '/speakers/store',
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-speakers',url);
								$('#addSpeaker').modal('hide');
								$('.message-log').append('<div class="note note-success">Speaker successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-speakers').dataTable({
							        "ajax": "{{URL::to('internal_trainings')}}/{{$internal_training->id}}/speakers",
							        "columns": [
							            { "data": "name" },
							            { "data": "topic" },
							            { "data": "educational_background" },
							            { "data": "work_background" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-speaker" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-speaker" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
							        		}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "30%", "aTargets": [ 0 ] },
								      { "sWidth": '15%', "aTargets": [ 1 ] },
								      { "sWidth": '20%', "aTargets": [ 2 ] },
								      { "sWidth": '20%', "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] },
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-addspeaker-name').append(data.errors.name);
								$('#error-addspeaker-topic').append(data.errors.topic);
								$('#error-addspeaker-educationalbackground').append(data.errors.educationalbackground);
								$('#error-addspeaker-workbackground').append(data.errors.workbackground);
							}
						}
					});
				});

			$('#tb-speakers').on('click', '.btn-edit-speaker', function (e) {
				var id = $(this).attr('data-id');

				var form = $('form[data-update]');
				var method = form.find('input[name="method"]').val() || 'POST';
				var url = form.prop('action');

				$('#editSpeaker').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

				editSpeakerInformation(id,url);

				$('form[data-update]').on('submit', function (e) {

					e.preventDefault();

					$.ajax({
						type: method,
						url: url + '/' + id,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-speakers',url);
								$('#editSpeaker').modal('hide');
								$('.message-log').append('<div class="note note-success">Speaker information successfully updated.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-speakers').dataTable({
							        "ajax": "{{URL::to('internal_trainings')}}/{{$internal_training->id}}/speakers",
							        "columns": [
							            { "data": "name" },
							            { "data": "topic" },
							            { "data": "educational_background" },
							            { "data": "work_background" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-speaker" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-speaker" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
							        		}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "30%", "aTargets": [ 0 ] },
								      { "sWidth": '15%', "aTargets": [ 1 ] },
								      { "sWidth": '20%', "aTargets": [ 2 ] },
								      { "sWidth": '20%', "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] },
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-updatespeaker-name').append(data.errors.name);
								$('#error-updatespeaker-topic').append(data.errors.topic);
								$('#error-updatespeaker-educationalbackground').append(data.errors.educationalbackground);
								$('#error-updatespeaker-workbackground').append(data.errors.workbackground);
							}
						}
					});
				});
			});

			$('#tb-speakers').on('click', '.btn-delete-speaker', function (e) {

				var id = $(this).attr('data-id');
				var url = "{{ URL::to('internal_trainings')}}/{{$internal_training->id}}/speakers";
				$('.message-log').empty();

			    $('#deleteSpeaker').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-speaker', function() {

			            deleteSpeaker(id,url);
			            //$form.trigger('submit');
			            //$('.message-log').append('<div class="note note-success">Speaker successfully deleted.</div>').fadeIn(300).delay(3000).fadeOut(300);
			    });

			    $('#deleteSpeaker').on('hidden.bs.modal', function (e) {
					id = '';
				});
			});

			clearAllFields('#addSpeaker','#add-speaker');
			clearAllFields('#editSpeaker','#update-speaker');

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

			function editSpeakerInformation(id,url) {
				$.ajax({
					type: 'GET',
					url: url + '/' + id + '/edit',
					data: id,
					success: function(data) {
						if(data.success)
						{
							$('#editSpeaker').modal('show');						
							$('#update-speaker').find('input[name=name]').val(data.result.name);
							$('#update-speaker').find('input[name=topic]').val(data.result.topic);
							$('#update-speaker').find('textarea[name=educational_background]').val(data.result.educational_background);
							$('#update-speaker').find('textarea[name=work_background]').val(data.result.work_background);
							$('#editSpeaker').modal({ backdrop: 'static', keyboard: false });
							alert(data.result.name);
						}
					}
				});
			}

			function deleteSpeaker(id,url) {

				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteSpeaker').modal('hide');

							$('.message-log').append('<div class="note note-success">Speaker successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-speakers').dataTable({
							        "ajax": "{{URL::to('internal_trainings')}}/{{$internal_training->id}}/speakers",
							        "columns": [
							            { "data": "name" },
							            { "data": "topic" },
							            { "data": "educational_background" },
							            { "data": "work_background" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-speaker" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-speaker" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
							        		}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "30%", "aTargets": [ 0 ] },
								      { "sWidth": '15%', "aTargets": [ 1 ] },
								      { "sWidth": '20%', "aTargets": [ 2 ] },
								      { "sWidth": '20%', "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] },
								    ]
								});
						}
					}
				});
			}

			

		});


	</script>
@stop