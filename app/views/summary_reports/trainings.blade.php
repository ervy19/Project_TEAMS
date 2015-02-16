@extends('layouts.index')

@section('title')
	Summary Report - Trainings
@stop

@section('breadcrumb')
	<li>Summary Report - Trainings</li>
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
			<li role="presentation" class="active"><a>Trainings</a></li>
			<li role="presentation"><a href="{{ URL::to('summary_report/skills_competencies') }}">Skills and Competencies</a></li>
		</ul>
        <div id="container" style="min-width: 310px; max-width: 1000px; height: 125px; margin: 0 auto"></div>
	</div>
</div>

<div class="col-sm-12 col-md-12 training-data">
    <div class="row panel">
        <h2 class="header-panel">Internal Trainings</h2>
        <div class="row sc-stats it-summary">
                <div class="col-sm-3 col-md-3">
                    <div class="dashboard-stat">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                {{ $trainingsCount }}
                            </div>
                            <div class="desc">
                                 Internal Trainings
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
                                10
                            </div>
                            <div class="desc">
                                 Average PTA Completion
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="dashboard-stat">
                        <div class="visual">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                10
                            </div>
                            <div class="desc">
                                 Average Participant Attendees
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
                                10
                            </div>
                            <div class="desc">
                                 Average PTE Completion
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="col-sm-12 col-md-12 training-data">
    <div class="row panel et-summary">
        <h2 class="header-panel">External Trainings</h2>
    </div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {

            stackedBar();

            function stackedBar()
            {
                $('#container').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        categories: ['Trainings'],
                        labels: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        allowDecimals: false,
                        min: 0,
                        title: {
                            text: null
                        }
                    },
                    legend: {
                        reversed: true
                    },
                    plotOptions: {
                        series: {
                            stacking: 'normal'
                        }
                    },
                    series: [{
                        name: 'Internal Trainings',
                        data: [{{$itCount}}]
                    }, {
                        name: 'External Trainings',
                        data: [{{$etCount}}]
                    }],
                    credits: {
                        enabled: false 
                    }
                });
            }

		});
	</script>
@stop