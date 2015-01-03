<?php

class AssessmentItemsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$internaltrainings = Internal_Training::where('isActive', '=', true)->get();

		return View::make('training_assessments.index')
			->with('internaltrainings', $internaltrainings );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function accomplish_pta($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.accomplish-pta')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}

	public function accomplish_pte($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.accomplish-pte')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function create_pta($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.create-pta')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function create_pte($id)
	{
		 $id = "3";''
		 $internaltrainings = Internal_Training::where('id', '=', $id)->get();
		 $title = Internal_Training::where('isActive', '=', true)->where('id', '=', $id)->pluck('title');
		 $theme_topic = Internal_Training::where('id', '=', $id)->pluck('theme_topic');
		 $organizerschid = Internal_Training::where('id', '=', $id)->pluck('organizer_schools_colleges_id');
		 $school_college = School_College::where('id', '=', $id)->where('id', '=', $organizerschid)->pluck('name');
	

		return View::make('training_assessments.create-pte')
			->with('internaltrainings', $internaltrainings)
			->with('title', $title)
			->with('theme_topic', $theme_topic)
			->with('organizerschid', $organizerschid)
			->with('school_college', $school_college);
	}

	public function edit_pta($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.edit-pta')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}

	public function edit_pte($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.edit-pte')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}

	public function show_pta($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.show-pta')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
	}

	public function show_pte($id)
	{
		$schoolcollege = School_College::where('isActive', true)->get();
		$department = Department::where('isActive', true)->get();

		return View::make('training_assessments.show-pte')
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
            // store
            $internaltrainings = new Internal_Training;
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
		 $internaltrainings = Internal_Training::where('id', '=', $id)->get();
		 $title = Internal_Training::where('id', '=', $id)->pluck('title');
		 $theme_topic = Internal_Training::where('id', '=', $id)->pluck('theme_topic');
		 $organizerschid = Internal_Training::where('id', '=', $id)->pluck('organizer_schools_colleges_id');
		 $school_college = School_College::where('id', '=', $id)->where('id', '=', $organizerschid)->pluck('name');
		 $venue = Internal_Training::where('id', '=', $id)->pluck('venue');
		 $date_start = Internal_Training::where('id', '=', $id)->pluck('date_start');
		 $date_end = Internal_Training::where('id', '=', $id)->pluck('date_end');
		 $time_start = Internal_Training::where('id', '=', $id)->pluck('time_start');
		 $time_end = Internal_Training::where('id', '=', $id)->pluck('time_end');
		 $objectives = Internal_Training::where('id', '=', $id)->pluck('objectives');
		 $expected_outcome = Internal_Training::where('id', '=', $id)->pluck('expected_outcome');

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
		 $internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.participants')
			->with('internaltrainings', $internaltrainings);
	}

	public function showAfterActivityEvaluation($id)
	{
		 $internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.after-activity-evaluation')
			->with('internaltrainings', $internaltrainings);
	}

	public function showTrainingEffectivenessReport($id)
	{
		 $internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.training-effectiveness-report')
			->with('internaltrainings', $internaltrainings);
	}



}
