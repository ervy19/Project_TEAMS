<?php

class Employee extends Eloquent {

	protected $table ='employees';

	protected $fillable = array('id', 'employee_number', 'name', 'email', 'age', 'tenure', 'isActive');

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}

	public function educational_attainment() {
		return $this->hasMany('Educational_Attainment');
	}

	public function IT_attendance() {
		return $this->belongsToMany('IT_Attendance');
	}
}

?>