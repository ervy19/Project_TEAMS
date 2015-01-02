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
		$scname = Department::where('isActive', '=', true)->lists('schools_colleges_id');

		return View::make('departments.index')
			->with('departments', $departments)
			->with('scname', $scname);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$sc = SkillsCompetencies::where('isActive', true)->lists('name');
		$schoolcollege = School_College::where('isActive', true)->lists('name');

		return View::make('departments.create')
			->with('sc', $sc)
			->with('schoolcollege', $schoolcollege);

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
                ->withInput();
        } else {
            // store to departments table
            $departments = new Department;
            $departments->name = Input::get('name');
            $school_college = Input::get('selected_sch_dept');
            $departments->schools_colleges_id = School_College::where('name', '=', $school_college)->pluck('id');
            $ndepartment = Input::get('name');
            $departments->save();
			
            $newdepartment = Department::where('name', $ndepartment)->pluck('id');

            $selectedsc = Input::get('selected_dept');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$departmentsc = new Department_SC;
            	$selectedid = SkillsCompetencies::where('isActive', '=', true)->where('name', '=', $scidArray[$i])->pluck('id');
	            $departmentsc->skills_competencies_id = $selectedid;
	            $departmentsc->department_id = $newdepartment;
	            $departmentsc->save();
	        }

            // redirect
            Session::flash('message', 'Successfully created Department!');
            return Redirect::to('departments')
            	->with('departments', $departments );
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
		$schid = Department::where('id', $id)->pluck('schools_colleges_id');

		$currentscid = Department_SC::where('department_id', "=", $id)->lists('skills_competencies_id');
		
		$schselected = School_College::where('isActive', '=', true)->where('id', '=', $schid)->pluck('name');
		$schoolcollege = School_College::where('isActive', true)->get();

		$scs = SkillsCompetencies::where('isActive', true)->get();
		$currentscs = array();

		foreach($currentscid as $key)
		{
			$scsname = SkillsCompetencies::where('isActive', "=", true)->where('id', $key)->pluck('name');
			array_push($currentscs, $scsname);
		}

		return View::make('departments.edit')
			->with('departments', $departments)
			->with('schoolcollege', $schoolcollege)
			->with('schid', $schid)
			->with('currentscs', $currentscs)
			->with('schselected', $schselected)
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
                ->withInput();
        } else {
        	$departmentId = Department::where('name', Input::get('name'))->pluck('id');
        	$departmentName = Input::get('name');
        	$departmentSchId = School_College::where('isActive', '=', true)->where('name', '=', Input::get('selected_sch_edit'))->pluck('id');
			$currentscid = Department_SC::where('department_id', $id)->lists('skills_competencies_id');
			$currentscs = array();
			foreach($currentscid as $key)
			{
				$scsname = SkillsCompetencies::where('isActive', true)->where('id', $key)->pluck('name');
				array_push($currentscs, $scsname);
			}

        	try {
	        	//delete all records of current department
	        	Department_SC::where('department_id', $id)->delete();

	            // update/save in department table
	            $departments = Department::find($id);
	            $departments->name = $departmentName;
            	$departments->schools_colleges_id = $departmentSchId;
	            $departments->save();
				
				//update department_sc table
	            $selectedsc = Input::get('selected_dept_edit');
	            $departmentId = Department::where('name', $departmentName)->pluck('id');
	            $scidArray = explode(",", $selectedsc);

	            for($i = 0; $i < count($scidArray); $i++){
	            	$departmentsc = new Department_SC;
	            	$selectedid = SkillsCompetencies::where('name', $scidArray[$i])->pluck('id');
		            $departmentsc->skills_competencies_id = $selectedid;
		            $departmentsc->department_id = $departmentId;
		            $departmentsc->save();
		        }

	            // redirect
	            Session::flash('message', 'Successfully updated Department!');
	            return Redirect::to('departments');
	        }
	        catch(PDOException $exception) {
	        	//update department_sc table
	        	for($i = 0; $i < count($currentscid); $i++){
	            	$departmentsc = new Department_SC;
		            $departmentsc->skills_competencies_id = $currentscid[$i];
		            $departmentsc->department_id = $departmentId;
		            $departmentsc->save();
		        }

	        	// redirect
	            Session::flash('message', 'Successfully updated Department!');
	            return Redirect::to('departments');
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
		$departments = Department::find($id);
        $departments->isActive = false;
        $departments->save();

        // redirect
        Session::flash('message', 'Successfully deleted Department!');
        return Redirect::to('departments');
	}


}
