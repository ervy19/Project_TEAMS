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
        return View::make('reports.ter-report');
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
