<?php

class PositionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$positions = Position::all();

		return View::make('positions.index')
			->with('positions', $positions );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('positions.create');
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
            'positions' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('positions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $positions = new Position;
            $positions->title = Input::get('positions');
            $positions->save();
            // redirect
            Session::flash('message', 'Successfully created Position!');
            return Redirect::to('positions');
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
		$positions = Position::find($id);

		return View::make('positions.show')
			->with('positions', $positions );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$positions = Position::find($id);

		return View::make('positions.edit')
			->with('positions', $positions );
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
            'positions' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('positions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $positions = Position::find($id);
            $positions->title = Input::get('positions');
            $positions->save();

            // redirect
            Session::flash('message', 'Successfully updated Position!');
            return Redirect::to('positions');
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
		$positions = Position::find($id);
        $positions->delete();

        // redirect
        Session::flash('message', 'Successfully deleted Position!');
        return Redirect::to('positions');
	}


}
