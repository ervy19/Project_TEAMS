<?php

class IT_Addressed_SC extends Eloquent {

	protected $table ='it_addressed_sc';

	protected $fillable = array('skills_competencies_id', 'internal_training_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('name');

	public function skillscompetencies() {
		return $this->hasMany('SkillsCompetencies');
	}

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
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