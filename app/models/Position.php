<?php

class Position extends Eloquent {

	protected $table ='positions';

	protected $fillable = array('id', 'title', 'isActive');

	public function rank() {
		return $this->hasMany('Rank');
	}

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}

	public function position_SC() {
		return $this->hasMany('Position_SC');
	}
}

?>