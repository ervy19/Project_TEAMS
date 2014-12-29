<?php

class Campus_Supervisor extends Eloquent {

	protected $table ='campus_supervisors';

	protected $fillable = array('supervisor_id', 'name', 'title', 'campus_id', 'isActive');

	public function supervisor() {
		return $this->hasOne('Supervisor');
	}

	public function campus() {
		return $this->belongsTo('Campus');
	}
}

?>