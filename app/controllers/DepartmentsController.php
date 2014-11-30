<?php

class DepartmentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$departments = Department::all();

		return View::make('departments.index')
			->with('departments', $departments );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('departments.create');
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
            'departments' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('departments/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $departments = new Department;
            $departments->name = Input::get('departments');
            $departments->save();
            // redirect
            Session::flash('message', 'Successfully created Department!');
            return Redirect::to('departments');
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
		$departments = Department::find($id);

		return View::make('departments.show')
			->with('departments', $departments );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$departments = Department::find($id);

		return View::make('departments.edit')
			->with('departments', $departments );
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
            'departments' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('departments/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $departments = Department::find($id);
            $departments->name = Input::get('departments');
            $departments->save();

            // redirect
            Session::flash('message', 'Successfully updated Department!');
            return Redirect::to('departments');
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
		$departments = Department::find($id);
        $departments->delete();

        // redirect
        Session::flash('message', 'Successfully deleted Department!');
        return Redirect::to('departments');
	}


}
