@extends('layouts.index')

@section('title')
	{{  $employee->full_name }} - Individual Training Report
@stop

@section('breadcrumb')
    <li><a href="{{ URL::to('employees') }}">Employees</a></li>
    <li><a href="{{ URL::to('employees') }}/{{ $employee->id }}">{{  $employee->full_name }}</a></li>
    <li>Individual Training Summary Report</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
    <div class="row panel">
        <div class="col-sm-12 col-md-12">
        <h1>Individual Training Summary Report</h1>
        <h4>{{  $employee->employee_number }}</h4>
        <h2>{{  $employee->full_name }}</h2>
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <h4 class="filter-label">Filter by:&nbsp;&nbsp;</h4>
                    {{ Form::select('sc-filter', ['Select Filter','Skills/Competencies','Trainings'], null, array('id' => 'dd-sc-filter', 'class' => 'form-control')) }}
                </div>
                <div class="col-sm-9 col-md-9">
                    {{ Form::select('sc-filter-options', [], null, array('id' => 'dd-sc-options', 'class' => 'form-control')) }}
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-12 training-data">
    <div class="row panel">
        <div class="employee-details">
            <h5 class="has-designation">Needed Skills and Competencies</h5>
        @if($employee->designations)
            <div class="tags">
            @foreach($employee->designations as $key => $value)
                @foreach($value->department_scs as $k => $v)
                    <h3><span class="label label-default">{{ $v->name }}</span></h3>
                @endforeach
                @foreach($value->position_scs as $k => $v)
                    <h3><span class="label label-default">{{ $v->name }}</span></h3>
                @endforeach
            @endforeach
            </div>
        @else
            <h5 class="no-designation">No skills/competencies tagged to this employee.</h5>
        @endif
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-12 training-data">
	<div class="row panel">
        <div class="employee-details">
            <h5 class="has-designation">Trainings</h5>
        </div>
        <br>
		<div class="row sc-stats">
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
                                 External Trainings Attended
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
                                 Internal Trainings Attended
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
                                 Average PTA Rating
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
                                 Average PTE Rating
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {


		});
	</script>
@stop