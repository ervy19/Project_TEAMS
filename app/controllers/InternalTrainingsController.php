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

		return View::make('internal_trainings.index')
			->with('internaltrainings', $internaltrainings );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('internal_trainings.create');
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
           	$internaltrainings->organizer_schools_colleges_id = Input::get('schoolorganizer');
            $internaltrainings->organizer_department_id = Input::get('department_id');
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
		 $internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.show')
			->with('internaltrainings', $internaltrainings);
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


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.edit')
			->with('internaltrainings', $internaltrainings );
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
            return Redirect::to('internal_trainings/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $internaltrainings = Internal_Training::find($id);
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
            $internaltrainings->organizer_schools_colleges_id = Input::get('school_college_id');
            $internaltrainings->organizer_department_id = Input::get('department_id');
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
		$internaltrainings = Internal_Training::find($id);
        $internaltrainings->isActive = false;
        $internaltrainings->save();

        // redirect
        Session::flash('message', 'Successfully deleted Internal Training!');
        return Redirect::to('internal_trainings');
	}


}
