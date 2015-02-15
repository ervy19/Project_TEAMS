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
		$internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
                                ->join('departments','internal_trainings.organizer_department_id','=','departments.id')
                                ->join('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
                                ->join('it_participants','internal_trainings.training_id','=','it_participants.internal_training_id')
                                ->join('assessment_items', 'internal_trainings.training_id', '=', 'assessment_items.internal_training_id')
                                ->where('training_id', '=', $training_id)
                                ->first();

        //Get School/College and Department
        $did = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_department_id');
        $department = Department::where('id', '=', $did)->pluck('name');

        $sid = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_schools_colleges_id');
        $schoolcollege = School_College::where('id', '=', $sid)->pluck('name');

        //Get Schedule
        $date_start = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');

        //Get Participant Ratings
        $assessment_item_names = Assessment_Response::select(DB::raw('assessment_responses.name'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('participant_assessments.type', '=', "pta")
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
                        ->where('participant_assessments.type', '=', "pta")
                        ->avg('assessment_responses.rating');

            //GET THE STANDARD DEVIATION
            $ratings = Assessment_Response::select(DB::raw('assessment_responses.rating'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('assessment_responses.name', '=', $value->name)
                        ->where('participant_assessments.type', '=', "pta")
                        ->get();

            $stddev_tmp = array();
            foreach ($ratings as $key2 => $value2) {
                $tmp = pow($value2->rating - $mean, 2);
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

            //VERBAL INTERPRETATION
            if($mean <= 1)
            {
                $verbalinterpretation = "No Knowledge";
            }
            else if(1 < $mean && $mean <= 2)
            {
                $verbalinterpretation = "Inadequate Knowledge";
            }
            else if(2 < $mean && $mean <= 3)
            {
                $verbalinterpretation = "Adequate Knowledge";
            }
            else if(3 < $mean && $mean <= 4)
            {
                $verbalinterpretation = "Extensive Knowledge";
            }
            else if(4 < $mean && $mean <= 5)
            {
                $verbalinterpretation = "Very Extensive Knowledge";
            }

            array_push($assessment_items, array('name' => $value->name, 'mean' => $mean, 'stddev' => $stddev, 'verbalinterpretation' => $verbalinterpretation));
        }

        //RANK
        /**$rank_array = array();
        $init = $assessment_items[0]->"mean";
        $rank_array[0] = 1;
        for ($i=1; $i <= count($assessment_items); $i++) {
            
            if($assessment_items[$i]->"mean" > $init)
            {
                $rank_array[$i]
            }
            else if($assessment_items[i]->"mean" < $init)
            {

            }
            else
            {
                return 'DRAW';
            }
        }*/

        //OVERALLS
        //OVERALL MEAN
        $mean_sum = array();
        foreach ($assessment_items as $key3 => $value3) {
            array_push($mean_sum, $value3["mean"]);
        }
        $overall_mean = array_sum($mean_sum) / count($mean_sum);

        //OVERALL SD (SD OF SD)
        $sd_mean_array = array();
        foreach ($assessment_items as $key4 => $value4) {
            array_push($sd_mean_array, $value4["stddev"]);
        }
        $sd_mean = array_sum($sd_mean_array) / count($sd_mean_array);

        $stddev_tmp2 = array();
        foreach ($sd_mean_array as $key5 => $value5) {
            $tmp2 = pow($value5 - $sd_mean, 2);
            array_push($stddev_tmp2, $tmp2);
        }

        if(count($stddev_tmp2)-1 != 0)
        {
            $overall_variance = array_sum($stddev_tmp2) / (count($stddev_tmp2) - 1);
            $overall_stddev = sqrt($overall_variance);
        }
        else
        {
            $overall_stddev = 0;
        }

        //OVERALL VERBAL INTERPRETATION
        if($overall_mean <= 1)
        {
            $overall_verbalinterpretation = "No Knowledge";
        }
        else if(1 < $overall_mean && $overall_mean <= 2)
        {
            $overall_verbalinterpretation = "Inadequate Knowledge";
        }
        else if(2 < $overall_mean && $overall_mean <= 3)
        {
            $overall_verbalinterpretation = "Adequate Knowledge";
        }
        else if(3 < $overall_mean && $overall_mean <= 4)
        {
            $overall_verbalinterpretation = "Extensive Knowledge";
        }
        else if(4 < $overall_mean && $overall_mean <= 5)
        {
            $overall_verbalinterpretation = "Very Extensive Knowledge";
        }

        //GET INTERNAL TRAINING EVAL NARRATIVE & RECCOMENDATIONS
        $training_narratives = Internal_Training::where('training_id', '=', $training_id)->first();
        $evaluation_and_recomendations_array = array('evaluation' => $training_narratives->evaluation_narrative, 'recommendation' => $training_narratives->recommendations);

        return View::make('reports.pta-report')
            ->with('internaltraining', $internaltraining)
            ->with('department', $department)
            ->with('schoolcollege', $schoolcollege)
            ->with('assessment_items', $assessment_items)
            ->with('overall_mean', $overall_mean)
            ->with('overall_stddev', $overall_stddev)
            ->with('overall_verbalinterpretation', $overall_verbalinterpretation)
            ->with('evaluation_and_recomendations_array', $evaluation_and_recomendations_array)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end);
	}

    public function pteReport($training_id)
    {
        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
                                ->join('departments','internal_trainings.organizer_department_id','=','departments.id')
                                ->join('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
                                ->join('it_participants','internal_trainings.training_id','=','it_participants.internal_training_id')
                                ->join('assessment_items', 'internal_trainings.training_id', '=', 'assessment_items.internal_training_id')
                                ->where('training_id', '=', $training_id)
                                ->first();

        //Get School/College and Department
        $did = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_department_id');
        $department = Department::where('id', '=', $did)->pluck('name');

        $sid = Internal_Training::where('training_id', '=', $training_id)->pluck('organizer_schools_colleges_id');
        $schoolcollege = School_College::where('id', '=', $sid)->pluck('name');

        //Get schedule
        $date_start = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');

        //Get Participant Ratings
        $assessment_item_names = Assessment_Response::select(DB::raw('assessment_responses.name'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('participant_assessments.type', '=', "pte")
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
                        ->where('participant_assessments.type', '=', "pte")
                        ->avg('assessment_responses.rating');

            //GET THE STANDARD DEVIATION
            $ratings = Assessment_Response::select(DB::raw('assessment_responses.rating'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('assessment_responses.name', '=', $value->name)
                        ->where('participant_assessments.type', '=', "pte")
                        ->get();

            $stddev_tmp = array();
            foreach ($ratings as $key2 => $value2) {
                $tmp = pow($value2->rating - $mean, 2);
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

            //VERBAL INTERPRETATION
            if($mean <= 1)
            {
                $verbalinterpretation = "No Knowledge";
            }
            else if(1 < $mean && $mean <= 2)
            {
                $verbalinterpretation = "Inadequate Knowledge";
            }
            else if(2 < $mean && $mean <= 3)
            {
                $verbalinterpretation = "Adequate Knowledge";
            }
            else if(3 < $mean && $mean <= 4)
            {
                $verbalinterpretation = "Extensive Knowledge";
            }
            else if(4 < $mean && $mean <= 5)
            {
                $verbalinterpretation = "Very Extensive Knowledge";
            }

            array_push($assessment_items, array('name' => $value->name, 'mean' => $mean, 'stddev' => $stddev, 'verbalinterpretation' => $verbalinterpretation));
        }

        //RANK
        /**$rank_array = array();
        $init = $assessment_items[0]->"mean";
        $rank_array[0] = 1;
        for ($i=1; $i <= count($assessment_items); $i++) {
            
            if($assessment_items[$i]->"mean" > $init)
            {
                $rank_array[$i]
            }
            else if($assessment_items[i]->"mean" < $init)
            {

            }
            else
            {
                return 'DRAW';
            }
        }*/

        //OVERALLS
        //OVERALL MEAN
        $mean_sum = array();
        foreach ($assessment_items as $key3 => $value3) {
            array_push($mean_sum, $value3["mean"]);
        }
        $overall_mean = array_sum($mean_sum) / count($mean_sum);

        //OVERALL SD (SD OF SD)
        $sd_mean_array = array();
        foreach ($assessment_items as $key4 => $value4) {
            array_push($sd_mean_array, $value4["stddev"]);
        }
        $sd_mean = array_sum($sd_mean_array) / count($sd_mean_array);

        $stddev_tmp2 = array();
        foreach ($sd_mean_array as $key5 => $value5) {
            $tmp2 = pow($value5 - $sd_mean, 2);
            array_push($stddev_tmp2, $tmp2);
        }

        if(count($stddev_tmp2)-1 != 0)
        {
            $overall_variance = array_sum($stddev_tmp2) / (count($stddev_tmp2) - 1);
            $overall_stddev = sqrt($overall_variance);
        }
        else
        {
            $overall_stddev = 0;
        }

        //OVERALL VERBAL INTERPRETATION
        if($overall_mean <= 1)
        {
            $overall_verbalinterpretation = "No Knowledge";
        }
        else if(1 < $overall_mean && $overall_mean <= 2)
        {
            $overall_verbalinterpretation = "Inadequate Knowledge";
        }
        else if(2 < $overall_mean && $overall_mean <= 3)
        {
            $overall_verbalinterpretation = "Adequate Knowledge";
        }
        else if(3 < $overall_mean && $overall_mean <= 4)
        {
            $overall_verbalinterpretation = "Extensive Knowledge";
        }
        else if(4 < $overall_mean && $overall_mean <= 5)
        {
            $overall_verbalinterpretation = "Very Extensive Knowledge";
        }

        //GET INTERNAL TRAINING EVAL NARRATIVE & RECCOMENDATIONS
        $training_narratives = Internal_Training::where('training_id', '=', $training_id)->first();
        $evaluation_and_recomendations_array = array('evaluation' => $training_narratives->evaluation_narrative, 'recommendation' => $training_narratives->recommendations);

        return View::make('reports.pte-report')
            ->with('internaltraining', $internaltraining)
            ->with('department', $department)
            ->with('schoolcollege', $schoolcollege)
            ->with('assessment_items', $assessment_items)
            ->with('overall_mean', $overall_mean)
            ->with('overall_stddev', $overall_stddev)
            ->with('overall_verbalinterpretation', $overall_verbalinterpretation)
            ->with('evaluation_and_recomendations_array', $evaluation_and_recomendations_array)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end);
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
        if($aae_average >= 4.5 && $aae_average <= 5)
        {
            $aae_verbal = "Very Extensive Knowledge";
        }
        else if($aae_average >= 3.5 && $aae_average < 4.5)
        {
            $aae_verbal = "Extensive Knowledge";
        }
        else if($aae_average >= 2.5 && $aae_average < 3.5)
        {
            $aae_verbal = "Adequate Knowledge";
        }
        else if($aae_average >= 1.5 && $aae_average < 2.5)
        {
            $aae_verbal = "Inadequate Knowledge";
        }
        else if($aae_average >= 0.5 && $aae_average < 1.5)
        {
            $aae_verbal = "No Knowledge";
        }

        //after activity evaluation
        if($pta_average >= 4.5 && $pta_average <= 5)
        {
            $ptaverbal = "Very Extensive Knowledge";
        }
        else if($pta_average >= 3.5 && $pta_average < 4.5)
        {
            $ptaverbal = "Extensive Knowledge";
        }
        else if($pta_average >= 2.5 && $pta_average < 3.5)
        {
            $ptaverbal = "Adequate Knowledge";
        }
        else if($pta_average >= 1.5 && $pta_average < 2.5)
        {
            $ptaverbal = "Inadequate Knowledge";
        }
        else if($pta_average >= 0.5 && $pta_average < 1.5)
        {
            $ptaverbal = "No Knowledge";
        }

        //post-training assessment
        if($pte_average >= 4.5 && $pte_average <= 5)
        {
            $pte_verbal = "Very Extensive Knowledge";
        }
        else if($pte_average >= 3.5 && $pte_average < 4.5)
        {
            $pte_verbal = "Extensive Knowledge";
        }
        else if($pte_average >= 2.5 && $pte_average < 3.5)
        {
            $pte_verbal = "Adequate Knowledge";
        }
        else if($pte_average >= 1.5 && $pte_average < 2.5)
        {
            $pte_verbal = "Inadequate Knowledge";
        }
        else if($pte_average >= 0.5 && $pte_average < 1.5)
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
            ->with('pte_verbal', $pte_verbal)
            ->with('ptaverbal', $ptaverbal)
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
