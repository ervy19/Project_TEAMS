@extends('layouts.index')

@section('title')
	Add Internal Training
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Create User</h1>

				{{ Confide::makeSignupForm()->render(); }} 

		</div>
	</div>
</div>

@stop
