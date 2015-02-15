<?php

class SkillsCompetencies extends Eloquent {

	protected $table = 'skills_competencies';

	protected $fillable = array('name', 'description', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('internaltrainings_tagged', 'externaltrainings_tagged', 'trainings_tagged', 'departments_tagged', 'positions_tagged');

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

	public function getInternaltrainingsTaggedAttribute()
	{
		$internal_tagged = IT_Addressed_SC::where('isActive','=',true)->where('skills_competencies_id','=',$this->id)->count();
		
		return $internal_tagged;
	}

	public function getExternaltrainingsTaggedAttribute()
	{
		$external_tagged = ET_Addressed_SC::where('isActive','=',true)->where('skills_competencies_id','=',$this->id)->count();
		
		return $external_tagged;
	}

	public function getTrainingsTaggedAttribute()
	{
		
		$trainings_tagged = IT_Addressed_SC::where('isActive','=',true)->where('skills_competencies_id','=',$this->id)->count();
		$trainings_tagged += ET_Addressed_SC::where('isActive','=',true)->where('skills_competencies_id','=',$this->id)->count();

		return $trainings_tagged;
	}

	public function getDepartmentsTaggedAttribute()
	{
		$departments_tagged = Department_SC::where('isActive','=',true)->where('skills_competencies_id','=',$this->id)->count();

		return $departments_tagged;
	}

	public function getPositionsTaggedAttribute()
	{
		$positions_tagged = Position_SC::where('isActive','=',true)->where('skills_competencies_id','=',$this->id)->count();

		return $positions_tagged;
	}
}