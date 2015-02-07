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
             /*return Redirect::to('campuses')
                 ->withErrors($validator)
                 ->withInput(Input::except('password'));*/
         } else {
            // store
            $speakers = new IT_Participant;
            $speakers->employee_id = Input::get('employee');
            $speakers->employee_designation_id = 1;
            $speakers->internal_training_id = $internal_training_id;
            $speakers->save();

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
		//
	}


}
