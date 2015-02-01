<?php

class ET_Queue extends Eloquent {

	protected $table ='et_queues';

	protected $fillable = array('id', 'title', 'theme_topic', 'participation', 'organizer', 'venue', 'date_start', 'date_end', 'employee_id', 'isActive');

	public function employee() {
		return $this->hasOne('Employee');
	}

}

?>