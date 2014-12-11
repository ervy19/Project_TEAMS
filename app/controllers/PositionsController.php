<?php

class PositionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$positions = DB::table('positions')->where('isActive', '=', true)->get();

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
            'title' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('positions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store to positions table
            $positions = new Position;
            $positions->title = Input::get('title');
            $positions->save();
/**
HINDI GUMAGANA WTF
            //	store to positions_sc table
            //	all skills and competencies to a position
            $position_sc = new Position_SC;
            foreach ($("skills_competencies").select2("val") as $key => $value) {
            	$position_sc->skills_competencies_id = $value;
            	$position_sc->position_id = Position::last()->id;
            }
**/
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
            'title' => 'required'
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
            $positions->title = Input::get('title');
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
        $positions->isActive = false;
        $positions->save();

        // redirect
        Session::flash('message', 'Successfully deleted Position!');
        return Redirect::to('positions');
	}


}
