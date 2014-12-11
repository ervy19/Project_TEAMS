@extends('layouts.index')

@section('title')
	Edit Position Information
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

			<h1>Edit Position Information</h1>

			<a href="{{ URL::to('positions') }}" class="btn btn-primary">Back</a>

			<!-- if there are creation errors, they will show here -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::model($positions, array('route' => array('positions.update', $positions->id), 'method' => 'PUT')) }}

				<div class="form-group">
					{{ Form::label('title','Position Name: ') }}
					{{ Form::text('title') }}
				</div>

				{{ Form::submit('Edit Position') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop