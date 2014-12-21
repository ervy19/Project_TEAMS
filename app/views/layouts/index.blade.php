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
          <a class="navbar-brand" href="{{ URL::to('/') }}"><img src={{asset('assets/img/CEU_logo.jpg')}} alt="logo" class="img-responsive"></a>
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
            <li><a href="#">Reports</a></li>
          </ul>          

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="badge badge-default">2</span><i class="fa fa-inbox fa-lg"></i>&nbsp;&nbsp;Notifications</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Logout</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user fa-lg"></i>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Supervisor Name</a></li>
                <li class="divider"></li>
                <li><a href="#">Account Settings</a></li>
                <li><a href="#">Logout</a></li>
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
        <p class="text-muted">© 2014 Centro Escolar University Human Resources | Training Evaluation and Monitoring System</p>
      </div>
    </footer>

    <!-- BEGIN CORE JS -->

    {{ HTML::script('assets/js/jquery.min.js'); }}

    {{ HTML::script('assets/js/bootstrap.min.js'); }}

    {{ HTML::script('assets/js/jquery.dataTables.min.js'); }}

    {{ HTML::script('assets/js/dataTables.bootstrap.js'); }}

    {{ HTML::script('assets/js/select2.min.js'); }}

    <!-- BEGIN PAGE-LEVEL JS -->
    <script>
      $("#skills_competencies").select2({
        placeholder: "Select a Skill/Competency",
        });
    </script>
    <script>
      $("#skills_competencies_edit").select2();
      $("#skills_competencies_dept").select2();
      $("#skills_competencies_dept_edit").select2();
      $("#school_college").select2();
    </script>
    <script>
      $("#schools_colleges").select2();
    </script>
    <script>
      $("#schoolorganizer").select2();
    </script>
    <script>
      $("#departmentorganizer").select2();
    </script>
    
    @yield('page_js')

  </body>
</html>