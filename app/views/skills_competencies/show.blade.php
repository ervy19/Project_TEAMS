@extends('layouts.index')

@section('title')
	Skills and Competencies Tags
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Skill or Competency</h1>
			{{	$scs->name	}}
		</div>
	</div>
</div>

@stop