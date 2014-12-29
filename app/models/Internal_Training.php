<?php

class Internal_Training extends Eloquent {

	protected $table ='internal_trainings';

	protected $fillable = array('training_id', 'format', 'objectives', 'expected_outcome', 'evaluation_narrative', 'recommendations', 'organizer_schools_colleges_id', 'organizer_department_id', 'isTrainingPlan', 'isActive');

	public function department() {
		return $this->belongsTo('Department');
	}
	
	public function school_college() {
		return $this->belongsTo('School_College');
	}

	public function training() {
		return $this->hasOne('Training');
	}
}

?>