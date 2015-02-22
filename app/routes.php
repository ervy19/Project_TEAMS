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

Route::get('test', function()
{
	return View::make('user_accounts.account-settings');
});


Route::get('employees/{id}/training-log', array('as' => 'employees.training-log', 'uses' => 'ReportsController@getTrainingLog'));

Route::get('reports/ter-report/{internal_training}', array('as' => 'reports.ter-report', 'uses' => 'ReportsController@terReport'));

Route::get('ter-report', array('as' => 'reports.get-ter-report', 'uses' => 'ReportsController@terReport'));

Route::get('submit-external-training', array('as' => 'external_trainings.createQueue', 'uses' => 'ExternalTrainingsController@createQueue'));

Route::post('confirm-external-training', array('as' => 'external_trainings.confirmQueue', 'uses' => 'ExternalTrainingsController@confirmQueue'));

Route::post('submit-external-training', array('as' => 'external_trainings.storeQueue', 'uses' => 'ExternalTrainingsController@storeQueue'));

Route::post('back-external-training', array('as' => 'external_trainings.backDetails', 'uses' => 'ExternalTrainingsController@backDetails'));
Route::delete('external_trainings/index/{external_trainings}', array('as' => 'external_trainings.destroy', 'uses' => 'ExternalTrainingsController@destroy'));

Route::get('search-trainings', array('as' => 'training_plan', 'uses' => 'TrainingPlanController@publicIndex'));

/*
|--------------------------------------------------------------------------
| External Training Submission Routes (PUBLIC)
|--------------------------------------------------------------------------
|
| Different application routes for Submission of External Trainings
|
*/


Route::get('external_trainings/{external_trainings}/credit-external-training', array('as' => 'external_trainings.getQueue', 'uses' => 'ExternalTrainingsController@getQueue'));

Route::post('external_trainings/{external_trainings}', array('as' => 'external_trainings.credit', 'uses' => 'ExternalTrainingsController@creditQueue'));

Route::get('external_trainings/queue', array('as' => 'external_trainings.queue', 'uses' => 'ExternalTrainingsController@indexQueue'));
Route::delete('external_trainings/queue/{external_trainings}', array('as' => 'external_trainings.destroyQueue', 'uses' => 'ExternalTrainingsController@destroyQueue'));

Route::get('success-external-training', array('as' => 'external_trainings_queue.success', function()
{
	return View::make('success-external-training');
}));

/*
|--------------------------------------------------------------------------
| Reports Routes
|--------------------------------------------------------------------------
|
| Different application routes for reports
|
*/
Route::get('reports/pta-report/{internal_training}', array('as' => 'reports.pta-report', 'uses' => 'ReportsController@ptaReport'));

Route::get('reports/pte-report/{internal_training}', array('as' => 'reports.pte-report', 'uses' => 'ReportsController@pteReport'));




Route::get('employees/{id}/training-log-download', array('as' => 'employees.training-log-download', 'uses' => 'ReportsController@downloadTrainingLog'));


/*
|--------------------------------------------------------------------------
| Confide Routes
|--------------------------------------------------------------------------
|
| Different application routes for Confide
|
*/

