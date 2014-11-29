<?php

class ET_Queue extends Eloquent {

	protected $table ='et_queues';

	protected $fillable = array('id', 'title', 'theme_topic', 'participation', 'organizer', 'venue', 'date_start', 'date_end', 'designation_id', 'isActive');

	public function employee_designation() {
		return $this->hasOne('Employee_Designation');
	}

}

?>