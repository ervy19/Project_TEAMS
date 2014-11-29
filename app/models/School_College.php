<?php

class School_College extends Eloquent {

	protected $table ='schools_colleges';

	protected $fillable = array('id', 'name', 'isActive');

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}
	
	public function school_college_supervisor() {
		return $this->hasOne('School_College_Supervisor');
	}
}

?>