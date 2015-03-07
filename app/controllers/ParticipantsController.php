<?php

class ParticipantsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($internal_training_id)
	{
		$internaltraining = Training::find($internal_training_id);

		$employees = Employee::where('isActive', true)->get()->lists('full_name','id');

		$isAdminHR = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;       
        }

		if(Request::ajax()){
			$participants = IT_Participant::where('internal_training_id', '=', $internal_training_id)
							->where('isActive','=',true)
							->get();

			return Response::json(['data' => $participants]);
		}
		else
		{
			$participants = IT_Participant::where('internal_training_id', '=', $internal_training_id)
							->get();	    

			return View::make('internal_trainings.participants')
				->with('internal_training', $internaltraining)
				->with('employees',$employees)
				->with('isAdminHR',$isAdminHR)
				->with('participants',$participants);
		}
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
	public function store($internal_training_id)
	{
		$rules = array(
            'employee' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
         if ($validator->fails()) {
         	return Response::json([
         		'success' => false,
         		'errors' => $validator->errors()->toArray()]
         	);
         } else {
            // store
            $it_participant = new IT_Participant;
            $it_participant->employee_id = Input::get('employee');
            $it_participant->employee_designation_id = 1;
            $it_participant->internal_training_id = $internal_training_id;
            $it_participant->save();

            $participant_assessment = new Participant_Assessment;
            $participant_assessment->type = 'pta';
            $participant_assessment->it_participant_id = $it_participant->id;
            $participant_assessment->save();

            $supervisor = Employee_Designation::find($it_participant->employee_designation_id);

            $notification = new Notification;
            $notification->type = 'pta';
            $notification->training_link = $internal_training_id;
            $notification->participant_link = $it_participant->id;
            $notification->user_id = $supervisor->supervisor->user_id;
            $notification->save();

            $training_title = Training::where('id', '=', $internal_training_id)->pluck('title');
			Mail::send('mail.accomplish-pta', array('training_title' => $training_title), 
                function($message)
                {
                    $desigs = Employee_Designation::where('employee_id', '=', Input::get('employee'))->get();
                    $emails = array();
                    foreach ($desigs as $key => $value) {
                        $init = User::where('id', '=', $value->supervisor->user_id)->first();
                        array_push($emails, $init->email);
                    }

                    foreach ($emails as $key1 => $value1) {
                        $message->to($value1, 'CEU HR Admin')->subject('Your Employee will Attend a Training');
                    }
                }
            );        

            return Response::json(['success' => true]);
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
		$it_participant = IT_Participant::where('internal_training_id','=',$id)->first();
		$it_participant->isActive = false;
		$it_participant->save();	

		return Response::json(['success' => true]);
	}


}
