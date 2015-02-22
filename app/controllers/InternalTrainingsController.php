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
                                ->leftJoin('departments','internal_trainings.organizer_department_id','=','departments.id')
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
            'isTrainingPlan' => 'required',
            'schoolcollege' => 'required_without:department',
            'department' => 'required_without:schoolcollege'
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
            
            $schoolcollege = Input::get('schoolcollege');
            if ($schoolcollege == "")
            {}
            else
            {
                $internaltrainings->organizer_schools_colleges_id = $schoolcollege;
            }

            $department = Input::get('department');
            if ($department == "")
            {}
            else
            {
                $internaltrainings->organizer_department_id = $department;
            }

            $internaltrainings->isTrainingPlan = Input::get('isTrainingPlan');

            $internaltrainings->save();

            //Schedule
            $time_start_s = Input::get('timestart1');
            $time_end_s = Input::get('timeend1');
            $date1 = Input::get('date1');

            if($date1 == "")
            {

            }
            else
            {
                $dateCount = Input::get('countbox');
                $dateCountInt = (int)$dateCount;

                if ($dateCountInt == 1)
                {
                    $startdate = new Training_Schedule;
                    $date1 = Input::get('date1');
                    $startdate->date_scheduled = date("Y-m-d", strtotime($date1));
                    $startdate->timeslot = $time_start_s . "-" . $time_end_s;
                    $startdate->isStartDate = 1;
                    $startdate->isEndDate = 1;
                    $startdate->training_id = $trainings->id;
                    $startdate->save();
                }
                else if($dateCountInt > 1)
                {

                    for($i=1; $i<=$dateCountInt; $i++)
                    {
                        $last = $dateCountInt;
                        if($i == 1)
                        {
                            $timestart2 = Input::get('timestart1');
                            $timeend2 = Input::get('timeend1');

                            $startdate = new Training_Schedule;
                            $date2 = Input::get('date1');
                            $startdate->date_scheduled = date("Y-m-d", strtotime($date2));
                            $startdate->timeslot = $timestart2 . "-" . $timeend2;
                            $startdate->isStartDate = 1;
                            $startdate->isEndDate = 0;
                            $startdate->training_id = $trainings->id;
                            $startdate->save();
                        }
                        else if($i == $last)
                        {
                            $timestartlast = Input::get("timestart".$i);
                            $timeendlast = Input::get("timeend".$i);

                            $startdate = new Training_Schedule;
                            $lastdate = Input::get("date".$i);
                            $startdate->date_scheduled = date("Y-m-d", strtotime($lastdate));
                            $startdate->timeslot = $timestartlast . "-" . $timeendlast;
                            $startdate->isStartDate = 0;
                            $startdate->isEndDate = 1;
                            $startdate->training_id = $trainings->id;
                            $startdate->save();
                        }
                        else
                        {
                            $timestart = Input::get("timestart".$i);
                            $timeend = Input::get("timeend".$i);

                            $startdate = new Training_Schedule;
                            $datescheduled = Input::get("date".$i);
                            $startdate->date_scheduled = date("Y-m-d", strtotime($datescheduled));
                            $startdate->timeslot = $timestart . "-" . $timeend;
                            $startdate->isStartDate = 0;
                            $startdate->isEndDate = 0;
                            $startdate->training_id = $trainings->id;
                            $startdate->save();
                        }
                    }
                }
            }

            //Tagged Skills and Competencies
            $selectedsc = Input::get('scit');
            if($selectedsc == "")
            {}
            else 
            {
                $scidArray = explode(",", $selectedsc);

                for($i = 0; $i < count($scidArray); $i++){
                    $ITsc = new IT_Addressed_SC;
                    $selectedid = SkillsCompetencies::where('isActive','=',true)->where('name', '=', $scidArray[$i])->pluck('id');
                    $ITsc->skills_competencies_id = $selectedid;
                    $ITsc->internal_training_id = $trainings->id;
                    $ITsc->save();
                }
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
        $hasParticipants = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;

            $encrypted_training_id = Crypt::encrypt($id);

            $speakers = Speaker::where('internal_training_id', '=', $id)->first();

            if($speakers)
            {
                $hasSpeakers = true;
            }

            $participants = IT_Participant::where('internal_training_id','=',$id)
                                ->where('isActive','=',true)
                                ->get();

            $countComplete = 0;
            $countPTAttendance = 0;
            $countPTAOnly = 0;
            $countAttendedOnly = 0;
            $countNoReq = 0;

            if(!$participants->isEmpty())
            {
                $hasParticipants = true;
                
                $a = 0; $b = 0; $c = 0; $d = 0; $e = 0;

                foreach ($participants as $key => $value) {
                    if($value->has_pta && $value->attended && $value->has_pte)
                    {
                        //Complete requirements
                        $a++;
                    }
                    else if ($value->has_pta && $value->attended)
                    {
                        //PTA and Attendance only
                        $b++;
                    }
                    else if ($value->has_pta)
                    {
                        //Has PTA only
                        $c++;
                    }
                    else if ($value->attended)
                    {
                        //Has attended only
                        $d++;
                    }
                    else
                    {
                        $e++;
                    }
                }

                $countComplete = round($a/count($participants),2);
                $countPTAttendance = round($b/count($participants),2);
                $countPTAOnly = round($c/count($participants),2);
                $countAttendedOnly = round($d/count($participants),2);
                $countNoReq = round($e/count($participants),2);
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
                ->with('hasSpeakers',$hasSpeakers)
                ->with('hasParticipants',$hasParticipants)
                ->with('countComplete',$countComplete)
                ->with('countPTAttendance',$countPTAttendance)
                ->with('countPTAOnly',$countPTAOnly)
                ->with('countAttendedOnly',$countAttendedOnly)
                ->with('countNoReq',$countNoReq);
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
        $speakerevaluation = Speaker::where('isActive','=',true)->where('internal_training_id','=',$id)->get();

        $attendees = IT_Participant::join('participant_attendances','it_participants.id','=','participant_attendances.it_participant_id')
            ->where('it_participants.internal_training_id','=',$id)
            ->first();

        $speakersid = Speaker::where('isActive','=',true)->where('internal_training_id','=',$id)->lists('id');
        $speakers = Speaker::where('isActive','=',true)->where('internal_training_id','=',$id)->get();
        
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

                $speakerevaluation = array();

                foreach($speakersid as $value)
                {
                    $speval = Speaker_Evaluation::where('isActive','=',true)->where('speaker_id','=',$value)->first();
                    $name = Speaker::where('isActive','=',true)->where('id','=',$value)->pluck('name');
                    array_push($speakerevaluation, array( 'name' => $name, 'id' => $speval->speaker_id, "evaluation_criterion1_".$speval->speaker_id => $speval->evaluation_criterion1, "evaluation_criterion2_".$speval->speaker_id => $speval->evaluation_criterion2, "evaluation_criterion3_".$speval->speaker_id => $speval->evaluation_criterion3));
                }

                //$speaker = Speaker::where('internal_training_id', '=', $id)->pluck('id');
                //$speakerevaluation = Speaker_Evaluation::where('speaker_id', '=', $speaker)->first();
                
                return View::make('internal_trainings.after-activity-evaluation')
                    ->with('internal_training', $internal_training)
                    ->with('activityevaluation', $activityevaluation)
                    ->with('existsAE',$existsAE)
                    ->with('hasAttendees',$hasAttendees)
                    ->with('isAdminHR',$isAdminHR)
                    ->with('speakers', $speakers)
                    ->with('speakerevaluation', $speakerevaluation);

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
                    ->with('isAdminHR',$isAdminHR)
                    ->with('speakers', $speakers);
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
            'planning_criterion1' => 'required|numeric',
            'planning_criterion2' => 'required|numeric',
            'objectives_criterion1' => 'required|numeric',
            'objectives_criterion2' => 'required|numeric',
            'objectives_criterion3' => 'required|numeric',
            'content_criterion1' => 'required|numeric',
            'content_criterion2' => 'required|numeric',
            'materials_criterion1' => 'required|numeric',
            'materials_criterion2' => 'required|numeric',
            'schedule_criterion1' => 'required|numeric',
            'schedule_criterion2' => 'required|numeric',
            'schedule_criterion3' => 'required|numeric',
            'openForum_criterion1' => 'required|numeric',
            'openForum_criterion2' => 'required|numeric',
            'openForum_criterion3' => 'required|numeric',
            'venue_criterion1' => 'required|numeric',
            'venue_criterion2' => 'required|numeric',
            'comments' => 'required'
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
            $speakers = Speaker::where('isActive','=',true)->where('internal_training_id','=',$id)->lists('id');
            foreach($speakers as $value)
            {
                $speakerevaluation = new Speaker_Evaluation;
                $speakerevaluation->evaluation_criterion1 = Input::get("evaluation_criterion1_" . $value);
                $speakerevaluation->evaluation_criterion2 = Input::get("evaluation_criterion2_" . $value);
                $speakerevaluation->evaluation_criterion3 = Input::get("evaluation_criterion3_" . $value);
                $speakerevaluation->speaker_id = $value;
                $speakerevaluation->save(); 
            }
            

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
	public function edit($training_id)
	{
		$internaltrainings = Training::with('internal_training')->find($training_id);
        $internaltraining = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->first();

        $schoolcollegeid = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->pluck('organizer_schools_colleges_id');
        $departmentid = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->pluck('organizer_department_id');

        $selectedschoolcollege = School_College::where('isActive', '=', true)->where('id', '=', $schoolcollegeid)->pluck('name');
        $selecteddepartment = Department::where('isActive', '=', true)->where('id', '=', $departmentid)->pluck('name');

		$schoolcollege = School_College::where('isActive', true)->lists('name','id');
		$department = Department::where('isActive', true)->lists('name','id');

        //selected values
        $sschoolcollege = Internal_Training::where('isActive','=',true)->where('training_id','=',$training_id)->pluck('organizer_schools_colleges_id');
        $sdepartment = Internal_Training::where('isActive','=',true)->where('training_id','=',$training_id)->pluck('organizer_department_id');

        $dateschedule = Training_Schedule::where('isActive','=',true)->where('training_id','=',$training_id)->lists('id');
        $count = 1;
        $totalcount = 0;
        $schedules = array();

        foreach($dateschedule as $tsid)
        {
            $datedb = Training_Schedule::where('isActive','=',true)->where('id','=',$tsid)->pluck('date_scheduled');
            $dateformat = new DateTime($datedb);
            $date = DATE_FORMAT($dateformat,'F d, Y');
            $timeslot = Training_Schedule::where('isActive','=',true)->where('id','=',$tsid)->pluck('timeslot');
            $timeArray_start = explode("-", $timeslot);
            $time_start = $timeArray_start[0];
            $time_end = $timeArray_start[1];
            array_push($schedules, array('count' => $count, 'date' => $date, 'timestart' => $time_start, 'timeend' => $time_end));
            $count++;
            $totalcount++;
        }

        $sc = SkillsCompetencies::where('isActive', true)->lists('name');

        $currentscid = IT_Addressed_SC::where('internal_training_id', '=', $training_id)->lists('skills_competencies_id');
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
            ->with('sc', $sc)
            ->with('currentscs', $currentscs)
            ->with('schedules', $schedules)
            ->with('totalcount', $totalcount)
            ->with('selectedschoolcollege', $selectedschoolcollege)
            ->with('selecteddepartment', $selecteddepartment)
            ->with('sschoolcollege', $sschoolcollege)
            ->with('sdepartment', $sdepartment);

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
            'objectives' => 'required',
            'isTrainingPlan' => 'required',
            'schoolcollege' => 'required_without:department',
            'department' => 'required_without:schoolcollege'
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

            //Internal Trainings Table
            $internaltrainings = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $id)->first();
            $internaltrainings->training_id = $id;
            $internaltrainings->format = Input::get('format');
            $internaltrainings->objectives = Input::get('objectives');
            $internaltrainings->expected_outcome = Input::get('expected_outcome');
            
            //$internaltrainings->organizer_schools_colleges_id = Input::get('schoolcollege');
            //$internaltrainings->organizer_department_id = Input::get('department');
            
            //$schoolcollege = Input::get('schoolcollege');
            //$department = Input::get('department');

            $internaltraining = Internal_Training::where('isActive','=',true)->where('training_id','=',$id)
            ->update(array(
                    'organizer_schools_colleges_id' => Input::get('schoolcollege'),
                    'organizer_department_id' => Input::get('department')
                ));

            /**if ($schoolcollege == "")
            {}
            else
            {
                $internaltrainings->organizer_schools_colleges_id = 3;
            }

            $department = Input::get('department');
            if ($department == "")
            {}
            else
            {
                $internaltrainings->organizer_department_id = Input::get('department');
            }*/

            $internaltrainings->isTrainingPlan = Input::get('isTrainingPlan');

            $internaltrainings->save();

            //Schedule
            $time_start_s = Input::get('timestart1');
            $time_end_s = Input::get('timeend1');
            $date1 = Input::get('date1');

            if($date1 == "")
            {

            }
            else
            {
                Training_Schedule::where('training_id', '=', $id)->delete();

                $dateCount = Input::get('countbox');
                $dateCountInt = (int)$dateCount;

                if ($dateCountInt == 1)
                {
                    $startdate = new Training_Schedule;
                    $date1 = Input::get('date1');
                    $startdate->date_scheduled = date("Y-m-d", strtotime($date1));
                    $startdate->timeslot = $time_start_s . "-" . $time_end_s;
                    $startdate->isStartDate = 1;
                    $startdate->isEndDate = 1;
                    $startdate->training_id = $trainings->id;
                    $startdate->save();
                }
                else if($dateCountInt > 1)
                {

                    for($i=1; $i<=$dateCountInt; $i++)
                    {
                        $last = $dateCountInt;
                        if($i == 1)
                        {
                            $timestart2 = Input::get('timestart1');
                            $timeend2 = Input::get('timeend1');

                            $startdate = new Training_Schedule;
                            $date2 = Input::get('date1');
                            $startdate->date_scheduled = date("Y-m-d", strtotime($date2));
                            $startdate->timeslot = $timestart2 . "-" . $timeend2;
                            $startdate->isStartDate = 1;
                            $startdate->isEndDate = 0;
                            $startdate->training_id = $trainings->id;
                            $startdate->save();
                        }
                        else if($i == $last)
                        {
                            $timestartlast = Input::get("timestart".$i);
                            $timeendlast = Input::get("timeend".$i);

                            $startdate = new Training_Schedule;
                            $lastdate = Input::get("date".$i);
                            $startdate->date_scheduled = date("Y-m-d", strtotime($lastdate));
                            $startdate->timeslot = $timestartlast . "-" . $timeendlast;
                            $startdate->isStartDate = 0;
                            $startdate->isEndDate = 1;
                            $startdate->training_id = $trainings->id;
                            $startdate->save();
                        }
                        else
                        {
                            $timestart = Input::get("timestart".$i);
                            $timeend = Input::get("timeend".$i);

                            $startdate = new Training_Schedule;
                            $datescheduled = Input::get("date".$i);
                            $startdate->date_scheduled = date("Y-m-d", strtotime($datescheduled));
                            $startdate->timeslot = $timestart . "-" . $timeend;
                            $startdate->isStartDate = 0;
                            $startdate->isEndDate = 0;
                            $startdate->training_id = $trainings->id;
                            $startdate->save();
                        }
                    }
                }
            }

            //Tagged Skills and Competencies
            IT_Addressed_SC::where('internal_training_id', '=', $id)->delete();

            $selectedsc = Input::get('it_sc_edit');
            if($selectedsc == "")
            {}
            else 
            {
                $scidArray = explode(",", $selectedsc);

                for($i = 0; $i < count($scidArray); $i++){
                    $ITsc = new IT_Addressed_SC;
                    $selectedid = SkillsCompetencies::where('isActive',true)->where('name', "=", $scidArray[$i])->pluck('id');
                    $ITsc->skills_competencies_id = $selectedid;
                    $ITsc->internal_training_id = $trainings->id;
                    $ITsc->save();
                }
            }
            
            // redirect
            Session::flash('message', 'Successfully created the Internal Training!');
            return Redirect::to('internal_trainings');
        }
    }



	 /** Remove the specified resource from storage.
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
