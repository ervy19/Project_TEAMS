<?php

class Assessment_Response extends Eloquent {

	protected $table ='assessment_responses';

	protected $fillable = array('id', 'name', 'rating', 'participant_assessment_id', 'isActive');

	public function participant_assessment() {
		return $this->belongsTo('Participant_Assessment');
	}
	
}

?>