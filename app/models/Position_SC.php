<?php

class Position_SC extends Eloquent {

	protected $table ='position_sc';

	protected $fillable = array('skills_competencies_id', 'position_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('name','position_needs');

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
	
	public function getPositionNeedsAttribute()
	{
		$position_needs = Employee_Designation::where('position_id','=',$this->position_id)
							->where('isActive','=',true)
							->count();

		return $position_needs;
	}
}

?>