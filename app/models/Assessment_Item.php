<?php

class Assessment_Item extends Eloquent {

	protected $table ='assessment_items';

	protected $fillable = array('id', 'name', 'rating', 'participant_assesssment_id', 'isActive');

	public function participant_assessment() {
		return $this->hasOne('Participant_Assessment');
	}
	
}

?>