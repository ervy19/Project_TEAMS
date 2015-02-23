<?php

class EmployeesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$employees = Employee::where('isActive', '=', true)->orderBy('created_at', 'DESC')->get();

		$isAdminHR = false;

        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR'))
        {
            $isAdminHR = true;
        }

		return View::make('employees.index')
			->with('employees', $employees )
			->with('isAdminHR',$isAdminHR);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$positions = Position::where('isActive', '=', true)->get();
		$ranks = Rank::where('isActive', '=', true)->get();
		$schools_colleges = School_College::where('isActive', '=', true)->get();
		$departments = Department::where('isActive', '=', true)->get();
		$campuses = Campus::where('isActive', '=', true)->get();
		$supervisors = Supervisor::where('isActive', '=', true)->get(); 

		return View::make('employees.create')
			->with('positions', $positions)
			->with('ranks', $ranks)
			->with('schools_colleges', $schools_colleges)
			->with('departments', $departments)
			->with('campuses', $campuses)
			->with('supervisors', $supervisors);
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
            'employee_number' => 'required|integer',
            'last_name' => 'required',
            'given_name' => 'required',
            'middle_initial' => 'required',
            'email' => 'required|email',
            'age' => 'required',
            'tenure' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('employees/create')
                ->withErrors($validator)
                ->withInput(Input::except('employee_number'));
        } else {
            // store to employees
            $employees = new Employee;
            $employees->employee_number = Input::get('employee_number');
            $employees->last_name = Input::get('last_name');
            $employees->given_name = Input::get('given_name');
            $employees->middle_initial = Input::get('middle_initial');
            $employees->email = Input::get('email');
            $employees->age = Input::get('age');
            $employees->tenure = Input::get('tenure');
            $employees->save();
		
            $limit = Input::get('count');
            //store to employees designation
			for($i = 1; $i <= $limit; $i++)
			{
				$myInputs = Input::get("myInputs".$i);
				$employee_designation = new Employee_Designation;
				$employee_designation->employee_id = $employees->id;
				
				$employee_designation->classifications = array_get($myInputs, '0');
				$employee_designation->title = array_get($myInputs, '1');
				$employee_designation->campus_id = Campus::where('name', '=', array_get($myInputs, '2'))->pluck('id');
				$employee_designation->schools_colleges_id = School_College::where('name', '=', array_get($myInputs, '3'))->pluck('id');
				$employee_designation->department_id = Department::where('name', '=', array_get($myInputs, '4'))->pluck('id');
				$employee_designation->supervisor_id = Supervisor::where('name', '=', array_get($myInputs, '5'))->pluck('id');
				$employee_designation->position_id = Position::where('title', '=', array_get($myInputs, '6'))->pluck('id');
				$employee_designation->rank_id = Rank::where('title', '=', array_get($myInputs, '7'))->pluck('id');
				
				$employee_designation->save();
			}

            // redirect
            Session::flash('message', 'Successfully added Employee!');
            return Redirect::to('employees');
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
		$employees = Employee::find($id);

		$designations = Employee_Designation::where('isActive', '=', true)
								->where('employee_id','=',$id)
								->first();

		//dd($designations);
        //Get all internal trainings of the employee
        /*$it_attended = Training::select(DB::raw('*'))
        			->leftJoin('internal_trainings', 'internal_trainings.training_id', '=', 'trainings.id')
        			->leftJoin('it_participants', 'it_participants.internal_training_id', '=', 'internal_trainings.training_id')
        			->where('it_participants.employee_id', '=', $id)
        			->where('trainings.isInternalTraining', '=', 1)
        			->where('trainings.isActive', '=', 1)
        			->get();

        $et_attended = Training::select(DB::raw('*'))
        			->leftJoin('external_trainings', 'external_trainings.training_id', '=', 'trainings.id')
        			->leftJoin('employee_designations', 'employee_designations.id', '=', 'external_trainings.designation_id')
        			->where('employee_designations.employee_id', '=', $id)
        			->where('trainings.isActive', '=', true)
        			->where('trainings.isInternalTraining', '=', 0)
        			->get();*/
        //dd($designations);
//dd($designations->department_scs);
		return View::make('employees.show')
			->with('employees', $employees )
			->with('designations', $designations);

			//->with('employees', $employee )
			//->with('designations', $designations);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employees = Employee::find($id);

		//Get employee details
		$employee_details = array('employee_number' => $employees->employee_number, 
									'last_name' => $employees->last_name, 
									'given_name' => $employees->given_name, 
									'middle_initial' => $employees->middle_initial,
									'email' => $employees->email,
									'age' => $employees->age,
									'tenure' => $employees->tenure
								);


		//count the number of employee designations
        $currentCount = Employee_Designation::where('employee_id', '=', $id)->count();

        //assign all employee designations to an array
        $emp_desig_array = Employee_Designation::where('employee_id', '=', $id)->get();

        //make array for each employee designation
        //put all employee designations to one array to pass to view
        $selected_data = array();
        for($i = 0; $i < $currentCount; $i++)
        {
        	${'selected_array'.$i} = array();
        	$current = array_get($emp_desig_array, $i);
        	
        	array_push(${'selected_array'.$i}, $current->classifications);
        	array_push(${'selected_array'.$i}, $current->title);
			array_push(${'selected_array'.$i}, Campus::where('id', '=', $current->campus_id)->pluck('name'));
			array_push(${'selected_array'.$i}, School_College::where('id', '=', $current->schools_colleges_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Department::where('id', '=', $current->department_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Supervisor::where('id', '=', $current->supervisor_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Position::where('id', '=', $current->position_id)->pluck('title'));
			array_push(${'selected_array'.$i}, Rank::where('id', '=', $current->rank_id)->pluck('title'));
        	
        	array_push($selected_data, ${'selected_array'.$i});
        }


        $positions = Position::where('isActive', '=', true)->get();
		$ranks = Rank::where('isActive', '=', true)->get();
		$schools_colleges = School_College::where('isActive', '=', true)->get();
		$departments = Department::where('isActive', '=', true)->get();
		$campuses = Campus::where('isActive', '=', true)->get();
		$supervisors = Supervisor::where('isActive', '=', true)->get(); 

		return View::make('employees.edit')
			->with('employees', $employees )
			->with('positions', $positions)
			->with('ranks', $ranks)
			->with('schools_colleges', $schools_colleges)
			->with('departments', $departments)
			->with('campuses', $campuses)
			->with('supervisors', $supervisors)
			->with('selected_data', $selected_data)
			->with('employee_details', $employee_details); 
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
            'employee_number' => 'required|integer',
            'last_name' => 'required',
            'given_name' => 'required',
            'middle_initial' => 'required',
            'email' => 'required|email',
            'age' => 'required',
            'tenure' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('employees/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
        	//count the number of employee designations
        	$count = Employee_Designation::where('employee_id', '=', $id)->where('isActive', '=', true)->count();

            //update employee
            $employees = Employee::find($id);
            $employees->employee_number = Input::get('employee_number');
            $employees->last_name = Input::get('last_name');
            $employees->given_name = Input::get('given_name');
            $employees->middle_initial = Input::get('middle_initial');
            $employees->email = Input::get('email');
            $employees->age = Input::get('age');
            $employees->tenure = Input::get('tenure');
            $employees->save();

            $limit = Input::get('count');
            //update employees designation
			for($i = 1; $i <= $limit; $i++)
			{
				if($i > $count) {
					$myInputs = Input::get("myInputs".$i);
					$new_desig = new Employee_Designation;

					$new_desig->classifications = array_get($myInputs, '0');
					$new_desig->title = array_get($myInputs, '1');
					$new_desig->employee_id = $employees->id;
					$new_desig->campus_id = Campus::where('name', '=', array_get($myInputs, '2'))->pluck('id');
					$new_desig->schools_colleges_id = School_College::where('name', '=', array_get($myInputs, '3'))->pluck('id');
					$new_desig->department_id = Department::where('name', '=', array_get($myInputs, '4'))->pluck('id');
					$new_desig->supervisor_id = Supervisor::where('name', '=', array_get($myInputs, '5'))->pluck('id');
					$new_desig->position_id = Position::where('title', '=', array_get($myInputs, '6'))->pluck('id');
					$new_desig->rank_id = Rank::where('title', '=', array_get($myInputs, '7'))->pluck('id');

					$new_desig->save();
				}
				else {
					$myInputs = Input::get("myInputs".$i);
					$employee_designation = Employee_Designation::where('employee_id', '=', $id)->where('isActive', '=', true)->get();
					
					$employee_designation[$i-1]->classifications = array_get($myInputs, '0');
					$employee_designation[$i-1]->title = array_get($myInputs, '1');
					$employee_designation[$i-1]->campus_id = Campus::where('name', '=', array_get($myInputs, '2'))->pluck('id');
					$employee_designation[$i-1]->schools_colleges_id = School_College::where('name', '=', array_get($myInputs, '3'))->pluck('id');
					$employee_designation[$i-1]->department_id = Department::where('name', '=', array_get($myInputs, '4'))->pluck('id');
					$employee_designation[$i-1]->supervisor_id = Supervisor::where('name', '=', array_get($myInputs, '5'))->pluck('id');
					$employee_designation[$i-1]->position_id = Position::where('title', '=', array_get($myInputs, '6'))->pluck('id');
					$employee_designation[$i-1]->rank_id = Rank::where('title', '=', array_get($myInputs, '7'))->pluck('id');
					
					$employee_designation[$i-1]->save();
				}
			}

            // redirect
            Session::flash('message', 'Successfully updated the Employee!');
            return Redirect::to('employees');
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
		$employees = Employee::find($id);
        $employees->isActive = false;
        $employees->save();

        // redirect
        Session::flash('message', 'Successfully deleted Employee!');
        return Redirect::to('employees');
	}

	public function showTrainingReport($id)
	{
		$employee = Employee::find($id);

		$it_count = Internal_Training::join('it_participants','it_participants.internal_training_id','=','internal_trainings.training_id')
						->where('it_participants.employee_id','=',$id)
						->count();

		$et_count = External_Training::join('employee_designations','external_trainings.designation_id','=','employee_designations.id')
								->where('employee_designations.employee_id','=',$id)
								->count();

		$average_pta = IT_Participant::select('it_participants.*', DB::raw('avg(participant_assessments.rating) AS average_score'))
							->join('participant_assessments','it_participants.id','=','participant_assessments.it_participant_id')
							->groupBy('participant_assessments.rating')
							->where('it_participants.employee_id','=',$id)
							->where('participant_assessments.type','=','pta')
							->first();

		$average_pte = IT_Participant::select('it_participants.*', DB::raw('avg(participant_assessments.rating) AS average_score'))
							->join('participant_assessments','it_participants.id','=','participant_assessments.it_participant_id')
							->groupBy('participant_assessments.rating')
							->where('it_participants.employee_id','=',$id)
							->where('participant_assessments.type','=','pte')
							->first();

		return View::make('summary_reports.employee_training')
					->with('employee',$employee)
					->with('itCount',$it_count)
					->with('etCount',$et_count)
					->with('averagePTA',$average_pta)
					->with('averagePTE',$average_pte);
	}

	public function getEmployeeDesignation($id)
	{
		if(Request::ajax())
		{
			$employee_designations = Employee_Designation::where('employee_id','=',$id)
										->where('isActive','=',true)
										->get();

			if (!$employee_designations->isEmpty())
			{
				return Response::json(['hasDesignation' => true, 'data' => $employee_designations]);
			}
			else
			{
				return Response::json(['hasDesignation' => false]);
			}			
		}
	}
}
