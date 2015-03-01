<?php

class TrainingAssessmentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($training_id)
	{
		$assessmentitems = Assessment_Item::where('internal_training_id', '=', $training_id)->get();

		if(Request::ajax()){
			return Response::json(['success' => true,'data' => $assessmentitems]);
		}
		else
		{
			return View::make('internal_trainings.assessment-items');
		}
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
			$type = "pta";
			$header = "Create Pre-Training Assessment";
			$internaltrainingslist = Internal_Training::where('isActive', '=', true)->lists('training_id');
			$internaltrainings = array();

			foreach ($internaltrainingslist as $id)
			{
				$trainingtitle = Training::where('isActive', '=', true)->where('id', '=', $id)->pluck('title');
				array_push($internaltrainings, $trainingtitle);
			}

			return View::make('training_assessments.create')
				->with('internaltrainings', $internaltrainings)
				->with('header', $header)
				->with('type', $type);
		}

		elseif($type=="pte")
		{
			$type = "pte";
			$header = "Create Post-Training Evaluation";
			$internaltrainingslist = Internal_Training::where('isActive', '=', true)->lists('training_id');
			$internaltrainings = array();

			foreach ($internaltrainingslist as $id)
			{
				$trainingtitle = Training::where('isActive', '=', true)->where('id', '=', $id)->pluck('title');
				array_push($internaltrainings, $trainingtitle);
			}

			return View::make('training_assessments.create')
				->with('internaltrainings', $internaltrainings)
				->with('header', $header)
				->with('type', $type);
		}
	}

	public function storeAI($training_id)
	{
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
            $assessmentitem = new Assessment_Item;
	        $assessmentitem->name = Input::get('name');
			$assessmentitem->internal_training_id = $training_id;
		    $assessmentitem->save();

            return Response::json(['success' => true]);
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
				$rules = array(
					'internaltraining' => 'required'		
	        );

	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('pta/create')
	                ->withErrors($validator)
	                ->withInput();
	        } 
	        else {
	            // store
	        	$inputItems = Input::get('assessment_items');
	        	$training = Input::get('internaltraining');
	        	$selecttraining = Training::where('isActive', '=', true)->where('title', '=', $training)->pluck('id');
	         	$itemsArray = explode(",", $inputItems);

	            for($i = 0; $i < count($itemsArray); $i++){
	            	$assessmentitem = new Assessment_Item;
	            	$assessmentitem->name = $itemsArray[$i];
	            	$assessmentitem->internal_training_id = $selecttraining;
		            $assessmentitem->save();
		        }        

	            // redirect
	            Session::flash('message', 'Successfully accomplished PTA!');
	            return Redirect::to('internal_trainings');
			}
		}

		elseif($type=="pte")
		{
			$rules = array(
					'internaltraining' => 'required'
	        );

	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('pte/create')
	                ->withErrors($validator)
	                ->withInput();
	        } 
	        else {
	            // store
	        	$inputItems = Input::get('assessment_items');
	        	$training = Input::get('internaltraining');
	        	$selecttraining = Training::where('isActive', '=', true)->where('title', '=', $training)->pluck('id');
	         	$itemsArray = explode(",", $inputItems);

	            for($i = 0; $i < count($itemsArray); $i++){
	            	$assessmentitem = new Assessment_Item;
	            	$assessmentitem->name = $itemsArray[$i];
	            	$assessmentitem->internal_training_id = $selecttraining;
		            $assessmentitem->save();
		        }        

	            // redirect
	            Session::flash('message', 'Successfully created Assessment Items!');
	            return Redirect::to('internal_trainings');
			}
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


	public function accomplish($id, $type, $participant_id)
	{
		if($type=="pta")
		{
			$type = "pta";
			$sectiontitle = "Accomplish Pre-Training Assessment";
			$header = "Pre-Training Assessment";
		}
		elseif($type=="pte")
		{
			$type = "pte";
			$sectiontitle = "Accomplish Post-Training Evaluation";
			$header = "Post-Training Evaluation";
		}

			$participant = IT_Participant::find($participant_id);
			$assessmentitems = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $id)->get();
			$participantassessment = Participant_Assessment::where('isActive', '=', true)->where('type', '=', $type)->where('it_participant_id', '=', $participant_id)->first();
			$assessmentresponse = Assessment_Response::where('participant_assessment_id', '=', $participantassessment->id)->where('isActive', '=', true)->get();

			$itemcount = count($assessmentitems);

			$intent = "accomplish";

			$internaltraining = Internal_Training::select(DB::raw('*'))
								->leftJoin('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
								->leftJoin('trainings','internal_trainings.training_id','=','trainings.id')
								->where('internal_trainings.training_id','=',$id)
								->where('internal_trainings.isActive', '=', true)
								->first();

			$training_id = $id;

			return View::make('training_assessments.accomplish')
				->with('internaltraining', $internaltraining)
				->with('assessmentitems', $assessmentitems)
				->with('assessmentresponse', $assessmentresponse)
				->with('participant',$participant)
				->with('participantassessment', $participantassessment)
				->with('participant_id', $participant_id)
				->with('itemcount', $itemcount)
				->with('header', $header)
				->with('sectiontitle', $sectiontitle)
				->with('type', $type)
				->with('intent', $intent);
	}

	public function showAccomplished($id, $type, $participant_id)
	{
		if($type=="pta")
		{
			$type = "pta";
			$sectiontitle = "Accomplish Pre-Training Assessment";
			$header = "Pre-Training Assessment";
		}
		elseif($type=="pte")
		{
			$type = "pte";
			$sectiontitle = "Accomplish Post-Training Evaluation";
			$header = "Post-Training Evaluation";
		}

			$participant = IT_Participant::find($participant_id);
			$assessmentitems = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $id)->lists('name');
			$participantassessment = Participant_Assessment::where('isActive', '=', true)->where('type', '=', $type)->where('it_participant_id', '=', $participant_id)->first();
			$assessmentresponse = Assessment_Response::where('participant_assessment_id', '=', $participantassessment->id)->where('isActive', '=', true)->get();
			
			$itemcount = count($assessmentitems);

	        $intent = "show";

			$internaltraining = Internal_Training::select(DB::raw('*'))
								->leftJoin('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
								->leftJoin('trainings','internal_trainings.training_id','=','trainings.id')
								->where('internal_trainings.training_id','=',$id)
								->where('internal_trainings.isActive', '=', true)
								->first();

			return View::make('training_assessments.show')
				->with('internaltraining', $internaltraining)
				->with('assessmentitems', $assessmentitems)
				->with('assessmentresponse', $assessmentresponse)
				->with('participant',$participant)
				->with('participantassessment', $participantassessment)
				->with('participant_id', $participant_id)
				->with('itemcount', $itemcount)
				->with('header', $header)
				->with('sectiontitle', $sectiontitle)
				->with('type', $type)
				->with('intent', $intent);
	}
}
