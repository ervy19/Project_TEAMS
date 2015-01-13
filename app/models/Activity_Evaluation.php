<?php

class Activity_Evaluation extends Eloquent {

	protected $table ='activity_evaluations';

	protected $fillable = array('id', 'planning_criterion1', 'planning_criterion2', 'objectives_criterion1', 'objectives_criterion2', 'objectives_criterion3', 'content_criterion1', 'content_criterion2', 'materials_criterion1', 'materials_criterion2', 'schedule_criterion1', 'schedule_criterion2', 'schedule_criterion3', 'openForum_criterion1', 'openForum_criterion2', 'openForum_criterion3', 'venue_criterion1', 'venue_criterion2', 'comments', 'internal_training_id', 'isActive');

	public function internal_training() {
		return $this->belongsTo('Internal_Training');
	}
	
}

?>