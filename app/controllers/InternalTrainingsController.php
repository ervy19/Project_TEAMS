<?php

class InternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$internaltrainings = Training::where('isActive', '=', true)->get();

		return View::make('internal_trainings.index')
			->with('internaltrainings', $internaltrainings);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$schoolcollege = School_College::where('isActive', true)->lists('name','id');
		$department = Department::where('isActive', true)->lists('name','id');

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
            'theme_topic' => 'required|max:255',
            'schedule' => 'required|max:255',
            'objectives' => 'required',
            'isTrainingPlan' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store

            //Trainings Table
            $trainings = new Training;
            $trainings->title = Input::get('title');
            $trainings->theme_topic = Input::get('theme_topic');
            $trainings->venue = Input::get('venue');
            $trainings->schedule = Input::get('schedule');
            $trainings->save();         

            //Internal Trainings Table
            $internaltrainings = new Internal_Training;
            $internaltrainings->training_id = $trainings->id;

            $internaltrainings->objectives = Input::get('objectives');
            $internaltrainings->expected_outcome = Input::get('expected_outcome');
            
            $internaltrainings->organizer_schools_colleges_id = Input::get('schoolcollege');
            $internaltrainings->organizer_department_id = Input::get('department');

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

		$internaltrainings = Training::with('internal_training')->find($id);		 

		return View::make('internal_trainings.show')
			->with('internaltrainings', $internaltrainings);
	}

	public function showParticipants($id)
	{
		$internaltrainings = Training::with('internal_training')->find($id);

		return View::make('internal_trainings.participants')
			->with('internaltrainings', $internaltrainings);
	}

	public function showAfterActivityEvaluation($id)
	{
		 $internaltrainings = Training::with('internal_training')->find($id);

		return View::make('internal_trainings.after-activity-evaluation')
			->with('internaltrainings', $internaltrainings);
	}

	public function showTrainingEffectivenessReport($id)
	{
		$internaltrainings = Training::with('internal_training')->find($id);

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
		$internaltrainings = Training::with('internal_training')->find($id);

		$schoolcollege = School_College::where('isActive', true)->lists('name','id');
		$department = Department::where('isActive', true)->lists('name','id');

		return View::make('internal_trainings.edit')
			->with('internaltrainings', $internaltrainings)
			->with('schoolcollege', $schoolcollege)
			->with('department', $department);
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
            'theme_topic' => 'required|max:255',
            'schedule' => 'required|max:255'
        );
        $validator = Validator::make(Input::all(), $rules);

        $v_rules = array(
            'objectives' => 'required',
            'isTrainingPlan' => 'required'
        );
        $validator_two = Validator::make(Input::all()['internal_training'], $v_rules);

        // process the login
        if ($validator->fails() || $validator_two->fails()) {
            return Redirect::to('internal_trainings/' . $id . '/edit')
                ->withErrors($validator)
                ->withErrors($validator_two)
                ->withInput();
        } else {

            //Trainings Table
            $trainings = Training::find($id);
            $trainings->title = Input::get('title');
            $trainings->theme_topic = Input::get('theme_topic');
            $trainings->venue = Input::get('venue');
            $trainings->schedule = Input::get('schedule');
            $trainings->save();         

            $internaltrainings = Internal_Training::where('training_id','=',$id)->update(
            	array(
            		'objectives' => Input::get('internal_training')['objectives'],
            		'expected_outcome' => Input::get('internal_training')['expected_outcome'],
                    'organizer_schools_colleges_id' => Input::get('internal_training')['organizer_schools_colleges_id'],
            		'organizer_department_id' => Input::get('internal_training')['organizer_department_id'],
					'isTrainingPlan' => Input::get('internal_training')['isTrainingPlan']
            	));

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
		$training = Training::find($id);
        $training->isActive = false;
        $training->save();

        $internaltraining = Internal_Training::where('training_id','=',$id)
        	->update(array(
            		'isActive' => false
            	));

        // redirect
        Session::flash('message', 'Successfully deleted Internal Training!');
        return Redirect::to('internal_trainings');
	}

}
