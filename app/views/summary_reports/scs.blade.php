@extends('layouts.index')

@section('title')
	Summary Report - Skills and Competencies
@stop

@section('breadcrumb')
	<li>Summary Report - Skills and Competencies</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h1 class="panel-header">Summary Reports</h1>
		</div>
	</div>
</div>


<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
		<ul class="nav nav-tabs nav-justified">
			<li role="presentation"><a href="{{ URL::to('summary_report/trainings') }}">Trainings</a></li>
			<li role="presentation" class="active"><a>Skills and Competencies</a></li>
		</ul>
		<br>
		<div class="col-sm-12 col-md-12">
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<h4 class="filter-label">Filter by:&nbsp;&nbsp;</h4>
					{{ Form::select('sc-filter', ['Select Filter','Skill/Competency','Department','Position'], null, array('id' => 'dd-sc-filter', 'class' => 'form-control')) }}
				</div>
				<div class="col-sm-9 col-md-9">
					{{ Form::select('sc-filter-options', [], null, array('id' => 'dd-sc-options', 'class' => 'form-control')) }}
				</div>
			</div>
		</div>
		<br><br><br>
	</div>
</div>
<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
		<div class="row sc-stats">
			<div class="col-sm-3 col-md-3">
				<div class="dashboard-stat">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							 {{ $sc_count }}
						</div>
						<div class="desc">
							 Skills and Competencies
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="dashboard-stat">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							 {{ $sctraining }}
						</div>
						<div class="desc">
							 Average SCs per Training
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="dashboard-stat">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							 {{ $scdepartment }}
						</div>
						<div class="desc">
							 Average SCs per Department
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="dashboard-stat">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							 {{ $scposition }}
						</div>
						<div class="desc">
							 Average SCs per Position
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="sc" style="min-width: 310px; max-width:800px; margin: 0 auto"></div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {

		$("#dd-sc-options").select2({
		    allowClear: true
		});

		$('#dd-sc-filter').change(function(){
		       var id = $(this).val();
		       if(id==0)
		       {
		       		$('#dd-sc-options').empty();
		       }
		       else if(id==1)
		       {
		       		$('#dd-sc-options').empty();
		       		$.get('{{ URL::to('') }}/skills_competencies', function(data){
			           $.each(data.data, function(element, index){
			               $('#dd-sc-options').append('<option value="'+index.id+'">'+index.name+'</option>')
			           });
			      	}, 'json');
		       }
		       else if(id==2) 
		       {
		       		$('#dd-sc-options').empty();
		       		$.get('{{ URL::to('') }}/departments', function(data){
			           $.each(data.data, function(element, index){
			               $('#dd-sc-options').append('<option value="'+index.id+'">'+index.name+'</option>')
			           });
			      	}, 'json');
		       }
		       else if(id==3)
		       {
		       		$('#dd-sc-options').empty();
		       		$.get('{{ URL::to('') }}/positions', function(data){
			           $.each(data.data, function(element, index){
			               $('#dd-sc-options').append('<option value="'+index.id+'">'+index.title+'</option>')
			           });
			      	}, 'json');
		       }
		});

		$('#dd-sc-options').change(function(){
			var filter_id = $('#dd-sc-filter').val();
			var id = $(this).val();

			var name = [];
			var trainings = []; 
			var addressedNeeds = [];
			var unaddressedNeeds = [];

			if(filter_id==1)
			{
				$.get('{{ URL::to('') }}/skills_competencies/'+id, function(data){
					if(data.success)
					{
						name.push(data.data.name);
						trainings.push(data.data.internaltrainings_tagged+data.data.externaltrainings_tagged);
						addressedNeeds.push(1);
			          	unaddressedNeeds.push(3);
						chart(name,trainings,addressedNeeds,unaddressedNeeds);
					}
				},'json');
			}
			else if(filter_id==2)
			{
				$.get('{{ URL::to('') }}/departments/'+id+'/needed-skills-competencies', function(data){
					if(data.success)
					{
						$.each(data.data, function(element, index){
			            	name.push(index.name);
			            	trainings.push(index.internaltrainings_tagged+index.externaltrainings_tagged)
			          		addressedNeeds.push(1);
			          		unaddressedNeeds.push(3);
			          	});
			          	chart(name,trainings,addressedNeeds,unaddressedNeeds);
					}
				},'json');
			}
			else if(filter_id==3)
			{
				$.get('{{ URL::to('') }}/positions/'+id+'/needed-skills-competencies', function(data){
					if(data.success)
					{
						$.each(data.data, function(element, index){
			            	name.push(index.name);
			            	trainings.push(index.internaltrainings_tagged+index.externaltrainings_tagged)
			          		addressedNeeds.push(14);
			          		unaddressedNeeds.push(9);
			          	});
			          	chart(name,trainings,addressedNeeds,unaddressedNeeds);
					}
				},'json');
			}
		});

		function chart(name, trainings, addressedNeeds, unaddressedNeeds)
		{
			$('#sc').highcharts({
			    chart: {
			        type: 'bar'
			    },
			    title: {
			        text: null
			    },
			    xAxis: {
			        categories: name,
				    title: {
					    text: null
				    }
				},
				yAxis: {
					allowDecimals: false,
					min: 0,
				    title: {
					    text: 'Number of Trainings',
					    align: 'high'
					},
					labels: {
						overflow: 'justify'
					}
				},
				pointRange: 1,
				plotOptions: {
					bar: {
				    	dataLabels: {
				        	enabled: true
				        }
				    }
				},
				legend: {
					layout: 'vertical',
				    align: 'right',
				    verticalAlign: 'top',
				    x: 0,
				    y: 0,
				    floating: true,
				    borderWidth: 1,
				    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				    shadow: true
				},
				credits: {
					enabled: false 
				},
				series: [
					{
						name: 'Unaddressed Needs',
					    data: unaddressedNeeds
					},
				    {
				    	name: 'Addressed Needs',
				        data: addressedNeeds
				    }, 
				    {
				        name: 'Trainings',
				        data: trainings
				   	}
				]
			});	
		}
});
	</script>
@stop