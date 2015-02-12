<?php

class EmployeesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$employees = Employee::where('isActive', '=', true)->get();

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
				$employee_designation->campus_id = Campus::where('name', '=', array_get($myInputs, '1'))->pluck('id');
				$employee_designation->schools_colleges_id = School_College::where('name', '=', array_get($myInputs, '2'))->pluck('id');
				$employee_designation->department_id = Department::where('name', '=', array_get($myInputs, '3'))->pluck('id');
				$employee_designation->supervisor_id = Supervisor::where('id', '=', array_get($myInputs, '4'))->pluck('id');
				$employee_designation->position_id = Position::where('title', '=', array_get($myInputs, '5'))->pluck('id');
				$employee_designation->rank_id = Rank::where('title', '=', array_get($myInputs, '6'))->pluck('id');
				
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
		$employee = Employee::find($id);

		$designations = Employee_Designation::select(DB::raw('employee_designations.id, positions.title as position_title, ranks.title as rank_title, schools_colleges.name as school_college_name, departments.name as department_name, campuses.name as campus_name'))
								->leftJoin('positions','positions.id','=','employee_designations.position_id')
								->leftJoin('ranks','ranks.id','=','employee_designations.rank_id')
								->leftJoin('schools_colleges','schools_colleges.id','=','employee_designations.schools_colleges_id')
								->leftJoin('departments','departments.id','=','employee_designations.department_id')
								->leftJoin('campuses','campuses.id','=','employee_designations.campus_id')
								->where('employee_designations.isActive', '=', true)
								->get();

		//$supervisor = DB::table('')

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
        	
        	array_push(${'selected_array'.$i}, $current->type);
			array_push(${'selected_array'.$i}, Campus::where('id', '=', $current->campus_id)->pluck('name'));
			array_push(${'selected_array'.$i}, School_College::where('id', '=', $current->schools_colleges_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Department::where('id', '=', $current->department_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Supervisor::where('id', '=', $current->supervisor_id)->pluck('id'));
			array_push(${'selected_array'.$i}, Position::where('id', '=', $current->position_id)->pluck('title'));
			array_push(${'selected_array'.$i}, Rank::where('id', '=', $current->rank_id)->pluck('title'));
        	
        	array_push($selected_data, ${'selected_array'.$i});
        }
        
        //Get all internal trainings of the employee
        $it_attended = Training::select(DB::raw('*'))
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
        			->get();

		return View::make('employees.show')
			->with('employees', $employee )
			->with('selected_data', $selected_data)
			->with('it_attended', $it_attended)
			->with('et_attended', $et_attended)
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
        	
        	array_push(${'selected_array'.$i}, $current->type);
			array_push(${'selected_array'.$i}, Campus::where('id', '=', $current->campus_id)->pluck('name'));
			array_push(${'selected_array'.$i}, School_College::where('id', '=', $current->schools_colleges_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Department::where('id', '=', $current->department_id)->pluck('name'));
			array_push(${'selected_array'.$i}, Supervisor::where('id', '=', $current->supervisor_id)->pluck('id'));
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
			->with('selected_data', $selected_data); 
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
        	$count = Employee_Designation::where('employee_id', '=', $id)->count();

            // update
            $employees = Employee::find($id);
            $employees->employee_number = Input::get('employee_number');
            $employees->last_name = Input::get('last_name');
            $employees->given_name = Input::get('given_name');
            $employees->middle_initial = Input::get('middle_initial');
            $employees->email = Input::get('email');
            $employees->age = Input::get('age');
            $employees->tenure = Input::get('tenure');
            $employees->save();

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

	public function getEmployeeDesignation($id)
	{
		if(Request::ajax())
		{
			$employee_designations = Employee_Designation::select('*')
									->join('positions','employee_designations.position_id','=','positions.id')
									->where('employee_designations.isActive','=',true)
									->get();

			if ($employee_designations)
			{
				return Response::json(['data' => $employee_designations]);
			}
			else
			{

			}			
		}
	}

	public function getTrainingLog($id)
	{
		//get employee details
		$emp_details = Employee::where('id', '=', $id)->get();

		//get employee designation details
		$desig_id = Employee_Designation::where('employee_id', '=', $id)->first();
		$emp_desig_details = array();

		//try {
			array_push($emp_desig_details, $desig_id->type);
			array_push($emp_desig_details, Campus::where('id', '=', $desig_id->campus_id)->pluck('name'));
			array_push($emp_desig_details, School_College::where('id', '=', $desig_id->schools_colleges_id)->pluck('name'));
			array_push($emp_desig_details, Department::where('id', '=', $desig_id->department_id)->pluck('name'));



		        //Get all internal trainings of the employee
		        $it_attended = Training::select(DB::raw('*'))
		        			->leftJoin('it_attendances', 'it_attendances.internal_training_id', '=', 'trainings.id')
		        			->leftJoin('internal_trainings', 'internal_trainings.training_id', '=', 'it_attendances.internal_training_id')
		        			->leftJoin('schools_colleges', 'schools_colleges.id','=','internal_trainings.organizer_schools_colleges_id')
		        			//->leftJoin('departments', 'departments.id', '=', 'internal_trainings.organizer_department_id')
		        			->where('it_attendances.employee_id', '=', $id)
		        			->where('trainings.isInternalTraining', '=', 1)
		        			->where('trainings.isActive', '=', 1)
		        			->get();
		 
		        //get all external trainings of the employee
		        $et_attended = Training::select(DB::raw('*'))
		        			->leftJoin('external_trainings', 'external_trainings.training_id', '=', 'trainings.id')
		        			->leftJoin('employee_designations', 'employee_designations.id', '=', 'external_trainings.designation_id')
		        			->where('employee_designations.employee_id', '=', $id)
		        			->where('trainings.isActive', '=', true)
		        			->where('trainings.isInternalTraining', '=', 0)
		        			->get();
		
	/**	}
		catch (Exception $e) {
			Session::flash('error', 'Employee has no designations');
			return Redirect::to('employees');
		}**/
		

		return View::make('reports.training-log')
			->with('it_attended', $it_attended)
			->with('et_attended', $et_attended)
			->with('emp_details', $emp_details)
			->with('emp_desig_details', $emp_desig_details);
		
		//return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
	}
}
