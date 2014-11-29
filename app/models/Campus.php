<?php

class Campus extends Eloquent {

	protected $table ='campuses';

	protected $fillable = array('id', 'title', 'address', 'isActive');

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}
	
	public function campus_supervisor() {
		return $this->hasOne('Campus_Supervisor');
	}
}

?>