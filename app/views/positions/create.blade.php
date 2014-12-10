@extends('layouts.index')

@section('title')
	Add Position
@stop

@section('page_js')
  <script>
   $("#skills_competencies").select2();
  </script>
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

    <div>
      <select multiple id="skills_competencies" style="width: 300px">
      <optgroup label="Alaskan/Hawaiian Time Zone">
        <option value="AK">Alaska</option>
        <option value="HI">Hawaii</option>
      </optgroup>
      </select>
    </div>

		{{ Form::submit('Add Position') }}

	{{ Form::close() }}

@stop

