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

		<h1 class="panel-header">Campuses</h1>

		<div class="message-log"></div>

		<button type="button" id="btn-add-campus" class="btn btn-primary" data-toggle="modal" data-target="#addCampus">
			Add Campus<i class="fa fa-plus fa-lg add-plus"></i>
		</button>

		<br><br>

		<table id="tb-campuses" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Campus Name</th>
					<th>Campus Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($campuses as $key => $value)
				<tr>
					<td>{{ $value->name }}</td>
					<td>{{ $value->address }}</td>
					<td>
						<button type="submit" class="btn btn-info btn-edit-campus" data-id="{{ $value->id }}">
							<i class="fa fa-edit"></i>&nbsp;Edit
						</button>
						&nbsp;
					   	{{ Form::open(array('route' => array('campuses.destroy', $value->id), 'method' => 'delete', 'class' => 'form-archive form-delete')) }}
					   		<button type="submit" class="btn btn-small btn-danger btn-delete-campus"><i class="fa fa-trash"></i>&nbsp;Archive</button>
					   	{{ Form::close() }}	   
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>

<!-- Add Campus Modal -->
<div class="modal fade" id="addCampus" tabindex="-1" role="dialog" aria-labelledby="addCampusLabel" aria-hidden="true">
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
<div class="modal fade" id="editCampus" tabindex="-1" role="dialog" aria-labelledby="editCampusLabel" aria-hidden="true">
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
<div class="modal fade" id="deleteCampus" tabindex="-1" role="dialog" aria-labelledby="deleteCampusLabel" aria-hidden="true">
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

			var table = $('#tb-campuses').dataTable();

			$('#btn-add-campus').on('click', function (e) {
				addCampus();
			});

			$('.btn-edit-campus').on('click', function (e) {
				var id = $(this).attr('data-id');

				var form = $('form[data-update]');
				var method = form.find('input[name="_method"]').val() || 'POST';
				var url = form.prop('action');
		
				editCampusInformation(id,url);

				updateCampusInformation(id,method,url);

			});

			$('.btn-delete-campus').on('click', function (e) {
				var $form=$(this).closest('form'); 
			    e.preventDefault();
			    $('#deleteCampus').modal({ backdrop: 'static', keyboard: false })
			        .one('click', '#btn-archive-campus', function() {
			            $form.trigger('submit');
			            $('.message-log').append('<div class="alert alert-success">Campus successfully deleted.</div>').fadeIn(300).delay(3000).fadeOut(300);
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

			function addCampus() {
				$('form[data-add]').on('submit', function (e) {

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');

					$.ajax({
						type: method,
						url: url,
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-campuses',url);
								$('#addCampus').modal('hide');
								//$('.message-log').append('<div class="alert alert-success">Campus successfully added.</div>').fadeIn(300).delay(3000).fadeOut(300);
								window.location.reload(true);
							}
							else
							{
								$('.error-message').empty();
								$('#error-addcampus-name').append(data.errors.name);
								$('#error-addcampus-address').append(data.errors.address);
							}
						}
					});

					e.preventDefault();
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

			function updateCampusInformation(id,method,url) {
				$('form[data-update]').on('submit', function (e) {
					$.ajax({
						type: method,
						url: url + '/' + id,
						data: (this).serialize(),
						success: function(data) {
							if(data.success)
							{
								//RefreshTable('#tb-campuses',url);
								$('#editCampus').modal('hide');
								//$('.message-log').append('<div class="alert alert-success">Campus information successfully updated.</div>').fadeIn(300).delay(3000).fadeOut(300);
								window.location.reload(true);
							}
							else
							{
								//alert(data);
								$('.error-message').empty();
								$('#error-updatecampus-name').append(data.errors.name);
								$('#error-updatecampus-address').append(data.errors.address);
							}
						}
					});

					//table.ajax.url(url).load().delay(10000);

					e.preventDefault();
				});
			}

		});
	</script>
@stop