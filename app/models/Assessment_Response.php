<?php

class Assessment_Response extends Eloquent {

	protected $table ='assessment_responses';

	protected $fillable = array('name', 'rating', 'participant_assessment_id', 'isActive');

	protected $guarded = 'id';

	public function participant_assessment() {
		return $this->belongsTo('Participant_Assessment');
	}
	
}

?>