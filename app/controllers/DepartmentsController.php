<?php

class DepartmentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = Department::where('isActive', '=', true)->orderBy('created_at', 'DESC')->get();

		$schoolscolleges = School_College::where('isActive', '=', true)->lists('name','id');

		$scs = SkillsCompetencies::where('isActive', '=', true)->lists('name','id');

		if(Request::ajax()){
			return Response::json(['data' => $departments]);
		}
		else
		{
			return View::make('departments.index')
				->with('schoolscolleges',$schoolscolleges)
				->with('scs',$scs);
		}
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
            'name' => 'required',
            'type' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        		);
        } else {
            // store to departments table
            $department = new Department;
            $department->name = Input::get('name');
            if(Input::get('type') == 1)
            {
            	$department->schools_colleges_id = Input::get('schoolcollege');
            }

            $department->save();

            /*$selectedsc = Input::get('selected_dept');
            $scidArray = explode(",", $selectedsc);

            for($i = 0; $i < count($scidArray); $i++){
            	$departmentsc = new Department_SC;
            	$selectedid = SkillsCompetencies::where('isActive', '=', true)->where('name', '=', $scidArray[$i])->pluck('id');
	            $departmentsc->skills_competencies_id = $selectedid;
	            $departmentsc->department_id = $newdepartment;
	            $departmentsc->save();
	        }*/

	        //Tagged Skills and Competencies
            $selectedsc = Input::get('scs');
            if($selectedsc == "")
            {}
            else 
            {
                $scidArray = explode(",", $selectedsc);

                for($i = 0; $i < count($scidArray); $i++){
                    $departmentsc = new Department_SC;
                    $departmentsc->skills_competencies_id = $scidArray[$i];
		            $departmentsc->department_id = $department->id;
		            $departmentsc->save();
                }
            }

            return Response::json(['success' => true]);
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
		$department = Department::find($id);

		$department_scs = Department_SC::where('department_id','=',$id)->get();

		if($department)
		{
			return Response::json(['result' => true, 'data' => $department, 'scs' => $department_scs]);
		}
		else
		{
			return Response::json(['result' => false]);
		}
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

        return Response::json(['success' => true]);
	}

	public function neededSkillsCompetencies($id)
	{
		$department_scs = Department_SC::where('isActive','=',true)
							->where('department_id','=',$id)
							->get();

		$needed_scs = array();

		foreach ($department_scs as $key => $value) {
			$sc = SkillsCompetencies::find($value->skills_competencies_id);
			array_push($needed_scs, $sc);
		}

		if(Request::ajax()){
			return Response::json(['success' => true,'data' => $needed_scs]);
		}
	}
}