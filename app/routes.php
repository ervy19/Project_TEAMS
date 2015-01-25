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

Route::get('external_trainings/pending-approval', array(
	'as' => 'external_trainings.pending-approval', 
	'uses' => 'ExternalTrainingsController@indexQueue'
	));

//Route::group(array('before' => 'auth'), function()
//{

	Route::get('internal_trainings/{internal_trainings}/speakers', array('as' => 'internal_trainings.speakers', 'uses' => 'SpeakersController@index'));

	Route::post('internal_trainings/{internal_trainings}/speakers/store', array('as' => 'speakers.store', 'uses' => 'SpeakersController@store'));

	Route::get('internal_trainings/{internal_trainings}/participants', array('as' => 'internal_trainings.participants', 'uses' => 'InternalTrainingsController@showParticipants'));

	Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));

	Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation/{intent}', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));

	Route::post('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'after_activity_eval.store', 'uses' => 'InternalTrainingsController@storeEval'));

	Route::get('internal_trainings/{internal_trainings}/training-effectiveness-report', array('as' => 'internal_trainings.training-effectiveness-report', 'uses' => 'InternalTrainingsController@showTrainingEffectivenessReport'));

	Route::post('internal_trainings/{internal_trainings}', array('as' => 'internal_trainings.store-report', 'uses' => 'InternalTrainingsController@storeReport'));

	Route::get('internal_trainings/{id}/{type}/accomplish/{participant_id}', array('as' => 'training_assessment.accomplish', 'uses' => 'TrainingAssessmentsController@accomplish'));

	Route::post('internal_trainings/{training_id}/{type}/{participant_id}', array('as' => 'training_response.store', 'uses' => 'TrainingResponsesController@store'));

	Route::get('training_plan', array('as' => 'training_plan', function()
	{
		return View::make('training_plan.index');
	}));


	Route::get('dashboard', array('as' => 'dashboard', function()
	{

		/*$options = array(
		'validate_all' => false,
		'return_type' => 'boolean'
		);

		$role = Auth::user()->ability('Admin,HR','manage_users', $options);
		$name = Auth::user()->username;*/
		return View::make('dashboard.index');
			//->with('name',$name)
			//->with('role',$role);
	}));


	Route::resource('employees','EmployeesController');

	Route::resource('campuses','CampusesController');

	Route::get('external_trainings/pending-approval', array(
		'as' => 'external_trainings.pending-approval', 
		'uses' => 'ExternalTrainingsController@indexQueue'
		));


	Route::resource('departments','DepartmentsController');

	Route::resource('positions','PositionsController');

	Route::resource('ranks','RanksController');

	Route::resource('schools_colleges','SchoolsCollegesController');

	Route::resource('internal_trainings','InternalTrainingsController');

	Route::resource('external_trainings','ExternalTrainingsController');

	Route::resource('skills_competencies','SkillsCompetenciesController');

//Route::resource('speakers','SpeakersController');


	Route::post('upload',array('as'=>'upload', 'before'=>'auth','uses'=>'UploadController@index'));

//});
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
Route::get('/', 'UsersController@login');
Route::post('/', 'UsersController@doLogin');
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

//});


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

/*
|--------------------------------------------------------------------------
| Maatwebsite Routes
|--------------------------------------------------------------------------
|
| Different application routes for Import from Excel Functionality
|
*/
/*
Route::get('form', function(){
 return View::make('form');
});

Route::any('form-submit', function(){

	if(Input::hasFile('teamssample'))
	{
		echo 'WAHAHAHAHA';
	}
	else
	{
		echo "NO";
	}
});
*/
