<?php

class Training extends Eloquent {

	protected $table ='trainings';

	protected $fillable = array('title', 'theme_topic', 'venue', 'schedule', 'isTrainingPlan', 'isActive');

	protected $guarded = 'id';

	public function internal_training() {
		return $this->hasOne('Internal_Training');
	}

	public function external_training() {
		return $this->hasOne('External_Training');
	}

}

?>