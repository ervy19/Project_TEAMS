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
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-12 training-data individual-training-summary">
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

<div class="col-sm-12 col-md-12 training-data individual-training-summary">
    <div class="panel">
	   <div class="row">
            <div class="employee-details">
                <h5 class="has-designation">Trainings</h5>
            </div>
    		<div class="row sc-stats">
                <div class="col-sm-3 col-md-3">
                        <div class="dashboard-stat">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                     {{ $etCount }}
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
                                     {{ $itCount }}
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
                                     @if(isset($averagePTA))
                                        {{ round($averagePTA->average_score,2)}}
                                    @else
                                        0
                                    @endif
                                    &nbsp;/&nbsp;<span class="over">5.0</span>
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
                                    @if(isset($averagePTE))
                                        {{ round($averagePTE->average_score,2)}}
                                    @else
                                        0
                                    @endif
                                    &nbsp;/&nbsp;<span class="over">5.0</span>
                                </div>
                                <div class="desc">
                                     Average PTE Rating
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="row">

                    <table id="tb-trainings-scs" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Skills Competencies Addressed</th>
                                <th>Training Requirements</th>
                                <th>Action</th>
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
    </div>
</div>



@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {
            var x;
            var table = $('#tb-trainings-scs').dataTable({
                "ajax": "{{ URL::to('employees') }}/{{ $employee->id }}/individual-training-data",
                "columns": [
                    { "data": "training_title"},
                    { "data": "training_type" },
                    { "data": "training_scs",
                        "render": function ( data, type, full, meta ) {
                            var scs = '';
                            if(data)
                            {
                                $.each(data, function(element, index){
                                    scs += '<span class="tags label label-primary">'+index.name+'</span>';
                                });
                            }
                            else
                            {
                                scs += 'No skills/competencies tagged'
                            }
                            

                            return scs;
                        }
                    },
                    { "data": "requirement_statuses",
                      "render": function ( data, type, row, meta ) {
                        if(data)
                        {
                            var status = '';
                            if(row.training_type === "Internal")
                            {
                                if(data[0])
                                {
                                    status += '<span class="label label-success">Has PTA</span>&nbsp;';
                                }
                                else
                                {
                                    status += '<span class="label label-danger">No PTA Yet</span>&nbsp;';
                                }

                                if(data[1])
                                {
                                    status += '<span class="label label-success">Has Attended</span>&nbsp;';
                                }
                                else
                                {
                                    status += '<span class="label label-danger">Has Not Attended</span>&nbsp;';
                                }

                                if(data[2])
                                {
                                    status += '<span class="label label-success">Has PTE</span>';
                                }
                                else
                                {
                                    status += '<span class="label label-danger">No PTE Yet</span>';
                                }
                            }
                            else
                            {
                                status += '<span class="label label-success">Credited</span>';
                            }

                            return status;
                        }
                        else
                        {
                            return '';
                        }
                      } 
                    },
                    { 
                        "data": "training_id",
                        "render": function ( data, type, row, meta ) {
                            if(row.training_type === "Internal")
                            {
                                return '<a href="{{ URL::to("internal_trainings") }}/'+data+'" class="btn btn-primary"><i class="fa fa-file-text-o"></i>&nbsp;View</button>';
                            }
                            else
                            {
                                return '<a href="{{ URL::to("external_trainings") }}/'+data+'" class="btn btn-primary"><i class="fa fa-file-text-o"></i>&nbsp;View</button>';
                            }
                        }
                    }
                ],
                  "aoColumnDefs": [
                  { "sWidth": "30%", "aTargets": [ 0 ] },
                  { "sWidth": '5%', "aTargets": [ 1 ] },
                  { "sWidth": '40%', "aTargets": [ 2 ] },
                  { "sWidth": '20%', "aTargets": [ 3 ] },
                  { "sWidth": '5%', "aTargets": [ 4 ] }
                ]
            });
		});
	</script>
@stop