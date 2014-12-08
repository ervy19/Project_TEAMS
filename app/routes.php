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

Route::resource('employees','EmployeesController');

Route::resource('campuses','CampusesController');

Route::resource('departments','DepartmentsController');

Route::resource('positions','PositionsController');

Route::resource('schools_colleges','SchoolsCollegesController');

Route::resource('internal_trainings','InternalTrainingsController');

Route::resource('external_trainings','ExternalTrainingsController');

Route::resource('skills_competencies','SkillsCompetenciesController');

Route::get('querytest', function() {

	echo 'query test';
});

