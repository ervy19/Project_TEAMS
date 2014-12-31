<?php

class Participant_Attendance extends Eloquent {

	protected $table ='participant_attendances';

	protected $fillable = array('id', 'date', 'time', 'it_participant_id', 'isActive');

	public function it_participant() {
		return $this->hasMany('IT_Participant');
	}
}

?>