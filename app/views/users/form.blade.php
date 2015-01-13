@extends('layouts.index')

@section('title')
	Import File
@stop

@section('content')
	{{ Form::open(array('url' => 'test', 'files' => 'true')) }}

		{{ Form::label('Upload here') }}
		{{ Form::file('file') }}

		{{ Form::submit('Upload') }}

	{{ Form::close() }}
@stop