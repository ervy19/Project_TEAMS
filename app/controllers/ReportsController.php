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

    public function errorPage($training_id)
    {
        return View::make('reports.error-page');
    }

	public function ptaReport($training_id)
	{
		$internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
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
        $date_start_tmp = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end_tmp = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');

        //Get Participant Ratings
        $assessment_item_names = Assessment_Response::select(DB::raw('assessment_responses.name'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('participant_assessments.type', '=', "pta")
                        ->distinct()
                        ->get();

        if ($assessment_item_names == NULL)
        {
             $strerror = "PTA has not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }
        else
        {
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

        $dateformat_start = new DateTime($date_start_tmp);
        $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

        $dateformat_end = new DateTime($date_end_tmp);
        $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

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
	}

    public function pteReport($training_id)
    {
        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
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
        $date_start_tmp = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end_tmp = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');

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

        $dateformat_start = new DateTime($date_start_tmp);
        $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

        $dateformat_end = new DateTime($date_end_tmp);
        $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

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
        $date_start_tmp = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end_tmp = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');
        
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

        //VERBAL INTERPRETATION FOR OVERALL AVERAGE RATINGS
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
            $pta_verbal = "Very Extensive Knowledge";
        }
        else if($pta_average >= 3.5 && $pta_average < 4.5)
        {
            $pta_verbal = "Extensive Knowledge";
        }
        else if($pta_average >= 2.5 && $pta_average < 3.5)
        {
            $pta_verbal = "Adequate Knowledge";
        }
        else if($pta_average >= 1.5 && $pta_average < 2.5)
        {
            $pta_verbal = "Inadequate Knowledge";
        }
        else if($pta_average >= 0.5 && $pta_average < 1.5)
        {
            $pta_verbal = "No Knowledge";
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

        //PARTICIPANTS TABLE
        $allparticipants = IT_Participant::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->lists('id');
        $participants = array();
        $ptatotal = 0;
        $ptetotal = 0;
        $count = 0;

        foreach ($allparticipants as $participant_id)
        {
            $lastname = IT_Participant::select(DB::raw('*'))
                    ->join('employees','it_participants.employee_id','=','employees.id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('it_participants.id','=',$participant_id)
                    ->pluck('last_name');

            $givenname = IT_Participant::select(DB::raw('*'))
                    ->join('employees','it_participants.employee_id','=','employees.id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('it_participants.id','=',$participant_id)
                    ->pluck('given_name');

            $mi = IT_Participant::select(DB::raw('*'))
                    ->join('employees','it_participants.employee_id','=','employees.id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('it_participants.id','=',$participant_id)
                    ->pluck('middle_initial');
            
            $pta = IT_Participant::select(DB::raw('*'))
                    ->join('participant_assessments','it_participants.id','=','participant_assessments.it_participant_id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('participant_assessments.type','=',"pta")
                    ->where('participant_assessments.it_participant_id', '=', $participant_id)
                    ->avg('participant_assessments.rating');
            
            $ptatotal += $pta;

            //post-training assessment
                if($pta >= 4.5 && $pte_average <= 5)
                {
                    $ptaverbal = "Very Extensive Knowledge";
                }
                else if($pta >= 3.5 && $pte_average < 4.5)
                {
                    $ptaverbal = "Extensive Knowledge";
                }
                else if($pta >= 2.5 && $pte_average < 3.5)
                {
                    $ptaverbal = "Adequate Knowledge";
                }
                else if($pta >= 1.5 && $pte_average < 2.5)
                {
                    $ptaverbal = "Inadequate Knowledge";
                }
                else if($pta >= 0.5 && $pte_average < 1.5)
                {
                    $ptaverbal = "No Knowledge";
                }
                else
                {
                    $ptaverbal = "";
                }

                $pte = IT_Participant::select(DB::raw('*'))
                    ->join('participant_assessments','it_participants.id','=','participant_assessments.it_participant_id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('participant_assessments.type','=',"pte")
                    ->where('participant_assessments.it_participant_id', '=', $participant_id)
                    ->avg('participant_assessments.rating');

                $ptetotal += $pte;

            //post-training assessment
                if($pte >= 4.5 && $pte_average <= 5)
                {
                    $pteverbal = "Very Extensive Knowledge";
                }
                else if($pte >= 3.5 && $pte_average < 4.5)
                {
                    $pteverbal = "Extensive Knowledge";
                }
                else if($pte >= 2.5 && $pte_average < 3.5)
                {
                    $pteverbal = "Adequate Knowledge";
                }
                else if($pte >= 1.5 && $pte_average < 2.5)
                {
                    $pteverbal = "Inadequate Knowledge";
                }
                else if($pte >= 0.5 && $pte_average < 1.5)
                {
                    $pteverbal = "No Knowledge";
                }

                $count++;
            
            array_push($participants, array('last' => $lastname, 'given' => $givenname, 'mi' => $mi, 'pta' => $pta, 'ptaverbal' => $ptaverbal, 'pte' => $pte, 'pteverbal' => $pteverbal));
        }

        $overallpta = $ptatotal/$count;
        $overallpte = $ptetotal/$count;

        //pre-training assessment
            if($overallpta >= 4.5 && $pte_average <= 5)
            {
                $overallptaverbal = "Very Extensive Knowledge";
            }
            else if($overallpta >= 3.5 && $pte_average < 4.5)
            {
                $overallptaverbal = "Extensive Knowledge";
            }
            else if($overallpta >= 2.5 && $pte_average < 3.5)
            {
                $overallptaverbal = "Adequate Knowledge";
            }
            else if($overallpta >= 1.5 && $pte_average < 2.5)
            {
                $overallptaverbal = "Inadequate Knowledge";
            }
            else if($overallpta >= 0.5 && $pte_average < 1.5)
            {
                $overallptaverbal = "No Knowledge";
            }
            else
            {
                $overallptaverbal = "";
            }

        //pre-training assessment
            if($overallpte >= 4.5 && $pte_average <= 5)
            {
                $overallpteverbal = "Very Extensive Knowledge";
            }
            else if($overallpte >= 3.5 && $pte_average < 4.5)
            {
                $overallpteverbal = "Extensive Knowledge";
            }
            else if($overallpte >= 2.5 && $pte_average < 3.5)
            {
                $overallpteverbal = "Adequate Knowledge";
            }
            else if($overallpte >= 1.5 && $pte_average < 2.5)
            {
                $overallpteverbal = "Inadequate Knowledge";
            }
            else if($overallpte >= 0.5 && $pte_average < 1.5)
            {
                $overallpteverbal = "No Knowledge";
            }
            else
            {
                $overallpteverbal = "";
            }

        $overallaveratings = array();
        array_push($overallaveratings, array('overallpta' => $overallpta, 'overallptaverbal' => $overallptaverbal, 'overallpte' => $overallpte, 'overallpteverbal' => $overallpteverbal));

        $dateformat_start = new DateTime($date_start_tmp);
        $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

        $dateformat_end = new DateTime($date_end_tmp);
        $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

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
            ->with('pta_verbal', $pta_verbal)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end)
            ->with('time_start_s', $time_start_s)
            ->with('time_end_s', $time_end_s)
            ->with('time_start_e', $time_start_e)
            ->with('time_end_e', $time_end_e)
            ->with('participants', $participants)
            ->with('overallaveratings', $overallaveratings);
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
                            //->leftJoin('schools_colleges', 'schools_colleges.id','=','internal_trainings.organizer_schools_colleges_id')
                            ->leftJoin('departments', 'departments.id', '=', 'internal_trainings.organizer_department_id')
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
            return Redirect::to('employees')->with('error');
        }
        

        return View::make('reports.training-log')
            ->with('it_attended', $it_attended)
            ->with('et_attended', $et_attended)
            ->with('emp_details', $emp_details)
            ->with('emp_desig_details', $emp_desig_details);
    }

    public function downloadTrainingLog($id)
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
                            //->leftJoin('schools_colleges', 'schools_colleges.id','=','internal_trainings.organizer_schools_colleges_id')
                            ->leftJoin('departments', 'departments.id', '=', 'internal_trainings.organizer_department_id')
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

        $data = array(
            'it_attended' => $it_attended,
            'et_attended' => $et_attended,
            'emp_details' => $emp_details,
            'emp_desig_details' => $emp_desig_details
            );

        date_default_timezone_set('Asia/Manila');
        $currentTimeDate = date("Y-m-d H:i:s"); 
        $currentTime = date("H:i:s");
        $currentDate = date("Y-m-d");

        $pdf = PDF::loadView('reports.training-log-download', $data);
        $pdf->setOrientation('landscape');
        return $pdf->download($currentDate . ' ' . $emp_details[0]->last_name . ', ' . $emp_details[0]->given_name . ' ' . $emp_details[0]->middle_initial . ' Training Log.pdf');
    }

    public function downloadPtaReport($training_id)
    {
        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
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
        $date_start_tmp = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end_tmp = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');

        //Get Participant Ratings
        $assessment_item_names = Assessment_Response::select(DB::raw('assessment_responses.name'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('participant_assessments.type', '=', "pta")
                        ->distinct()
                        ->get();

        $oneItem = Assessment_Item::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('name');
        $oneResponse = Assessment_Response::where('isActive','=',true)->where('name', '=', $oneItem)->pluck('id');

        $itpart = IT_Participant::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('id');
        $partassess = Participant_Assessment::where('isActive','=',true)->where('it_participant_id','=',$itpart)->where('type','=',"pta")->pluck('id');
        
        if($partassess == NULL)
        {
            $strerror = "PTA has not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }           
        else
        {
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

            $dateformat_start = new DateTime($date_start_tmp);
            $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

            $dateformat_end = new DateTime($date_end_tmp);
            $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

            $data = array(
                'internaltraining' => $internaltraining,
                'department' => $department,
                'schoolcollege' => $schoolcollege,
                'assessment_items' => $assessment_items,
                'overall_mean' => $overall_mean,
                'overall_stddev' => $overall_stddev,
                'overall_verbalinterpretation' => $overall_verbalinterpretation,
                'evaluation_and_recomendations_array' => $evaluation_and_recomendations_array,
                'date_start' => $date_start,
                'date_end' => $date_end
                );

            date_default_timezone_set('Asia/Manila');
            $currentTimeDate = date("Y-m-d H:i:s"); 
            $currentTime = date("H:i:s");
            $currentDate = date("Y-m-d");

            $pdf = PDF::loadView('reports.pta-report-download', $data);
            return $pdf->download($currentDate . ' ' . $internaltraining->title .' Pre-Training Assessment.pdf');         
            }

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

            $dateformat_start = new DateTime($date_start_tmp);
            $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

            $dateformat_end = new DateTime($date_end_tmp);
            $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

            $data = array(
                'internaltraining' => $internaltraining,
                'department' => $department,
                'schoolcollege' => $schoolcollege,
                'assessment_items' => $assessment_items,
                'overall_mean' => $overall_mean,
                'overall_stddev' => $overall_stddev,
                'overall_verbalinterpretation' => $overall_verbalinterpretation,
                'evaluation_and_recomendations_array' => $evaluation_and_recomendations_array,
                'date_start' => $date_start,
                'date_end' => $date_end
                );

            date_default_timezone_set('Asia/Manila');
            $currentTimeDate = date("Y-m-d H:i:s"); 
            $currentTime = date("H:i:s");
            $currentDate = date("Y-m-d");

            $pdf = PDF::loadView('reports.pta-report-download', $data);
            return $pdf->download($currentDate . ' ' . $internaltraining->title .' Pre-Training Assessment.pdf');
    }

    public function downloadPteReport($training_id)
    {
        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
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
        $date_start_tmp = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end_tmp = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');

        //Get Participant Ratings
        $assessment_item_names = Assessment_Response::select(DB::raw('assessment_responses.name'))
                        ->join('participant_assessments', 'participant_assessments.id', '=', 'assessment_responses.participant_assessment_id')
                        ->join('it_participants', 'it_participants.id', '=', 'participant_assessments.it_participant_id')
                        ->where('it_participants.internal_training_id', '=', $training_id)
                        ->where('participant_assessments.type', '=', "pte")
                        ->distinct()
                        ->get();

        $oneItem = Assessment_Item::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('name');
        $oneResponse = Assessment_Response::where('isActive','=',true)->where('name', '=', $oneItem)->pluck('id');

        $itpart = IT_Participant::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('id');
        $partassess = Participant_Assessment::where('isActive','=',true)->where('it_participant_id','=',$itpart)->where('type','=',"pte")->pluck('id');
        
        if($partassess == NULL)
        {
            $strerror = "PTE has not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }
        else
        {
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

        $dateformat_start = new DateTime($date_start_tmp);
        $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

        $dateformat_end = new DateTime($date_end_tmp);
        $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

        $data = array(
            'internaltraining' => $internaltraining,
            'department' => $department,
            'schoolcollege' => $schoolcollege,
            'assessment_items' => $assessment_items,
            'overall_mean' => $overall_mean,
            'overall_stddev' => $overall_stddev,
            'overall_verbalinterpretation' => $overall_verbalinterpretation,
            'evaluation_and_recomendations_array' => $evaluation_and_recomendations_array,
            'date_start' => $date_start,
            'date_end' => $date_end
            );

        date_default_timezone_set('Asia/Manila');
        $currentTimeDate = date("Y-m-d H:i:s"); 
        $currentTime = date("H:i:s");
        $currentDate = date("Y-m-d");

        $pdf = PDF::loadView('reports.pte-report-download', $data);
        return $pdf->download($currentDate . ' ' . $internaltraining->title . ' Post Training Evaluation.pdf');
        }                 
    }

    public function downloadTerReport($training_id)
    {
        //Internal Training Details
        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
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
        $date_start_tmp = Training_Schedule::where('isActive', '=', true)->where('isStartDate', '=', 1)->pluck('date_scheduled');
        $date_end_tmp = Training_Schedule::where('isActive', '=', true)->where('isEndDate', '=', 1)->pluck('date_scheduled');
        
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

        //Test
        $oneItem = Assessment_Item::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('name');
        $oneResponse = Assessment_Response::where('isActive','=',true)->where('name', '=', $oneItem)->pluck('id');

        $itpart = IT_Participant::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('id');
        $partassesspta = Participant_Assessment::where('isActive','=',true)->where('it_participant_id','=',$itpart)->where('type','=',"pte")->pluck('id');
        $partassesspte = Participant_Assessment::where('isActive','=',true)->where('it_participant_id','=',$itpart)->where('type','=',"pte")->pluck('id');
        $aae_test = Activity_Evaluation::where('isActive','=',true)->where('internal_training_id','=',$training_id)->pluck('planning_criterion1');
        
        if($partassesspte == NULL && $partassesspta == NULL)
        {
            $strerror = "PTA and PTE have not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }
        else if($partassesspta == NULL)
        {
            $strerror = "PTA has not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }
        else if($partassesspte == NULL)
        {
            $strerror = "PTE has not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }
        else if($aae_test == NULL)
        {
            $strerror = "After Activity Evaluation has not been accomplished yet.";
            return View::make('reports.error-page')
            ->with('internaltraining', $internaltraining)
            ->with('strerror', $strerror);
        }
        else
        {
            //VERBAL INTERPRETATION FOR OVERALL AVERAGE RATINGS
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
            $pta_verbal = "Very Extensive Knowledge";
        }
        else if($pta_average >= 3.5 && $pta_average < 4.5)
        {
            $pta_verbal = "Extensive Knowledge";
        }
        else if($pta_average >= 2.5 && $pta_average < 3.5)
        {
            $pta_verbal = "Adequate Knowledge";
        }
        else if($pta_average >= 1.5 && $pta_average < 2.5)
        {
            $pta_verbal = "Inadequate Knowledge";
        }
        else if($pta_average >= 0.5 && $pta_average < 1.5)
        {
            $pta_verbal = "No Knowledge";
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

        //PARTICIPANTS TABLE
        $allparticipants = IT_Participant::where('isActive', '=', true)->where('internal_training_id', '=', $training_id)->lists('id');
        $participants = array();
        $ptatotal = 0;
        $ptetotal = 0;
        $count = 0;

        foreach ($allparticipants as $participant_id)
        {
            $lastname = IT_Participant::select(DB::raw('*'))
                    ->join('employees','it_participants.employee_id','=','employees.id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('it_participants.id','=',$participant_id)
                    ->pluck('last_name');

            $givenname = IT_Participant::select(DB::raw('*'))
                    ->join('employees','it_participants.employee_id','=','employees.id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('it_participants.id','=',$participant_id)
                    ->pluck('given_name');

            $mi = IT_Participant::select(DB::raw('*'))
                    ->join('employees','it_participants.employee_id','=','employees.id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('it_participants.id','=',$participant_id)
                    ->pluck('middle_initial');
            
            $pta = IT_Participant::select(DB::raw('*'))
                    ->join('participant_assessments','it_participants.id','=','participant_assessments.it_participant_id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('participant_assessments.type','=',"pta")
                    ->where('participant_assessments.it_participant_id', '=', $participant_id)
                    ->avg('participant_assessments.rating');
            
            $ptatotal += $pta;

            //post-training assessment
                if($pta >= 4.5 && $pte_average <= 5)
                {
                    $ptaverbal = "Very Extensive Knowledge";
                }
                else if($pta >= 3.5 && $pte_average < 4.5)
                {
                    $ptaverbal = "Extensive Knowledge";
                }
                else if($pta >= 2.5 && $pte_average < 3.5)
                {
                    $ptaverbal = "Adequate Knowledge";
                }
                else if($pta >= 1.5 && $pte_average < 2.5)
                {
                    $ptaverbal = "Inadequate Knowledge";
                }
                else if($pta >= 0.5 && $pte_average < 1.5)
                {
                    $ptaverbal = "No Knowledge";
                }
                else
                {
                    $ptaverbal = "";
                }

                $pte = IT_Participant::select(DB::raw('*'))
                    ->join('participant_assessments','it_participants.id','=','participant_assessments.it_participant_id')
                    ->where('it_participants.internal_training_id','=',$training_id)
                    ->where('participant_assessments.type','=',"pte")
                    ->where('participant_assessments.it_participant_id', '=', $participant_id)
                    ->avg('participant_assessments.rating');

                $ptetotal += $pte;

            //post-training assessment
                if($pte >= 4.5 && $pte_average <= 5)
                {
                    $pteverbal = "Very Extensive Knowledge";
                }
                else if($pte >= 3.5 && $pte_average < 4.5)
                {
                    $pteverbal = "Extensive Knowledge";
                }
                else if($pte >= 2.5 && $pte_average < 3.5)
                {
                    $pteverbal = "Adequate Knowledge";
                }
                else if($pte >= 1.5 && $pte_average < 2.5)
                {
                    $pteverbal = "Inadequate Knowledge";
                }
                else if($pte >= 0.5 && $pte_average < 1.5)
                {
                    $pteverbal = "No Knowledge";
                }

                $count++;
            
            array_push($participants, array('last' => $lastname, 'given' => $givenname, 'mi' => $mi, 'pta' => $pta, 'ptaverbal' => $ptaverbal, 'pte' => $pte, 'pteverbal' => $pteverbal));
        }

        $overallpta = $ptatotal/$count;
        $overallpte = $ptetotal/$count;

        //pre-training assessment
            if($overallpta >= 4.5 && $pte_average <= 5)
            {
                $overallptaverbal = "Very Extensive Knowledge";
            }
            else if($overallpta >= 3.5 && $pte_average < 4.5)
            {
                $overallptaverbal = "Extensive Knowledge";
            }
            else if($overallpta >= 2.5 && $pte_average < 3.5)
            {
                $overallptaverbal = "Adequate Knowledge";
            }
            else if($overallpta >= 1.5 && $pte_average < 2.5)
            {
                $overallptaverbal = "Inadequate Knowledge";
            }
            else if($overallpta >= 0.5 && $pte_average < 1.5)
            {
                $overallptaverbal = "No Knowledge";
            }
            else
            {
                $overallptaverbal = "";
            }

        //pre-training assessment
            if($overallpte >= 4.5 && $pte_average <= 5)
            {
                $overallpteverbal = "Very Extensive Knowledge";
            }
            else if($overallpte >= 3.5 && $pte_average < 4.5)
            {
                $overallpteverbal = "Extensive Knowledge";
            }
            else if($overallpte >= 2.5 && $pte_average < 3.5)
            {
                $overallpteverbal = "Adequate Knowledge";
            }
            else if($overallpte >= 1.5 && $pte_average < 2.5)
            {
                $overallpteverbal = "Inadequate Knowledge";
            }
            else if($overallpte >= 0.5 && $pte_average < 1.5)
            {
                $overallpteverbal = "No Knowledge";
            }
            else
            {
                $overallpteverbal = "";
            }

        $overallaveratings = array();
        array_push($overallaveratings, array('overallpta' => $overallpta, 'overallptaverbal' => $overallptaverbal, 'overallpte' => $overallpte, 'overallpteverbal' => $overallpteverbal));

        $dateformat_start = new DateTime($date_start_tmp);
        $date_start = DATE_FORMAT($dateformat_start,'F d, Y');

        $dateformat_end = new DateTime($date_end_tmp);
        $date_end = DATE_FORMAT($dateformat_end,'F d, Y');

        $data = array(
            'internaltraining' => $internaltraining,
            'internaltrainings'=> $internaltrainings,
            'department'=> $department,
            'schoolcollege' => $schoolcollege,
            'speakerstring' => $speakerstring,
            'eval_narrative' => $eval_narrative,
            'recommendations' => $recommendations,
            'scnames' => $scnames,
            'count' => $count,
            'aae_average' => $aae_average,
            'pta_average' => $pta_average,
            'pte_average' => $pte_average,
            'aae_verbal' => $aae_verbal,
            'pte_verbal' => $pte_verbal,
            'pta_verbal' => $pta_verbal,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'time_start_s' => $time_start_s,
            'time_end_s' => $time_end_s,
            'time_start_e' => $time_start_e,
            'time_end_e' => $time_end_e,
            'participants' => $participants,
            'overallaveratings' => $overallaveratings
            );

        date_default_timezone_set('Asia/Manila');
        $currentTimeDate = date("Y-m-d H:i:s"); 
        $currentTime = date("H:i:s");
        $currentDate = date("Y-m-d");

        $pdf = PDF::loadView('reports.ter-report-download', $data);
        return $pdf->download($currentDate . ' ' . $internaltrainings->title . ' Training Effectiveness Report.pdf');
    }
        

    }
}
