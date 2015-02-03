<?php

class ITAttendanceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($encrypted_id)
	{
		$id = Crypt::decrypt($encrypted_id);

		$training = Training::find($id);

		$training_title = $training->title;

		/*
			if (not yet expired)
				return Attendance page
			else //if expired
				return Expired Page
		*/

		return View::make('internal_trainings.attendance')
					->with('encrypted_id',$encrypted_id)
					->with('title',$training_title);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($encrypted_training_id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'employee_number' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        	);
        } else {

        	$employee = Employee::where('employee_number','=',Input::get('employee_number'))
        					->first();

        	if($employee)
        	{
        		$training_id = Crypt::decrypt($encrypted_training_id);

        		$participant = IT_Participant::where('employee_id','=',$employee->id)->first();

        		if($participant)
        		{
        			$new_attendance = new Participant_Attendance;
        			date_default_timezone_set('Asia/Manila');
        			$new_attendance->date = date('Y/m/d', time());;
        			$new_attendance->time = date('h:i:s', time());;
        			$new_attendance->it_participant_id = $participant->id;
        			$new_attendance->save();
        		}
        		else
        		{
        			$new_participant = new IT_Participant;
        			$new_participant->employee_id = $employee->id;
        			$new_participant->internal_training_id = $training_id;
        			$new_participant->save();

        			$new_attendance = new Participant_Attendance;
        			date_default_timezone_set('Asia/Manila');
        			$new_attendance->date = date('Y/m/d', time());;
        			$new_attendance->time = date('h:i:s', time());;
        			$new_attendance->it_participant_id = $new_participant->id;
        			$new_attendance->save();
        		}

        		return Response::json([
	        		'success' => true,
	        		'result' => $employee
        		]);

        	}
        	else
        	{
        		return Response::json([
        			'success' => false
        		]);
        	}

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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
