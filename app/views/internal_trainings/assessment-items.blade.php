@extends('layouts.index')

@section('title')
	Internal Training Assessment Items - {{ $internal_training->title }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}">{{$internal_training->title or '---'}}</a></li>
	<li>Assessment Items</li>
@stop

@section('content')

	<div class="col-sm-12 col-md-12 training-info">
		<div class="panel">
			<div class="row training-details">
				<h2>{{  $internal_training->title or '---' }}</h2>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-md-12 training-data">
		<div class="panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/speakers">Speakers</a></li>
				<li role="presentation" class="active"><a href="#">Assessment Items</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/participants">Participants</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/after-activity-evaluation">After Activity Evaluation</a></li>
				<li role="presentation"><a href="{{ URL::to('internal_trainings') }}/{{$internal_training->id}}/training-effectiveness-report">Training Effectiveness Report</a></li>
			</ul>
			<div class="training-contents">
				<table id="tb-assessment-items" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!-- Edit Assessment Item Modal -->
<div class="modal fade" id="editAssessmentITem" tabindex="-1" role="dialog" aria-labelledby="editAssessmentItemLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="editAssessmentItemLabel"><i class="fa fa-edit fa-lg"></i>&nbsp;&nbsp;Edit Assessment Item</h4>
      		</div>
      		<div class="modal-body">
      			<div class="container">
      				<div class="col-sm-12 col-md-12">
      					<div class="row">
      						{{ Form::open(['data-update','method' => 'PUT', 'id' => 'update-assessment-item', 'class' => 'form-horizontal form-update-assessment-item']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-4 col-md-4">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addAssessmentItem-name" class="error-message"></div>
									</div>
								</div>
						</div>
					</div>
				</div>	
      		</div>
    		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						{{ Form::submit('Save Assessment Item', array('id' => 'btn-update-speaker', 'class' => 'btn btn-primary')) }}
      						{{ Form::close() }}
      		</div>
    	</div>
	</div>
</div>
@stop