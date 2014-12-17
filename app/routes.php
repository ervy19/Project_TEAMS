<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Different application routes of TEAMS
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('internal_trainings/{internal_trainings}/participants', array('as' => 'internal_trainings.participants', 'uses' => 'InternalTrainingsController@showParticipants'));

Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));

Route::get('internal_trainings/{internal_trainings}/training-effectiveness-report', array('as' => 'internal_trainings.training-effectiveness-report', 'uses' => 'InternalTrainingsController@showTrainingEffectivenessReport'));

Route::get('training_plan', array('as' => 'training_plan', function()
{
	return View::make('training_plan.index');
}));

Route::get('dashboard', array('as' => 'dashboard', function()
{
	return View::make('dashboard.index');
}));


Route::get('external_trainings/pending-approval', array('as' => 'external_trainings.pending-approval', 'uses' => 'ExternalTrainingsController@indexPending'));

Route::resource('employees','EmployeesController');

Route::resource('campuses','CampusesController');

Route::resource('departments','DepartmentsController');

Route::resource('positions','PositionsController');

Route::resource('schools_colleges','SchoolsCollegesController');

Route::resource('internal_trainings','InternalTrainingsController');

Route::resource('external_trainings','ExternalTrainingsController');

Route::resource('skills_competencies','SkillsCompetenciesController');

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');