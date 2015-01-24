@extends('layouts.index')

@section('title')
	Add Pre-Training Assessment
@stop

@section('content')

<div class="col-sm-12 col-md-12">
	<div class="panel">
		<div class="row">
			<h2>{{ $header }}</h2>
		</div>
	</div>
	@if ($type === 'pta')
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">

				{{ HTML::ul($errors->all()) }}

				{{ Form::open(array('url' => 'pta', 'class' => 'form-horizontal')) }}

				      	<div class="form-group row">
							<div class="col-sm-12 col-md-12">
							{{ Form::label('training_id','Internal Training: ') }}
							</div>
							<!--
							{{ Form::select('internaltraining', $internaltrainings, 'Select a Training', array('class' => 'col-sm-6 col-md-6')) }}
							-->
							<select id="inttrainings" style="width: 300px">
								<option selected disabled>Select Training</option>
					      		@foreach($internaltrainings as $key => $value)
					        		<option> {{ $value }} </option>
					      		@endforeach
				      		</select>
				      		<input type="hidden" id="internaltraining" name='internaltraining'>
						</div>

						<div>
							<h5>Assessment items: </h5>
						</div>
						
					    <input type="button" value="Add Assessment Item" onClick="addInput('dynamicInput');" class="btn btn-primary">
					    <input type="hidden" id='count'>
					    <input type="hidden" id='items' name='items'>
					    <input type="hidden" id='assessment_items' name='assessment_items'>

					    <br>

					    <div class="form-group" id="dynamicInput">
				     		<br>
					    </div>

						<input type="submit" value="Create PTA" onClick="checkVal();" class="btn btn-primary">
				{{ Form::close() }}
			<br>
			</div>
		</div>
	</div>
	@elseif ($type === 'pte')
	<div class="panel">
		<div class="row">
			<div class="col-sm-12 col-md-12">

				{{ HTML::ul($errors->all()) }}

				{{ Form::open(array('url' => 'pte', 'class' => 'form-horizontal')) }}

				      	<div class="form-group row">
							<div class="col-sm-12 col-md-12">
							{{ Form::label('training_id','Internal Training: ') }}
							</div>
							<!--
							{{ Form::select('internaltraining', $internaltrainings, 'Select a Training', array('class' => 'col-sm-6 col-md-6')) }}
							-->
							<select id="inttrainings" style="width: 300px">
								<option selected disabled>Select Training</option>
					      		@foreach($internaltrainings as $key => $value)
					        		<option> {{ $value }} </option>
					      		@endforeach
				      		</select>
				      		<input type="hidden" id="internaltraining" name='internaltraining'>
						</div>


						<div>
							<h5>Assessment items: </h5>
						</div>
						
					    <input type="button" value="Add Assessment Item" onClick="addInput('dynamicInput');" class="btn btn-primary">
					    <input type="hidden" id='count'>
					    <input type="hidden" id='items' name='items'>
					    <input type="hidden" id='assessment_items' name='assessment_items'>

					    <br>

					    <div class="form-group" id="dynamicInput">
				     		<br>
					    </div>

						<input type="submit" value="Create PTE" onClick="checkVal();" class="btn btn-primary">
				{{ Form::close() }}
			<br>
			</div>
		</div>
	</div>
	@endif
</div>

@stop

@section('page_js')

	<script type="text/javascript">

	var count = 1;
		function addInput(divName){
			
		    var newdiv = document.createElement('div');
		    newdiv.innerHTML = "<input type='text' id='item" + count + "' " + "name='input[" + count + "]'>";

			document.getElementById(divName).appendChild(newdiv);
			document.getElementById('count').value = count;
			var box = "item" + count;
			document.getElementById('items').value = box;
			count++;    
		}
		function checkVal(){
			var content = new Array();
			var i;
		    for(i = 1; i < count; i++) {
		        var input = document.getElementById("item"+i).value;
				content.push(input);
			}
			document.getElementById('assessment_items').value = content;
		}

		$(document).ready(function() { $("#inttrainings").select2() });

        var intt = $('#inttrainings');
		$(intt).change(function() {
			var elemt = document.getElementById("internaltraining");
			elemt.value = $(intt).val();
		});	

	</script>
@stop