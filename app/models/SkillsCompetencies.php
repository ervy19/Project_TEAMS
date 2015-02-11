<?php

class SkillsCompetencies extends Eloquent {

	protected $table = 'skills_competencies';

	protected $fillable = array('name', 'description', 'isActive');

	protected $guarded = 'id';

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

	public function positionsCountRelation()
	{
	    return $this->position_sc()->selectRaw('skills_competencies_id, count(*) as count')
	        ->groupBy('skills_competencies_id');
	}

	public function getPositionsCountAttribute()
	{

	    return $this->positionsCountRelation ?
	    	$this->positionsCountRelation->count:0;
	}

}