<?php

class UploadsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($internal_training_id)
	{
		$internaltrainings = Training::with('internal_training')->find($internal_training_id);
		$internaltraining = Training::where('id', '=', $internal_training_id)->get();
        $testresponse = Activity_Evaluation::where('isActive', '=', true)->where('internal_training_id', '=', $internal_training_id)->get();
        
        if (is_null($testresponse)) {
            $intent = "accomplish";
        }
        else {
            $intent = "show";
        }

		return View::make('uploads.create')
			->with('internaltrainings', $internaltrainings)
            ->with('intent', $intent)
            ->with('internaltraining', $internaltraining);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * ACCEPTS:
	 *	- radio button 'isIndividual'
	 *	- file (Excel)
	 *	- text 'individual_id'
	 *
	 * @return Response
	 */
	public function store($internal_training_id)
	{
		date_default_timezone_set('Asia/Manila');
		$currentTimeDate = date("Y-m-d H:i:s"); 
		$currentTime = time("H:i:s"); 
		$currentDate = date("Y-m-d");

		//excel file must contain 2 columns (employee_number & time)
		if(Input::get('isIndividual') == 0) { //IF UPLOAD OPTION IS SELECTED
			if(file_exists(Input::file('file'))) {
				Excel::load(Input::file('file'), function($reader) {
					$results = $reader->get();

					//save the contents to the it_attendance table
					for ($i = 0; $i < count($results) ; $i++) { 
						$it_attendances = new Participant_Attendance;

						$exists = IT_Participant::where('employee_id', '=', $results[i]->employee_number)->where('internal_training_id', '=', $internal_training_id)->get();
						//$exists = Employee::where('employee_number', '=', $results[i]->employee_number)->where('isActive', '=', true);
						if($exists != null)	
						{
							$it_attendances->date = $currentDate; //Check this please
							if($results[$i]->time != null)
							{
								$it_attendances->time = $results[$i]->time;
							}
							else
							{
								$it_attendances->time = $currentTime; //Check this please
							}
							$it_attendances->it_participant_id = $exists->id;
							//$it_attendances->save();
						}
						else
						{
							$emp_valid = Employee::where('employee_number', '=', $results[i]->employee_number)->where('isActive', '=', true)->get();
							if($emp_valid != null)
							{
								//WRITE TO IT_PARTICIPANTS
								$it_participant = new IT_Participant;
								$it_participant->employee_id = Employee::where('employee_number', '=', $results[i]->employee_number)->where('isActive', '=', 1)->pluck('id');

								/**$emp_desig_temp = Employee_Designation::where('employee_id', '=', Employee::where('employee_number', '=', $results[i]->employee_number)->pluck('id'))->first();
								$it_participant->employee_designation_id = Employee_Designation::where('')*/

								$it_participant->internal_training_id = $internal_training_id;
								$it_participant->save();

								//WRITE TO PARTICIPANT_ATTENDANCES
								$exists2 = IT_Participant::where('employee_id', '=', $results[i]->employee_number)->where('internal_training_id', '=', $internal_training_id)->get();
								$it_attendances->date = $currentDate; //Check this please
								if($results[$i]->time != null)
								{
									$it_attendances->time = $results[$i]->time;
								}
								else
								{
									$it_attendances->time = $currentTime; //Check this please
								}
								$it_attendances->it_participant_id = $exists2->id;
								$it_attendances->save();
								}
							else
							{
								return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants')
									->withErrors('Employee number doesn\'t exist');
							}
						}
					}
					$it_attendances->save();
				});
			}
			else {
				echo 'No file selected';
			}
		}
		else if(Input::get('isIndividual') == 1) { //IF INDIVIDUAL OPTION IS SELECTED
			if(Input::get('individual_id') != "") {
				$individual_id = Input::get('individual_id');
				$it_attendances = new Participant_Attendance;
				$exists = IT_Participant::where('employee_id', '=', $individual_id)->where('internal_training_id', '=', $internal_training_id)->get();
				if($exists != null)	
				{
					$it_attendances->date = $currentDate; //Check this please
					$it_attendances->time = $currentTime; //Check this please

					$it_attendances->it_participant_id = $exists->id;
					//$it_attendances->save();
				}
				else {
					$emp_valid = Employee::where('employee_number', '=', $individual_id)->where('isActive', '=', true)->get();
					if($emp_valid != null)
					{
						//WRITE TO IT_PARTICIPANTS
						$it_participant = new IT_Participant;
						$it_participant->employee_id = Employee::where('employee_number', '=', $individual_id)->where('isActive', '=', 1)->pluck('id');
						
						/**$emp_desig_temp = Employee_Designation::where('employee_id', '=', Employee::where('employee_number', '=', $results[i]->employee_number)->pluck('id'))->first();
						$it_participant->employee_designation_id = Employee_Designation::where('')*/
						
						$it_participant->internal_training_id = $internal_training_id;
						$it_participant->save();
						
						//WRITE TO PARTICIPANT_ATTENDANCES
						$exists2 = IT_Participant::where('employee_id', '=', $individual_id)->where('internal_training_id', '=', $internal_training_id)->get();
						$it_attendances->date = $currentDate; //Check this please
						$it_attendances->time = $currentTime; //Check this please
						
						$it_attendances->it_participant_id = $exists2->id;
						//$it_attendances->save();
						}
					else
					{
						return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants')
							->withErrors('Employee number doesn\'t exist');
					}
				}
				$it_attendances->save();
			}
			else {
				return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants')
					->withErrors('Please input an employee number');
			}
		}
		else {
			return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants')
				->withErrors('Select if individual or batch');
		}
		return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
	}

	public function showUploadAttendance($internal_training_id)
	{
		$internaltrainings = Training::with('internal_training')->find($internal_training_id);
		$internaltraining = Training::where('id', '=', $internal_training_id)->get();
        $testresponse = Activity_Evaluation::where('isActive', '=', true)->where('internal_training_id', '=', $internal_training_id)->get();
        
        if (is_null($testresponse)) {
            $intent = "accomplish";
        }
        else {
            $intent = "show";
        }

		return View::make('uploads.create-attendance')
			->with('internaltrainings', $internaltrainings)
            ->with('intent', $intent)
            ->with('internaltraining', $internaltraining);
	}

	public function batchAttendance($internal_training_id)
	{
		date_default_timezone_set('Asia/Manila');
		$currentTimeDate = date("Y-m-d H:i:s"); 
		$currentTime = date("H:i:s");
		$currentDate = date("Y-m-d");

		if(file_exists(Input::file('file'))) {
			$results = Excel::load(Input::file('file'))->get();

			//save the contents to the it_attendance table
			for ($i = 0; $i < count($results[0]["employee_number"]) ; $i++) { 
				$it_attendances = new Participant_Attendance;
				$empid = Employee::where('isActive','=',true)->where('employee_number','=',$results[$i]["employee_number"])->pluck('id');
				$exists = IT_Participant::where('employee_id', '=', $empid)->where('internal_training_id', '=', $internal_training_id)->count();
				$partid = IT_Participant::where('employee_id', '=', $empid)->where('internal_training_id', '=', $internal_training_id)->pluck('id');
				if($exists != 0)	
				{
					$it_attendances->date = $currentDate; //Check this please
					if($results[$i]["time"] != null)
					{
						$it_attendances->time = $results[$i]["time"];
					}
					else
					{
						$it_attendances->time = $currentTime; //Check this please
					}
					$it_attendances->it_participant_id = $partid;
					//$it_attendances->save();
				}
				else
				{
					$emp_valid = Employee::where('employee_number', '=', $results[$i]["employee_number"])->where('isActive', '=', true)->count();
					if($emp_valid != 0)
					{
						//WRITE TO IT_PARTICIPANTS
						$it_participant = new IT_Participant;
						$it_participant->employee_id = Employee::where('employee_number', '=', $results[$i]["employee_number"])->where('isActive', '=', 1)->pluck('id');

						$emp_desig_temp = Employee_Designation::where('employee_id', '=', Employee::where('employee_number', '=', $results[$i]->employee_number)->pluck('id'))->first();
						$it_participant->employee_designation_id = $emp_desig_temp;

						$it_participant->internal_training_id = $internal_training_id;
						$it_participant->save();

						//WRITE TO PARTICIPANT_ATTENDANCES
						$it_attendances->date = $currentDate; //Check this please
						if($results[$i]["time"] != null)
						{
							$it_attendances->time = $results[$i]["time"];
						}
						else
						{
							$it_attendances->time = $currentTime; //Check this please
						}
						$it_attendances->it_participant_id = $it_participant->id;
						$it_attendances->save();
					}
					else
					{
						return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
					}
					return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
				}
				return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
			}
			return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
		}
		return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
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

	public function createParticipant($internal_training_id)
	{
		$internaltrainings = Training::with('internal_training')->find($internal_training_id);
		$internaltraining = Training::where('id', '=', $internal_training_id)->get();
        $testresponse = Activity_Evaluation::where('isActive', '=', true)->where('internal_training_id', '=', $internal_training_id)->get();
        
        if (is_null($testresponse)) {
            $intent = "accomplish";
        }
        else {
            $intent = "show";
        }

		return View::make('uploads.create-participant')
			->with('internaltrainings', $internaltrainings)
            ->with('intent', $intent)
            ->with('internaltraining', $internaltraining);
	}

	public function storeParticipant($internal_training_id)
	{
		date_default_timezone_set('Asia/Manila');
		$currentTimeDate = date("Y-m-d H:i:s"); 
		$currentTime = date("H:i:s");
		$currentDate = date("Y-m-d");

		if(file_exists(Input::file('file'))) {
			$results = Excel::load(Input::file('file'))->get();

			for ($i = 0; $i < count($results[0]["employee_number"]) ; $i++) { 
				$it_participant = new IT_Participant;
				$x = Employee::where('employee_number', '=', $results[$i]["employee_number"])->where('isActive', '=', 1)->pluck('id');
				dd($x);
				$it_participant->employee_id = $x;

				$emp_desig_temp = Employee_Designation::where('employee_id', '=', Employee::where('employee_number', '=', $results[$i]->employee_number)->pluck('id'))->first();
				$it_participant->employee_designation_id = $emp_desig_temp;

				$it_participant->internal_training_id = $internal_training_id;
				$it_participant->save();
			}
		}

		return Redirect::to('/internal_trainings/'.$internal_training_id.'/participants');
	}

}
