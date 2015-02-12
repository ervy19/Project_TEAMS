<?php

class ReportsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        
	}

	public function ptaReport($training_id)
	{
        /**training
        Internal_Training
        IT_Participant
        Assessment_Item
        'evaluation_narrative', 'recommendations'*/
		$internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
                                ->join('departments','internal_trainings.organizer_department_id','=','departments.id')
                                ->join('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
                                ->join('it_participants','internal_trainings.training_id','=','it_participants.internal_training_id')
                                ->join('assessment_items', 'internal_trainings.training_id', '=', 'assessment_items.internal_training_id')
                                ->where('training_id', '=', $training_id)
                                ->first();

        $did = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_department_id');
        $department = Department::where('id', '=', $did)->pluck('name');

        $sid = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_schools_colleges_id');
        $schoolcollege = School_College::where('id', '=', $sid)->pluck('name');

        //Get Participant Ratings
        $assessment_item_names = Assessment_Response::select(DB::raw('assessment_responses.name'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->distinct()
                        ->get();

        $assessment_items = array();
        foreach ($assessment_item_names as $key => $value) {
            //GET THE MEAN
            $mean = Assessment_Response::select(DB::raw('assessment_responses.rating'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('assessment_responses.name', '=', $value->name)
                        ->avg('assessment_responses.rating');

            //GET THE STANDARD DEVIATION
            $ratings = Assessment_Response::select(DB::raw('assessment_responses.rating'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('assessment_responses.name', '=', $value->name)
                        ->get();

            $stddev_tmp = array();
            foreach ($ratings as $key => $valuevalue) {
                $tmp = pow($valuevalue->rating - $mean, 2);
                array_push($stddev_tmp, $tmp);
            }

            if(count($stddev_tmp)-1 != 0)
            {
                $variance = array_sum($stddev_tmp) / (count($stddev_tmp) - 1);
                $stddev = sqrt($variance);
            }
            else
            {
                $stddev = 0;
            }


            array_push($assessment_items, array('name' => $value->name, 'mean' => $mean, 'stddev' => $stddev));
        }

        return View::make('reports.pta-report')
            ->with('internaltraining', $internaltraining)
            ->with('department', $department)
            ->with('schoolcollege', $schoolcollege)
            ->with('assessment_items', $assessment_items);
	}

    public function pteReport($training_id)
    {
        return View::make('reports.pte-report');
    }

    public function terReport($training_id)
    {
        //Internal Training Details
        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
                                ->join('departments','internal_trainings.organizer_department_id','=','departments.id')
                                ->join('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
                                ->join('it_participants','internal_trainings.training_id','=','it_participants.internal_training_id')
                                ->join('assessment_items', 'internal_trainings.training_id', '=', 'assessment_items.internal_training_id')
                                ->where('training_id', '=', $training_id)
                                ->first();

        $internaltrainings = Training::where('isActive', '=', true)->where('id', '=', $training_id)->first();
        $eval_narrative = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->pluck('evaluation_narrative');
        $recommendations = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->pluck('recommendations');
        
        $did = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->pluck('organizer_department_id');
        $department = Department::where('isActive', '=', true)->where('id', '=', $did)->pluck('name');

        $sid = Internal_Training::where('isActive', '=', true)->where('training_id', '=', $training_id)->pluck('organizer_schools_colleges_id');
        $schoolcollege = School_College::where('isActive', '=', true)->where('id', '=', $sid)->pluck('name');

        $speaker = Speaker::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->lists('name');
        $speakerstring = implode(', ', $speaker);

        //Tagged Skills and Competencies
        $taggedscid = IT_Addressed_SC::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->lists('skills_competencies_id');
        $scnames = array();
        $count = 1;

        foreach($taggedscid as $key)
        {
            $scname = SkillsCompetencies::where('isActive', '=', true)->where('id', '=', $key)->pluck('name');
            array_push($scnames, array('count' => $count, 'name' => $scname));
            $count++;
        }

        //schedule
        $date_start = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');
        
        $start_time_sched = Training_Schedule::where('isActive', '=', true)->where('training_id', '=', $training_id)->where('isStartDate', '=', 1)->pluck('timeslot');
        $timeArray_start = explode("-", $start_time_sched);
        $time_start_s = $timeArray_start[0];
        $time_end_s = $timeArray_start[1];

        $end_time_sched = Training_Schedule::where('isActive', '=', true)->where('training_id', '=', $training_id)->where('isEndDate', '=', 1)->pluck('timeslot');
        $timeArray_end = explode("-", $end_time_sched);
        $time_start_e = $timeArray_end[0];
        $time_end_e = $timeArray_end[1];

        //average ratings
        $aae_average = Activity_Evaluation::select(DB::raw('planning_criterion1','planning_criterion2','objectives_criterion1','objectives_criterion2','objectives_criterion3','content_criterion1','content_criterion2','materials_criterion1','materials_criterion2','schedule_criterion1','schedule_criterion2','schedule_criterion3','openForum_criterion1','openForum_criterion2','openForum_criterion3','venue_criterion1','venue_criterion2'))
                        ->where('internal_training_id', '=', $training_id)
                        ->avg('planning_criterion1','planning_criterion2','objectives_criterion1','objectives_criterion2','objectives_criterion3','content_criterion1','content_criterion2','materials_criterion1','materials_criterion2','schedule_criterion1','schedule_criterion2','schedule_criterion3','openForum_criterion1','openForum_criterion2','openForum_criterion3','venue_criterion1','venue_criterion2');

        $pta_average = Participant_Assessment::select(DB::raw('participant_assessments.rating'))
                        ->join('it_participants','participant_assessments.it_participant_id','=','it_participants.id')
                        ->where('it_participants.internal_training_id','=',$training_id)
                        ->where('participant_assessments.type','=',"pta")
                        ->avg('participant_assessments.rating');

        $pte_average = Participant_Assessment::select(DB::raw('participant_assessments.rating'))
                        ->join('it_participants','participant_assessments.it_participant_id','=','it_participants.id')
                        ->where('it_participants.internal_training_id','=',$training_id)
                        ->where('participant_assessments.type','=',"pte")
                        ->avg('participant_assessments.rating');

        //verbal interpretation
        //after activity evaluation
        if($aae_average > 4.5 && $aae_average < 5)
        {
            $aae_verbal = "Very Extensive Knowledge";
        }
        else if($aae_average > 3.5 && $aae_average < 4.5)
        {
            $aae_verbal = "Extensive Knowledge";
        }
        else if($aae_average > 2.5 && $aae_average < 3.5)
        {
            $aae_verbal = "Adequate Knowledge";
        }
        else if($aae_average > 1.5 && $aae_average < 2.5)
        {
            $aae_verbal = "Inadequate Knowledge";
        }
        else if($aae_average > 0.5 && $aae_average < 1.5)
        {
            $aae_verbal = "No Knowledge";
        }

        //pre-training assessment
        if($pta_average > 4.5 && $pta_average < 5)
        {
            $pta_verbal = "Very Extensive Knowledge";
        }
        else if($pta_average > 3.5 && $pta_average < 4.5)
        {
            $pta_verbal = "Extensive Knowledge";
        }
        else if($pta_average > 2.5 && $pta_average < 3.5)
        {
            $pta_verbal = "Adequate Knowledge";
        }
        else if($pta_average > 1.5 && $pta_average < 2.5)
        {
            $pta_verbal = "Inadequate Knowledge";
        }
        else if($pta_average > 0.5 && $pta_average < 1.5)
        {
            $pta_verbal = "No Knowledge";
        }

        //post-training assessment
        if($pte_average > 4.5 && $pte_average < 5)
        {
            $pte_verbal = "Very Extensive Knowledge";
        }
        else if($pte_average > 3.5 && $pte_average < 4.5)
        {
            $pte_verbal = "Extensive Knowledge";
        }
        else if($pte_average > 2.5 && $pte_average < 3.5)
        {
            $pte_verbal = "Adequate Knowledge";
        }
        else if($pte_average > 1.5 && $pte_average < 2.5)
        {
            $pte_verbal = "Inadequate Knowledge";
        }
        else if($pte_average > 0.5 && $pte_average < 1.5)
        {
            $pte_verbal = "No Knowledge";
        }


        return View::make('reports.ter-report')
            ->with('internaltraining', $internaltraining)
            ->with('internaltrainings', $internaltrainings)
            ->with('department', $department)
            ->with('schoolcollege', $schoolcollege)
            ->with('speakerstring', $speakerstring)
            ->with('eval_narrative', $eval_narrative)
            ->with('recommendations', $recommendations)
            ->with('scnames', $scnames)
            ->with('count', $count)
            ->with('aae_average', $aae_average)
            ->with('pta_average', $pta_average)
            ->with('pte_average', $pte_average)
            ->with('aae_verbal', $aae_verbal)
            ->with('pta_verbal', $pta_verbal)
            ->with('pte_verbal', $pte_verbal)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end)
            ->with('time_start_s', $time_start_s)
            ->with('time_end_s', $time_end_s)
            ->with('time_start_e', $time_start_e)
            ->with('time_end_e', $time_end_e);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

    public function summaryReport()
    {
        if(Request::ajax()){
            //return Response::json(['data' => $scs]);
        }
        else
        {
            return View::make('summary_reports.trainings');
        }
    }

    public function getTrainingLog($id)
    {
        //get employee details
        $emp_details = Employee::where('id', '=', $id)->get();

        //get employee designation details
        $desig_id = Employee_Designation::where('employee_id', '=', $id)->first();
        $emp_desig_details = array();

        try {
            array_push($emp_desig_details, $desig_id->type);
            array_push($emp_desig_details, Campus::where('id', '=', $desig_id->campus_id)->pluck('name'));
            array_push($emp_desig_details, School_College::where('id', '=', $desig_id->schools_colleges_id)->pluck('name'));
            array_push($emp_desig_details, Department::where('id', '=', $desig_id->department_id)->pluck('name'));



                //Get all internal trainings of the employee
                $it_attended = Training::select(DB::raw('*'))
                            ->leftJoin('it_participants', 'it_participants.internal_training_id', '=', 'trainings.id')
                            ->leftJoin('internal_trainings', 'internal_trainings.training_id', '=', 'it_participants.internal_training_id')
                            ->leftJoin('schools_colleges', 'schools_colleges.id','=','internal_trainings.organizer_schools_colleges_id')
                            //->leftJoin('departments', 'departments.id', '=', 'internal_trainings.organizer_department_id')
                            ->leftJoin('training_schedules', 'training_schedules.training_id', '=', 'trainings.id')
                            ->where('training_schedules.isStartDate', '=', 1)
                            ->where('it_participants.employee_id', '=', $id)
                            ->where('trainings.isInternalTraining', '=', 1)
                            ->where('trainings.isActive', '=', 1)
                            ->get();
         
                //get all external trainings of the employee
                $et_attended = Training::select(DB::raw('*'))
                            ->leftJoin('external_trainings', 'external_trainings.training_id', '=', 'trainings.id')
                            ->leftJoin('employee_designations', 'employee_designations.id', '=', 'external_trainings.designation_id')
                            ->leftJoin('training_schedules', 'training_schedules.et_id', '=', 'external_trainings.training_id')
                            ->where('training_schedules.isStartDate', '=', 1)
                            ->where('employee_designations.employee_id', '=', $id)
                            ->where('trainings.isActive', '=', true)
                            ->where('trainings.isInternalTraining', '=', 0)
                            ->get();
        }
        catch (Exception $e) {
            Session::flash('error', 'Employee has no designations');
            return Redirect::to('employees');
        }
        

        return View::make('reports.training-log')
            ->with('it_attended', $it_attended)
            ->with('et_attended', $et_attended)
            ->with('emp_details', $emp_details)
            ->with('emp_desig_details', $emp_desig_details);
 
        //return PDF::load($html, 'A4', 'portrait')->download('my_pdf');  
    }
}
