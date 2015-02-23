<?php

class Department extends Eloquent {

	protected $table ='departments';

	protected $fillable = array('name', 'schools_colleges_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('supervisor');

	public function getSupervisorAttribute()
	{
		$department_supervisor = Department_Supervisor::where('department_supervisors.department_id','=',$this->id)
									->first();

		if($department_supervisor)
		{
			$supervisor = Supervisor::find($department_supervisor->supervisor_id);

			return $supervisor->name;
		}
		else
		{
			return 'No Supervisor tagged';
		}
	}

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}

	public function department_sc() {
		return $this->hasMany('Department_SC');
	}
	
}

?>