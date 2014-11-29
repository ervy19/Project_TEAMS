<?php

class Educational_Attainment extends Eloquent {

	protected $table ='educational_attainment';

	protected $fillable = array('id', 'degree_title', 'degree_course', 'institution', 'year_attained', 'employee_id', 'isActive');

	public function employee() {
		return $this->hasOne('Employee');
	}

}

?>