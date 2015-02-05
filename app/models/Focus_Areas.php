<?php

class Focus_Areas extends Eloquent {

	protected $table ='focus_area';

	protected $fillable = array('instructional_strategy', 'evaluation_of_learning', 'curriculum_enrichment', 'research_aid_instruction', 'content_update', 'materials_production', 'others', 'training_id', 'isActive');

	protected $guarded = 'id';

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}
	
}

?>