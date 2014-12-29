<?php

class Training extends Eloquent {

	protected $table ='trainings';

	protected $fillable = array('id', 'title', 'theme_topic', 'venue', 'schedule', 'isTrainingPlan', 'isActive');

}

?>