<?php

class Speaker extends Eloquent {

	protected $table ='speakers';

	protected $fillable = array('id', 'name', 'topic', 'educational_background', 'work_background', 'training_id', 'isActive');

	public function internal_training() {
		return $this->hasMany('Internal_Training');
	}

	public function speaker_evaluation()) {
		return $this->hasMany('Speaker_Evaluation');
	}
	
}

?>