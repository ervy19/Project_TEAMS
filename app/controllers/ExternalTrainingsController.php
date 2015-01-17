<?php

class ExternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$externaltrainings = External_Training::where('isActive', '=', true)->get();

		return View::make('external_trainings.index')
			->with('externaltrainings', $externaltrainings );
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
		$externaltrainingsqueue = DB::table('et_queues')
            ->join('employees','et_queues.designation_id','=','employees.id')
            ->select('et_queues.id','employees.last_name','employees.given_name','employees.middle_initial','et_queues.title','et_queues.theme_topic','et_queues.participation','et_queues.organizer','et_queues.venue','et_queues.date_start','et_queues.date_end')
            ->get();

		return View::make('external_trainings.pending-approval')
			->with('externaltrainingsqueue', $externaltrainingsqueue );
	}

	public function createQueue()
	{
		return View::make('submit-external-training');
	}

	public function storeQueue()
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'employee_number' => 'required',
            'title' => 'required',
            'theme_topic' => 'required',
            'participation' => 'required',
            'organizer' => 'required',
            'venue' => 'required',
            'date_start' => 'required',
            'date_end' => 'required'

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
                ->first();

            if ($employee)
            {
                // store
                $externaltrainings = new ET_Queue;
                $externaltrainings->title = Input::get('title');
                $externaltrainings->theme_topic = Input::get('theme_topic');
                $externaltrainings->participation = Input::get('participation');
                $externaltrainings->organizer = Input::get('organizer');
                $externaltrainings->venue = Input::get('venue');
                $externaltrainings->date_start = Input::get('date_start');
                $externaltrainings->date_end = Input::get('date_end');
                $externaltrainings->designation_id = $employee->id;
                $externaltrainings->save();

                $employee_number = $employee->employee_number;

                return Redirect::to('success-external-training')
                    ->with('message',$employee_number);
            }
            else {
                return Redirect::to('submit-external-training')
                    ->withErrors('MAY MALI!!!');  
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
            $externaltraining->date_start = Input::get('date_start');
            $externaltraining->date_end = Input::get('date_end');
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
