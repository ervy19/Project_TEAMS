<?php

class Assessment_Item extends Eloquent {

	protected $table ='assessment_items';

	protected $fillable = array('id', 'name', 'training_id', 'isActive');

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}
}

?>