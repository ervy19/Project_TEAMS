<?php

class Campus extends Eloquent {

	protected $table ='campuses';

	protected $fillable = array('name', 'address');

	protected $guarded = array('id');

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}
	
	public function campus_supervisor() {
		return $this->hasOne('Campus_Supervisor');
	}
}

?>