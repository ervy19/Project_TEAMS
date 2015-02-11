<?php

class IT_Participant extends Eloquent {

	protected $table ='it_participants';

	protected $fillable = array('id', 'employee_id', 'employee_designation_id', 'internal_training_id', 'isActive');

	protected $appends = array('employee_name','position_title');

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

	/*public function getSupervisorNameAttribute()
	{
		$supervisor = Employee_Designation::find($this->employee_designation_id)
						->join('supervisors','employee_designations.id','=','supervisors.id')
						->
	}*/

	public function getHasPtaAttribute()
	{
		$pta = Participant_Assessment::where('type','=','pta')
				->where('it_participant_id','=',$this->id)
				->first();

		if($pta)
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
		$attendance = IT_Attendance::where('it_participant_id','=',$this->id)
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
				->first();	

		if($pte)
		{
			return true;
		}
		else
		{
			return false;
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