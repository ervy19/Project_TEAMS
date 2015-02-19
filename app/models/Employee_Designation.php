<?php

class Employee_Designation extends Eloquent {

	protected $table ='employee_designations';

	protected $fillable = array('type', 'employee_id', 'position_id', 'rank_id', 'schools_colleges_id', 'department_id', 'campus_id', 'supervisor_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('supervisor, supervisor_name, campus_name, schoolcollege_name, department_name, position_title, rank_title, department_scs, position_scs');

	public function campus() {
		return $this->belongsTo('Campus');
	}

	public function school_college() {
		return $this->belongsTo('School_College');
	}

	public function department() {
		return $this->belongsTo('Department');
	}

	public function position() {
		return $this->belongsTo('Position');
	}

	public function rank() {
		return $this->belongsTo('Rank');
	}

	public function external_training() {
		return $this->hasMany('External_Training');
	}

	public function employee() {
		return $this->belongsTo('Employee');
	}

	public function participant_assessment() {
		return $this->hasMany('Participant_Assessment');
	}

	public function getSupervisorAttribute()
	{
		$supervisor = Supervisor::find($this->supervisor_id);

		if($supervisor)
		{
			return $supervisor;
		}
		else
		{
			return '';
		}
	}

	public function getSupervisorNameAttribute()
	{
		$supervisor = Supervisor::find($this->supervisor_id);

		if($supervisor)
		{
			return $supervisor->name;
		}
		else
		{
			return '';
		}
	}

	public function getCampusNameAttribute()
	{
		$campus = Campus::find($this->campus_id);

		if ($campus)
		{
			return $campus->name;
		}
		else
		{
			return '';
		}
		
	}

	public function getSchoolcollegeNameAttribute()
	{
		$school_college = School_College::find($this->schools_colleges_id);

		if($school_college)
		{
			return $school_college->name;
		}
		else
		{
			return '';
		}
	}

	public function getDepartmentNameAttribute()
	{
		$department = Department::find($this->department_id);

		if($department)
		{
			return $department->name;
		}
		else
		{
			return '';
		}
	}

	public function getPositionTitleAttribute()
	{
		$position = Position::find($this->position_id);

		if($position)
		{
			return $position->title;
		}
		else
		{
			return '';
		}
	}

		public function getRankTitleAttribute()
	{
		$rank = Rank::find($this->rank_id);

		if($rank)
		{
			return $rank->title;
		}
		else
		{
			return '';
		}
	}

	public function getDepartmentScsAttribute()
	{
		$department_scs = Department_SC::where('isActive','=',true)
							->where('department_id','=',$this->department_id)
							->get();

		if(!$department_scs->isEmpty())
		{
			return $department_scs;
		}
		else
		{
			return '';
		}
	}

	public function getPositionScsAttribute()
	{
		$position_scs = Position_SC::where('isActive','=',true)
							->where('position_id','=',$this->position_id)
							->get();

		if(!$position_scs->isEmpty())
		{
			return $position_scs;
		}
		else
		{
			return '';
		}
	}
}

?>