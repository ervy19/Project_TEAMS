<?php

class External_Training extends Eloquent {

	protected $table ='external_trainings';

	protected $fillable = array('participation', 'organizer', 'designation_id', 'isActive');

	protected $guarded = 'training_id';

	public function training() {
		return $this->hasOne('Training');
	}

	public function employee_designation() {
		return $this->belongsToMany('Employee_Designation');
	}
	
}

?>