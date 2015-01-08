<?php

class TrainingResponsesController extends \BaseController {

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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($training_id, $type, $participant_id)
	{
		if($type=="pta")
			{
				$itemname = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->lists('name');
				$rules = array(
					
					);

	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('internal_trainings/'.$id.'/pta/accomplish')
	                ->withErrors($validator)
	                ->withInput();
	        } 
	        else {
	            // store

	        	$itemname = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->lists('name');

	        	$participant_assessment = new Participant_Assessment;
	        	$participant_assessment->type = $type;
	        	$participant_assessment->rating = null;
	        	$participant_assessment->verbal_interpretation = Input::get('verbalinterpretation');
	        	$participant_assessment->remarks = Input::get('remarks');
	        	$participant_assessment->it_participant_id = $participant_id;
	        	$participant_assessment->save();

	        	$rating = 0;

	        	foreach ($itemname as $key => $value)
	        	{
	            	$response = new Assessment_Response;
	            	$response->name = $value;
	            	$response->rating = Input::get($value);
	            	$rating += $response->rating;
	            	$response->participant_assessment_id = $participant_assessment->id;
		            $response->save();
		        }

		        $itemnameCount = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->count();

		        $participant_assessment = Participant_Assessment::find($participant_assessment->id);
		        $participant_assessment->rating = $rating/$itemnameCount;
		        $participant_assessment->save();


	            // redirect
	            Session::flash('message', 'Successfully recorded participant response!');
	            return Redirect::to('dashboard');
			}
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


	public function accomplish()
	{
		if($type=="pta")
		{
			
		}
		elseif($type=="pte")
		{
			
		}

	}

	public function showAcomplished($type)
	{

	}

}
