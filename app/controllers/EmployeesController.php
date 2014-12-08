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
		return View::make('employees.create');
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
            'email' => 'required|email|unique:Employees,email,'.$id,
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
            // store
            $employees = new Employee;
            $employees->employee_number = Input::get('employee_number');
            $employees->last_name = Input::get('last_name');
            $employees->given_name = Input::get('given_name');
            $employees->middle_initial = Input::get('middle_initial');
            $employees->email = Input::get('email');
            $employees->age = Input::get('age');
            $employees->tenure = Input::get('tenure');
            $employees->save();
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
            'email' => 'required|email|unique:Employees,email,'.$id,
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
