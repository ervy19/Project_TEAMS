<?php

class IT_Participant extends Eloquent {

	protected $table ='it_participants';

	protected $fillable = array('id', 'employee_id', 'employee_designation_id', 'internal_training_id', 'isActive');

	protected $appends = array('training_id','training_type','employee_name','position_title','supervisor_name','training_title','has_pta','attended','has_pte','requirement_statuses','training_scs');

	public function getTrainingIdAttribute()
	{
		return $this->internal_training_id;
	}	

	public function getTrainingTypeAttribute()
	{
		return 'Internal';
	}

	public function getEmployeeNameAttribute()
	{
		$employee = Employee::find($this->employee_id);

		if($employee)
		{
			return $employee->full_name;
		}
		else
		{
			return '';
		}
	}

	public function getPositionTitleAttribute()
	{
		$employee_designation = Employee_Designation::where('employee_designations.employee_id','=',$this->employee_id)->first();

		if($employee_designation)
		{
			$position = Position::find($employee_designation->position_id);

			return $position->title;
		}
		else
		{
			return '';
		}
	}

	public function getSupervisorNameAttribute()
	{
		$supervisor = Employee_Designation::join('supervisors','employee_designations.supervisor_id','=','supervisors.id')
						->where('employee_designations.id','=',$this->employee_designation_id)
						->where('employee_designations.isActive','=',true)
						->first();

		if($supervisor)
		{
			return $supervisor->name;
		}
		else
		{
			return '';
		}
	}

	public function getTrainingTitleAttribute()
	{
		$training = Training::find($this->internal_training_id);

		if($training)
		{
			return $training->title;
		}
		else
		{
			return '';
		}
	}

	public function getHasPtaAttribute()
	{
		$pta = Participant_Assessment::where('type','=','pta')
									->where('it_participant_id','=',$this->id)
									->where('isActive','=',true)
									->first();

		if($pta && $pta->has_response)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAttendedAttribute()
	{
		$attendance = Participant_Attendance::where('it_participant_id','=',$this->id)
						->where('isActive','=',true)
						->first();

		if($attendance)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getHasPteAttribute()
	{
		$pte = Participant_Assessment::where('type','=','pte')
									->where('it_participant_id','=',$this->id)
									->where('isActive','=',true)
									->first();

		if($pte && $pte->has_response)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getRequirementStatusesAttribute()
	{
		$pta = Participant_Assessment::where('type','=','pta')
									->where('it_participant_id','=',$this->id)
									->where('isActive','=',true)
									->first();

		$attendance = Participant_Attendance::where('it_participant_id','=',$this->id)
						->first();

		$pte = Participant_Assessment::where('type','=','pte')
									->where('it_participant_id','=',$this->id)
									->where('isActive','=',true)
									->first();

		$requirementStatus = array();

		if($pta && $pta->has_response)
		{
			array_push($requirementStatus, true);
		}
		else
		{
			array_push($requirementStatus, false);
		}

		if($attendance)
		{
			array_push($requirementStatus, true);
		}
		else
		{
			array_push($requirementStatus, false);
		}

		if($pte && $pte->has_response)
		{
			array_push($requirementStatus, true);
		}
		else
		{
			array_push($requirementStatus, false);
		}

		return $requirementStatus;

	}

	public function getTrainingScsAttribute()
	{
		$scs = IT_Addressed_SC::where('internal_training_id','=',$this->internal_training_id)
					->where('isActive','=',true)
					->get();

		if(!$scs->isEmpty())
		{

			return $scs;
		}
		else
		{
			return '';
		}
	}

	public function employee() {
		return $this->hasOne('Employee');
	}

	public function employee_designation() {
		return $this->belongsToMany('Employee_Designation');
	}

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}
}

?>