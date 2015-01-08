<?php

class SkillsCompetenciesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$scs = SkillsCompetencies::select(DB::raw('skills_competencies.id, skills_competencies.name, count(department_sc.id) as departmentsTagged, count(position_sc.id) as positionsTagged, count(it_addressed_sc.id) as internalTrainingsTagged, count(et_addressed_sc.id) as externalTrainingsTagged'))
								->leftJoin('department_sc','skills_competencies.id','=','department_sc.skills_competencies_id')
								->leftJoin('position_sc','skills_competencies.id','=','position_sc.skills_competencies_id')
								->leftJoin('it_addressed_sc','skills_competencies.id','=','it_addressed_sc.skills_competencies_id')
								->leftJoin('et_addressed_sc','skills_competencies.id','=','et_addressed_sc.skills_competencies_id')
								->where('skills_competencies.isActive', '=', true)
								->groupBy('skills_competencies.id')
								->get();	

		if(Request::ajax()){
			return Response::json(['data' => $scs]);
		}
		else
		{
			return View::make('skills_competencies.index');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('skills_competencies.create');
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
            'name' => 'required|max:255'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        	);
        } else {
            // store
            $scs = new SkillsCompetencies;
            $scs->name = Input::get('name');
            $scs->save();

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
        $scs = SkillsCompetencies::find($id);

		return View::make('skills_competencies.show')
			->with('scs', $scs );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $scs = SkillsCompetencies::find($id)->toArray();

		return Response::json([
			'success' => true,
			'result' => $scs
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
            'name' => 'required|max:255'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        	);
        } else {
            // store
            $scs = SkillsCompetencies::find($id);
            $scs->name = Input::get('name');
            $scs->save();

            return Response::json(['success' => true]);
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
		$scs = SkillsCompetencies::find($id);
        $scs->isActive = false;
        $scs->save();

    	return Response::json(['success' => true]);
    }
}
