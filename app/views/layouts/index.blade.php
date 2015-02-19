<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>CEU HR TEAMS | @yield('title') </title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{ HTML::style('assets/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/css/font-awesome.min.css'); }}
    {{ HTML::style('assets/css/jquery.dataTables.min.css'); }}
    {{ HTML::style('assets/css/dataTables.bootstrap.css'); }}

    <!-- BEGIN SELECT2 CSS -->
    {{ HTML::style('assets/css/select2.css'); }}
    {{ HTML::style('assets/css/select2-bootstrap.css'); }}
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('page_css')

    <!-- BEGIN THEME STYLES -->
    {{ HTML::style('assets/css/general-style.css'); }}
    {{ HTML::style('assets/css/pages-style.css'); }}

  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{asset('assets/img/CEU_logo.jpg')}}" alt="logo" class="img-responsive"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav nav-title">
            <li><a>Human Resources TEAMS</a></li>
          </ul>       

          <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ URL::to('employees') }}">Employees</a></li>
            <li><a href="{{ URL::to('internal_trainings') }}">Trainings</a></li>
            <li><a href="{{ URL::to('training_plan') }}">Training Plan</a></li>
            <li><a href="{{ URL::to('summary_report/trainings') }}">Summary Reports</a></li>
          </ul>          

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="badge badge-default">{{ $notifications_count or '' }}</span><i class="fa fa-inbox fa-lg"></i>&nbsp;&nbsp;Notifications</a>
              <ul id="notifications" class="dropdown-menu scrollable-menu" role="menu">
                @if(isset($notifications))
                  @if(!$notifications->isEmpty())
                    @foreach($notifications as $key => $value)
                      <li>
                      @if($value->type == 'pta')
                        <a href="{{URL::to('internal_trainings')}}/{{$value->training_link}}/{{$value->type}}/accomplish/{{$value->participant_link}}">Accomplish PTA of {{ $value->employee_name }}</a>
                      @elseif($value->type == 'pte')
                        <a href="{{URL::to('internal_trainings')}}/{{$value->training_link}}/{{$value->type}}/{{$value->participant_link}}">Accomplish PTE of {{ $value->employee_name }}</a>
                      @elseif($value->type == 'et_queue')
                        <a href="#">{{ $value->employee_name }} has submitted an external training data</a>
                      @endif
                      </li>
                    @endforeach
                  @else
                    <li><a><center><b>You don't have new notifications</b></center></a></li>
                  @endif
                @else
                  <li><a><center><b>You don't have new notifications</b></center></a></li>
                @endif
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user fa-lg"></i>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a><i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;{{ $name or '---' }}</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-cog fa-lg"></i>&nbsp;&nbsp;Account Settings</a></li>
                <li><a href="{{ URL::to('logout') }}"><i class="fa fa-unlock-alt fa-lg"></i>&nbsp;&nbsp;Logout</a></li>
              </ul>
            </li>
          </ul>


        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container-fluid breadcrumb-header">
      <div class="row">
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          @yield('breadcrumb')
        </ol>
      </div>
    </div>
    
    <div class="container-fluid">

        @yield('content')

    </div>

    <footer class="footer">
      <div class="container-fluid">
        <p class="text-muted">© 2015 Centro Escolar University Human Resources | Training Evaluation and Monitoring System</p>
      </div>
    </footer>

    <!-- BEGIN CORE JS -->

    {{ HTML::script('assets/js/jquery.min.js'); }}

    {{ HTML::script('assets/js/bootstrap.min.js'); }}

    {{ HTML::script('assets/js/jquery.dataTables.min.js'); }}

    {{ HTML::script('assets/js/dataTables.bootstrap.js'); }}

    {{ HTML::script('assets/js/select2.min.js'); }}

    {{ HTML::script('assets/js/highcharts.js'); }}

    <!-- BEGIN PAGE-LEVEL JS -->
    <script>
      $("#skills_competencies").select2({
        placeholder: "Select a Skill/Competency"
        });
      $("#dd-positions-add").select2({
        placeholder: "HEHEHE"
      });

      $("#dd-positions-edit").select2({
        placeholder: "HEHEHE",
          allowClear: true
      });
      $("#skills_competencies_edit").select2();
      $("#skills_competencies_dept").select2();
      $("#skills_competencies_dept_edit").select2();
      $("#school_college").select2();
      $("#skills_competencies_it").select2();
      $("#schools_colleges").select2();
      $("#schoolorganizer").select2();
      $("#departmentorganizer").select2();
      $("#skills_competencies_itraining_edit").select2();
    </script>
    
    @yield('page_js')

  </body>
</html>