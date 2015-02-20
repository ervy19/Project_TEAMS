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
       <br>
       <div id="trainingcount-barchart" style="min-width: 310px; max-width: 1000px; height: 125px; margin: 0 auto"></div>
       <br>
       <div class="col-sm-8 col-md-8">
           <div id="trainingcount-linechart" style="min-width: 310px; margin: 0 auto"></div>
        </div>
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
                    <div class="dashboard-stat">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                10
                            </div>
                            <div class="desc">
                                 Average PTA Compliance
                            </div>
                        </div>
                    </div>
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
                    <div class="dashboard-stat">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                10
                            </div>
                            <div class="desc">
                                 Average PTE Compliance
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-md-9">
                    <div id="internaltraining-percentageareachart" style="min-width: 310px; margin: 0 auto"></div>
                </div>
            </div>
    </div>
</div>

<div class="col-sm-12 col-md-12 training-data">
    <div class="row panel">
        <h2 class="header-panel">External Trainings</h2>
        <div class="row sc-stats it-summary">
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
                                 Credited External Trainings
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-stat">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                10
                            </div>
                            <div class="desc">
                                 External Trainings in Queue
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-md-9">
                    <div id="externaltraining-stackedchart" style="min-width: 310px; margin: 0 auto"></div>
                </div>
            </div>
    </div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {

            stackedBar('#trainingcount-barchart');

            lineChart('#trainingcount-linechart');

            percentageAreaChart('#internaltraining-percentageareachart')

            stackedChart('#externaltraining-stackedchart');

            function stackedBar(element)
            {
                $(element).highcharts({
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

            function lineChart(element)
            {
                var thisYear = new Date().getFullYear();
                var nextYear = thisYear + 1;

                $(element).highcharts({
                    title: {
                        text: null
                    },
                    xAxis: {
                        categories: ['Apr ' + thisYear, 'May ' + thisYear, 'Jun ' + thisYear, 'Jul ' + thisYear, 
                        'Aug ' + thisYear, 'Sep ' + thisYear, 'Oct ' + thisYear, 'Nov ' + thisYear, 'Dec ' + thisYear, 'Jan '+ nextYear, 'Feb ' + nextYear, 'Mar ' + nextYear]
                    },
                    yAxis: {
                        title: {
                            text: 'Number of Trainings'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Internal Trainings',
                        data: [10,15,26,23,27,12,21,19,10,5,2,1]
                    }, {
                        name: 'External Trainings',
                        data: [5,3,10,16,32,22,17,16,12,21,18,19]
                    }]
                });
            }

            function percentageAreaChart(element)
            {
                $(element).highcharts({
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        tickmarkPlacement: 'on',
                        title: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Percentage'
                        }
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f})<br/>',
                        shared: true
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        area: {
                            stacking: 'percent',
                            lineColor: '#ffffff',
                            lineWidth: 1,
                            marker: {
                                lineWidth: 1,
                                lineColor: '#ffffff'
                            }
                        }
                    },
                    series: [{
                        name: 'With PTA but without attendance',
                        data: [10,15,26,23,27,12,21,19,10,5,2,1]
                    }, {
                        name: 'Attended and with PTA only',
                        data: [5,3,10,16,32,22,17,16,12,21,18,19]
                    }, {
                        name: 'Attended only',
                        data: [10,15,26,23,32,22,17,16,22,17,16,12]
                    }, {
                        name: 'Attended and has both PTA and PTE',
                        data: [10,15,26,23,27,12,17,16,12,21,18,19]
                    }]
                });
            }

            function stackedChart(element)
            {
                $(element).highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yAxis: [{
                        min: 0,
                        title: {
                            text: 'External Trainings'
                        }
                    }],
                    legend: {
                        shadow: false
                    },
                    tooltip: {
                        shared: true
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        column: {
                            grouping: false,
                            shadow: false,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Credited',
                        color: 'rgba(165,170,217,1)',
                        data: [10,15,26,23,27,12,21,19,10,5,2,1],
                        pointPadding: 0.3,
                        pointPlacement: -0.2
                    }, {
                        name: 'In Queue',
                        color: 'rgba(126,86,134,.9)',
                        data: [5,3,10,16,32,22,17,16,12,21,18,19],
                        pointPadding: 0.4,
                        pointPlacement: -0.2
                    }]
                });
            }
		});
	</script>
@stop