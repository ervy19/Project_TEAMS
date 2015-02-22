@extends('layouts.index')

@section('title')
	Internal Training - {{ $internaltrainings->title or '---' }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('internal_trainings') }}">Internal Trainings</a></li>
	<li>{{$internaltrainings->title or '---'}}</li>
@stop

@section('content')

	@if($isAdminHR || $isOrganizer)
		<div class="col-sm-8 col-md-8 training-info">
	@else
		<div class="col-sm-12 col-md-12 training-info">
	@endif
		<div class="panel">
			<div class="row training-details">
				<h2 class="panel-header">{{  $internaltrainings->title or '---' }}</h2>
				<div class="col-sm-1 col-md-1">
					<h6>Theme: </h6>
					<h6>Organizer:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->theme_topic or '---' }}</h5>
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $organizer or '---' }}</h5>
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Venue:</h6>
					<h6>Schedule:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltrainings->venue or '---' }}
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						@foreach($schedArray as $value)
						<h5>{{ $value["date_scheduled"] . " (" . $value["timeslot"] . ") " }}</h5>
						@endforeach
				</div>

				<div class="col-sm-1 col-md-1">
					<h6>Format:</h6>
				</div>
				<div class="col-sm-11 col-md-11">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltraining->internal_training->format or '---' }}</h5>
				</div>

				<div class="col-sm-12 col-md-12">
					<h6>Objectives:</h6>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltraining->internal_training->objectives or '---'}}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Expected Outcome:</h6>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $internaltraining->internal_training->expected_outcome or '---'}}</p>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Focus Areas:</h6>
					<div class="tags">
					@if($focus_areas)
						@if($focus_areas->instructional_strategy)
							<h3><span class="label label-default">Instructional Strategy</span></h3>
						@endif
						@if($focus_areas->evaluation_of_learning)
							<h3><span class="label label-default">Evaluation of Learning</span></h3>
						@endif
						@if($focus_areas->curriculum_enrichment)
							<h3><span class="label label-default">Curriculum Enrichment</span></h3>
						@endif
						@if($focus_areas->research_aid_instruction)
							<h3><span class="label label-default">Research Aid Instruction</span></h3>
						@endif
						@if($focus_areas->content_update)
							<h3><span class="label label-default">Content Update</span></h3>
						@endif
						@if($focus_areas->materials_production)
							<h3><span class="label label-default">Materials Production</span></h3>
						@endif
						<h3><span class="label label-default">{{ $focus_areas->others }}</span></h3>
					@else
						<h3><span class="label label-default">No Focus Areas</span></h3>
					@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<h6>Skills and Competencies Addressed:</h6>
					@if($scs)
						@foreach($scs as $key => $value)
							<div class="tags">
								<a href="#"><h3><span class="label label-default">{{ $value->name }}</span></h3></a>
							</div>
						@endforeach
					@else
						<div class="tags">
							<a href="#"><h3><span class="label label-default">No Skills/Competencies Tagged</span></h3></a>
						</div>
					@endif
				</div>
				@if(!($isAdminHR || $isOrganizer))
				<div class="col-sm-12 col-md-12">
					<h6>Speakers:</h6>
						@if(!$hasSpeakers)
							<h5>--- No Speakers Registered ---</h5>
						@else
							<table id="tb-speakers" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Topic</th>
										<th>Educational Background</th>
										<th>Work Background</th>
									</tr>
								</thead>
								<tbody>
								@foreach($speakers as $key => $value)
									<tr>
										<td>{{ $value->name }}</td>
										<td>{{ $value->topic }}</td>
										<td>{{ $value->educational_background }}</td>
										<td>{{ $value->work_background }}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						@endif
				</div>
				@endif
			</div>
		</div>
	</div>
	@if($isAdminHR || $isOrganizer)
	<div class="col-sm-4 col-md-4 training-sidebar">
		<div class="row panel training-participants">
			<h3 class="panel-header">Participants</h3>
			<a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->training_id}}/participants" class="label label-primary view-participant pull-right">View</a>
			<div id="participant-summary" style="margin: 0 auto"></div>
		</div>
		<div class="row panel training-requirements">
			<h3 class="panel-header">Training Requirements</h3>
			<div class="col-sm-12 col-md-12 requirement">
				<h4 class="pull-left">Speakers</h4>
				<a href="{{ URL::to('internal_trainings') }}/{{$internaltrainings->training_id}}/speakers" class="label label-success pull-right">View Speakers</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<h4 class="pull-left">Items for Training Assessment</h4>
				<a id="btn-view-item" class="label label-success pull-right">View Items</a>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<h4 class="pull-left">After Activity Evaluation Report</h4>
				<span class="label label-danger status pull-right">Not Yet Available</span>
			</div>
			<div class="col-sm-12 col-md-12 requirement">
				<h4 class="pull-left">Training Effectiveness Report</h4>
				<span class="label label-danger status pull-right">Not Yet Available</span>
			</div>
		</div>
		@if($isAdminHR)
			<div class="row panel training-attendance">
				<div class="col-sm-12 col-md-12 content">
				@if($hasSpeakers)
					<a href="{{ URL::to('') }}/{{ $encrypted_training_id }}" target="_blank" class="btn btn-primary">Register Attendees</a>
				@else
					<p style="margin-bottom:-10px;"><b>Register speakers before you can record attendance</b></p>
				@endif
				</div>
			</div>
		@endif
	</div>

	<!-- Assessment Items Modal -->
	<div class="modal fade" id="assessmentItems" tabindex="-1" role="dialog" aria-labelledby="assessmentItemsLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="assessmentItemsLabel"><i class="fa fa-users fa-lg"></i>&nbsp;&nbsp;Items for Assessment</h4>
	      		</div>
	      		<div class="modal-header">
	      			<div class="container">
		      			<div class="col-sm-12 col-md-12">
		      				<div class="row">
		      					{{ Form::open(['data-add','id' => 'add-assessment-item', 'class' => 'form-horizontal']) }}
								<div class="form-group row">
									{{ Form::label('name','Name: ', array('class' => 'col-sm-1 col-md-1 control-label')) }}
									<div class="col-sm-3 col-md-3">
										{{ Form::text('name', '',array('class' => 'form-control')) }}
										<div id="error-addsc-name" class="error-message"></div>
									</div>
									<div class="col-sm-2 col-md-2">
									{{ Form::submit('Add Item', array('class' => 'btn btn-primary')) }}
									</div>
								</div>
      							{{ Form::close() }}
							</div>
						</div>
					</div>	
	      		</div>
	      		<div class="modal-body">
	      			<div class="container">
		      			<div class="col-sm-12 col-md-12">
		      				<div class="row">
		      					<div id="assessment-items-tags" class="tags"></div>
		      				</div>
		      			</div>
		      		</div>
		      	</div>
	    		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
		</div>
	</div>
	@endif
	
