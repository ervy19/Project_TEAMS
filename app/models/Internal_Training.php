<?php

class Internal_Training extends Eloquent {

	protected $table ='internal_trainings';

	protected $fillable = array('id', 'title', 'theme_topic', 'venue', 'date_start', 'date_end', 'time_start', 'time_end', 'objectives', 'expected_outcome', 'evaluation_narrative', 'recommendations', 'organizer_schools_colleges_id', 'organizer_department_id', 'isTrainingPlan', 'isActive');

	public function department() {
		return $this->belongsTo('Department');
	}
	
	public function school_college() {
		return $this->belongsTo('School_College');
	}

	public function participant_assessment() {
		return $this->hasMany('Participant_Assessment');
	}

	public function it_addressed_sc() {
		return $this->hasMany('IT_Addressed_SC');
	}

	public function focus_area() {
		return $this->hasOne('Focus_Areas');
	}

	public function it_attendance() {
		return $this->hasMany('IT_Attendance');
	}

	public function speaker() {
		return $this->hasMany('Speaker');
	}

	public function speaker_evaluation() {
		return $this->hasOne('Speaker_Evaluation');
	}

	public function activity_evaluation() {
		return $this->hasOne('Activity_Evaluation');
	}
}

?>