Route::get('login', 'UsersController@login');
Route::post('login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('login/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('logout', 'UsersController@logout');

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

	Route::get('summary_report/trainings', array('as' => 'summary_report.trainings', 'uses' => 'SummaryReportsController@trainingsReport'));

	Route::get('summary_report/skills_competencies', array('as' => 'summary_report.skills_competencies', 'uses' => 'SummaryReportsController@scsReport'));


	/*
	|--------------------------------------------------------------------------
	| Internal Training Routes
	|--------------------------------------------------------------------------
	|
	| Different application routes for Internal Training components
	|
	*/
	/*Download Reports (PTA, PTE, TER) Routes*/
	Route::get('internal_trainings/{internal_trainings}/training-effectiveness-report/download', array('as' => 'internal_training.download-ter', 'uses' => 'ReportsController@downloadTerReport'));
	Route::get('internal_trainings/{internal_trainings}/participants/download-pta', array('as' => 'internal_training.download-pta', 'uses' => 'ReportsController@downloadPtaReport'));
	Route::get('internal_trainings/{internal_trainings}/participants/download-pte', array('as' => 'internal_training.download-pte', 'uses' => 'ReportsController@downloadPteReport'));

	Route::get('internal_trainings/{internal_trainings}/participants/add-attendance', array('as' => 'internal_trainings.upload-attendance', 'uses' => 'UploadsController@showUploadAttendance'));
	Route::post('internal_trainings/{internal_trainings}/participants/add-attendance', array('as' => 'internal_trainings.store-upload-attendance', 'uses' => 'UploadsController@batchAttendance'));

	Route::get('internal_trainings/{internal_trainings}/participants/add-participant', array('as' => 'internal_trainings.upload-participant', 'uses' => 'UploadsController@createParticipant'));
	Route::post('internal_trainings/{internal_trainings}/participants/add-participant', array('as' => 'internal_trainings.store-upload-participant', 'uses' => 'UploadsController@storeParticipant'));

	/*Speaker Routes under Internal Trainings*/
	Route::get('internal_trainings/{internal_trainings}/speakers', array('as' => 'internal_trainings.speakers', 'uses' => 'SpeakersController@index'));
	Route::get('internal_trainings/{internal_trainings}/speakers/{speaker}/edit', array('as' => 'internal_trainings.speakers', 'uses' => 'SpeakersController@edit'));
	Route::post('internal_trainings/{internal_trainings}/speakers/store', array('as' => 'speakers.store', 'uses' => 'SpeakersController@store'));
	Route::put('internal_trainings/{internal_trainings}/speakers/{speaker}', array('as' => 'speakers.update', 'uses' => 'SpeakersController@update'));
	Route::patch('internal_trainings/{internal_trainings}/speakers/{speaker}', array('uses' => 'SpeakersController@update'));
	Route::delete('internal_trainings/{internal_trainings}/speakers/{speaker}', array('uses' => 'SpeakersController@destroy'));

	/*Participant Routes under Internal Trainings*/
	Route::get('internal_trainings/{internal_trainings}/participants', array('as' => 'participants.index', 'uses' => 'ParticipantsController@index'));
	Route::get('internal_trainings/{internal_trainings}/participants/{participant}/edit', array('as' => 'participants.edit', 'uses' => 'ParticipantsController@edit'));
	Route::post('internal_trainings/{internal_trainings}/participants', array('as' => 'participants.store', 'uses' => 'ParticipantsController@store'));
	Route::put('internal_trainings/{internal_trainings}/participants/{participant}', array('as' => 'participants.update', 'uses' => 'ParticipantsController@update'));
	Route::patch('internal_trainings/{internal_trainings}/participants/{participant}', array('uses' => 'ParticipantsController@update'));
	Route::delete('internal_trainings/{internal_trainings}/participants/{participant}', array('as' => 'participants.destroy', 'uses' => 'ParticipantsController@destroy'));


	Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));
	//Route::get('internal_trainings/{internal_trainings}/after-activity-evaluation/{intent}', array('as' => 'internal_trainings.after-activity-evaluation', 'uses' => 'InternalTrainingsController@showAfterActivityEvaluation'));
	Route::post('internal_trainings/{internal_trainings}/after-activity-evaluation', array('as' => 'after_activity_eval.store', 'uses' => 'InternalTrainingsController@storeEval'));


	Route::get('internal_trainings/{internal_trainings}/training-effectiveness-report', array('as' => 'internal_trainings.training-effectiveness-report', 'uses' => 'InternalTrainingsController@showTrainingEffectivenessReport'));

	//Route::get('internal_trainings/{id}/{type}/accomplish', array('as' => 'training_assessment.accomplish', 'uses' => 'TrainingAssessmentsController@accomplish'));

	Route::post('internal_trainings/{internal_trainings}', array('as' => 'internal_trainings.store-report', 'uses' => 'InternalTrainingsController@storeReport'));

	Route::get('internal_trainings/{id}/{type}/show/{participant_id}', array('as' => 'training_assessment.show', 'uses' => 'TrainingAssessmentsController@showAccomplished'));

	Route::get('internal_trainings/{id}/{type}/accomplish/{participant_id}', array('before' => 'accomplish-ta', 'as' => 'training_assessment.accomplish', 'uses' => 'TrainingAssessmentsController@accomplish'));

	Route::post('internal_trainings/{training_id}/{type}/{participant_id}', array('before' => 'accomplish-ta', 'as' => 'training_response.store', 'uses' => 'TrainingResponsesController@store'));



	//Used for getting specific employee designation
	Route::get('internal_trainings/participants/{employee_id}', array('as' => 'participant.employee_designation', 'uses' => 'EmployeesController@getEmployeeDesignation'));

	Route::get('external_trainings/queue', array('as' => 'external_trainings.queue', 'uses' => 'ExternalTrainingsController@indexQueue'));

	Route::get('training_plan', array('as' => 'training_plan', 'uses' => 'TrainingPlanController@index'));


	Route::get('users', array('as' => 'users.index', 'uses' => 'UsersController@index'));
	Route::get('users/create', array('as' => 'users.create', 'uses' => 'UsersController@create'));
	Route::post('users', array('as' => 'users.store', 'uses' => 'UsersController@store'));
	Route::get('users/{user_id}/edit', array('before' => 'update-user-account', 'as' => 'users.edit', 'uses' => 'UsersController@edit'));
	Route::put('users/{user_id}',  array('before' => 'update-user-account', 'as' => 'users.update', 'uses' => 'UsersController@update'));
	Route::patch('users/{user_id}', array('before' => 'update-user-account', 'uses' => 'UsersController@update'));
	Route::delete('users/{user_id}', array('as' => 'users.destroy', 'uses' => 'UsersController@destroy'));


	Route::resource('roles','RolesController');

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


	Route::get('internal_trainings/{training_id}/assessment-items', array('as' => 'internal_trainings.assessment_items', 'uses' => 'TrainingAssessmentsController@index'));
	Route::post('internal_trainings/{training_id}/assessment-items', array('as' => 'internal_trainings.assessment_items', 'uses' => 'TrainingAssessmentsController@storeAI'));

	Route::get('employees/{employee_id}/individual-training-report', array('as' => 'employees.individual_training_report', 'uses' => 'EmployeesController@showTrainingReport'));
	Route::get('employees/{employee_id}/individual-training-data', array('as' => 'employees.individual_training_data', 'uses' => 'SummaryReportsController@individualTrainingReport'));

