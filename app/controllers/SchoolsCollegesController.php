<?php

class SchoolsCollegesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$schools_colleges = School_College::where('isActive', '=', true)->get();

		return View::make('schools_colleges.index')
			->with('schools_colleges', $schools_colleges );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('schools_colleges.create');
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
            'schools_colleges' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('schools_colleges/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $schools_colleges = new School_College;
            $schools_colleges->name = Input::get('schools_colleges');
            $schools_colleges->save();
            // redirect
            Session::flash('message', 'Successfully created School/College!');
            return Redirect::to('schools_colleges');
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
		$schools_colleges = School_College::find($id);

		return View::make('schools_colleges.show')
			->with('schools_colleges', $schools_colleges );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$schools_colleges = School_College::find($id);

		return View::make('schools_colleges.edit')
			->with('schools_colleges', $schools_colleges );
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
            'schools_colleges' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('schools_colleges/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $schools_colleges = School_College::find($id);
            $schools_colleges->name = Input::get('schools_colleges');
            $schools_colleges->save();

            // redirect
            Session::flash('message', 'Successfully updated School_College!');
            return Redirect::to('schools_colleges');
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
		$schools_colleges = School_College::find($id);
        $schools_colleges->isActive = false;
        $schools_colleges->save();

        // redirect
        Session::flash('message', 'Successfully deleted School/College!');
        return Redirect::to('schools_colleges');
	}


}
