@extends('layouts.index')

@section('title')
	- Account Settings
@stop

@section('breadcrumb')
    <li>Account Settings</li>
@stop

@section('content')
	    <div class="container-fluid">
		<div class="col-sm-12 col-md-12">
			<div class="panel">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="panel">

						<h2 class="panel-header">Account Settings</h2>
						{{ $error->all }}
						{{ Form::open(array('url' => 'users/reset_password', 'class' => 'form-horizontal')) }}

							<div class="form-group row">
								{{ Form::label('password','New Password: ') }}
								{{ Form::password('password', '', array( 'class' => 'form-control')) }}
								{{ $errors->first('password') }}
							</div>

							<div class="form-group row">
								{{ Form::label('password_confirmation','Confirm New Password: ') }}
								{{ Form::password('password_confirmation', '', array( 'class' => 'form-control')) }}
								{{ $errors->first('password_confirmation') }}
							</div>

							
							{{ Form::submit('Change Password', array('class' => 'btn btn-primary pull-right')) }}

						{{ Form::close() }}							


						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
@stop

@section('page_js')
	<script type="text/javascript">
		$(document).ready( function () {

		});
	</script>
@stop