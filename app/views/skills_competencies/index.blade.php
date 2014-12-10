@extends('layouts.index')

@section('title')
	Skills and Competencies
@stop

@section('content')

<div class="row panel">

	<h1>Skills and Competencies</h1>

	<a href="{{ URL::to('skills_competencies/create') }}" class="btn btn-primary">Add Skill/Competency</a>

	<br><br>

	<table id="tb-skills_competencies" class="table table-bordered">
		<thead>
			<tr>
				<th>Skill/Competency</th>
				<th>Number of Departments Tagged</th>
				<th>Number of Positions Tagged</th>
				<th>Number of Trainings Tagged</th>
				<th>Action</th>
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
					<a class="btn btn-small btn-info" href="{{ URL::to('skills_competencies/' . $value->id . '/edit') }}">Edit</a>
					&nbsp;&nbsp;
				   {{ Form::open(array('route' => array('skills_competencies.destroy', $value->id), 'method' => 'delete')) }}
				    <button type="submit" class="btn btn-small btn-danger">Archive</button>
				   {{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-skills_competencies').DataTable();
		} );
	</script>
@stop