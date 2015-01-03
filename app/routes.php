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

Route::get('{type}/accomplish', array('as' => 'training_assessment.accomplish', function()
{
	return View::make('training_assessments/accomplish');
}));



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




/*
|--------------------------------------------------------------------------
| Confide Routes
|--------------------------------------------------------------------------
|
| Different application routes for Confide
|
*/
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


/*
|--------------------------------------------------------------------------
| Training Assessment Routes
|--------------------------------------------------------------------------
|
| Different application routes for Training Assessments (PTA and PTE)
|
*/
Route::get('{type}/create', array('as' => 'training_assessment.create', 'uses' => 'TrainingAssessmentsController@create'));

Route::post('{type}', array('as' => 'training_assessment.store', 'uses' => 'TrainingAssessmentsController@store'));

Route::get('{type}/{training_assessment}', array('as' => 'training_assessment.show', 'uses' => 'TrainingAssessmentsController@show'));

Route::get('{type}/{training_assessment}/edit', array('as' => 'training_assessment.edit', 'uses' => 'TrainingAssessmentsController@edit'));

Route::put('{type}/{training_assessment}', array('as' => 'training_assessment.update', 'uses' => 'TrainingAssessmentsController@update'));
Route::patch('{type}/{training_assessment}', array('uses' => 'TrainingAssessmentsController@update'));

Route::delete('{type}/{training_assessment}', array('as' => 'training_assessment.destroy', 'uses' => 'TrainingAssessmentsController@destroy'));




/*
|--------------------------------------------------------------------------
| External Training Routes
|--------------------------------------------------------------------------
|
| Different application routes for External Trainings
|
*/

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