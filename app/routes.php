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
	return View::make('login');
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

Route::get('external_trainings/pending-approval', array('as' => 'external_trainings.pending-approval', 'uses' => 'ExternalTrainingsController@indexQueue'));

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






Route::get('training_assessments/accomplish-pta', array('as' => 'accomplish-pta', function()
{
	return View::make('training_assessments.accomplish-pta');
}));

Route::get('training_assessments/accomplish-pte', array('as' => 'accomplish-pta', function()
{
	return View::make('training_assessments.accomplish-pte');
}));

Route::get('training_assessments/show-pta', array('as' => 'show-pta', function()
{
	return View::make('training_assessments.show-pta');
}));

Route::get('training_assessments/show-pte', array('as' => 'show-pte', function()
{
	return View::make('training_assessments.show-pte');
}));






Route::get('submit-external-training', array('as' => 'external_trainings.createQueue', 'uses' => 'ExternalTrainingsController@createQueue'));

Route::post('submit-external-training', array('as' => 'external_trainings.storeQueue', 'uses' => 'ExternalTrainingsController@storeQueue'));

Route::get('confirm-external-training', array('as' => 'external_trainings_queue.confirm', function()
{
	return View::make('confirm-external-training');
}));

Route::get('success-external-training', array('as' => 'external_trainings_queue.success', function()
{
	return View::make('success-external-training');
}));

Route::get('external_trainings/{external_trainings}/credit-external-training', array('as' => 'external_trainings.getQueue', 'uses' => 'ExternalTrainingsController@getQueue'));

Route::put('external_trainings/{external_trainings}', array('as' => 'external_trainings.credit', 'uses' => 'ExternalTrainingsController@creditQueue'));