@extends('layouts.index')

@section('title')
	Edit Department Information
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Department Information</h1>

			<a href="{{ URL::to('departments') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($departments, array('route' => array('departments.update', $departments->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('name','Department Name: ') }}
					{{ Form::text('name') }}
				</div>

				{{ Form::submit('Edit Department') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop