<?php

class Employee_Designation extends Eloquent {

	protected $table ='employee_designations';

	protected $fillable = array('type', 'employee_id', 'position_id', 'rank_id', 'schools_colleges_id', 'department_id', 'campus_id', 'isActive');

	protected $guarded = 'id';

	public function campus() {
		return $this->belongsTo('Campus');
	}

	public function school_college() {
		return $this->belongsTo('School_College');
	}

	public function department() {
		return $this->belongsTo('Department');
	}

	public function position() {
		return $this->belongsTo('Position');
	}

	public function rank() {
		return $this->belongsTo('Rank');
	}

	public function external_training() {
		return $this->hasMany('External_Training');
	}
	
	public function et_queue() {
		return $this->hasMany('ET_Queue');
	}

	public function employee() {
		return $this->belongsTo('Employee');
	}

	public function participant_assessment() {
		return $this->hasMany('Participant_Assessment');
	}
	
}

?>