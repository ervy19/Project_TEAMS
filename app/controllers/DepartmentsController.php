<?php

class DepartmentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = DB::table('departments')->where('isActive', '=', true)->get();

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
		$sc = SkillsCompetencies::where('isActive', true)->get();

		return View::make('departments.create')
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
            'name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('departments/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store to positions table
            $departments = new Department;
            $departments->name = Input::get('name');
            $ndepartment = Input::get('name');
            $departments->save();
			
            $selectedsc = Input::get('selected');
            $newdepartment = Department::where('name', $ndepartment)->pluck('id');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$departmentsc = new Department_SC;
            	$selectedid = SkillsCompetencies::where('isActive',true)->where('name', $scidArray[$i])->pluck('id');
	            $departmentsc->skills_competencies_id = $selectedid;
	            $departmentsc->department_id = $newdepartment;
	            $departmentsc->save();
	        }

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
		$currentscid = Department_SC::where('department_id', $id)->lists('skills_competencies_id');
		$scs = SkillsCompetencies::where('isActive', true)->get();
		$currentscs = array();

		foreach($currentscid as $key)
		{
			$scsname = SkillsCompetencies::where('isActive', true)->where('id', $key)->pluck('name');
			array_push($currentscs, $scsname);
		}

		return View::make('departments.edit')
			->with('departments', $departments)
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
            'name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('departments/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
        	//delete all records of current position
        	Department_SC::where('department_id', $id)->delete();

            // update/save in positions_sc table
            $departments = Department::find($id);
            $departments->name = Input::get('name');
            $ndepartment = Input::get('name');
            $departments->save();
			
            $selectedsc = Input::get('selected');
            $selecteddepartment = Department::where('name', $ndepartment)->pluck('id');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$departmentsc = new Department_SC;
            	$selectedid = SkillsCompetencies::where('isActive', true)->where('name', $scidArray[$i])->pluck('id');
	            $departmentsc->skills_competencies_id = $selectedid;
	            $departmentsc->department_id = $selecteddepartment;
	            $departmentsc->save();
	        }

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
        $departments->isActive = false;
        $departments->save();

        // redirect
        Session::flash('message', 'Successfully deleted Department!');
        return Redirect::to('departments');
	}


}
