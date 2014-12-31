<?php

class Participant_Assessment extends Eloquent {

	protected $table ='participant_assessments';

	protected $fillable = array('id', 'type', 'rating', 'verbal_interpretation', 'remarks', 'it_participant_id', 'isActive');

	public function it_participant() {
		return $this->belongsTo('IT_Participant');
	}
	
}

?>