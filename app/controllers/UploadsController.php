<?php

class UploadsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('uploads.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(file_exists(Input::file('file'))) {
			Excel::load(Input::file('file'), function($reader) {
				$results = $reader->get();

				//save the contents to the database
				for ($i = 0; $i < count($results) ; $i++) { 
					$it_attendances = new IT_Attendance;
					$it_attendances->time = 'time_example'; //EDIT THIS
					$it_attendances->employee_id = $results[$i]->employee_number;
					$it_attendances->internal_training_id = 1; //EDIT THIS
					$it_attendances->save();
				}	
			});
		}
		else {
			echo 'No file selected';
		}

		return Redirect::to('uploads/create');
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
