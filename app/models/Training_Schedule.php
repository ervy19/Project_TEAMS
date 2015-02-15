<?php

class Training_Schedule extends Eloquent {

	protected $table ='training_schedules';

	protected $fillable = array('id', 'date_scheduled', 'timeslot', 'isStartDate', 'isEndDate', 'training_id', 'et_id', 'isActive');

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}

	public function et_queue() {
		return $this->belongsTo('ET_Queue');
	}
	
}

?>