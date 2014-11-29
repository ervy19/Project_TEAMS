<?php

class SkillsCompetenciesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$scs = SkillsCompetencies::all();

		return View::make('skills_competencies.index')
			->with('scs', $scs );
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
            'skill_competency' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('skills_competencies/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $scs = new SkillsCompetencies;
            $scs->name = Input::get('skill_competency');
            $scs->save();

            // redirect
            Session::flash('message', 'Successfully created Skill/Competency!');
            return Redirect::to('skills_competencies');
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
        $scs = SkillsCompetencies::find($id);

		return View::make('skills_competencies.edit')
			->with('scs', $scs );
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
            'skill_competency' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('skills_competencies/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $scs = SkillsCompetencies::find($id);
            $scs->name = Input::get('skill_competency');
            $scs->save();

            // redirect
            Session::flash('message', 'Successfully updated Skill/Competency!');
            return Redirect::to('skills_competencies');
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
        $scs->delete();

        // redirect
        Session::flash('message', 'Successfully deleted Skill/Competency!');
        return Redirect::to('skills_competencies');
	}

}
