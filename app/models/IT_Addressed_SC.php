<?php

class IT_Addressed_SC extends Eloquent {

	protected $table ='it_addressed_sc';

	protected $fillable = array('id', 'skills_competencies_id', 'internal_training_id', 'isActive');

	public function skill_competency() {
		return $this->hasMany('Skill_Competency');
	}

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}
	
}

?>