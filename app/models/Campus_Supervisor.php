<?php

class Campus_Supervisor extends Eloquent {

	protected $table ='campus_supervisors';

	protected $fillable = array('id', 'name', 'campus_id', 'isActive');

	public function campus() {
		return $this->belongsTo('Campus');
	}
	
	public function participant_assessment() {
		return $this->hasMany('Participant_Assessment');
	}
}

?>