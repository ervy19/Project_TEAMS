<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('dashboard');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Role Filter
|--------------------------------------------------------------------------
|
| The role filter limits access to certain views wherein only users which
| have the assigned role/s needed for access is allowed to proceed 
|
*/

Entrust::routeNeedsRole( 'users*', array('Admin'), Redirect::to('dashboard') );

Entrust::routeNeedsRole( 'campuses*', array('Admin','HR Admin'), Redirect::to('dashboard'), false );

Entrust::routeNeedsRole( 'schools_colleges*', array('Admin','HR Admin'), Redirect::to('dashboard'), false );

Entrust::routeNeedsRole( 'departments*', array('Admin','HR Admin'), Redirect::to('dashboard'), false );

Entrust::routeNeedsRole( 'positions*', array('Admin','HR Admin'), Redirect::to('dashboard'), false );

Entrust::routeNeedsRole( 'ranks*', array('Admin','HR Admin'), Redirect::to('dashboard'), false );

Entrust::routeNeedsRole( 'skills_competencies*', array('Admin','HR Admin'), Redirect::to('dashboard'), false );




Route::filter('update-user-account', function($route)
{
	if(!(Auth::user()->id == $route->getParameter('user_id')))
	{
		return Redirect::to('dashboard');
	}
});

Route::filter('accomplish-ta', function($route)
{
	$supervisor = Supervisor::where('user_id','=',Auth::user()->id)->first();
	$it_participant =  IT_Participant::find($route->getParameter('participant_id'));

	$participant_designation = Employee_Designation::join('supervisors','employee_designations.supervisor_id','=','supervisors.id')
								->where('employee_designations.id','=',$it_participant->employee_designation_id)
								->where('employee_designations.isActive','=',true)
								->first();

	if($supervisor && $it_participant && $participant_designation)
	{
		if ($supervisor->id !== $participant_designation->supervisor_id)
		{
			return Redirect::to('dashboard');
		}
	}
	else
	{
		return Redirect::to('dashboard');
	}
});

Route::filter('show-accomplishedta', function($route)
{
	$supervisor = Supervisor::where('user_id','=',Auth::user()->id)->first();
	$it_participant =  IT_Participant::find($route->getParameter('participant_id'));

	$participant_designation = Employee_Designation::join('supervisors','employee_designations.supervisor_id','=','supervisors.id')
								->where('employee_designations.id','=',$it_participant->employee_designation_id)
								->where('employee_designations.isActive','=',true)
								->first();

	if($supervisor && $it_participant && $participant_designation)
	{
		if ($supervisor->id !== $participant_designation->supervisor_id)
		{
			return Redirect::to('dashboard');
		}
	}
	else
	{
		return Redirect::to('dashboard');
	}
});