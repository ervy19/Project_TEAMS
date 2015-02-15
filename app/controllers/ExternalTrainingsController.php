<?php

class ExternalTrainingsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $externaltrainings = Training::where('isActive', '=', true)->where('isInternalTraining', '=', 0)->get();

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
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'theme_topic' => 'required',
            'participation' => 'required',
            'organizer' => 'required',
            'venue' => 'required',
            'schedule' => 'required',
            'designation_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store

            //trainings table
            $newtraining = new Training;
            $newtraining->title = Input::get('title');
            $newtraining->theme_topic = Input::get('theme_topic');
            $newtraining->venue = Input::get('venue');
            $newtraining->schedule = Input::get('schedule');
            $newtraining->isTrainingPlan = Input::get('isTrainingPlan');
            $newtraining->save();

            //external_trainings table
            $externaltrainings = new External_Training;
            $externaltrainings->participation = Input::get('participation');
            $externaltrainings->organizer = Input::get('organizer');
            $externaltrainings->designation_id = Input::get('designation_id');
            $externaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully created the External Training!');
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
        $externaltrainings = External_Training::find($id);

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
        $externaltrainings = ET_Queue::find($id);

        return View::make('external_trainings.edit')
            ->with('externaltrainings', $externaltrainings );
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
            'title' => 'required',
            'theme_topic' => 'required',
            'participation' => 'required',
            'organizer' => 'required',
            'venue' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'designation_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $externaltrainings = External_Training::find($id);
            $externaltrainings->title = Input::get('title');
            $externaltrainings->theme_topic = Input::get('theme_topic');
            $externaltrainings->participation = Input::get('participation');
            $externaltrainings->organizer = Input::get('organizer');
            $externaltrainings->venue = Input::get('venue');
            $externaltrainings->date_start = Input::get('date_start');
            $externaltrainings->date_end = Input::get('date_end');
            $externaltrainings->designation_id = Input::get('designation_id');
            $externaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully updated the External Training!');
            return Redirect::to('external_trainings');
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
        $externaltrainings = External_Training::find($id);
        $externaltrainings->isActive = false;
        $externaltrainings->save();

        // redirect
        Session::flash('message', 'Successfully deleted External Training!');
        return Redirect::to('external_trainings');
    }


    public function indexQueue()
    {
        $externaltrainingsqueue = ET_Queue::select('et_queues.id','employees.last_name','employees.given_name','employees.middle_initial','et_queues.title','et_queues.theme_topic','et_queues.participation','et_queues.organizer','et_queues.venue','training_schedules.date_scheduled','training_schedules.timeslot')
            ->join('employees','et_queues.employee_id','=','employees.id')
            ->join('training_schedules','et_queues.id','=','training_schedules.et_id')
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
        $date_start = "";
        $date_end = "";
        $time_start_s = "";
        $time_end_s = "";
        $time_start_e = "";
        $time_end_e = "";

        return View::make('submit-external-training')
            ->with('employee_number', $employee_number)
            ->with('title', $title)
            ->with('theme_topic', $theme_topic)
            ->with('participation', $participation)
            ->with('organizer', $organizer)
            ->with('venue', $venue)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end)
            ->with('time_start_s', $time_start_s)
            ->with('time_end_s', $time_end_s)
            ->with('time_start_e', $time_start_e)
            ->with('time_end_e', $time_end_e);
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
        $date_start = Input::get('date_start');
        $date_end = Input::get('date_end');

        $time_start_s = Input::get('time_start_s');
        $time_end_s = Input::get('time_end_s');
        $time_start_e = Input::get('time_start_e');
        $time_end_e = Input::get('time_end_e');

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
                $startdate = new Training_Schedule;
                $startdate->date_scheduled = Input::get('date_start');
                $startdate->timeslot = $time_start_s . "-" . $time_end_s;
                $startdate->isStartDate = 1;
                $startdate->isEndDate = 0;
                $startdate->et_id = $externaltrainings->id;
                $startdate->save();

                $enddate = new Training_Schedule;
                $enddate->date_scheduled = Input::get('date_end');
                $enddate->timeslot = $time_start_e . "-" . $time_end_e;
                $enddate->isStartDate = 0;
                $enddate->isEndDate = 1;
                $enddate->et_id = $externaltrainings->id;
                $enddate->save();

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
            ->select('et_queues.id','employees.last_name','employees.given_name','employees.middle_initial','et_queues.title','et_queues.theme_topic','et_queues.participation','et_queues.organizer','et_queues.venue','et_queues.date_start','et_queues.date_end')
            ->where('et_queues.id', '=', $id)
            ->get();

        if ($externaltraining)
        {
            return View::make('external_trainings.credit-external-training')
                ->with('externaltraining', $externaltraining );
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
            'organizer' => 'required',
            'venue' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
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
            $externaltraining = new External_Training;
            $externaltraining->title = Input::get('title');
            $externaltraining->theme_topic = Input::get('theme_topic');
            $externaltraining->participation = Input::get('participation');
            $externaltraining->organizer = Input::get('organizer');
            $externaltraining->venue = Input::get('venue');
            $externaltraining->designation_id = Input::get('designation_id');
            $externaltraining->save();

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
        return Redirect::to('external_trainings/pending-approvals');
    }

}
