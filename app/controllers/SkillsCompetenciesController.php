<?php

class SkillsCompetenciesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$scs = SkillsCompetencies::where('skills_competencies.isActive', '=', true)
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

        if(Request::ajax()){
        	$scs = SkillsCompetencies::where('skills_competencies.isActive', '=', true)
								->where('skills_competencies.id', '=', $id)
								->first();

			return Response::json(['success' => true, 'data' => $scs]);
		}
		else
		{
			return View::make('skills_competencies.show')
						->with('scs', $scs );
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

    public function summaryReport()
    {
    	$scs = SkillsCompetencies::where('isActive','=',true)->first();

    	//Count number of active trainings
    	$sc_count = SkillsCompetencies::where('isActive','=',true)->count();

    	/*Compute for average number of SCs per training */
    	$itsc_count = IT_Addressed_SC::where('isActive','=',true)->count();
    	$etsc_count = ET_Addressed_SC::where('isActive','=',true)->count();

    	$trainingsc_count = $itsc_count + $etsc_count;

    	$scPerTraining = $trainingsc_count / (Training::where('isActive','=',true)->count());

    	/*Compute for average number of SCs per department */

    	$scPerDepartment = Department_SC::where('isActive','=',true)->count() / Department::where('isActive','=',true)->count();

    	/*Compute for average number of SCs per position */

    	$scPerPosition = Position_SC::where('isActive','=',true)->count() / Position::where('isActive','=',true)->count();

    	if(Request::ajax()){
            return Response::json(['data' => $scs]);
        }
        else
        {
        	return View::make('summary_reports.scs')
            				->with('scs',$scs)
            				->with('sc_count',$sc_count)
            				->with('sctraining',$scPerTraining)
            				->with('scdepartment',$scPerDepartment)
            				->with('scposition',$scPerPosition);
        }	
    }

}
