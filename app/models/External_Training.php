<?php

class External_Training extends Eloquent {

	protected $table ='external_trainings';

	protected $fillable = array('training_id', 'participation', 'organizer', 'designation_id', 'isActive');

	public function training() {
		return $this->hasOne('Training');
	}

	public function employee_designation() {
		return $this->belongsToMany('Employee_Designation');
	}
	
}

?>