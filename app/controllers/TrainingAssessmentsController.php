<?php

class TrainingAssessmentsController extends \BaseController {

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
	public function create($type)
	{
		if($type=="pta")
		{
			return View::make('training_assessments.create');
		}
		elseif($type=="pte")
		{
			return View::make('training_assessments.create');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($type)
	{
		if($type=="pta")
		{

		}
		elseif($type=="pte")
		{
			
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $type)
	{
		if($type=="pta")
		{

		}
		elseif($type=="pte")
		{
			
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $type)
	{
		if($type=="pta")
		{

		}
		elseif($type=="pte")
		{
			
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $type)
	{
		if($type=="pta")
		{

		}
		elseif($type=="pte")
		{
			
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, $type)
	{
		if($type=="pta")
		{

		}
		elseif($type=="pte")
		{
			
		}
	}


	public function accomplish($type)
	{

	}

	public function showAcomplished($type)
	{

	}

}
