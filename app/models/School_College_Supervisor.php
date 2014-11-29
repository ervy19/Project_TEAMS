<?php

class School_College_Supervisor extends Eloquent {

	protected $table ='schools_colleges_supervisors';

	protected $fillable = array('id', 'name', 'schools_colleges_id', 'isActive');

	public function school_college() {
		return $this->belongsTo('School_College');
	}
	
	public function participant_assessment() {
		return $this->hasMany('Participant_Assessment');
	}
}

?>