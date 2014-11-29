<?php

class Participant_Assessment extends Eloquent {

	protected $table ='participant_assessments';

	protected $fillable = array('id', 'type', 'rating', 'verbal_interpretation', 'employee_id', 'supervisor_id', 'training_id', 'isActive');

	public function internal_training() {
		return $this->hasOne('Internal_Training');
	}

	public function assessment_items() {
		return $this->hasMany('Assessment_Item');
	}

	public function employee_designation() {
		return $this->hasOne('Employee_Designation');
	}

	public function supervisor() {
		return $this->hasOne('Supervisor');
	}
	
}

?>