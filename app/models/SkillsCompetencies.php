<?php

class SkillsCompetencies extends Eloquent {

	protected $table = 'skills_competencies';

	protected $fillable = array('id', 'name', 'isActive');

	public function position_sc() {
		return $this->hasMany('Position_SC');
	}

	public function department_sc() {
		return $this->hasMany('Department_SC');
	}

	public function it_addressed_sc() {
		return $this->hasOne('IT_Addressed_SC');
	}

	public function et_addressed_sc() {
		return $this->hasOne('ET_Addressed_SC');
	}
	
}