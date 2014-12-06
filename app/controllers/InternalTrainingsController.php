<?php

class InternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$internaltrainings = DB::table('internal_trainings')->where('isActive', '=', true)->get();

		return View::make('internal_trainings.index')
			->with('internaltrainings', $internaltrainings );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('internal_trainings.create');
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
            'internaltrainings' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $internaltrainings = new Internal_Training;
            $internaltrainings->title = Input::get('internaltrainings');
            $internaltrainings->organizer_schools_colleges_id = Input::get('school_college_id');
            $internaltrainings->organizer_department_id = Input::get('department_id');
            $internaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully created the Internal Training!');
            return Redirect::to('internal_trainings');
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
		 $internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.show')
			->with('internaltrainings', $internaltrainings);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$internaltrainings = Internal_Training::find($id);

		return View::make('internal_trainings.edit')
			->with('internaltrainings', $internaltrainings );
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
            'internaltrainings' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal_trainings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $internaltrainings = Internal_Training::find($id);
            $internaltrainings->title = Input::get('internaltrainings');
            $internaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully updated the Internal Training!');
            return Redirect::to('internal_trainings');
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
		$internaltrainings = Internal_Training::find($id);
        $internaltrainings->isActive = false;
        $internaltrainings->save();

        // redirect
        Session::flash('message', 'Successfully deleted Internal Training!');
        return Redirect::to('internal_trainings');
	}


}
