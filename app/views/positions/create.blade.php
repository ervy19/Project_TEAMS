@extends('layouts.index')

@section('title')
	Add Position
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">

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
			      @foreach(SkillsCompetencies::all() as $key => $value)
			        <option> {{ $value->name }} </option>
			      @endforeach
			      </select>
			    </div>
			    
				{{ Form::submit('Add Position') }}

			{{ Form::close() }}

		</div>
	</div>
</div>

@stop

@section('page_js')
	<script type="text/javascript">
		$("#skills_competencies").select2();
	</script>
@stop