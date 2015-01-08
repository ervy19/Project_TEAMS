<?php

class RanksController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ranks = Rank::select(DB::raw('ranks.id, ranks.code, ranks.title, ranks.level, count(employee_designations.id) as employeeHoldingRank'))
			->leftJoin('employee_designations','ranks.id','=','employee_designations.rank_id')
			->where('ranks.isActive', '=', true)
			->groupBy('ranks.id')
			->get();

		$positions = Position::where('isActive', true)->lists('title','id');

		if(Request::ajax()){
			return Response::json(['data' => $ranks]);
		}
		else
		{
			return View::make('ranks.index')
				->with('positions', $positions);
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
            'code' => 'required|max:2',
            'title' => 'required|max:100', 
            'level' => 'required|max:2', 
            'position' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
        	return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        	);
            /*return Redirect::to('campuses')
                ->withErrors($validator)
                ->withInput(Input::except('password'));*/
        } else {
            // store
            $ranks = new Rank;
            $ranks->code = Input::get('code');
            $ranks->title = Input::get('title');
            $ranks->level = Input::get('level');
            $ranks->position_id = Input::get('position');

            $ranks->save();

            return Response::json(['success' => true]);
            // redirect
            //Session::flash('message', 'Successfully created Campus!');
            //return Redirect::to('campuses')->with('message', '<div class="alert alert-success">Campus successfully added.</div>');
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$rank = Rank::find($id)->toArray();

		return Response::json([
			'success' => true,
			'result' => $rank
			]);
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
            'code' => 'required|max:2',
            'title' => 'required|max:100', 
            'level' => 'required|max:2', 
            'position' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
        	return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        	);
            /*return Redirect::to('campuses')
                ->withErrors($validator)
                ->withInput(Input::except('password'));*/
        } else {
            // store
            $ranks = Rank::find($id);
            $ranks->code = Input::get('code');
            $ranks->title = Input::get('title');
            $ranks->level = Input::get('level');
            $ranks->position_id = Input::get('position');

            $ranks->save();

            return Response::json(['success' => true]);
            // redirect
            //Session::flash('message', 'Successfully created Campus!');
            //return Redirect::to('campuses')->with('message', '<div class="alert alert-success">Campus successfully added.</div>');
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
		$ranks = Rank::find($id);
        $ranks->isActive = false;
        $ranks->save();

        return Response::json(['success' => true]);
	}


}
