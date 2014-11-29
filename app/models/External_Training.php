<?php

class External_Training extends Eloquent {

	protected $table ='external_trainings';

	protected $fillable = array('id', 'title', 'theme_topic', 'participation', 'organizer', 'venue', 'date_start', 'date_end', 'designation_id', 'isActive');

	public function employee_designation() {
		return $this->hasOne('Employee_Designation');
	}

	public function et_addressed_sc() {
		return $this->hasOne('ET_Addressed_SC');
	}
	
}

?>