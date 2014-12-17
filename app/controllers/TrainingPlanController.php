<?php

class TrainingPlanController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$trainings = Internal_Training::where('isTrainingPlan', '=', true)->get(array('id','title','theme_topic','date_start','date_end','time_start','time_end'))->toJson();

		return View::make('training_plan.index')
			->with('trainings', $trainings );
	}

}