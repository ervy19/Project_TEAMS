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
            $nposition = Input::get('title');
            $positions->save();
			
            $selectedsc = Input::get('selected');
            $newposition = Position::where('title', $nposition)->pluck('id');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$positionsc = new Position_SC;
            	$selectedid = SkillsCompetencies::where('name', $scidArray[$i])->pluck('id');
	            $positionsc->skills_competencies_id = $selectedid;
	            $positionsc->position_id = $newposition;
	            $positionsc->save();
	        }

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
		//$posid = Position::where('id', $id)->pluck('id');
		$currentscid = Position_SC::where('position_id', $id)->lists('skills_competencies_id');
		
		// $currentscs = SkillsCompetencies::where('id', $currentscid)->lists('name');
		$currentscs = array();

		foreach($currentscid as $key)
		{
			$scsname = SkillsCompetencies::where('id', $key)->pluck('name');
			array_push($currentscs, $scsname);
		}

		return View::make('positions.edit')
			->with('positions', $positions)
			->with('currentscs', $currentscs)
			->with('currentscid', $currentscid);
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
            return Redirect::to('positions/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // update in positions table
            $positions = Position::find($id);
            $positions->title = Input::get('title');
            $nposition = Input::get('title');
            $positions->save();
			
            $selectedsc = Input::get('selected');
            $selectedposition = Position::where('title', $nposition)->pluck('id');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$positionsc = new Position_SC;
            	$selectedid = SkillsCompetencies::where('name', $scidArray[$i])->pluck('id');
	            $positionsc->skills_competencies_id = $selectedid;
	            $positionsc->position_id = $selectedposition;
	            $positionsc->save();
	        }

            // redirect
            Session::flash('message', 'Successfully created Position!');
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
