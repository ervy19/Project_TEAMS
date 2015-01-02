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

		return View::make('employees.index')
			->with('employees', $employees );
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
		//$supervisors = School_College_Supervisor::where('isActive', '=', true)->get();
		//$supervisors = Department_Supervisor::where('isActive', '=', true)->get();
		$supervisors = Campus_Supervisor::where('isActive', '=', true)->get(); 

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
			for($i = 1; $i <= 2; $i++)
			{
				$myInputs = $_POST["myInputs" + $i];
				$employee_designation = new Employee_Designation;
				$employee_designation->type = "Employee_Type_Sample";
				$employee_designation->employee_id = $employees->id;

				$employee_designation->position_id = "1";
				$employee_designation->rank_id = "2";
				$employee_designation->schools_colleges_id = "3";
				$employee_designation->department_id = "1";
				$employee_designation->campus_id = "2";
				$employee_designation->supervisor_id = "1";
				/**
				$employee_designation->position_id = Position::where('id', '=', $myInputs[0])->pluck('id');
				$employee_designation->rank_id = Rank::where('id', '=', $myInputs[1])->pluck('id');
				$employee_designation->schools_colleges_id = School_College::where('id', '=', $myInputs[2])->pluck('id');
				$employee_designation->department_id = Department::where('id', '=', $myInputs[3])->pluck('id');
				$employee_designation->campus_id = Campus::where('id', '=', $myInputs[4])->pluck('id');
				$employee_designation->supervisor_id = Supervisor::where('id', '=', $myInputs[5])->pluck('id');
				**/
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

		return View::make('employees.show')
			->with('employees', $employees );
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

		return View::make('employees.edit')
			->with('employees', $employees );
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
}
