<?php

class Department extends Eloquent {

	protected $table ='departments';

	protected $fillable = array('name', 'schools_colleges_id', 'isActive');

	protected $guarded = 'id';

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}

	public function department_sc() {
		return $this->hasMany('Department_SC');
	}
	
}

?>