<?php

class IT_Attendance extends Eloquent {

	protected $table ='it_attendances';

	protected $fillable = array('id', 'time', 'employee_id', 'internal_training_id', 'isActive');

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}

	public function employee() {
		return $this->hasOne('Employee');
	}

}

?>