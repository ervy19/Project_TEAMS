@extends('layouts.index')

@section('title')
	Import
@stop

@section('content')
	{{ Form::open(array('url'=>'uploads', 'files' => 'true')) }}
		{{ Form::label('Upload here') }}
		{{ Form::file('file') }}

		{{ Form::submit('Upload') }}
	{{ Form::close() }}
@stop