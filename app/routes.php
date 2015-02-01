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
	return View::make('landing');
});

Route::get('login', function()
{
	return View::make('login');
});

/*
|--------------------------------------------------------------------------
| Confide Routes
|--------------------------------------------------------------------------
|
| Different application routes for Confide
|
*/

Route::get('users/create', 'UsersController@create');
Route::get('users', 'UsersController@index');
Route::post('users', 'UsersController@store');
Route::get('login', 'UsersController@login');
Route::post('login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('login/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('logout', 'UsersController@logout');

	Route::get('internal_trainings/{internal_trainings}/speakers/{speaker}/edit', array('as' => 'internal_trainings.speakers', 'uses' => 'SpeakersController@edit'));

	Route::post('internal_trainings/{internal_trainings}/speakers/store', array('as' => 'speakers.store', 'uses' => 'SpeakersController@store'));

	Route::put('internal_trainings/{internal_trainings}/speakers/{speaker}', array('as' => 'speakers.update', 'uses' => 'SpeakersController@update'));

	Route::patch('internal_trainings/{internal_trainings}/speakers/{speaker}', array('uses' => 'SpeakersController@update'));

	Route::delete('internal_trainings/{internal_trainings}/speakers/{speaker}', array('uses' => 'SpeakersController@destroy'));

	Route::get('internal_trainings/{internal_trainings}/participants', array('as' => 'internal_trainings.participants', 'uses' => 'InternalTrainingsController@showParticipants'));

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Different application routes that requires user authentication
|
*/

Route::group(array('before' => 'auth'), function()
{

	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

	/*
	|--------------------------------------------------------------------------
	| Internal Training Routes
	|--------------------------------------------------------------------------
	|
	| Different application routes for Internal Training components
	|
	*/

	Route::get('internal_trainings/{internal_trainings}/speakers', array('as' => 'internal_trainings.speakers', 'uses' => 'SpeakersController@index'));
	Route::get('internal_trainings/{internal_trainings}/participants', array('as' => 'internal_trainings.participants', 'uses' => 'InternalTrainingsController@showParticipants'));
	
	Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));
	Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation/{intent}', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));
	Route::post('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'after_activity_eval.store', 'uses' => 'InternalTrainingsController@storeEval'));


	Route::get('internal_trainings/{internal_trainings}/training-effectiveness-report', array('as' => 'internal_trainings.training-effectiveness-report', 'uses' => 'InternalTrainingsController@showTrainingEffectivenessReport'));


	Route::get('internal_trainings/{id}/{type}/accomplish', array('as' => 'training_assessment.accomplish', 'uses' => 'TrainingAssessmentsController@accomplish'));

	Route::post('internal_trainings/{internal_trainings}', array('as' => 'internal_trainings.store-report', 'uses' => 'InternalTrainingsController@storeReport'));

	Route::get('internal_trainings/{id}/{type}/show/{participant_id}', array('as' => 'training_assessment.show', 'uses' => 'TrainingAssessmentsController@showAccomplished'));

	Route::get('internal_trainings/{id}/{type}/accomplish/{participant_id}', array('as' => 'training_assessment.accomplish', 'uses' => 'TrainingAssessmentsController@accomplish'));

	Route::post('internal_trainings/{training_id}/{type}/{participant_id}', array('as' => 'training_response.store', 'uses' => 'TrainingResponsesController@store'));

	Route::get('external_trainings/queue', array('as' => 'external_trainings.queue', 'uses' => 'ExternalTrainingsController@indexQueue'));


	Route::get('training_plan', array('as' => 'training_plan', function()
	{
		return View::make('training_plan.index');
	}));

	//Route::get('internal_trainings/{id}/participants/import', array('as' => 'uploads.create', 'uses' => 'UploadsController@create'));
	//Route::post('internal_trainings/{id}/participants/import', array('as' => 'uploads.store', 'uses' => 'UploadsController@store'));


	Route::resource('employees','EmployeesController');

	Route::resource('campuses','CampusesController');

	Route::resource('departments','DepartmentsController');

	Route::resource('positions','PositionsController');

	Route::resource('ranks','RanksController');

	Route::resource('schools_colleges','SchoolsCollegesController');

	Route::resource('internal_trainings','InternalTrainingsController');

	Route::resource('external_trainings','ExternalTrainingsController');

	Route::resource('skills_competencies','SkillsCompetenciesController');

	Route::resource('uploads','UploadsController');


//Route::resource('speakers','SpeakersController');


	Route::post('upload',array('as'=>'upload', 'before'=>'auth','uses'=>'UploadController@index'));


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

});

/*
|--------------------------------------------------------------------------
| External Training Submission Routes (PUBLIC)
|--------------------------------------------------------------------------
|
| Different application routes for Submission of External Trainings
|
*/

Route::get('submit-external-training', array('as' => 'external_trainings.createQueue', 'uses' => 'ExternalTrainingsController@createQueue'));

Route::post('submit-external-training', array('as' => 'external_trainings.storeQueue', 'uses' => 'ExternalTrainingsController@storeQueue'));

Route::get('confirm-external-training', array('as' => 'external_trainings_queue.confirm', function()
{
	return View::make('confirm-external-training');
}));

Route::get('external_trainings/{external_trainings}/credit-external-training', array('as' => 'external_trainings.getQueue', 'uses' => 'ExternalTrainingsController@getQueue'));

Route::put('external_trainings/{external_trainings}', array('as' => 'external_trainings.credit', 'uses' => 'ExternalTrainingsController@creditQueue'));


Route::get('success-external-training', array('as' => 'external_trainings_queue.success', function()
{
	return View::make('success-external-training');
}));

Route::get('{encrypted_internal_training_id}', 'ITAttendanceController@index');

Route::post('{encrypted_internal_training_id}/attendance/{employee_number}', 'ITAttendanceController@store');