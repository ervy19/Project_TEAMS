<?php

class EmployeesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$employees = Employee::all();

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
		//validation
		$rules = array(
            'employees' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('employees/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $employees = new Employee;
            $employees->name = Input::get('employees');
            $employees->save();
            // redirect
            Session::flash('message', 'Successfully created the Employee!');
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

		return View::make('employee.show')
			->with('employee', $employees );
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
			->with('employees', $employee );
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
            'employees' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('employees/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $employees = Employee::find($id);
            $employees->name = Input::get('employees');
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
        Session::flash('message', 'Successfully deleted the Employee!');
        return Redirect::to('employees');
	}


}
