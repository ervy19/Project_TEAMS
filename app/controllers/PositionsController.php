<?php

class PositionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$positions = Position::where('isActive', '=', true)->get();

		$positions_array = array();
		foreach ($positions as $key => $value) {
			$id = $value->id;
			$title = $value->title;
		
			$count = Employee_Designation::select(DB::raw('*'))
	               ->join('employees', 'employees.id', '=', 'employee_designations.employee_id')
	               ->join('positions', 'positions.id', '=', 'employee_designations.position_id')
	               ->where('positions.title', '=', $value->title)
	               ->count();

	        array_push($positions_array, array('id' => $id, 'title' => $title, 'count' => $count));
		}

		if(Request::ajax()){
			return Response::json(['data' => $positions]);
		}
		else
		{
			return View::make('positions.index')
					->with('positions_array', $positions_array);
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$sc = SkillsCompetencies::where('isActive', true)->get();

		return View::make('positions.create')
			->with('sc', $sc);
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
                ->withInput();
        } else {
            // store to positions table
            $positions = new Position;
            $positions->title = Input::get('title');
            $positions->save();
			
            $selectedsc = Input::get('selected');
            $position_id = Position::where('title', Input::get('title'))->pluck('id');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$positionsc = new Position_SC;
            	$selectedid = SkillsCompetencies::where('isActive',true)->where('name', "=", $scidArray[$i])->pluck('id');
	            $positionsc->skills_competencies_id = $selectedid;
	            $positionsc->position_id = $position_id;
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
		$currentscid = Position_SC::where('position_id', "=", $id)->lists('skills_competencies_id');
		$scs = SkillsCompetencies::where('isActive', "=", true)->get();
		$currentscs = array();

		foreach($currentscid as $key)
		{
			$scsname = SkillsCompetencies::where('isActive', true)->where('id', $key)->pluck('name');
			array_push($currentscs, $scsname);
		}

		return View::make('positions.edit')
			->with('positions', $positions)
			->with('currentscs', $currentscs)
			->with('currentscid', $currentscid)
			->with('scs', $scs);
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
                ->withInput();
        } else {
        	$positionId = Position::where('title', "=", Input::get('title'))->pluck('id');
			$currentscid = Position_SC::where('position_id', $id)->lists('skills_competencies_id');
			$currentscs = array();
			foreach($currentscid as $key)
			{
				$scsname = SkillsCompetencies::where('isActive', true)->where('id', $key)->pluck('name');
				array_push($currentscs, $scsname);
			}

        	try {
	        	//delete all records of current position
	        	Position_SC::where('position_id', $id)->delete();

	            // update/save in positions_sc table
	            $positions = Position::find($id);
	            //$positionTitle = Input::get('title');
	            $positions->title = Input::get('title');
	            $positions->save();
				
	            $selectedsc = Input::get('selected_edit');
	            $scidArray = explode(",", $selectedsc);

	            for($i = 0; $i < count($scidArray); $i++) {
	            	$selectedid = SkillsCompetencies::where('name', "=", $scidArray[$i])->pluck('id');

	            	$positionsc = new Position_SC;
		            $positionsc->skills_competencies_id = $selectedid;
		            $positionsc->position_id = $id;
		            $positionsc->save();
		        }

	            // redirect
	            Session::flash('message', 'Successfully updated Position!');
	            return Redirect::to('positions');
	        }
	        catch(PDOException $exception) {
	        	for($i = 0; $i < count($currentscid); $i++){
	            	$positionsc = new Position_SC;
		            $positionsc->skills_competencies_id = $currentscid[$i];
		            $positionsc->position_id = $positionId;
		            $positionsc->save();
		        }
	        	return Redirect::to('positions');
	        }
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

	public function neededSkillsCompetencies($id)
	{
		$position_scs = Position_SC::where('isActive','=',true)
							->where('position_id','=',$id)
							->get();

		$needed_scs = array();

		foreach ($position_scs as $key => $value) {
			$sc = SkillsCompetencies::find($value->skills_competencies_id);
			array_push($needed_scs, $sc);
		}

		$totalNeeds_Position = Employee_Designation::where('position_id','=',$id)
							->where('isActive','=',true)
							->count();

		if(Request::ajax()){
			return Response::json(['success' => true, 'data' => $needed_scs]);
		}
	}

}
