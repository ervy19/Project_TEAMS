@extends('layouts.index')

@section('title')
	Internal Training Speakers - {{ $internaltrainings->title }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}">{{$internaltrainings->title or '---'}}</a></li>
	<li>Speakers</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internaltrainings->title or '---' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a href="#">Speakers</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/participants">Participants</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/after-activity-evaluation/{{$intent}}">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">

				<button type="button" id="btn-add-speaker" class="btn btn-primary" data-toggle="modal" data-target="#addSpeaker">
					Add Speaker<i class="fa fa-plus fa-lg add-plus"></i>
				</button>
				<br><br>
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
		      				{{ Form::open(['data-add','id' => 'add-speaker', 'url' => 'internal_trainings/1/speakers/store', 'class' => 'form-horizontal']) }}
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

<!-- Edit Campus Information Modal -->
<div class="modal fade" id="editCampus" tabindex="-1" role="dialog" aria-labelledby="editCampusLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editCampusLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit Campus Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-campus', 'class' => 'form-horizontal form-update-campus']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-updatecampus-name" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('address','Address: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('address', '',array('class' => 'form-control', 'rows' => '3')) }}
										<div id="error-updatecampus-address" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save Campus Information', array('id' => 'btn-update-campus', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Delete Campus Modal -->
<div class="modal fade" id="deleteCampus" tabindex="-1" role="dialog" aria-labelledby="deleteCampusLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteCampusLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive Campus</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to archive this campus?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-campus" class="btn btn-danger ">Archive</button>
      		</div>
    	</div>
	</div>
</div>
@stop

@section('page_js')
	<script type="text/javascript">

		$(document).ready( function () {

			var table = $('#tb-speakers').dataTable({
		        "ajax": "{{URL::to('internal_trainings')}}/{{$internaltrainings->id}}/speakers",
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

					$('.message-log').empty();

					$.ajax({
						type: method,
						url: url,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-speakers',url);
								$('#addSpeaker').modal('hide');
								$('.message-log').append('<div class="note note-success">Speaker successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-speakers').dataTable({
							        "ajax": "{{URL::to('internal_trainings')}}/{{$internaltrainings->id}}/speakers",
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
				var method = form.find('input[name="_method"]').val() || 'POST';
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
							        "ajax": "{{ URL::to('campuses') }}",
							        "columns": [
							            { "data": "name" },
							            { "data": "address" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
										      return '<button type="button" class="btn btn-info btn-edit-speaker" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-speaker" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
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
								$('#error-updatecampus-name').append(data.errors.name);
								$('#error-updatecampus-address').append(data.errors.address);
							}
						}
					});
				});
			});

			$('#tb-speakers').on('click', '.btn-delete-spreaker', function (e) {

				var id = $(this).attr('data-id');
				var url = "{{ URL::to('campuses') }}";
				$('.message-log').empty();

			    $('#deleteSpeaker').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-speaker', function() {

			            deleteSpeaker(id,url);
			            //$form.trigger('submit');
			            //$('.message-log').append('<div class="note note-success">Campus successfully deleted.</div>').fadeIn(300).delay(3000).fadeOut(300);
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
							$('#editSpeaker').find('input[name=name]').val(data.result.name);
							$('#editSpeaker').find('input[name=topic]').val(data.result.topic);
							$('#editSpeaker').find('textarea[name=educationalbackground]').val(data.result.educationalbackground);
							$('#editSpeaker').find('textarea[name=workbackground]').val(data.result.workbackground);
							$('#editSpeaker').modal({ backdrop: 'static', keyboard: false });
						}
					}
				});
			}

			function deleteCampus(id,url) {

				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteCampus').modal('hide');

							$('.message-log').append('<div class="note note-success">Campus successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-campuses').dataTable({
							        "ajax": "{{ URL::to('campuses') }}",
							        "columns": [
							            { "data": "name" },
							            { "data": "address" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
										      return '<button type="button" class="btn btn-info btn-edit-speaker" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-speaker" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
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
					}
				});
			}

			

		});


	</script>
@stop