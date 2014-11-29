<?php

class Department_SC extends Eloquent {

	protected $table ='department_sc';

	protected $fillable = array('id', 'skills_competencies_id', 'department_id', 'isActive');

	public function department() {
		return $this->hasOne('Department');
	}

	public function skill_competency()) {
		return $this->hasOne('Skill_Competency');
	}
	
}

?>