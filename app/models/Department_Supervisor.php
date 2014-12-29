<?php

class Department_Supervisor extends Eloquent {

	protected $table ='department_supervisors';

	protected $fillable = array('supervisor_id', 'name', 'title', 'department_id', 'isActive');

	public function supervisor() {
		return $this->hasOne('Supervisor');
	}

	public function department() {
		return $this->belongsTo('Department');
	}
	
}

?>