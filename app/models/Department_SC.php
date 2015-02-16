<?php

class Department_SC extends Eloquent {

	protected $table ='department_sc';

	protected $fillable = array('skills_competencies_id', 'department_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('name');

	public function department() {
		return $this->hasOne('Department');
	}

	public function skill_competency() {
		return $this->belongsToMany('SkillsCompetencies');
	}

	public function getNameAttribute()
	{
		$sc = SkillsCompetencies::find($this->skills_competencies_id);

		if($sc)
		{
			return $sc->name;
		}
		else
		{
			return '';
		}
	}
	
}

?>