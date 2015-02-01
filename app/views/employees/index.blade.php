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

			<a href="{{ URL::to('employees/create') }}" class="btn btn-primary">Add Employee<i class="fa fa-plus fa-lg add-plus"></i></a>

			<br><br>

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
							<a class="btn btn-small btn-primary btn-view" href="{{ URL::to('employees/' . $value->id) }}">View</a>
							<a class="btn btn-small btn-info btn-edit" href="{{ URL::to('employees/' . $value->id . '/edit') }}">Edit</a>
						   {{ Form::open(array('route' => array('employees.destroy', $value->id), 'method' => 'delete', 'class' => 'form-archive')) }}
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

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-employees').DataTable({
		    	"aoColumnDefs": [
			      { "sWidth": "17%", "aTargets": [ 0 ] },
			      { "sWidth": '30%', "aTargets": [ 1 ] },
			      { "sWidth": '25%', "aTargets": [ 2 ] },
			      { "sWidth": '10%', "aTargets": [ 3 ] },
			      { "sWidth": '18%', "aTargets": [ 4 ] }
			    ]
		    });
		} );
	</script>
@stop