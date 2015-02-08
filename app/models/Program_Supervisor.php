<?php

class Program_Supervisor extends Eloquent {

	protected $table ='program_supervisors';

	protected $fillable = array('supervisor_id', 'campus_id', 'isActive');

	public function supervisor() {
		return $this->hasOne('Supervisor');
	}

	public function campus() {
		return $this->belongsTo('Campus');
	}
}

?>