<?php

class InternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$internaltrainings = Training::where('isActive', '=', true)->where('isInternalTraining', '=', 1)->get();

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
            $trainings->isInternalTraining = 1;
            $trainings->save();         

            //Internal Trainings Table
            $internaltrainings = new Internal_Training;
            $internaltrainings->training_id = $trainings->id;

            $internaltrainings->objectives = Input::get('objectives');
            $internaltrainings->expected_outcome = Input::get('expected_outcome');

            //initialize columns
            $internaltrainings->format = "";
            $internaltrainings->evaluation_narrative = "";
            $internaltrainings->recommendations = "";
            
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
        $schoolcollegeid = Internal_Training::where('training_id', '=', $id)->pluck('organizer_schools_colleges_id');
        $schoolcollege = School_College::where('id', '=', $schoolcollegeid)->pluck('name');
        $departmentid = Internal_Training::where('training_id', '=', $id)->pluck('organizer_department_id');
        $department = Department::where('id', '=', $departmentid)->pluck('name');        
        $encrypted_training_id = Crypt::encrypt($id);

		return View::make('internal_trainings.show')
			->with('internaltrainings', $internaltrainings)
            ->with('schoolcollege', $schoolcollege)
            ->with('department', $department)
            ->with('encrypted_training_id',$encrypted_training_id);
	}

	public function showSpeakers($id)
	{
		$internaltrainings = Training::with('internal_training')->find($id);

		return View::make('internal_trainings.speakers')
			->with('internaltrainings', $internaltrainings);
	}

	public function showParticipants($id)
	{
		$internaltrainings = Training::with('internal_training')->find($id);
        $testresponse = Activity_Evaluation::where('isActive', '=', true)->where('internal_training_id', '=', $id)->get();
        
        if (is_null($testresponse)) {
            $intent = "accomplish";
        }
        else {
            $intent = "show";
        }

		return View::make('internal_trainings.participants')
			->with('internaltrainings', $internaltrainings)
            ->with('intent', $intent);
	}

	public function showAfterActivityEvaluation($id, $intent)
	{
		 if($intent=="accomplish")
		 {
		 	$intent="accomplish";
			$internaltrainings = Training::where('id', '=', $id)->get();

			return View::make('internal_trainings.after-activity-evaluation')
				->with('internaltrainings', $internaltrainings)
				->with('intent', $intent);
		 }
		 elseif($intent=="show")
		 {
		 	$intent="show";
		 	$activityevaluation = Activity_Evaluation::where('internal_training_id', '=', $id)->get();
		 	$speaker = Speaker::where('internal_training_id', '=', $id)->pluck('id');
		 	$speakerevaluation = Speaker_Evaluation::where('speaker_id', '=', $speaker)->get();
		 	
		 	//dd($activityevaluation);
		 	
			$internaltrainings = Training::where('id', '=', $id)->get();

			return View::make('internal_trainings.after-activity-evaluation')
				->with('internaltrainings', $internaltrainings)
				->with('intent', $intent)
				->with('activityevaluation', $activityevaluation)
				->with('speakerevaluation', $speakerevaluation);
		 }
		 
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeEval($id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'planning_criterion1' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/{internal_trainings}/after-activity-evaluation/accomplish')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            //Activity_Evaluation Table
            $activityevaluation = new Activity_Evaluation;
            $activityevaluation->planning_criterion1 = Input::get('planning_criterion1');
            $activityevaluation->planning_criterion2 = Input::get('planning_criterion2');
            $activityevaluation->objectives_criterion1 = Input::get('objectives_criterion1');
            $activityevaluation->objectives_criterion2 = Input::get('objectives_criterion2');
            $activityevaluation->objectives_criterion3 = Input::get('objectives_criterion3');
            $activityevaluation->content_criterion1 = Input::get('content_criterion1');
            $activityevaluation->content_criterion2 = Input::get('content_criterion2');
            $activityevaluation->materials_criterion1 = Input::get('materials_criterion1');
            $activityevaluation->materials_criterion2 = Input::get('materials_criterion2');
            $activityevaluation->schedule_criterion1 = Input::get('schedule_criterion1');
            $activityevaluation->schedule_criterion2 = Input::get('schedule_criterion2');
            $activityevaluation->schedule_criterion3 = Input::get('schedule_criterion3');
            $activityevaluation->openForum_criterion1 = Input::get('openForum_criterion1');
            $activityevaluation->openForum_criterion2 = Input::get('openForum_criterion2');
            $activityevaluation->openForum_criterion3 = Input::get('openForum_criterion3');
            $activityevaluation->venue_criterion1 = Input::get('venue_criterion1');
            $activityevaluation->venue_criterion2 = Input::get('venue_criterion2');
            $activityevaluation->comments = Input::get('comments');
            $activityevaluation->internal_training_id = $id;
            $activityevaluation->save();

            //Speaker_Evaluation Table
            $speakerevaluation = new Speaker_Evaluation;
            $speakerevaluation->evaluation_criterion1 = Input::get('evaluation_criterion1');
            $speakerevaluation->evaluation_criterion2 = Input::get('evaluation_criterion2');
            $speakerevaluation->evaluation_criterion3 = Input::get('evaluation_criterion3');
            $speakerevaluation->speaker_id = 1;
            $speakerevaluation->save(); 

            // redirect
            Session::flash('message', 'Successfully recorded After Activity Evaluation!');
            return Redirect::to('dashboard');
        }
	}

	public function showTrainingEffectivenessReport($id)
	{
		$internaltrainings = Training::where('id', '=', $id)->get();
        $trainingdetails = Internal_Training::where('training_id', '=', $id)->get();
        $tereport = Internal_Training::where('training_id', '=', $id)->pluck('evaluation_narrative');
        $testresponse = Activity_Evaluation::where('isActive', '=', true)->where('internal_training_id', '=', $id)->get();
        
        if (is_null($testresponse)) {
            $intent = "accomplish";
        }
        else {
            $intent = "show";
        }

		return View::make('internal_trainings.training-effectiveness-report')
			->with('internaltrainings', $internaltrainings)
            ->with('tereport', $tereport)
            ->with('trainingdetails', $trainingdetails)
            ->with('intent', $intent);
	}

	public function storeReport($id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'evaluation_narrative' => 'required'

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/{internal_trainings}/training-effectiveness-report')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
        	DB::table('internal_trainings')
            ->where('training_id', $id)
            ->update(array(
            	'evaluation_narrative' => Input::get('evaluation_narrative'),
            	'recommendations' => Input::get('recommendations')));

            // redirect
            Session::flash('message', 'Successfully recorded Training Effectiveness Report!');
            return Redirect::to('dashboard');
        }
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
            $trainings->isInternalTraining = 1;
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
