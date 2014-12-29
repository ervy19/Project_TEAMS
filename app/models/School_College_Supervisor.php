<?php

class School_College_Supervisor extends Eloquent {

	protected $table ='schools_colleges_supervisors';

	protected $fillable = array('supervisor_id', 'name', 'title', 'schools_colleges_id', 'isActive');

	public function supervisor() {
		return $this->hasOne('Supervisor');
	}

	public function school_college() {
		return $this->belongsTo('School_College');
	}
}

?>