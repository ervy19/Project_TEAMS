<?php

class ExternalTrainingsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $externaltrainings = External_Training::select('trainings.title','trainings.theme_topic','trainings.venue','external_trainings.participation','external_trainings.organizer','training_schedules.date_scheduled','training_schedules.timeslot','external_trainings.training_id')
            ->join('trainings','external_trainings.training_id','=','trainings.id')
            ->join('training_schedules','trainings.id','=','training_schedules.training_id')
            ->where('external_trainings.isActive','=',true)
            ->groupBy('external_trainings.training_id')
            ->get();

        $isAdminHR = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;
        }

        return View::make('external_trainings.index')
            ->with('externaltrainings', $externaltrainings )
            ->with('isAdminHR', $isAdminHR);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $schoolcollege = School_College::where('isActive', '=', true)->lists('name','id');
        $designation = Employee_Designation::where('isActive', '=', true)->get();
        
        return View::make('external_trainings.create')
            ->with('schoolcollege', $schoolcollege)
            ->with('designation', $designation);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        $rules = array(
            'title' => 'required',
            'theme_topic' => 'required',
            'participation' => 'required',
            'venue' => 'required',
            'designation_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store

            //Trainings Table
            $training = new Training;
            $training->title = Input::get('title');
            $training->theme_topic = Input::get('theme_topic');
            $training->venue = Input::get('venue');
            $training->isInternalTraining = 0;
            $training->isTrainingPlan = 0;
            $training->save();
         
            $externaltraining = new External_Training;
            $externaltraining->training_id = $training->id;
            $externaltraining->participation = Input::get('participation');
            $externaltraining->organizer = Input::get('organizer');
            $externaltraining->designation_id = Input::get('designation_id');
            $externaltraining->save();

            //Schedule
            $schedules = Training_Schedule::where('isActive','=',true)->where('et_id','=',$id)->lists('id');
            foreach($schedules as $value)
            {
                $sid = Training_Schedule::where('isActive','=',true)->where('id','=',$value)->first();
                $sid->et_id = NULL;
                $sid->training_id = $training->id;
                $sid->save();
            }

             //Tagged Skills and Competencies
            $selectedsc = Input::get('scet_credit');
            if($selectedsc == "")
            {}
            else 
            {
                $scidArray = explode(",", $selectedsc);

                for($i = 0; $i < count($scidArray); $i++){
                    $ETsc = new ET_Addressed_SC;
                    $selectedid = SkillsCompetencies::where('isActive',true)->where('name', "=", $scidArray[$i])->pluck('id');
                    $ETsc->skills_competencies_id = $selectedid;
                    $ETsc->external_training_id = $trainings->id;
                    $ETsc->save();
                }
            }
            

            // redirect
            Session::flash('message', 'Successfully credited the External Training!');
            return Redirect::to('external_trainings');
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
        $externaltrainings = External_Training::where('isActive', '=', true)->where('training_id', '=', $id)->first();

        return View::make('external_trainings.show')
            ->with('externaltrainings', $externaltrainings);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $externaltraining = External_Training::select(DB::raw('*'))
            ->join('trainings','external_trainings.training_id','=','trainings.id')
            ->join('training_schedules','trainings.id','=','training_schedules.training_id')
            ->where('external_trainings.training_id','=',$id)
            ->first();

        $designations = Employee_Designation::where('isActive','=',true)->where('id','=',$externaltraining->designation_id)->lists('title','id');
        $sc = SkillsCompetencies::where('isActive', true)->lists('name');

        $currentscid = ET_Addressed_SC::where('external_training_id', '=', $id)->lists('skills_competencies_id');
        $currentscs = array();

        foreach($currentscid as $key)
        {
            $scsname = SkillsCompetencies::where('isActive', '=', true)->where('id', '=', $key)->pluck('name');
            array_push($currentscs, $scsname);
        }

        $currentdesig = External_Training::where('isActive','=',true)->where('training_id','=',$id)->pluck('designation_id');

        return View::make('external_trainings.edit')
            ->with('externaltraining', $externaltraining)
            ->with('designations', $designations)
            ->with('sc', $sc)
            ->with('currentscs', $currentscs)
            ->with('currentdesig', $currentdesig);
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
            'designation' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store

            //Trainings Table
            $training = Training::find($id);
            /*$training->title = Input::get('title');
            $training->theme_topic = Input::get('theme_topic');
            $training->venue = Input::get('venue');*/
            $training->isInternalTraining = 0;
            $training->isTrainingPlan = 0;
            $training->save();
         
            $externaltraining = External_Training::where('isActive','=',true)->where('training_id','=',$id)
            ->update(array(
                    'training_id' => $training->id
                    /**'participation' => Input::get('participation'),
                    'organizer' => Input::get('organizer'),
                    'designation_id' => Input::get('designation'),*/
                ));

             //Tagged Skills and Competencies
            $selectedsc = Input::get('scet_credit');
            ET_Addressed_SC::where('external_training_id', '=', $id)->delete();

            if($selectedsc == "")
            {}
            else 
            {
                $scidArray = explode(",", $selectedsc);

                for($i = 0; $i < count($scidArray); $i++){
                    $ETsc = new ET_Addressed_SC;
                    $selectedid = SkillsCompetencies::where('isActive',true)->where('name', "=", $scidArray[$i])->pluck('id');
                    $ETsc->skills_competencies_id = $selectedid;
                    $ETsc->external_training_id = $training->id;
                    $ETsc->save();
                }
            }
            

            // redirect
            Session::flash('message', 'Successfully credited the External Training!');
            return Redirect::to('external_trainings');
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($training_id)
    {
        $externaltraining = External_Training::where('training_id','=',$training_id)
            ->update(array(
                    'isActive' => false
                ));

        // redirect
        Session::flash('message', 'Successfully deleted External Training!');
        return Redirect::to('external_trainings');
    }


    public function indexQueue()
    {
        $externaltrainingsqueue = ET_Queue::select('et_queues.id','employees.last_name','employees.given_name','employees.middle_initial','et_queues.title','et_queues.theme_topic','et_queues.participation','et_queues.organizer','et_queues.venue','training_schedules.date_scheduled','training_schedules.timeslot')
            ->join('employees','et_queues.employee_id','=','employees.id')
            ->join('training_schedules','et_queues.id','=','training_schedules.et_id')
            ->where('et_queues.isActive','=',true)
            ->groupBy('training_schedules.et_id')
            ->get();

        return View::make('external_trainings.pending-approval')
            ->with('externaltrainingsqueue', $externaltrainingsqueue);
    }

    public function createQueue()
    {
        $employee_number = "";
        $title = "";
        $theme_topic = "";
        $participation = "";
        $organizer = "";
        $venue = "";

        return View::make('submit-external-training')
            ->with('employee_number', $employee_number)
            ->with('title', $title)
            ->with('theme_topic', $theme_topic)
            ->with('participation', $participation)
            ->with('organizer', $organizer)
            ->with('venue', $venue);
    }

    public function confirmQueue()
    {
        $employee_number = Input::get('employee_number');
        $title = Input::get('title');
        $theme_topic = Input::get('theme_topic');
        $participation = Input::get('participation');
        $organizer = Input::get('organizer');
        $venue = Input::get('venue');
        $date_start = Input::get('date_start');
        $date_end = Input::get('date_end');

        return View::make('confirm-external-training')
            ->with('employee_number', $employee_number)
            ->with('title', $title)
            ->with('theme_topic', $theme_topic)
            ->with('participation', $participation)
            ->with('organizer', $organizer)
            ->with('venue', $venue)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end);
    }

    public function backDetails()
    {
        $employee_number = Input::get('employee_number');
        $title = Input::get('title');
        $theme_topic = Input::get('theme_topic');
        $participation = Input::get('participation');
        $organizer = Input::get('organizer');
        $venue = Input::get('venue');
        $date_start = Input::get('date_start');
        $date_end = Input::get('date_end');

        return View::make('submit-external-training')
            ->with('employee_number', $employee_number)
            ->with('title', $title)
            ->with('theme_topic', $theme_topic)
            ->with('participation', $participation)
            ->with('organizer', $organizer)
            ->with('venue', $venue)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end);
    }      

    public function storeQueue()
    {
        $employee_number = Input::get('employee_number');
        $title = Input::get('title');
        $theme_topic = Input::get('theme_topic');
        $participation = Input::get('participation');
        $organizer = Input::get('organizer');
        $venue = Input::get('venue');

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'employee_number' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('submit-external-training')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $employee = DB::table('employees')
                ->where('employee_number',Input::get('employee_number'))
                ->pluck('id');

            if (is_null($employee))
            {
                return Redirect::to('submit-external-training')
                    ->withErrors('Wrong Input!');  
            }
            else {
                // store
                $externaltrainings = new ET_Queue;
                $externaltrainings->title = $title;
                $externaltrainings->theme_topic = $theme_topic;
                $externaltrainings->participation = $participation;
                $externaltrainings->organizer = $organizer;
                $externaltrainings->venue = $venue;
                $externaltrainings->employee_id = $employee;
                $externaltrainings->save();

                //Schedule
                $time_start = Input::get('timestart1');
                $time_end = Input::get('timeend1');
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
                        $startdate->timeslot = $time_start . "-" . $time_end;
                        $startdate->isStartDate = 1;
                        $startdate->isEndDate = 1;
                        $startdate->et_id = $externaltrainings->id;
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
                                $startdate->et_id = $externaltrainings->id;
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
                                $startdate->et_id = $externaltrainings->id;
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
                                $startdate->et_id = $externaltrainings->id;
                                $startdate->save();
                            }
                        }
                    }
                }

                return View::make('success-external-training')
                    ->with('employee_number',$employee_number);
            }
        }
    }

    public function getQueue($id)
    {        
        $externaltraining = DB::table('et_queues')
            ->join('employees','et_queues.employee_id','=','employees.id')
            ->join('employee_designations','employees.id','=','employee_designations.employee_id')
            ->join('training_schedules','et_queues.id','=','training_schedules.et_id')
            ->select('employees.last_name','employees.given_name','employees.middle_initial','et_queues.title','et_queues.theme_topic','et_queues.participation','et_queues.organizer','et_queues.venue','training_schedules.date_scheduled','training_schedules.timeslot','training_schedules.et_id','employee_designations.employee_id','et_queues.id')
            ->where('et_queues.id', '=', $id)
            ->first();

        $schoolcollege = School_College::where('isActive', '=', true)->lists('name');
        $designations = Employee_Designation::where('isActive','=',true)->where('employee_id', '=', $externaltraining->employee_id)->lists('title','id');
        $sc = SkillsCompetencies::where('isActive', true)->lists('name');

        if ($externaltraining)
        {
            return View::make('external_trainings.credit-external-training')
                ->with('externaltraining', $externaltraining)
                ->with('schoolcollege', $schoolcollege)
                ->with('designations', $designations)
                ->with('sc', $sc);
        }
        else
        {
            return Redirect::to('external_trainings/pending-approval')
                    ->withErrors('Employee has no designation yet');
        }
    }

    public function creditQueue($id)
    {
           // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'theme_topic' => 'required',
            'participation' => 'required',
            'venue' => 'required',
            'designation' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store

            //Trainings Table
            $training = new Training;
            $training->title = Input::get('title');
            $training->theme_topic = Input::get('theme_topic');
            $training->venue = Input::get('venue');
            $training->isInternalTraining = 0;
            $training->isTrainingPlan = 0;
            $training->save();
         
            $externaltraining = new External_Training;
            $externaltraining->training_id = $training->id;
            $externaltraining->participation = Input::get('participation');
            $externaltraining->organizer = Input::get('organizer');
            $externaltraining->designation_id = Input::get('designation');
            $externaltraining->save();

            //Schedule
            $schedules = Training_Schedule::where('isActive','=',true)->where('et_id','=',$id)->lists('id');
            foreach($schedules as $value)
            {
                $sid = Training_Schedule::where('isActive','=',true)->where('id','=',$value)->first();
                $etid = $sid->et_id;
                $sid->et_id = NULL;
                $sid->training_id = $training->id;
                $sid->save();

                $et = ET_Queue::where('isActive','=',true)->where('id','=',$etid)
                ->update(array(
                    'isActive' => false
                ));
            }

             //Tagged Skills and Competencies
            $selectedsc = Input::get('scet_credit');
            if($selectedsc == "")
            {}
            else 
            {
                $scidArray = explode(",", $selectedsc);

                for($i = 0; $i < count($scidArray); $i++){
                    $ETsc = new ET_Addressed_SC;
                    $selectedid = SkillsCompetencies::where('isActive',true)->where('name', "=", $scidArray[$i])->pluck('id');
                    $ETsc->skills_competencies_id = $selectedid;
                    $ETsc->external_training_id = $training->id;
                    $ETsc->save();
                }
            }
            

            // redirect
            Session::flash('message', 'Successfully credited the External Training!');
            return Redirect::to('external_trainings');
        }
    }

    public function destroyQueue($id)
    {
        $externaltrainings = ET_Queue::find($id);
        $externaltrainings->isActive = false;
        $externaltrainings->save();

        // redirect
        Session::flash('message', 'Successfully deleted External Training!');
        return Redirect::to('external_trainings/queue');
    }

}
