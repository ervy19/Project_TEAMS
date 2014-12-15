@extends('layouts.index')

@section('title')
	Edit Campus Information
@stop

@section('breadcrumb')
	<li>Edit Campus</li>
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

		<h1>Edit Campus Information</h1>

		<a href="{{ URL::to('campuses') }}" class="btn btn-primary">Back</a>

		<!-- if there are creation errors, they will show here -->
		{{ HTML::ul($errors->all()) }}

		{{ Form::model($campuses, array('route' => array('campuses.update', $campuses->id), 'method' => 'PUT')) }}

			<div class="form-group">
				{{ Form::label('title','Campus Name: ') }}
					{{ Form::text('title') }}
			</div>

			<div class="form-group">
				{{ Form::label('address','Address: ') }}
					{{ Form::text('address') }}
			</div>

			{{ Form::submit('Edit Campus') }}

		{{ Form::close() }}

		</div>
	</div>
</div>

@stop