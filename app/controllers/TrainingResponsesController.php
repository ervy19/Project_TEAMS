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
			$itemname = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->get();
			$rules = ['remarks' => 'required'];

			foreach ($itemname as $key => $value) {
					$rules += [$value->id  => 'required'];
			};

			//dd($rules);

	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('internal_trainings/'.$training_id.'/pta/accomplish/'.$participant_id)
	                ->withErrors($validator)
	                ->withInput();
	        } 
	        else {
	            // store
	        	
	        	if($type=='pte')
	            {
	            	$participant_assessment = new Participant_Assessment;
	            	$participant_assessment->type = 'pte';
	            	$participant_assessment->it_participant_id = $participant_id;
	            	$participant_assessment->save();
	            }

	            if($type=='pta')
	            {
	            	$participant_assessment = new Participant_Assessment;
	            	$participant_assessment->type = 'pta';
	            	$participant_assessment->it_participant_id = $participant_id;
	            	$participant_assessment->save();
	            }

	            $participant_assessment = Participant_Assessment::where('it_participant_id','=',$participant_id)
	            								->where('type','=',$type)
	            								->first();
	        	
	        	$totalRating = 0;

	        	foreach ($itemname as $key => $value)
	        	{	        		
	            	$response = new Assessment_Response;
	            	$response->name = $value->name;
	            	$response->rating = Input::get($value->id);
	            	$totalRating += $response->rating;
	            	$response->participant_assessment_id = $participant_assessment->id;
		            $response->save();
		        }

		        $rating = $totalRating/(count($itemname));

	        	$participant_assessment->rating = $rating;

	        	if($rating <= 5 && $rating >= 4.5)
	        	{
	        		$participant_assessment->verbal_interpretation = 'Excellent';
	        	}
	        	else if($rating < 4.5 && $rating >= 3.5)
	        	{
	        		$participant_assessment->verbal_interpretation = 'Very Good';
	        	}
	        	else if($rating < 3.5 && $rating >= 2.5)
	        	{
	        		$participant_assessment->verbal_interpretation = 'Good';
	        	}
	        	else if($rating < 2.5 && $rating >= 1.5)
	        	{
	        		$participant_assessment->verbal_interpretation = 'Fair';
	        	}
	        	else if($rating < 1.5)
	        	{
	        		$participant_assessment->verbal_interpretation = 'Poor';
	        	}
	        	else
	        	{
	     	        $participant_assessment->verbal_interpretation = 'None';
	        	}

	        	$participant_assessment->remarks = Input::get('remarks');
	        	$participant_assessment->it_participant_id = $participant_id;
	        	$participant_assessment->save();

	        	$notification = Notification::where('type','=',$type)
	        						->where('user_id','=',Auth::user()->id)
	        						->where('training_link','=',$training_id)
	        						->where('participant_link','=',$participant_id)
	        						->delete();

	            // redirect
	            if($type=='pta')
	            {
	            	Session::flash('message', 'Successfully recorded PTA!');
	            }
	            else if($type=='pte')
	            {
	            	Session::flash('message', 'Successfully recorded PTE!');
	            }
	            return Redirect::to('dashboard');
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
