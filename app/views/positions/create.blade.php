@extends('layouts.index')

@section('title')
	Add Position
<<<<<<< HEAD
=======
@stop

@section('page_css')
	{{ HTML::style('assets/css/select2.css'); }}

	{{ HTML::style('assets/css/multi-select.css'); }}
>>>>>>> origin/master
@stop

@section('content')

	<h1>Add Position Information</h1>

	<a href="{{ URL::to('positions') }}" class="btn btn-primary">Back</a>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'positions')) }}

		<div class="form-group">
				{{ Form::label('title','Position Name: ') }}
			{{ Form::text('title') }}
		</div>

		{{ Form::submit('Add Position') }}

	{{ Form::close() }}

@stop

@section('page_js')
	{{ HTML::script('assets/js/select2.min.js'); }}

	{{ HTML::script('assets/js/jquery.multi-select.js'); }}

	<script>

	</script>
@stop
