<?php

class ET_Addressed_SC extends Eloquent {

	protected $table ='et_addressed_sc';

	protected $fillable = array('id', 'skills_competencies_id', 'external_training_id', 'isActive');

	public function skillscompetencies() {
		return $this->hasMany('SkillsCompetencies');
	}

	public function external_training() {
		return $this->belongsTo('External_Training');
	}
	
}

?>