<?php

class Rank extends Eloquent {

	protected $table ='ranks';

	protected $fillable = array('code', 'title', 'level', 'isActive');

	protected $guarded = 'id';

	public function position() {
		return $this->hasOne('Positions');
	}

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}
	
}

?>