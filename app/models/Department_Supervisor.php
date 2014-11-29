<?php

class Department_Supervisor extends Eloquent {

	protected $table ='department_supervisors';

	protected $fillable = array('id', 'name', 'department_id', 'isActive');

	public function department() {
		return $this->belongsTo('Department');
	}
	
	public function participant_assessment() {
		return $this->hasMany('Participant_Assessment');
	}
}

?>