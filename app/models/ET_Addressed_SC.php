<?php

class ET_Addressed_SC extends Eloquent {

	protected $table ='et_addressed_sc';

	protected $fillable = array('id', 'skills_competencies_id', 'internal_training_id', 'isActive');

	public function skill_competency() {
		return $this->hasOne('Skill_Competency');
	}

	public function external_training() {
		return $this->hasOne('External_Training');
	}
	
}

?>