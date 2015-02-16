<?php

class Position_SC extends Eloquent {

	protected $table ='position_sc';

	protected $fillable = array('skills_competencies_id', 'position_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('name');

	public function position() {
		return $this->hasOne('Position');
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