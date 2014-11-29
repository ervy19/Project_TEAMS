<?php

class Position_SC extends Eloquent {

	protected $table ='position_sc';

	protected $fillable = array('id', 'skills_competencies_id', 'position_id', 'isActive');

	public function position() {
		return $this->hasOne('Position');
	}

	public function skill_competency() {
		return $this->hasOne('Skill_Competency');
	}
	
}

?>