<?php

class Speaker_Evaluation extends Eloquent {

	protected $table ='speaker_evaluations';

	protected $fillable = array('id', 'evaluation_criterion1', 'evaluation_criterion2', 'evaluation_criterion3', 'training_id', 'speaker_id', 'isActive');

	public function internal_training() {
		return $this->hasOne('Internal_Training');
	}

	public function speaker()) {
		return $this->belongsTo('Speaker');
	}
	
}

?>