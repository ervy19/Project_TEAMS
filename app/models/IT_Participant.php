<?php

class IT_Participant extends Eloquent {

	protected $table ='it_participants';

	protected $fillable = array('id', 'employee_id', 'employee_designation_id', 'internal_training_id', 'isActive');

	public function employee() {
		return $this->hasOne('Employee');
	}

	public function employee_designation() {
		return $this->belongsToMany('Employee_Designation');
	}

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}
}

?>