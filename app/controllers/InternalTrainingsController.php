<?php

class InternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$internaltrainings = Internal_Training::where('isActive', '=', true)->get();
		$trainings = Training::where('isActive', '=', true)->get();

		return View::make('internal_trainings.index')
			->with('internaltrainings', $internaltrainings)
			->with('trainings', $trainings);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('internal_trainings.create')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'theme_topic' => 'required',
            'isTrainingPlan' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            //store in trainings table
        	$training = new Training;
        	$training->title = Input::get('title');
        	$ntraining = Input::get('title');
            $training->theme_topic = Input::get('theme_topic');
            $training->venue = Input::get('venue');
            //for schedule
	            $date_start = Input::get('date_start');
	            $date_end = Input::get('date_end');
	            $time_start = Input::get('time_start');
	            $time_end = Input::get('time_end');
	        $training->schedule = $date_start . " (" . $time_start . " - " . $time_end . ") - " . $date_end . " (" . $time_start . " - " . $time_end . ")";
            $training->isTrainingPlan = Input::get('isTrainingPlan');
            $training->save();

            $newtraining = Training::where('title', $ntraining)->pluck('id');

        	//store in internal_trainings table
            $internaltrainings = new Internal_Training;
            $internaltrainings->training_id = $newtraining;
            $internaltrainings->format = Input::get('format');
            $internaltrainings->objectives = Input::get('objectives');
            $internaltrainings->expected_outcome = Input::get('expected_outcome');
            $internaltrainings->evaluation_narrative = Input::get('evaluation_narrative');
            $internaltrainings->recommendations = Input::get('recommendations');
            $schoolorganizer = Input::get('selected_sch_training');
           	$internaltrainings->organizer_schools_colleges_id = School_College::where('isActive', '=', true)->where('name', '=', $schoolorganizer)->pluck('id');
            $deptorganizer = Input::get('selected_dept_training');
            $internaltrainings->organizer_department_id = Department::where('isActive', '=', true)->where('name', '=', $deptorganizer)->pluck('id');
            $internaltrainings->isTrainingPlan = Input::get('isTrainingPlan');
            $internaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully created the Internal Training!');
            return Redirect::to('internal_trainings');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		 $id = "3";
		 $internaltrainings = Internal_Training::where('training_id', '=', $training_id)->get();
		 $title = Training::where('id', '=', $training_id)->pluck('title');
		 $theme_topic = Training::where('id', '=', $training_id)->pluck('theme_topic');
		 $organizerschid = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_schools_colleges_id');
		 $school_college = School_College::where('isActive', '=', true)->where('id', '=', $organizerschid)->pluck('name');
		 $venue = Training::where('id', '=', $training_id)->pluck('venue');
		 $schedule = Training::where('id', '=', $training_id)->pluck('schedule');
		 $objectives = Internal_Training::where('training_id', '=', $training_id)->pluck('objectives');
		 $expected_outcome = Internal_Training::where('training_id', '=', $training_id)->pluck('expected_outcome');

		return View::make('internal_trainings.show')
			->with('internaltrainings', $internaltrainings)
			->with('title', $title)
			->with('theme_topic', $theme_topic)
			->with('school_college', $school_college)
			->with('venue', $venue)
			->with('date_start', $date_start)
			->with('date_end', $date_end)
			->with('time_start', $time_start)
			->with('time_end', $time_end)
			->with('objectives', $objectives)
			->with('expected_outcome', $expected_outcome);
	}

	public function showParticipants($id)
	{
		 $internaltrainings = Internal_Training::find($training_id);

		return View::make('internal_trainings.participants')
			->with('internaltrainings', $internaltrainings);
	}

	public function showAfterActivityEvaluation($id)
	{
		 $internaltrainings = Internal_Training::find($training_id);

		return View::make('internal_trainings.after-activity-evaluation')
			->with('internaltrainings', $internaltrainings);
	}

	public function showTrainingEffectivenessReport($id)
	{
		 $internaltrainings = Internal_Training::find($training_id);

		return View::make('internal_trainings.training-effectiveness-report')
			->with('internaltrainings', $internaltrainings);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$internaltrainings = Internal_Training::find($training_id);
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();
		$currentstartdate = $internaltrainings->date_start;
		$currentenddate = $internaltrainings->date_end;
		$isTP = $internaltrainings->isTrainingPlan;

		return View::make('internal_trainings.edit')
			->with('internaltrainings', $internaltrainings)
			->with('schoolcollege', $schoolcollege)
			->with('department', $department)
			->with('currentstartdate', $currentstartdate)
			->with('currentenddate', $currentenddate)
			->with('isTP', $isTP);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'theme_topic' => 'required',
            'objectives' => 'required',
            'isTrainingPlan' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/' . $training_id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $internaltrainings = Internal_Training::find($training_id);
            $internaltrainings->title = Input::get('title');
            $internaltrainings->theme_topic = Input::get('theme_topic');
            $internaltrainings->venue = Input::get('venue');
            $internaltrainings->date_start = Input::get('date_start');
            $internaltrainings->date_end = Input::get('date_end');
            $internaltrainings->time_start = Input::get('time_start');
            $internaltrainings->time_end = Input::get('time_end');
            $internaltrainings->objectives = Input::get('objectives');
            $internaltrainings->expected_outcome = Input::get('expected_outcome');
            $internaltrainings->evaluation_narrative = Input::get('evaluation_narrative');
            $internaltrainings->recommendations = Input::get('recommendations');
            $schoolorganizer = Input::get('selected_sch_training_edit');
           	$internaltrainings->organizer_schools_colleges_id = School_College::where('isActive', '=', true)->where('name', '=', $schoolorganizer)->pluck('id');
            $deptorganizer = Input::get('selected_dept_training_edit');
            $internaltrainings->organizer_department_id = Department::where('isActive', '=', true)->where('name', '=', $deptorganizer)->pluck('id');
            $internaltrainings->isTrainingPlan = Input::get('isTrainingPlan');
            $internaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully edited the Internal Training!');
            return Redirect::to('internal_trainings');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$internaltrainings = Internal_Training::find($training_id);
        $internaltrainings->isActive = false;
        $internaltrainings->save();

        // redirect
        Session::flash('message', 'Successfully deleted Internal Training!');
        return Redirect::to('internal_trainings');
	}


}
