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
	         	$itemsArray = explode(",", $inputItems);

	            for($i = 0; $i < count($itemsArray); $i++){
	            	$assessmentitem = new Assessment_Item;
	            	$assessmentitem->name = $itemsArray[$i];
	            	$assessmentitem->internal_training_id = $training;
		            $assessmentitem->save();
		        }        

	            // redirect
	            Session::flash('message', 'Successfully created Assessment Items!');
	            return Redirect::to('dashboard');
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
	         	$itemsArray = explode(",", $inputItems);

	            for($i = 0; $i < count($itemsArray); $i++){
	            	$assessmentitem = new Assessment_Item;
	            	$assessmentitem->name = $itemsArray[$i];
	            	$assessmentitem->internal_training_id = $training;
		            $assessmentitem->save();
		        }        

	            // redirect
	            Session::flash('message', 'Successfully created Assessment Items!');
	            return Redirect::to('dashboard');
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


	public function accomplish($id, $type)
	{
		if($type=="pta")
		{
			$type = "pta";
			$sectiontitle = "Accomplish Pre-Training Assessment";
			$header = "Pre-Training Assessment";
			$assessmentitems = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $id)->lists('name');

			$internaltraining = Internal_Training::select(DB::raw('*'))
								->leftJoin('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
								->leftJoin('trainings','internal_trainings.training_id','=','trainings.id')
								->where('internal_trainings.isActive', '=', true)
								->groupBy('internal_trainings.training_id')
								->get();

			return View::make('training_assessments.accomplish')
				->with('internaltraining', $internaltraining)
				->with('assessmentitems', $assessmentitems)
				->with('header', $header)
				->with('sectiontitle', $sectiontitle)
				->with('type', $type);
		}
		elseif($type=="pte")
		{
			$type = "pte";
			$sectiontitle = "Accomplish Post-Training Evaluation";
			$header = "Post-Training Evaluation";
			$assessmentitems = Assessment_Item::where('isActive', '=', true)->where('internal_training_id', '=', $id)->lists('name');

			$internaltraining = Internal_Training::select(DB::raw('*'))
								->leftJoin('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
								->leftJoin('trainings','internal_trainings.training_id','=','trainings.id')
								->where('internal_trainings.isActive', '=', true)
								->groupBy('internal_trainings.training_id')
								->get();

			return View::make('training_assessments.accomplish')
				->with('internaltraining', $internaltraining)
				->with('assessmentitems', $assessmentitems)
				->with('header', $header)
				->with('sectiontitle', $sectiontitle)
				->with('type', $type);
		}

	}

	public function showAcomplished($type)
	{

	}

}
