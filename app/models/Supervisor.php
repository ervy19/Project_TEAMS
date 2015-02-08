<?php

class Supervisor extends Eloquent {

	protected $table ='supervisors';

	protected $fillable = array('name', 'title', 'supervisor_type', 'isActive');

	protected $guarded = 'id';
	
	public function campus_supervisor() {
		return $this->hasMany('Campus_Supervisor');
	}
	
	public function school_college_supervisor() {
		return $this->hasMany('School_College_Supervisor');
	}

	public function department_supervisor() {
		return $this->hasMany('Department_Supervisor');
	}
	
}

?>