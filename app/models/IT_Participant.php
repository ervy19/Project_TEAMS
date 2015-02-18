<?php

class IT_Participant extends Eloquent {

	protected $table ='it_participants';

	protected $fillable = array('id', 'employee_id', 'employee_designation_id', 'internal_training_id', 'isActive');

	protected $appends = array('employee_name','position_title','supervisor_name','has_pta','attended','has_pte','requirement_statuses');

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