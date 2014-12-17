@extends('layouts.index')

@section('title')
	Skills and Competencies
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Skills and Competencies</h1>

			<a href="{{ URL::to('skills_competencies/create') }}" class="btn btn-primary">Add Skill/Competency<i class="fa fa-plus fa-lg add-plus"></i></a>

			<br><br>

			<table id="tb-skills_competencies" class="table table-bordered">
				<thead>
					<tr>
						<th>Skill/Competency</th>
						<th>Departments Tagged</th>
						<th>Positions Tagged</th>
						<th>Trainings Tagged</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($scs as $key => $value)
					<tr>
						<td>{{ $value->name }}</td>
						<td>Sample</td>
						<td>Sample</td>
						<td>Sample</td>
						<td>
							<a class="btn btn-info" href="{{ URL::to('skills_competencies/' . $value->id . '/edit') }}"><i class="fa fa-edit fa-fw"></i>Edit</a>
						   {{ Form::open(array('route' => array('skills_competencies.destroy', $value->id), 'method' => 'delete')) }}
						    <button type="submit" class="btn btn-danger"><i class="fa fa-close fa-fw"></i>Archive</button>
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
		    $('#tb-skills_competencies').DataTable({
		    	"columnDefs": [ {
				      "targets": 4,
				      "searchable": false
				    }]
		    });
		} );
	</script>
@stop