<?php

class HR_Account extends Eloquent {

	protected $table ='hr_accounts';

	protected $fillable = array('name', 'user_id', 'isActive');

	protected $guarded = 'id';
	
	public function users() {
		return $this->belongsTo('users');
	}	
}

?>