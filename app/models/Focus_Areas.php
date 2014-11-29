<?php

class Focus_Areas extends Eloquent {

	protected $table ='focus_area';

	protected $fillable = array('id', 'instructional_strategy', 'evaluation_of_learning', 'curriculum_enrichment', 'research_aid_instruction', 'content_update', 'materials_production', 'others', 'training_id', 'isActive');

	public function internal_training() {
		return $this->hasOne('Internal_Training');
	}
	
}

?>