@stop

@section('page_js')
<script type="text/javascript">
			$(document).ready( function () {
@if($isAdminHR || $isOrganizer)
		

			    $('#participant-summary').highcharts({
			        chart: {
			        	marginTop: -50,
			        	marginBottom: 0,
			        	height: 300,
			            plotBackgroundColor: null,
			            plotBorderWidth: 0,
			            plotShadow: false
			        },
			        title: {
			            text: ''
			        },
			        credits: {
			        	enabled: false
			        },
			        tooltip: {
			            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			        },
			        plotOptions: {
			            pie: {
			                dataLabels: {
			                    enabled: false,
			                    distance: -50,
			                    style: {
			                        fontWeight: 'bold',
			                        color: 'white',
			                        textShadow: '0px 1px 2px black'
			                    }
			                },
			                startAngle: -90,
			                endAngle: 90,
			                center: ['50%', '75%']
			            }
			        },
			        series: [{
			            type: 'pie',
			            name: 'Participant Data',
			            innerSize: '50%',
			            data: [
			            	@if($hasParticipants)	
			            		['Not attended and without both PTA and PTE',   {{ $countNoReq }}],
			            		['With PTA only',   {{ $countPTAOnly }}],
				                ['Attended and with PTA',       {{ $countPTAttendance }}],
				                ['Attended only', {{ $countAttendedOnly }}],
				                ['Attended and with both PTA and PTE',    {{ $countComplete }}]
				            @else
				            	['No Participants', 100.0]
			            	@endif			                
			            ]
			        }]
			    });

				$('#btn-view-item').on('click', function() {
					var id = {{ $internaltrainings->id }}

					$('#assessment-items-tags').empty();

					$.get('{{ URL::to('') }}/internal_trainings/'+id+'/assessment-items', function(data){
						if(data.success)
						{
							$.each(data.data, function(element, index){
				            	$('#assessmentItems').find('.tags').append('<h3><span class="label label-default">'+index.name+'</span></h3>&nbsp;');
				          	});
						}
					},'json');

					$('#assessmentItems').modal('show');
				});	

				$('form[data-add]').on('submit', function (e) {

					e.preventDefault();

					var form = $(this);
					var method = form.find('input[name="method"]').val() || 'POST';
					var url = form.prop('action');

					$.ajax({
						type: method,
						url: url + '/assessment-items',
						data: form.serialize(),
						success: function(data) {
							if(data.success)
							{
								$('#assessmentItems').modal('hide');
								$.get('{{ URL::to('') }}/internal_trainings/'+id+'/assessment-items', function(data){
									if(data.success)
									{
										$('#assessmentItems').find('.tags').empty();
										$.each(data.data, function(element, index){
							            	$('#assessmentItems').find('.tags').append('<h3><span class="label label-default">'+index.name+'</span></h3>&nbsp;');
							          	});
									}
								},'json');
							}
							else
							{
								$('.error-message').empty();
								$('#error-addsc-name').append(data.errors.name);
							}
						}
					});
				});		    
@endif
		});
	</script>
@stop