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
			<h1>Summary Reports</h1>
		</div>
	</div>
</div>


<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation"><a href="{{ URL::to('summary_report/trainings') }}">Trainings</a></li>
				<li role="presentation" class="active"><a>Skills and Competencies</a></li>
			</ul>
	</div>
</div>

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<br>
			<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
			<br><br>
			<table id="tb-skills_competencies" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Skill/Competency</th>
					<th>Departments Tagged</th>
					<th>Positions Tagged</th>
					<th>Internal Trainings Tagged</th>
					<th>External Trainings Tagged</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
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

		$('#container').highcharts({
			         chart: {
            type: 'bar'
        },
        title: {
            text: 'Skills and Competencies'
        },
        xAxis: {
            categories: ['IT Literacy','Leadership Engagement','Basic Statistics','Classroom Management','Laboratory Management'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Trainings',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
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
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Trainings Addressed',
            data: [36, 31, 25, 21, 10]
        }, {
            name: 'Employee Addressed',
            data: [13, 16, 27, 28, 34]
        }, {
            name: 'Employee Needs',
            data: [23, 14, 20, 32, 34]
        }]
			    });

			function getCategories()
			{
				$.ajax({
			        url: 'api/v1/dashboard/month_mention_graphic',
			        type: "GET",
			        dataType: "json",
			        data : {username : "demo"},
			        success: function(data) {
			            chart.addSeries({
			              name: "mentions",
			              data: data.month_mentions_graphic
			            });
			        },
			        cache: false
			    });
			}

		var table = $('#tb-skills_competencies').dataTable({
		        "ajax": "{{ URL::to('skills_competencies') }}",
		        "columns": [
		            { "data": "name" },
		            { "data": "departmentsTagged" },
		            { "data": "positionsTagged" },
		            { "data": "internalTrainingsTagged" },
		            { "data": "externalTrainingsTagged" },
		        ],
		          "aoColumnDefs": [
			      { "sWidth": "28%", "aTargets": [ 0 ] },
			      { "sWidth": '18%', "aTargets": [ 1 ] },
			      { "sWidth": '18%', "aTargets": [ 2 ] },
			      { "sWidth": '18%', "aTargets": [ 3 ] },
			      { "sWidth": '18%', "aTargets": [ 4 ] }
			    ]
			});

		});
	</script>
@stop