<?php

class InternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$internaltrainings = Training::where('isActive', '=', true)->where('isInternalTraining', '=', 1)->get();
        $internaltrainings = Internal_Training::select(DB::raw('*'))
                                ->leftJoin('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
                                ->leftJoin('trainings','internal_trainings.training_id','=','trainings.id')
                                ->leftJoin('training_schedules','internal_trainings.training_id','=','training_schedules.training_id')
                                ->where('internal_trainings.isActive', '=', true)
                                ->groupBy('internal_trainings.training_id')
                                ->get();

        $isAdminHR = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;
        }

		return View::make('internal_trainings.index')
			->with('internaltrainings', $internaltrainings)
            ->with('isAdminHR',$isAdminHR);
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
        $sc = SkillsCompetencies::where('isActive', true)->lists('name');

		return View::make('internal_trainings.create')
			->with('schoolcollege', $schoolcollege)
			->with('department', $department)
            ->with('sc', $sc);
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
            $trainings->isInternalTraining = 1;
            $trainings->save();         

            //Internal Trainings Table
            $internaltrainings = new Internal_Training;
            $internaltrainings->training_id = $trainings->id;

            $internaltrainings->format = Input::get('format');
            $internaltrainings->objectives = Input::get('objectives');
            $internaltrainings->expected_outcome = Input::get('expected_outcome');

            //initialize columns
            $internaltrainings->evaluation_narrative = "";
            $internaltrainings->recommendations = "";
            
            $internaltrainings->organizer_schools_colleges_id = Input::get('schoolcollege');
            $internaltrainings->organizer_department_id = Input::get('department');

            $internaltrainings->isTrainingPlan = Input::get('isTrainingPlan');

            $internaltrainings->save();

            //Schedule
            $time_start_s = Input::get('time_start_s');
            $time_end_s = Input::get('time_end_s');
            $time_start_e = Input::get('time_start_e');
            $time_end_e = Input::get('time_end_e');

            $startdate = new Training_Schedule;
            $startdate->date_scheduled = Input::get('date_start');
            $startdate->timeslot = $time_start_s . "-" . $time_end_s;
            $startdate->isStartDate = 1;
            $startdate->isEndDate = 0;
            $startdate->training_id = $trainings->id;
            $startdate->save();

            $enddate = new Training_Schedule;
            $enddate->date_scheduled = Input::get('date_end');
            $enddate->timeslot = $time_start_e . "-" . $time_end_e;
            $enddate->isStartDate = 0;
            $enddate->isEndDate = 1;
            $enddate->training_id = $trainings->id;
            $enddate->save();
            
            //Tagged Skills and Competencies
            $selectedsc = Input::get('scit');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
                $ITsc = new IT_Addressed_SC;
                $selectedid = SkillsCompetencies::where('isActive',true)->where('name', "=", $scidArray[$i])->pluck('id');
                $ITsc->skills_competencies_id = $selectedid;
                $ITsc->internal_training_id = $trainings->id;
                $ITsc->save();
            }

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
        //Get the details of the specified internal training
        $internaltrainings = Training::join('internal_trainings','trainings.id','=','internal_trainings.training_id')
                                ->join('training_schedules','internal_trainings.training_id','=','training_schedules.training_id')
                                ->where('trainings.id','=',$id)
                                ->first();
        //for format, objectives, and outcome
        $internaltraining = Training::with('internal_training')->find($id);

        $focus_areas = Focus_Areas::where('internal_training_id','=',$internaltrainings->id)->first();
            
        $scs = DB::table('it_addressed_sc')
                    ->join('skills_competencies','it_addressed_sc.skills_competencies_id','=','skills_competencies.id')
                    ->where('internal_training_id','=',$internaltrainings->id)
                    ->get();

        $organizer = 'No Organizer Tagged';

        //Get the name of the school/college who organized the training
        $schoolcollege = School_College::find($internaltrainings->organizer_schools_colleges_id);

        //Get the name of the department who organized the training
        $department = Department::find($internaltrainings->organizer_department_id);        
            
        $organizer = '';

        if($schoolcollege)
        {
            $organizer = $schoolcollege->name . ' | ' ;
        }

        if($department)
        {
            $organizer .= 'Department of ' . $department->name;
        }

        $isAdminHR = false;
        $isOrganizer = false;
        $hasSpeakers = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;

            $encrypted_training_id = Crypt::encrypt($id);

            $speakers = Speaker::where('internal_training_id', '=', $id)->first();

            //dd($speakers);

            if($speakers)
            {
                $hasSpeakers = true;
            }

            return View::make('internal_trainings.show')
                ->with('internaltrainings', $internaltrainings)
                ->with('internaltraining', $internaltraining)
                ->with('organizer', $organizer)
                ->with('encrypted_training_id',$encrypted_training_id)
                ->with('focus_areas',$focus_areas)
                ->with('scs',$scs)
                ->with('isAdminHR',$isAdminHR)
                ->with('isOrganizer',$isOrganizer)
                ->with('hasSpeakers',$hasSpeakers);
        }
        else
        {
            //Check if the user's school/college/department has organized the training
            if(Auth::user()->hasRole('School_College Supervisor'))
            {
                $scSupervisor = Supervisor::select(DB::raw('schools_colleges.id as sc_id'))
                                ->join('schools_colleges_supervisors','supervisors.id','=','schools_colleges_supervisors.supervisor_id')
                                ->join('schools_colleges','schools_colleges_supervisors.schools_colleges.id','=','schools_colleges')
                                ->where('supervisors.user_id','=',Auth::user()->id)
                                ->first();

                if($scSupervisor->sc_id==$internaltrainings->organizer_schools_colleges_id)
                {
                    $isOrganizer = true;
                }
            }
            else if(Auth::user()->hasRole('Department Supervisor'))
            {
                $departmentSupervisor = Supervisor::select(DB::raw('departments.id as dept_id'))
                                ->join('department_supervisors','supervisors.id','=','department_supervisors.supervisor_id')
                                ->join('departments','department_supervisors.department_id','=','departments.id')
                                ->where('supervisors.user_id','=',Auth::user()->id)
                                ->first();
                if($departmentSupervisor->dept_id==$internaltrainings->organizer_department_id)
                {
                    $isOrganizer = true;
                }
            }

            $speakers = Speaker::where('internal_training_id','=',$id)
                                ->get();

            if($speakers!=null)
            {
                $hasSpeakers = true;
            }

            return View::make('internal_trainings.show')
                        ->with('internaltrainings', $internaltrainings)
                        ->with('organizer', $organizer)
                        ->with('focus_areas',$focus_areas)
                        ->with('scs',$scs)
                        ->with('speakers',$speakers)
                        ->with('hasSpeakers',$hasSpeakers)
                        ->with('isAdminHR',$isAdminHR)
                        ->with('isOrganizer',$isOrganizer);
        }
	}

	public function showSpeakers($id)
	{
		$internaltrainings = Training::with('internal_training')->find($id);

        $isAdminHR = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;       
        }

		return View::make('internal_trainings.speakers')
            ->with('internaltrainings', $internaltrainings)
            ->with('isAdminHR',$isAdminHR);
	}

	public function showAfterActivityEvaluation($id)
	{
        $internal_training = Training::where('id', '=', $id)->first();
        $activityevaluation = Activity_Evaluation::where('internal_training_id', '=', $id)->first();
        $attendees = IT_Participant::join('participant_attendances','it_participants.id','=','participant_attendances.it_participant_id')
                        ->where('it_participants.internal_training_id','=',$id)
                        ->first();

        //dd($attendees);

        $isAdminHR = false;
        $existsAE = false;
        $hasAttendees = false;

        if($attendees)
        {
            $hasAttendees = true;

            if($activityevaluation)
            {
                $existsAE = true;

                if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
                {
                    $isAdminHR = true;
                }

                //$speaker = Speaker::where('internal_training_id', '=', $id)->pluck('id');
                //$speakerevaluation = Speaker_Evaluation::where('speaker_id', '=', $speaker)->first();
                
                return View::make('internal_trainings.after-activity-evaluation')
                    ->with('internal_training', $internal_training)
                    ->with('activityevaluation', $activityevaluation)
                    ->with('existsAE',$existsAE)
                    ->with('hasAttendees',$hasAttendees)
                    ->with('isAdminHR',$isAdminHR);

            }
            else
            {
                if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
                {
                    $isAdminHR = true;
                }

                return View::make('internal_trainings.after-activity-evaluation')
                    ->with('internal_training', $internal_training)
                    ->with('existsAE',$existsAE)
                    ->with('hasAttendees',$hasAttendees)
                    ->with('isAdminHR',$isAdminHR);
            }
        }
        else
        {
            if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
            {
                $isAdminHR = true;
            }

            return View::make('internal_trainings.after-activity-evaluation')
                    ->with('internal_training', $internal_training)
                    ->with('existsAE',$existsAE)
                    ->with('hasAttendees',$hasAttendees)
                    ->with('isAdminHR',$isAdminHR);   
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
            return Redirect::to('internal_trainings/'.$id.'/after-activity-evaluation')
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
            return Redirect::to('internal_trainings/'.$id.'/after-activity-evaluation');
        }
	}

	public function showTrainingEffectivenessReport($id)
	{
        $internal_training = Training::join('internal_trainings','trainings.id','=','internal_trainings.training_id')
                                ->where('id', '=', $id)
                                ->first();
        $activityevaluation = Activity_Evaluation::where('internal_training_id', '=', $id)->first();

        if($internal_training->evaluation_narrative != "" || $internal_training->recommendations != "")
        {
            $tereport = true;
        }
        else
        {
            $tereport = false;
        }

        $isAdminHR = false;
        $existsTER = false;
        $hasAE = false;

        if($activityevaluation)
        {
            $hasAE = true;

            if($tereport)
            {
                $existsTER = true;

                if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
                {
                    $isAdminHR = true;
                }
 
                return View::make('internal_trainings.training-effectiveness-report')
                    ->with('internal_training', $internal_training)
                    ->with('isAdminHR',$isAdminHR)
                    ->with('existsTER',$existsTER)
                    ->with('hasAE',$hasAE);
            }
            else
            {
                if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
                {
                    $isAdminHR = true;
                }

                return View::make('internal_trainings.training-effectiveness-report')
                    ->with('internal_training', $internal_training)
                    ->with('isAdminHR',$isAdminHR)
                    ->with('existsTER',$existsTER)
                    ->with('hasAE',$hasAE);
            }
        }
        else
        {
            if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
            {
                $isAdminHR = true;
            }

                return View::make('internal_trainings.training-effectiveness-report')
                    ->with('internal_training', $internal_training)
                    ->with('isAdminHR',$isAdminHR)
                    ->with('existsTER',$existsTER)
                    ->with('hasAE',$hasAE);           
        }
	}

	public function storeReport($id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'evaluation_narrative' => 'required',
            'recommendations' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/'.$id.'/training-effectiveness-report')
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
            return Redirect::to('internal_trainings/'.$id.'/training-effectiveness-report');
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
        $internaltraining = Internal_Training::where('training_id', '=', $id)->first();

		$schoolcollege = School_College::where('isActive', true)->lists('name','id');
		$department = Department::where('isActive', true)->lists('name','id');

        $date_start = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');
        
        $start_time_sched = Training_Schedule::where('isActive', '=', true)->where('training_id', '=', $id)->where('isStartDate', '=', 1)->pluck('timeslot');
        $timeArray_start = explode("-", $start_time_sched);
        $time_start_s_edit = $timeArray_start[0];
        $time_end_s = $timeArray_start[1];

        $end_time_sched = Training_Schedule::where('isActive', '=', true)->where('training_id', '=', $id)->where('isEndDate', '=', 1)->pluck('timeslot');
        $timeArray_end = explode("-", $end_time_sched);
        $time_start_e = $timeArray_end[0];
        $time_end_e = $timeArray_end[1];

        $sc = SkillsCompetencies::where('isActive', true)->lists('name');

        $currentscid = IT_Addressed_SC::where('internal_training_id', '=', $id)->lists('skills_competencies_id');
        $currentscs = array();

        foreach($currentscid as $key)
        {
            $scsname = SkillsCompetencies::where('isActive', '=', true)->where('id', '=', $key)->pluck('name');
            array_push($currentscs, $scsname);
        }

		return View::make('internal_trainings.edit')
			->with('internaltrainings', $internaltrainings)
            ->with('internaltraining', $internaltraining)
			->with('schoolcollege', $schoolcollege)
			->with('department', $department)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end)
            ->with('time_start_s_edit', $time_start_s_edit)
            ->with('time_end_s', $time_end_s)
            ->with('time_start_e', $time_start_e)
            ->with('time_end_e', $time_end_e)
            ->with('sc', $sc)
            ->with('currentscs', $currentscs);

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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'theme_topic' => 'required|max:255'
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
            $trainings = Training::find($id);
            $trainings->title = Input::get('title');
            $trainings->theme_topic = Input::get('theme_topic');
            $trainings->venue = Input::get('venue');
            $trainings->isInternalTraining = 1;
            $trainings->save();         

            $trainingid = Training::where('id', '=', $id);

            DB::table('internal_trainings')
            ->where('training_id', $id)
            ->update(array(
                'format' => Input::get('format'),
                'objectives' => Input::get('objectives'),
                'expected_outcome' => Input::get('expected_outcome'),
                'evaluation_narrative' => "",
                'recommendations' => "",
                'organizer_schools_colleges_id' => Input::get('organizer_schools_colleges_id'),
                'organizer_department_id' => Input::get('organizer_department_id'),
                'isTrainingPlan' => Input::get('isTrainingPlan')
                ));

            /**Internal Trainings Table
            $internaltrainings = Internal_Training::where('training_id', '=', $trainings->id)->find($);

            $internaltrainings->format = Input::get('internal_training[format]');
            $internaltrainings->objectives = Input::get('internal_training[objectives]');
            $internaltrainings->expected_outcome = Input::get('internal_training[expected_outcome]');

            //initialize columns
            $internaltrainings->evaluation_narrative = "";
            $internaltrainings->recommendations = "";
            
            $internaltrainings->organizer_schools_colleges_id = Input::get('internal_training[organizer_schools_colleges_id]');
            $internaltrainings->organizer_department_id = Input::get('internal_training[organizer_department_id]');

            $internaltrainings->isTrainingPlan = Input::get('internal_training[isTrainingPlan]');

            $internaltrainings->save();*/

            //Schedule
            $time_start_s = Input::get('time_start_s_edit');
            $time_end_s = Input::get('time_end_s');
            $time_start_e = Input::get('time_start_e');
            $time_end_e = Input::get('time_end_e');

            $dsid = Training_Schedule::where('isActive', '=', true)->where('training_id', '=', $id)->where('isStartDate', '=', 1)->pluck('id');
            $deid = Training_Schedule::where('isActive', '=', true)->where('training_id', '=', $id)->where('isEndDate', '=', 1)->pluck('id');

            $startdate = Training_Schedule::find($dsid);
            $startdate->date_scheduled = Input::get('date_start');
            $startdate->timeslot = $time_start_s . "-" . $time_end_s;
            $startdate->isStartDate = 1;
            $startdate->isEndDate = 0;
            $startdate->training_id = $trainings->id;
            $startdate->save();

            /**$startdate = Training_Schedule::find($deid);
            $enddate->date_scheduled = Input::get('date_end');
            $enddate->timeslot = $time_start_e . "-" . $time_end_e;
            $enddate->isStartDate = 0;
            $enddate->isEndDate = 1;
            $enddate->training_id = $trainings->id;
            $enddate->save();*/

            DB::table('training_schedules')
            ->where('training_id', $id)
            ->where('id', $deid)
            ->update(array(
                'date_scheduled' => Input::get('date_end'),
                'timeslot' => $time_start_e . "-" . $time_end_e,
                ));
            
            //Tagged Skills and Competencies
            $selectedsc = Input::get('it_sc_edit');
            $scidArray = explode(",", $selectedsc);

            IT_Addressed_SC::where('internal_training_id', '=', $id)->delete();

            for($i = 0; $i < count($scidArray); $i++){
                $ITsc = new IT_Addressed_SC;
                $selectedid = SkillsCompetencies::where('isActive', '=', true)->where('name', '=', $scidArray[$i])->pluck('id');
                $ITsc->skills_competencies_id = $selectedid;
                $ITsc->internal_training_id = $trainings->id;
                $ITsc->save();
            }

            // redirect
            Session::flash('message', 'Successfully created the Internal Training!');
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
