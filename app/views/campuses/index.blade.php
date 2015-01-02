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

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			Add Campus<i class="fa fa-plus fa-lg add-plus"></i>
		</button>

		<br><br>

		<table class="table table-striped table-bordered">
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
						<a class="btn btn-small btn-info" href="{{ URL::to('campuses/' . $value->id . '/edit') }}">Edit</a>
						&nbsp;&nbsp;
					   {{ Form::open(array('route' => array('campuses.destroy', $value->id), 'method' => 'delete')) }}
					    <button type="submit" class="btn btn-small btn-danger">Archive</button>
					   {{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel"><i class="fa fa-building-o fa-lg"></i>&nbsp;&nbsp;Add Campus Information</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
		      				{{ Form::open(array('url' => 'campuses', 'class' => 'form-horizontal')) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										{{ $errors->first('name','<div class="error-message">:message</div>') }}
									</div>
								</div>
								<div class="form-group row">
									{{ Form::label('address','Address: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::textarea('address', '',array('class' => 'form-control', 'rows' => '3')) }}
										{{ $errors->first('address','<div class="error-message">:message</div>') }}
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

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    
		} );
	</script>
@stop