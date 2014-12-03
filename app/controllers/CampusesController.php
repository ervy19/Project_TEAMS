<?php

class CampusesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$campuses = Campus::all();

		return View::make('campuses.index')
			->with('campuses', $campuses );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('campuses.create');
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
            'campuses', 'address' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('campuses/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $campuses = new Campus;
            $campuses->title = Input::get('campuses');
            $campuses->address = Input::get('address');
            $campuses->save();
            // redirect
            Session::flash('message', 'Successfully created Campus!');
            return Redirect::to('campuses');
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
		$campuses = Campus::find($id);

		return View::make('campuses.show')
			->with('campuses', $campuses );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$campuses = Campus::find($id);

		return View::make('campuses.edit')
			->with('campuses', $campuses );
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
            'campuses' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('campuses/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $campuses = Campus::find($id);
            $campuses->title = Input::get('campuses');
            $campuses->address = Input::get('address');
            $campuses->save();

            // redirect
            Session::flash('message', 'Successfully updated Campus!');
            return Redirect::to('campuses');
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
		$campuses = Campus::find($id);
        $campuses->isActive = false;
        $campuses->save();

        // redirect
        Session::flash('message', 'Successfully deleted Campus!');
        return Redirect::to('campuses');
	}


}
