<?php

class SchoolsCollegesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$schools_colleges = School_College::select(DB::raw('schools_colleges.id, schools_colleges.name, count(employee_designations.id) as employeeCount'))
								->leftJoin('employee_designations','schools_colleges.id','=','employee_designations.schools_colleges_id')
								->where('schools_colleges.isActive', '=', true)
								->groupBy('schools_colleges.id')
								->get();		


		if(Request::ajax()){
			return Response::json(['data' => $schools_colleges]);
		}
		else
		{
			return View::make('schools_colleges.index');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('schools_colleges.create');
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
            $schools_colleges = new School_College;
            $schools_colleges->name = Input::get('name');
            $schools_colleges->save();
            
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
		$schools_colleges = School_College::find($id);

		return View::make('schools_colleges.show')
			->with('schools_colleges', $schools_colleges );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$schools_colleges = School_College::find($id)->toArray();

		return Response::json([
			'success' => true,
			'result' => $schools_colleges
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
            'name' => 'required'
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
            $schools_colleges = School_College::find($id);
            $schools_colleges->name = Input::get('name');
            $schools_colleges->save();

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
		$schools_colleges = School_College::find($id);
        $schools_colleges->isActive = false;
        $schools_colleges->save();

        return Response::json(['success' => true]);
	}
}
