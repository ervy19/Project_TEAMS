<?php

class ET_Addressed_SC extends Eloquent {

	protected $table ='et_addressed_sc';

	protected $fillable = array('skills_competencies_id', 'external_training_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('name');

	public function skillscompetencies() {
		return $this->hasMany('SkillsCompetencies');
	}

	public function external_training() {
		return $this->belongsTo('External_Training');
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