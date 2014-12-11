@extends('layouts.index')

@section('title')
	Add School/College
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="row panel">

		<h1>Add School/College Information</h1>

		<a href="{{ URL::to('schools_colleges') }}" class="btn btn-primary">Back</a>

		<!-- if there are creation errors, they will show here -->
		{{ HTML::ul($errors->all()) }}

		{{ Form::open(array('url' => 'schools_colleges')) }}

			<div class="form-group">
					{{ Form::label('name','School/College Name: ') }}
					{{ Form::text('name') }}
			</div>

			{{ Form::submit('Add School/Colleges') }}

		{{ Form::close() }}

	</div>
</div>

@stop