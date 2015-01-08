@extends('layouts.index')

@section('title')
	Ranks
@stop

@section('breadcrumb')
	<li>Ranks</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">Ranks</h1>
			<button type="button" id="btn-add-rank" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addRank">
				Add Rank<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

		<table id="tb-ranks" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Code</th>
					<th>Title</th>
					<th>Level</th>
					<th>Employees Holding the Rank</th>
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

<!-- Add Rank Modal -->
<div class="modal fade" id="addRank" tabindex="-1" role="dialog" aria-labelledby="addRankLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addRankLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add Rank</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(['data-add','id' => 'add-rank', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('code','Code: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('code', '',array('class' => 'form-control')) }}
										<div id="error-addrank-code" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('title','Title: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('title', '',array('class' => 'form-control')) }}
										<div id="error-addrank-title" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('level','Level: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('level', '',array('class' => 'form-control')) }}
										<div id="error-addrank-level" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('position','Position: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::select('position', array('' => 'Select a Position') + $positions, null, array('id' => 'dd-positions-add', 'data-placeholder' => 'Select an option')) }}
										<div id="error-addrank-position" class="error-message"></div>
									</div>
						    	</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Add Rank', array('class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Edit Rank Information Modal -->
<div class="modal fade" id="editRank" tabindex="-1" role="dialog" aria-labelledby="editRankLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editRankLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit Rank Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-rank', 'class' => 'form-horizontal form-update-rank']) }}
								<div class="form-group row">
									{{ Form::label('code','Code: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('code', '',array('class' => 'form-control')) }}
										<div id="error-updaterank-code" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('title','Title: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('title', '',array('class' => 'form-control')) }}
										<div id="error-updaterank-title" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('level','Level: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('level', '',array('class' => 'form-control')) }}
										<div id="error-updaterank-level" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('position','Position: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::select('position', array('' => 'Select a Position') + $positions, null, array('id' => 'dd-positions-edit')) }}
										<div id="error-updaterank-position" class="error-message"></div>
									</div>
						    	</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save Rank Information', array('id' => 'btn-update-rank', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>

<!-- Delete Rank Modal -->
<div class="modal fade" id="deleteRank" tabindex="-1" role="dialog" aria-labelledby="deleteRankLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="deleteRankLabel"><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Archive Rank</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						<h5 class="confirm-delete">Are you sure you want to archive this rank?</h5>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button type="button" id="btn-archive-rank" class="btn btn-danger ">Archive</button>
      		</div>
    	</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		
		$(document).ready( function () {

			var table = $('#tb-ranks').dataTable({
		        "ajax": "{{ URL::to('ranks') }}",
		        "columns": [
		            { "data": "code" },
		            { "data": "title" },
		            { "data": "level" },
		            { "data": "employeeHoldingRank" },
		            { 
		            	"data": "id",
		            	"render": function ( data, type, full, meta ) {
		            	 return '<button type="button" class="btn btn-info btn-edit-rank" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-rank" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
						}
		        	}
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "10%", "aTargets": [ 0 ] },
			      { "sWidth": "35%", "aTargets": [ 1 ] },
			      { "sWidth": "10%", "aTargets": [ 2 ] },
			      { "sWidth": '20%', "aTargets": [ 3 ] },
			      { "sWidth": '15%', "aTargets": [ 4 ] }
			    ]
			});					

			$('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');

					$('#addRank').on('hidden.bs.modal', function (e) {
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
								$('#addRank').modal('hide');
								$('.message-log').append('<div class="note note-success">Rank successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
		
								table.fnDestroy();

								table = $('#tb-ranks').dataTable({
							        "ajax": "{{ URL::to('ranks') }}",
							        "columns": [
							            { "data": "code" },
							            { "data": "title" },
							            { "data": "level" },
							            { "data": "employeeHoldingRank" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-rank" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-rank" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "10%", "aTargets": [ 0 ] },
								      { "sWidth": "35%", "aTargets": [ 1 ] },
								      { "sWidth": "10%", "aTargets": [ 2 ] },
								      { "sWidth": '20%', "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] }
								    ]
								});	
							}
							else
							{
								$('.error-message').empty();
								$('#error-addrank-code').append(data.errors.code);
								$('#error-addrank-title').append(data.errors.title);
								$('#error-addrank-level').append(data.errors.level);
								$('#error-addrank-position').append(data.errors.position);
							}
						}
					});
				});

			$('#tb-ranks').on('click', '.btn-edit-rank', function (e) {
				var id = $(this).attr('data-id');

				var form = $('form[data-update]');
				var method = form.find('input[name="_method"]').val() || 'POST';
				var url = form.prop('action');

				$('#editRank').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

				editRankInformation(id,url);

				$('form[data-update]').on('submit', function (e) {

					e.preventDefault();

					$.ajax({
						type: method,
						url: url + '/' + id,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								$('#editRank').modal('hide');
								$('.message-log').append('<div class="note note-success">Rank information successfully updated.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-ranks').dataTable({
							        "ajax": "{{ URL::to('ranks') }}",
							        "columns": [
							            { "data": "code" },
							            { "data": "title" },
							            { "data": "level" },
							            { "data": "employeeHoldingRank" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-rank" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-rank" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "10%", "aTargets": [ 0 ] },
								      { "sWidth": "35%", "aTargets": [ 1 ] },
								      { "sWidth": "10%", "aTargets": [ 2 ] },
								      { "sWidth": '20%', "aTargets": [ 3 ] },
								      { "sWidth": '15%', "aTargets": [ 4 ] }
								    ]
								});
							}
							else
							{
								$('.error-message').empty();
								$('#error-updaterank-code').append(data.errors.code);
								$('#error-updaterank-title').append(data.errors.title);
								$('#error-updaterank-level').append(data.errors.level);
								$('#error-updaterank-position').append(data.errors.position);
							}
						}
					});
				});
			});

			$('#tb-ranks').on('click', '.btn-delete-rank', function (e) {

				var id = $(this).attr('data-id');
				var url = "{{ URL::to('ranks') }}";
				$('.message-log').empty();

			    $('#deleteRank').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-rank', function() {

			            deleteRank(id,url);
			    });

			    $('#deleteRank').on('hidden.bs.modal', function (e) {
					id = '';
				});
			});

			clearAllFields('#addRank','#add-rank');
			clearAllFields('#editRank','#update-rank');

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

			function editRankInformation(id,url) {
				$.ajax({
					type: 'GET',
					url: url + '/' + id + '/edit',
					data: id,
					success: function(data) {
						if(data.success)
						{			
							$('#update-rank').find('input[name=code]').val(data.result.code);
							$('#update-rank').find('input[name=title]').val(data.result.title);
							$('#update-rank').find('input[name=level]').val(data.result.level);
							$('#dd-positions-edit').select2("val",data.result.position_id);
							$('#editRank').modal({ backdrop: 'static', keyboard: false });
						}
					}
				});
			}

			function deleteRank(id,url) {

				$.ajax({
					type: 'DELETE',
					url: url + '/' + id,
					data: id,
					success: function(data) {
						if(data.success)
						{		
							$('#deleteRank').modal('hide');

							$('.message-log').append('<div class="note note-success">Rank successfully archived.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
								table.fnDestroy();

								table = $('#tb-ranks').dataTable({
							        "ajax": "{{ URL::to('ranks') }}",
							        "columns": [
							            { "data": "code" },
							            { "data": "title" },
							            { "data": "level" },
							            { "data": "employeeHoldingRank" },
							            { 
							            	"data": "id",
							            	"render": function ( data, type, full, meta ) {
							            	 return '<button type="button" class="btn btn-info btn-edit-rank" data-id="'+data+'"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button type="submit" class="btn btn-small btn-danger btn-delete-rank" data-id="'+data+'"><i class="fa fa-trash"></i>&nbsp;Archive</button>';
											}
							        	}
							        ],
							          "aoColumnDefs": [
								      { "sWidth": "10%", "aTargets": [ 0 ] },
								      { "sWidth": "35%", "aTargets": [ 1 ] },
								      { "sWidth": "10%", "aTargets": [ 2 ] },
								      { "sWidth": '20%', "aTargets": [ 3 ] },
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