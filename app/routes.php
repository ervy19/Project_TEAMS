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

Route::get('internal_trainings/participants', array('as' => 'internal_trainings.participants', function()
{
	return View::make('internal_trainings/participants');
}));

Route::get('internal_trainings/after-activity-evaluation', array('as' => 'internal_trainings.after-activity-evaluation', function()
{
	return View::make('internal_trainings.after-activity-evaluation');
}));

Route::get('internal_trainings/training-effectiveness-report', array('as' => 'internal_trainings.training-effectiveness-report', function()
{
	return View::make('internal_trainings.training-effectiveness-report');
}));

Route::get('training_plan', array('as' => 'training_plan', function()
{
	return View::make('training_plan.index');
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

Route::get('querytest', function($department_id=1) {

	
});



