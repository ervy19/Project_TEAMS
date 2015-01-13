<?php

class Speaker_Evaluation extends Eloquent {

	protected $table ='speaker_evaluations';

	protected $fillable = array('id', 'evaluation_criterion1', 'evaluation_criterion2', 'evaluation_criterion3', 'speaker_id', 'isActive');

	public function speaker() {
		return $this->belongsTo('Speaker');
	}
	
}

?>