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

        $assessment_items = Assessment_Item::where('internal_training_id', '=', $training_id)->get();

        //Get Participant Ratings
        $itparticipant = IT_Participant::where('internal_training_id', '=', $training_id)->lists('id');
        $partassessments = array();

        foreach($itparticipant as $key)
        {
            $participantassessment = Participant_Assessment::where('it_participant_id', '=', $key)->pluck('id');
            array_push($partassessments, $participantassessment);
        }

        $responses = array();

        foreach($partassessments as $assessment)
        {
            $assessmentresponse = Assessment_Response::where('participant_assessment_id', '=', $assessment)->pluck('rating');
            array_push($responses, $assessmentresponse);
        }

        /**$meanresponses = DB::table('orders')->avg('price');

        $internaltraining = Internal_Training::select(DB::raw('*'))
                                ->join('trainings','internal_trainings.training_id','=','trainings.id')
                                ->join('departments','internal_trainings.organizer_department_id','=','departments.id')
                                ->join('schools_colleges','internal_trainings.organizer_schools_colleges_id','=','schools_colleges.id')
                                ->join('it_participants','internal_trainings.training_id','=','it_participants.internal_training_id')
                                ->join('assessment_items', 'internal_trainings.training_id', '=', 'assessment_items.internal_training_id')
                                ->where('training_id', '=', $training_id)
                                ->first();*/

        return View::make('reports.pta-report')
            ->with('internaltraining', $internaltraining)
            ->with('department', $department)
            ->with('schoolcollege', $schoolcollege)
            ->with('assessment_items', $assessment_items)
            ->with('responses', $responses);
	}

    public function pteReport($training_id)
    {
        return View::make('reports.pte-report');
    }

    public function terReport($training_id)
    {
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

        //try {
            array_push($emp_desig_details, $desig_id->type);
            array_push($emp_desig_details, Campus::where('id', '=', $desig_id->campus_id)->pluck('name'));
            array_push($emp_desig_details, School_College::where('id', '=', $desig_id->schools_colleges_id)->pluck('name'));
            array_push($emp_desig_details, Department::where('id', '=', $desig_id->department_id)->pluck('name'));



                //Get all internal trainings of the employee
                $it_attended = Training::select(DB::raw('*'))
                            ->leftJoin('it_attendances', 'it_attendances.internal_training_id', '=', 'trainings.id')
                            ->leftJoin('internal_trainings', 'internal_trainings.training_id', '=', 'it_attendances.internal_training_id')
                            ->leftJoin('schools_colleges', 'schools_colleges.id','=','internal_trainings.organizer_schools_colleges_id')
                            //->leftJoin('departments', 'departments.id', '=', 'internal_trainings.organizer_department_id')
                            ->where('it_attendances.employee_id', '=', $id)
                            ->where('trainings.isInternalTraining', '=', 1)
                            ->where('trainings.isActive', '=', 1)
                            ->get();
         
                //get all external trainings of the employee
                $et_attended = Training::select(DB::raw('*'))
                            ->leftJoin('external_trainings', 'external_trainings.training_id', '=', 'trainings.id')
                            ->leftJoin('employee_designations', 'employee_designations.id', '=', 'external_trainings.designation_id')
                            ->where('employee_designations.employee_id', '=', $id)
                            ->where('trainings.isActive', '=', true)
                            ->where('trainings.isInternalTraining', '=', 0)
                            ->get();
        
    /** }
        catch (Exception $e) {
            Session::flash('error', 'Employee has no designations');
            return Redirect::to('employees');
        }**/
        

        return View::make('reports.training-log')
            ->with('it_attended', $it_attended)
            ->with('et_attended', $et_attended)
            ->with('emp_details', $emp_details)
            ->with('emp_desig_details', $emp_desig_details);
        
        //return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
    }
}
