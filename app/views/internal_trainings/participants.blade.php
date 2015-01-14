@extends('layouts.index')

@section('title')
	Internal Training Participants - {{ $internaltrainings->title or '---' }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}">{{$internaltrainings->title or '---'}}</a></li>
	<li>Participants</li>
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
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/speakers">Speakers</a></li>
				<li role="presentation" class="active"><a href="#">Participants</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">

				<a href="#" class="btn btn-primary">Add Participant<i class="fa fa-plus fa-lg add-plus"></i></a>
				<br><br>

				<table id="tb-it_participants" class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Department</th>
							<th>Assessor</th>
							<th>Participation Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Ana Marie O. Afortunado</td>
							<td>Head</td>
							<td>Human Resources</td>
							<td>VP Espino</td>
							<td>
								<span class="label label-danger">No PTA</span>
								<span class="label label-danger">Not Attended</span>
								<span class="label label-danger">No PTE</span>
							</td>
						</tr>
						<tr>
							<td>Erna Yabut</td>
							<td>Vice President</td>
							<td>Research and Evaluation</td>
							<td>N/A</td>
							<td>
								<span class="label label-success">PTA</span>
								<span class="label label-danger">Not Attended</span>
								<span class="label label-danger">No PTE</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#tb-it_participants').DataTable( {

				"aoColumnDefs": [
      				{ "bSortable": false, "aTargets": [ 4 ] }
    			]

		    });
		});
	</script>
@stop