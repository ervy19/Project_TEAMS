@extends('layouts.index')

@section('title')
	Campuses
@stop

@section('breadcrumb')
	<li>Campuses</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
		<div class="panel-heading">
			<h1 class="panel-header">Campuses</h1>
			<button type="button" id="btn-add-campus" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addCampus">
				Add Campus<i class="fa fa-plus fa-lg add-plus"></i>
			</button>
		</div>

		<div class="message-log"></div>

		<table id="tb-campuses" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Campus Name</th>
					<th>Campus Address</th>
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

<!-- Add Campus Modal -->
<div class="modal fade" id="addCampus" tabindex="-1" role="dialog" aria-labelledby="addCampusLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addCampusLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add Campus Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(['data-add','id' => 'add-campus', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addcampus-name" class="error-message"></div>
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('address','Address: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('address', '',array('class' => 'form-control', 'rows' => '3')) }}
										<div id="error-addcampus-address" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Add Campus', array('class' => 'btn btn-primary')) }}
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

			var table = $('#tb-campuses').dataTable({
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

			$('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');

					$('#addCampus').on('hidden.bs.modal', function (e) {
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

			$('#tb-campuses').on('click', '.btn-edit-campus', function (e) {
				var id = $(this).attr('data-id');

				var form = $('form[data-update]');
				var method = form.find('input[name="_method"]').val() || 'POST';
				var url = form.prop('action');

				$('#editCampus').on('hidden.bs.modal', function (e) {
					id = '';
				});

				$('.message-log').empty();

				editCampusInformation(id,url);

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
								$('#editCampus').modal('hide');
								$('.message-log').append('<div class="note note-success">Campus information successfully updated.</div>').fadeIn(300).delay(3000).fadeOut(300);
								
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
								$('#error-updatecampus-name').append(data.errors.name);
								$('#error-updatecampus-address').append(data.errors.address);
							}
						}
					});
				});
			});

			$('#tb-campuses').on('click', '.btn-delete-campus', function (e) {

				var id = $(this).attr('data-id');
				var url = "{{ URL::to('campuses') }}";
				$('.message-log').empty();

			    $('#deleteCampus').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-campus', function() {

			            deleteCampus(id,url);
			            //$form.trigger('submit');
			            //$('.message-log').append('<div class="note note-success">Campus successfully deleted.</div>').fadeIn(300).delay(3000).fadeOut(300);
			    });

			    $('#deleteCampus').on('hidden.bs.modal', function (e) {
					id = '';
				});
			});

			clearAllFields('#addCampus','#add-campus');
			clearAllFields('#editCampus','#update-campus');

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

			function editCampusInformation(id,url) {
				$.ajax({
					type: 'GET',
					url: url + '/' + id + '/edit',
					data: id,
					success: function(data) {
						if(data.success)
						{					
							$('#editCampus').find('input[name=name]').val(data.result.name);
							$('#editCampus').find('textarea[name=address]').val(data.result.address);
							$('#editCampus').modal({ backdrop: 'static', keyboard: false });
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
					}
				});
			}

			

		});

	</script>
@stop