@extends('layouts.index')

@section('title')
	Employees
@stop

@section('breadcrumb')
	<li>Employees</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Employees</h1>

			@if($isAdminHR)

			<a href="{{ URL::to('employees/create') }}" class="btn btn-primary">Add Employee<i class="fa fa-plus fa-lg add-plus"></i></a>

			<br><br>

			@endif

			<table id="tb-employees" class="table table-bordered">
				<thead>
					<tr>
						<th>Employee Number</th>
						<th>Name</th>
						<th>Email</th>
						<th>Tenure</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($employees as $key => $value)
					<tr>
						<td>{{ $value->employee_number }}</td>
						<td>{{ $value->last_name . ', ' . $value->given_name . " " . $value->middle_initial }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ $value->tenure }}</td>
						<td>
							&nbsp;
							<a class="btn btn-small btn-primary btn-view" href="{{ URL::to('employees/' . $value->id) }}"><i class="fa fa-file-text-o"></i>&nbsp;View</a>
							@if($isAdminHR)
							<a class="btn btn-small btn-info btn-edit" href="{{ URL::to('employees/' . $value->id . '/edit') }}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
						   {{ Form::open(array('route' => array('employees.destroy', $value->id), 'method' => 'delete', 'class' => 'form-archive')) }}
						   	<button type="submit" class="btn btn-small btn-danger"><i class="fa fa-trash"></i>&nbsp;Archive</button>
						   {{ Form::close() }}
						   @endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-employees').DataTable({
		    	"aoColumnDefs": [
		    	@if($isAdminHR)
			      { "sWidth": "13%", "aTargets": [ 0 ] },
			      { "sWidth": '30%', "aTargets": [ 1 ] },
			      { "sWidth": '25%', "aTargets": [ 2 ] },
			      { "sWidth": '10%', "aTargets": [ 3 ] },
			      { "sWidth": '22%', "aTargets": [ 4 ] }
			    @else
			      { "sWidth": "13%", "aTargets": [ 0 ] },
			      { "sWidth": '35%', "aTargets": [ 1 ] },
			      { "sWidth": '25%', "aTargets": [ 2 ] },
			      { "sWidth": '15%', "aTargets": [ 3 ] },
			      { "sWidth": '12%', "aTargets": [ 4 ] }
			    @endif
			    ]
		    });
		} );
	</script>
@stop