//Route::resource('speakers','SpeakersController');

	Route::get('departments/{department_id}/needed-skills-competencies', array('as' => 'departments.needed_skills_competencies', 'uses' => 'DepartmentsController@neededSkillsCompetencies'));

	Route::get('positions/{position_id}/needed-skills-competencies', array('as' => 'positions.needed_skills_competencies', 'uses' => 'PositionsController@neededSkillsCompetencies'));

	Route::post('upload',array('as'=>'upload', 'before'=>'auth','uses'=>'UploadController@index'));


	/*
	|--------------------------------------------------------------------------
	| Training Assessment Routes
	|--------------------------------------------------------------------------
	|
	| Different application routes for Training Assessments (PTA and PTE)
	|
	*/
	Route::get('internal_trainings/{internal_trainings}/asssessment-items', array('as' => 'training_assessment.index', 'uses' => 'TrainingAssessmentsController@index'));

	Route::get('{type}/create', array('as' => 'training_assessment.create', 'uses' => 'TrainingAssessmentsController@create'));

	Route::post('{type}', array('as' => 'training_assessment.store', 'uses' => 'TrainingAssessmentsController@store'));

	Route::get('{type}/{training_assessment}', array('as' => 'training_assessment.show', 'uses' => 'TrainingAssessmentsController@show'));

	Route::get('{type}/{training_assessment}/edit', array('as' => 'training_assessment.edit', 'uses' => 'TrainingAssessmentsController@edit'));

	Route::put('{type}/{training_assessment}', array('as' => 'training_assessment.update', 'uses' => 'TrainingAssessmentsController@update'));

	Route::patch('{type}/{training_assessment}', array('uses' => 'TrainingAssessmentsController@update'));

	Route::delete('{type}/{training_assessment}', array('as' => 'training_assessment.destroy', 'uses' => 'TrainingAssessmentsController@destroy'));

});

Route::get('{encrypted_internal_training_id}', 'ITAttendanceController@index');

Route::post('attendance/{encrypted_internal_training_id}', 'ITAttendanceController@store');
