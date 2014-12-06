<?php

class ExternalTrainingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$externaltrainings = External_Training::where('isActive', '=', true)->get();

		return View::make('external_trainings.index')
			->with('externaltrainings', $externaltrainings );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('external_trainings.create');
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
            'externaltrainings' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $externaltrainings = new External_Training;
            $externaltrainings->title = Input::get('externaltrainings');
            $externaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully created the External Training!');
            return Redirect::to('external_trainings');
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
		 $externaltrainings = External_Training::find($id);

		return View::make('external_trainings.show')
			->with('externaltrainings', $externaltrainings);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$externaltrainings = External_Training::find($id);

		return View::make('external_trainings.edit')
			->with('externaltrainings', $externaltrainings );
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
            'externaltrainings' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('external_trainings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $externaltrainings = External_Training::find($id);
            $externaltrainings->title = Input::get('externaltrainings');
            $externaltrainings->save();

            // redirect
            Session::flash('message', 'Successfully updated the External Training!');
            return Redirect::to('external_trainings');
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
		$externaltrainings = External_Training::find($id);
        $externaltrainings->isActive = false;
        $externaltrainings->save();

        // redirect
        Session::flash('message', 'Successfully deleted External Training!');
        return Redirect::to('external_trainings');
	}


}
