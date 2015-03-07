<?php

class SummaryReportsController extends \BaseController {


	public function individualTrainingReport($id)
	{
		$internal_trainings = IT_Participant::where('it_participants.employee_id','=',$id)
						->where('it_participants.isActive','=',true)
						->get();

		$external_trainings = External_Training::where('external_trainings.isActive','=',true)
								->get();

		$trainings = array();

		foreach ($internal_trainings as $key => $value) {
			array_push($trainings, $value);
		}

		foreach ($external_trainings as $k => $v) {
			array_push($trainings, $v);
		}

		/*usort($trainings, function($a, $b) {
		    return $a['id'] - $b['id'];
		});*/


		if(Request::ajax()){
			return Response::json(['data' => $trainings]);
		}
	}

	public function trainingsReport()
	{
		$start_date = new DateTime('04/01/'.date("Y"));
		$end_date = new DateTime('03/31/'.(date("Y")+1));

		$it_count = Internal_Training::where('created_at','>=',$start_date)
						->where('created_at','<=',$end_date)
						->where('isActive','=',true)
						->count();

		$et_count = External_Training::where('created_at','>=',$start_date)
						->where('created_at','<=',$end_date)
						->where('isActive','=',true)
						->count();

		$trainings_count = $it_count + $et_count;


		$itCountPerMonth = Training::select(DB::raw('DISTINCT MONTH(training_schedules.date_scheduled) AS month, COUNT(training_schedules.training_id) AS count_month'))
						->join('training_schedules','trainings.id','=','training_schedules.training_id')
						->where('training_schedules.date_scheduled','>=',$start_date)
						->orWhere('training_schedules.date_scheduled','<=',$end_date)
						->where('trainings.isActive','=',true)
						->groupBy('training_schedules.date_scheduled')
						->get();

		//dd($itCountPerMonth);

		return View::make('summary_reports.trainings')
					->with('itCount',$it_count)
					->with('etCount',$et_count)
					->with('trainingsCount',$trainings_count)
					->with('itPerMonth',$itCountPerMonth);
	}

	public function scsReport()
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


    	return View::make('summary_reports.scs')
            				->with('scs',$scs)
            				->with('sc_count',$sc_count)
            				->with('sctraining',round($scPerTraining,0,PHP_ROUND_HALF_UP))
            				->with('scdepartment',round($scPerDepartment,0,PHP_ROUND_HALF_UP))
            				->with('scposition',round($scPerPosition,0,PHP_ROUND_HALF_UP));
	}

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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
